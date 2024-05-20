<?php
session_start();
if (!isset($_SESSION['akademisyen'])):
    header('location: /proje/auth/login/academician');
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
    <style>html, body {height: 100%}</style>
</head>
<body class="bg-dark bg-gradient p-5">
<div class="container-fluid bg-dark rounded-2 p-4">
    <div class="row justify-content-center">
        <!-- sidebar -->
        <div class="col-2 border-end border-dark-subtle">
            <div class="list-group bg-dark">
                <a href="/proje/home/academician/lessons" class="list-group-item list-group-item-action bg-dark text-white border-dark">Dersler</a>
                <a href="/proje/home/academician/exams" class="list-group-item list-group-item-action bg-dark text-white border-dark">Sınavlar</a>
                <a href="/proje/home/academician/exam-results" class="list-group-item list-group-item-action bg-dark text-white border-dark">Sınav Sonuçları</a>
                <a href="/proje/home/academician/attendance" class="list-group-item list-group-item-action bg-dark text-white border-dark">Devam Durumu</a>
                <a href="/proje/home/academician/attendance-results" class="list-group-item list-group-item-action bg-dark text-white border-dark">Devam Durumu Sonuçları</a>
                <a href="/proje/home/academician/assignments" class="list-group-item list-group-item-action bg-dark text-white border-dark">Ödevler</a>
                <a href="/proje/home/academician/assignment-results" class="list-group-item list-group-item-action bg-dark text-white border-dark">Ödev Sonuçları</a>
                <a href="/proje/home/academician/announcements" class="list-group-item list-group-item-action bg-dark text-white border-dark">Duyurular</a>
                <a href="/proje/home/academician/settings" class="list-group-item list-group-item-action bg-dark text-white border-dark">Ayarlar</a>
                <a href="/proje/auth/logout/academician.php" class="list-group-item list-group-item-action border-dark bg-danger text-white rounded">Çıkış Yap</a>
            </div>
        </div>
        <!-- content -->
        <div class="col-10">
            <div class="card bg-dark border-dark">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg"
                             alt="Baskent University" class="img-fluid">
                    </div>
                    <h4 class="text-start">Akademisyen Paneli</h4>
                    <h3 class="text-start text-muted">Hoşgeldiniz, <?= $academician['name'] ?></h3>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Dersler</h5>
                                    <p class="card-text text-center">Derslerinizi görüntüleyin ve düzenleyin</p>
                                    <a href="/proje/home/academician/lessons" class="btn btn-primary w-100">Derslere Git</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Sınavlar</h5>
                                    <p class="card-text text-center">Sınavlarınızı görüntüleyin ve düzenleyin</p>
                                    <a href="/proje/home/academician/exams" class="btn btn-primary w-100">Sınavlara Git</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Sınav Sonuçları</h5>
                                    <p class="card-text text-center">Sınav sonuçlarınızı görüntüleyin</p>
                                    <a href="/proje/home/academician/exam-results" class="btn btn-primary w-100">Sonuçlara Git</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Devam Durumu</h5>
                                    <p class="card-text text-center">Devam durumlarınızı görüntüleyin</p>
                                    <a href="/proje/home/academician/attendance" class="btn btn-primary w-100">Devam Durumuna Git</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Devam Durumu Sonuçları</h5>
                                    <p class="card-text text-center">Devam durumu sonuçlarınızı görüntüleyin</p>
                                    <a href="/proje/home/academician/attendance-results" class="btn btn-primary w-100">Sonuçlara Git</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Ödevler</h5>
                                    <p class="card-text text-center">Ödevlerinizi görüntüleyin ve düzenleyin</p>
                                    <a href="/proje/home/academician/assignments" class="btn btn-primary w-100">Ödevlere Git</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Ödev Sonuçları</h5>
                                    <p class="card-text text-center">Ödev sonuçlarınızı görüntüleyin</p>
                                    <a href="/proje/home/academician/assignment-results" class="btn btn-primary w-100">Sonuçlara Git</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Duyurular</h5>
                                    <p class="card-text text-center">Duyurularınızı görüntüleyin ve düzenleyin</p>
                                    <a href="/proje/home/academician/announcements" class="btn btn-primary w-100">Duyurulara Git</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Ayarlar</h5>
                                    <p class="card-text text-center">Ayarlarınızı düzenleyin</p>
                                    <a href="/proje/home/academician/settings" class="btn btn-primary w-100">Ayarlar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
