<?php
/*
$db = null;

try {
  $db = new mysqli('localhost', 'root', '', 'proje');
} catch (Exception $e) {
  die('Bağlantı hatası: ' . $e->getMessage());
}

$db->query("CREATE DATABASE project");
$db->query("USE project");

$db->query(
  "CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
);

$db->query(
  "CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(7) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
);
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>init</title>
</head>
<body>
  <h1>Veritabanı başarıyla oluşturuldu.</hh1>
  <a href="index.php">Anasayfa</a>
</body>
</html>