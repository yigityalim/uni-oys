<?php
session_start();
if (!isset($_SESSION['akademisyen'])):
    header('location: /proje/auth/login/student');
endif;

$academician = $_SESSION['akademisyen'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <script src="/proje/public/bootstrap.min.js" defer async type="module"></script>
    <title>ÖYS | Akademisyen</title>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg"
                             alt="Baskent University" class="img-fluid">
                    </div>
                    <h4 class="text-center">Akademisyen Paneli</h4>
                    <h3 class="text-center text-muted">Hoşgeldiniz, <?= $academician['name'] ?></h3>
                    <hr>
                    <div class="list-group list-group-flush">
                        <a href="/proje/home/academician/lessons"
                           class="list-group-item list-group-item-action">Dersler</a>
                        <a href="/proje/home/academician/exams"
                           class="list-group-item list-group-item-action">Sınavlar</a>
                        <a href="/proje/home/academician/exam-results" class="list-group-item list-group-item-action">Sınav
                            Sonuçları</a>
                        <a href="/proje/home/academician/attendance" class="list-group-item list-group-item-action">Devam
                            Durumu</a>
                        <a href="/proje/home/academician/attendance-results"
                           class="list-group-item list-group-item-action">Devam Durumu Sonuçları</a>
                        <a href="/proje/home/academician/assignments" class="list-group-item list-group-item-action">Ödevler</a>
                        <a href="/proje/home/academician/assignment-results"
                           class="list-group-item list-group-item-action">Ödev Sonuçları</a>
                        <a href="/proje/home/academician/announcements" class="list-group-item list-group-item-action">Duyurular</a>
                        <a href="/proje/home/academician/settings" class="list-group-item list-group-item-action">Ayarlar</a>
                        <a href="/proje/logout" class="list-group-item list-group-item-action text-danger">Çıkış Yap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
