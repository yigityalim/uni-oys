<?php

use JetBrains\PhpStorm\NoReturn;

const METHOD = 'AES-128-ECB';
const KEY = 'secret';

class Helpers
{

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

    public static function get($key, $value = null)
    {
        return self::fetch($key, $value, 'GET');
    }

    public static function post($key, $value = null)
    {
        return self::fetch($key, $value, 'POST');
    }

    public static function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public static function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
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

    public static function upload_image($file): string
    {
        if ($file) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;

            $acceptedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (!in_array($imageFileType, $acceptedExtensions)) {
                return "Sadece JPG, JPEG, PNG & GIF dosyaları yüklenebilir.";
            }

            if ($_FILES["image"]["size"] > 1000000) {
                return "Dosya boyutu 1MB'dan küçük olmalıdır.";
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    return $target_file;
                } else {
                    return "Resim yüklenirken bir hata oluştu.";
                }
            } else {
                return '';
            }
        } else {
            return "Resim yüklenemedi.";
        }
    }
}
