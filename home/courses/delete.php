<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();
$id = $_GET['id'];

// kursu silme işlemi
// burada öğrencinin ders kaydını siliyoruz. DERS SİLİNMEYECEK.

header('Location: /proje/home/courses/index.php');


