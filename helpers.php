<?php

use JetBrains\PhpStorm\NoReturn;

const METHOD = 'AES-128-ECB';
const KEY = 'secret';

class Helpers
{

    public static function session($key, $value = null)
    {
        if ($value) {
            $_SESSION[$key] = $value;
        } else {
            return $_SESSION[$key] ?? null;
        }

        return null;
    }

    public static function logout(): void
    {
        session_destroy();
        $_SESSION['user'] = null;
    }

    public static function redirect($url,  $status = 302): void
    {
        header("Location: $url", true, $status);
        exit;
    }

    public function get($key, $value = null)
    {
        return self::fetch($key, $value, 'GET');
    }

    public static function post($key, $value = null)
    {
        return self::fetch($key, $value, 'POST');
    }

    public static function fetch($key, $value, $method)
    {
        if ($method === 'GET') {
            return $_GET[$key] ?? $value;
        } else {
            return $_POST[$key] ?? $value;
        }
    }

    public static function openssl_enc($data): bool|string
    {
        return openssl_encrypt($data, METHOD, KEY);
    }

    public static function openssl_dec($data): bool|string
    {
        return openssl_decrypt($data, METHOD, KEY);
    }

    public static function asset($path): string
    {
        return "/$path";
    }
}
