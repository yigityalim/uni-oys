<?php
session_start();
require 'helpers.php';
require 'db.php';

if (!session('user')) return;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    $target_dir = "public/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    $acceptedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!in_array($imageFileType, $acceptedExtensions)) {
        echo "Sadece JPG, JPEG, PNG & GIF dosyaları yüklenebilir.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 1000000) {
        echo "Dosya boyutu 1MB'dan küçük olmalıdır.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            $db = new Database();
            $db->update('students')
                ->where('id', session('user')['id'])
                ->set([
                    'picture' => $target_file
                ]);
            header('Location: index.php');
        }
    }
}