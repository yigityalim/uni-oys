<?php

use JetBrains\PhpStorm\NoReturn;

const method = 'AES-128-ECB';
const key = 'secret';

function session($key, $value = null)
{
    if ($value) {
        $_SESSION[$key] = $value;
    } else {
        return $_SESSION[$key] ?? null;
    }

    return null;
}

function logout(): void
{
    session_destroy();
    $_SESSION = [];
}

#[NoReturn] function redirect($url,  $status = 302): void
{
    header("Location: $url", true, $status);
    exit;
}

function get($key, $value = null)
{
    return fetch($key, $value, 'GET');
}

function post($key, $value = null)
{
    return fetch($key, $value, 'POST');
}

function fetch($key, $value, $method)
{
    if ($method === 'GET') {
        return $_GET[$key] ?? $value;
    } else {
        return $_POST[$key] ?? $value;
    }
}

function openssl_enc($data): bool|string
{
    return openssl_encrypt($data, method, key);
}

function openssl_dec($data): bool|string
{
    return openssl_decrypt($data, method, key);
}

function asset($path): string
{
    return "/$path";
}