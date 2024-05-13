<?php

Session::checkLogin();

function upload_image(): string
{
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
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