<?php

class Database extends \PDO
{
    private mixed $dbName;
    private $type;
    private $sql;
    private $unionSql;
    private $tableName;
    private $where;
    private $having;
    private $grouped;
    private $group_id;
    private $join;
    private $orderBy;
    private $groupBy;
    private $limit;
    public bool $debug = false;
    public array $reference = [
        'NOW()'
    ];

    public function __construct($configFile = 'config.ini')
    {
        if (file_exists($configFile)) {
            $config = parse_ini_file($configFile);
            $host = $config['host'];
            $dbname = $config['schema'];
            $username = $config['username'];
            $password = $config['password'];
            $charset = $config['charset'];
        } else {
            die('Config dosyası bulunamadı.');
        }
        try {
            parent::__construct('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
            $this->dbName = $dbname;
            $this->query('SET CHARACTER SET ' . $charset);
            $this->query('SET NAMES ' . $charset);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            $this->showError($e);
        }
    }

    public function __destruct()
    {
        $this->sql = null;
    }

    public function from($tableName): static
    {
        $this->sql = 'SELECT * FROM ' . $tableName;
        $this->tableName = $tableName;
        return $this;
    }

    public function select($columns): static
    {
        $this->sql = str_replace(' * ', ' ' . $columns . ' ', $this->sql);
        return $this;
    }

    public function union(): static
    {
        $this->type = 'union';
        $this->unionSql = $this->sql;
        return $this;
    }

    public function group(Closure $fn): static
    {
        static $group_id = 0;
        $this->grouped = true;
        call_user_func_array($fn, [$this]);
        $this->group_id = ++$group_id;
        $this->grouped = false;
        return $this;
    }

    public function where($column, $value = '', $mark = '=', $logical = '&&'): static
    {
        $this->where[] = [
            'column' => $column,
            'value' => $value,
            'mark' => $mark,
            'logical' => $logical,
            'grouped' => $this->grouped,
            'group_id' => $this->group_id
        ];
        return $this;
    }

    public function having($column, $value = '', $mark = '=', $logical = '&&')
    {
        $this->having[] = [
            'column' => $column,
            'value' => $value,
            'mark' => $mark,
            'logical' => $logical,
            'grouped' => $this->grouped,
            'group_id' => $this->group_id
        ];
        return $this;
    }

    public function or_where($column, $value, $mark = '=')
    {
        $this->where($column, $value, $mark, '||');
        return $this;
    }

    public function or_having($column, $value, $mark = '=')
    {
        $this->having($column, $value, $mark, '||');
        return $this;
    }

    public function join($targetTable, $joinSql, $joinType = 'inner')
    {
        $this->join[] = ' ' . strtoupper($joinType) . ' JOIN ' . $targetTable . ' ON ' . sprintf($joinSql, $targetTable, $this->tableName);
        return $this;
    }

    public function leftJoin($targetTable, $joinSql)
    {
        $this->join($targetTable, $joinSql, 'left');
        return $this;
    }

    public function rightJoin($targetTable, $joinSql)
    {
        $this->join($targetTable, $joinSql, 'right');
        return $this;
    }

    public function orderBy($columnName, $sort = 'ASC')
    {
        $this->orderBy = ' ORDER BY ' . $columnName . ' ' . $sort;
        return $this;
    }

    public function groupBy($columnName)
    {
        $this->groupBy = ' GROUP BY ' . $columnName;
        return $this;
    }

    public function limit($start, $limit)
    {
        $this->limit = ' LIMIT ' . $start . ',' . $limit;
        return $this;
    }

    public function all(): bool|array
    {
        try {
            $query = $this->generateQuery();
            return $query->fetchAll(parent::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->showError($e);
        }

        return false;
    }

    public function first()
    {
        try {
            $query = $this->generateQuery();
            return $query->fetch(parent::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->showError($e);
        }
    }

    public function generateQuery(): bool|PDOStatement
    {
        if ($this->join) {
            $this->sql .= implode(' ', $this->join);
            $this->join = null;
        }
        $this->get_where('where');
        if ($this->groupBy) {
            $this->sql .= $this->groupBy;
            $this->groupBy = null;
        }
        $this->get_where('having');
        if ($this->orderBy) {
            $this->sql .= $this->orderBy;
            $this->orderBy = null;
        }
        if ($this->limit) {
            $this->sql .= $this->limit;
            $this->limit = null;
        }
        if ($this->type == 'union') {
            $this->sql = $this->unionSql . ' UNION ALL ' . $this->sql;
        }
        if ($this->debug) {
            echo $this->getSqlString();
        }
        $this->type = '';
        $query = $this->query($this->sql);
        return $query;
    }

    private function get_where($conditionType = 'where'): void
    {
        if (
            (is_array($this->{$conditionType}) && count($this->{$conditionType}) > 0)
        ) {
            $whereClause = ' ' . ($conditionType == 'having' ? 'HAVING' : 'WHERE') . ' ';
            $arrs = $this->{$conditionType};
            if (is_array($arrs)) {
                foreach ($arrs as $key => $item) {
                    if (
                        $item['grouped'] === true &&
                        (
                            (
                                (isset($arrs[$key - 1]) && $arrs[$key - 1]['grouped'] !== true) ||
                                (isset($arrs[$key - 1]) && $arrs[$key - 1]['group_id'] != $item['group_id'])
                            ) ||
                            (
                                (isset($arrs[$key - 1]) && $arrs[$key - 1]['grouped'] !== true) ||
                                (!isset($arrs[$key - 1]))
                            )
                        )
                    ) {
                        $whereClause .= (isset($arrs[$key - 1]) && $arrs[$key - 1]['grouped'] == true ? ' ' . $item['logical'] : null) . ' (';
                    }
                    switch ($item['mark']) {
                        case 'LIKE':
                            $where = $item['column'] . ' LIKE "%' . $item['value'] . '%"';
                            break;
                        case 'NOT LIKE':
                            $where = $item['column'] . ' NOT LIKE "%' . $item['value'] . '%"';
                            break;
                        case 'BETWEEN':
                            $where = $item['column'] . ' BETWEEN "' . $item['value'][0] . '" AND "' . $item['value'][1] . '"';
                            break;
                        case 'NOT BETWEEN':
                            $where = $item['column'] . ' NOT BETWEEN "' . $item['value'][0] . '" AND "' . $item['value'][1] . '"';
                            break;
                        case 'FIND_IN_SET':
                            $where = 'FIND_IN_SET(' . $item['column'] . ', ' . $item['value'] . ')';
                            break;
                        case 'FIND_IN_SET_REVERSE':
                            $where = 'FIND_IN_SET(' . $item['value'] . ', ' . $item['column'] . ')';
                            break;
                        case 'IN':
                            $where = $item['column'] . ' IN("' . (is_array($item['value']) ? implode('", "', $item['value']) : $item['value']) . '")';
                            break;
                        case 'NOT IN':
                            $where = $item['column'] . ' NOT IN(' . (is_array($item['value']) ? implode(', ', $item['value']) : $item['value']) . ')';
                            break;
                        case 'SOUNDEX':
                            $where = 'SOUNDEX(' . $item['column'] . ') LIKE CONCAT(\'%\', TRIM(TRAILING \'0\' FROM SOUNDEX(\'' . $item['value'] . '\')), \'%\')';
                            break;
                        default:
                            $where = $item['column'] . ' ' . $item['mark'] . ' ' . (preg_grep('/' . trim($item['value']) . '/i', $this->reference) ? $item['value'] : '"' . $item['value'] . '"');
                            break;
                    }
                    if ($key == 0) {
                        if (
                            $item['grouped'] == false &&
                            isset($arrs[$key + 1]['grouped']) == true
                        ) {
                            $whereClause .= $where . ' ' . $item['logical'];
                        } else {
                            $whereClause .= $where;
                        }
                    } else {
                        $whereClause .= ' ' . $item['logical'] . ' ' . $where;
                    }
                    if (
                        $item['grouped'] === true &&
                        (
                            (
                                (isset($arrs[$key + 1]) && $arrs[$key + 1]['grouped'] !== true) ||
                                ($item['grouped'] === true && !isset($arrs[$key + 1]))
                            )
                            ||
                            (
                                (isset($arrs[$key + 1]) && $arrs[$key + 1]['group_id'] != $item['group_id']) ||
                                ($item['grouped'] === true && !isset($arrs[$key + 1]))
                            )
                        )
                    ) {
                        $whereClause .= ' )';
                    }
                }
            }
            $whereClause = rtrim($whereClause, '||');
            $whereClause = rtrim($whereClause, '&&');
            $whereClause = preg_replace('/\(\s+(\|\||&&)/', '(', $whereClause);
            $whereClause = preg_replace('/(\|\||&&)\s+\)/', ')', $whereClause);
            $this->sql .= $whereClause;
            $this->unionSql .= $whereClause;
            $this->{$conditionType} = null;
        }
    }

    public function insert($tableName): static
    {
        $this->sql = 'INSERT INTO ' . $tableName;
        return $this;
    }

    public function set($data, $value = null): bool
    {
        try {
            if ($value) {
                if (str_contains($value, '+')) {
                    $this->sql .= ' SET ' . $data . ' = ' . $data . ' ' . $value;
                    $executeValue = null;
                } elseif (str_contains($value, '-')) {
                    $this->sql .= ' SET ' . $data . ' = ' . $data . ' ' . $value;
                    $executeValue = null;
                } else {
                    $this->sql .= ' SET ' . $data . ' = :' . $data . '';
                    $executeValue = [
                        $data => $value
                    ];
                }
            } else {

                $this->sql .= ' SET ' . implode(', ', array_map(function ($item) {
                        return $item . ' = :' . $item;
                    }, array_keys($data)));
                $executeValue = $data;
            }
            $this->get_where('where');
            $this->get_where('having');
            $query = $this->prepare($this->sql);
            return $query->execute($executeValue);
        } catch (PDOException $e) {
            $this->showError($e);
        }

        return false;
    }

    public function lastId(): bool|string
    {
        return $this->lastInsertId();
    }

    public function update($tableName): static
    {
        $this->sql = 'UPDATE ' . $tableName;
        return $this;
    }

    public function delete($tableName): static
    {
        $this->sql = 'DELETE FROM ' . $tableName;
        return $this;
    }

    public function done()
    {
        try {
            $this->get_where('where');
            $this->get_where('having');
            $query = $this->exec($this->sql);
            return $query;
        } catch (PDOException $e) {
            $this->showError($e);
        }
    }

    public function total()
    {
        if ($this->join) {
            $this->sql .= implode(' ', $this->join);
            $this->join = null;
        }
        $this->get_where('where');
        if ($this->groupBy) {
            $this->sql .= $this->groupBy;
            $this->groupBy = null;
        }
        $this->get_where('having');
        if ($this->orderBy) {
            $this->sql .= $this->orderBy;
            $this->orderBy = null;
        }
        if ($this->limit) {
            $this->sql .= $this->limit;
            $this->limit = null;
        }
        $query = $this->query($this->sql)->fetch(parent::FETCH_ASSOC);
        return $query['total'];
    }

    public function getSqlString()
    {
        $this->get_where('where');
        $this->get_where('having');
        $this->showSuccess($this->sql, __CLASS__ . ' SQL Sorgusu');
    }

    public function between($column, $values = [])
    {
        $this->where($column, $values, 'BETWEEN');
        return $this;
    }

    public function in($column, $value): static
    {
        $this->where($column, $value, 'IN');
        return $this;
    }

    public function notIn($column, $value): static
    {
        $this->where($column, $value, 'NOT IN');
        return $this;
    }

    public function like($column, $value): static
    {
        $this->where($column, $value, 'LIKE');
        return $this;
    }

    public function notLike($column, $value): static
    {
        $this->where($column, $value, 'NOT LIKE');
        return $this;
    }

    public function soundex($column, $value): static
    {
        $this->where($column, $value, 'SOUNDEX');
        return $this;
    }

    public function __call($name, $args)
    {
        die($name . '  metodu ' . __CLASS__ . ' sınıfı içinde bulunamadı.');
    }

    private function showError(PDOException $error): void
    {
        $this->errorTemplate($error->getMessage());
    }

    private function errorTemplate($errorMsg, $title = null): void
    {
        ?>
        <div class="db-error-msg-content">
            <div class="db-error-title">
                <?= $title ? $title : __CLASS__ . ' Hatası:' ?>
            </div>
            <div class="db-error-msg"><?= $errorMsg ?></div>
        </div>
        <style>
            .db-error-msg-content {
                padding: 15px;
                border-left: 5px solid #c00000;
                background: rgba(192, 0, 0, 0.06);
                background: #f8f8f8;
                margin-bottom: 10px;
            }

            .db-error-title {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                font-size: 16px;
                font-weight: 500;
            }

            .db-error-msg {
                margin-top: 15px;
                font-size: 14px;
                font-family: Consolas, Monaco, Menlo, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, sans-serif;
                color: #c00000;
            }
        </style>
        <?php
    }

    private function showSuccess($successMsg, $title = null)
    {
        ?>
        <div class="db-success-msg-content">
            <div class="db-success-title">
                <?= $title ? $title : __CLASS__ . ' Başarılı:' ?>
            </div>
            <div class="db-success-msg"><?= $successMsg ?></div>
        </div>
        <style>
            .db-success-msg-content {
                padding: 15px;
                border-left: 5px solid #6495ED;
                background: rgba(100, 149, 237, 0.10);
                margin-bottom: 10px;
                border-radius: 2px;
            }

            @media (prefers-color-scheme: dark) {
                .db-success-msg-content {
                    background: rgba(100, 149, 237, 0.60);
                }

                .db-success-title {
                    color: #fff !important;
                }

                .db-success-msg {
                    color: #fff !important;
                }
            }

            .db-success-title {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                font-size: 16px;
                font-weight: 500;
                color: #6495ED;
            }

            .db-success-msg {
                margin-top: 15px;
                font-size: 14px;
                font-family: Consolas, Monaco, Menlo, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, sans-serif;
                color: rgba(100, 149, 237, 1);
            }
        </style>
        <?php
    }

    /**
     * Belirtilen tabloyu temizler
     *
     * @param $tableName
     * @return bool|PDOStatement
     */
    public function truncate($tableName)
    {
        return $this->query('TRUNCATE TABLE ' . $this->dbName . '.' . $tableName);
    }
    public function setAutoIncrement($tableName, $ai = 1)
    {
        return $this->query("ALTER TABLE `{$tableName}` AUTO_INCREMENT = {$ai}")->fetch();
    }

}