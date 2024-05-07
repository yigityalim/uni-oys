<?php

class Request
{
    public static function get(string $key, string $default = null): ?string
    {
        return isset($_GET[$key]) ? htmlspecialchars($_GET[$key]) : $default;
    }

    public static function post(string $key, string $default = null): ?string
    {
        return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : $default;
    }

    public static function has(string $key): bool
    {
        return isset($_REQUEST[$key]);
    }

    public static function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}
