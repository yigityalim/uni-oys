<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/auth/login/student');
}
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje'. '/constants.php';

$db = new Database();

$student = $_SESSION['student'];
$season_id = $_GET['season'] ?? SEASON;
$faculty_id = $_GET['id'] ?? 1;

$seasons = $db->from('courses')->select('season')->where('department_id', $student['department_id'])->distinct()->all();
$faculty = $db->from('faculties')->where('id', $faculty_id)->first();
$faculties = $db->from('faculties')->all();
$courses = $db->from('courses')->where('department_id', $faculty['id'])->all();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <script src="/proje/public/bootstrap.min.js"></script>
    <title>ÖYS | Öğrenci</title>
</head>
<body class="bg-light">
<header class="navbar justify-content-start fixed-top bg-white shadow-sm px-3 py-0">
    <a href="/proje/home/student" class="navbar-brand d-flex align-items-center m-1">
        <img width="50"
             src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logocompact/300x300/1709033358/kucuk.PNG"
             class="logo mr-1" alt="ÖYS">
    </a>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home/student/index.php">Anasayfa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home/student/courses/">Dersler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home/student/grade">Başarı Notlarım</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home/student/academician">Akademisyen</a>
            </li>
        </ul>
    </nav>
    <div class="dropdown ms-auto">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $student['name'] ?>
            <img src="/proje/<?= $student['image_url'] ?>" width="30" class="ms-2 rounded-circle"
                 alt="Avatar">
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="/proje/home/student/profile">Profil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="/proje/home/student/academician">Akademisyen</a></li>
            <li><a class="dropdown-item" href="/proje/home/student/grade">Başarı Notlarım</a></li>
            <li>
                <a class="dropdown-item" href="/proje/home/student/courses">Tüm Dersler</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <?php foreach ($seasons as $season): ?>
                <li>
                    <a class="dropdown-item <?= isset($_GET['season']) && $_GET['season'] === $season['season'] ? 'active' : '' ?>"
                       href="/proje/home/student/index.php?season=<?= $season['season'] ?>"><?= $season['season'] ?></a>
                </li>
            <?php endforeach; ?>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="/proje/auth/logout/student.php">Çıkış Yap</a></li>
        </ul>
    </div>
</header>
<main class="container-fluid" style="margin-top: 56px;">
    <header class="row">
        <div class="col-12 py-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="d-flex w-100 justify-content-between">
                            <h1 class="fw-light"><?= $faculty['name'] ?></h1>
                            <div class="d-flex flex-column justify-content-center align-items-end">
                                <p class="text-muted mb-0"><?= date('d.m.Y') ?></p>
                                <p class="text-muted mb-0">Tüm Dönemler</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/proje/home/student" class="text-decoration-none">Ana sayfa</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/proje/home/student/faculties" class="text-decoration-none">Fakülteler</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-start fs-3 mb-3 mt-2">Hoşgeldin, <?= $student['name'] ?>!</h1>
    </header>
    <section>
        <div class="row gx-3">
            <?php if (!empty($courses)): ?>
                <div class="col-2">
                    <div class="p-3 border bg-light rounded-3">
                        <h5 class="fw-light">Gezinme</h5>
                        <ul class="nav flex-column">
                            <?php foreach ($courses as $course): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-primary"
                                       href="/proje/home/student/courses/index.php?code=<?= $course['code'] ?>">
                                        <?= $course['code'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <div class="<?= !empty($courses) ? 'col-10' : 'col-12' ?>">
                <div class="w-100 p-3 border bg-light rounded-3">
                    <h1 class="fw-light fs-3">Tüm Fakülteler</h1>
                    <p class="w-25 d-inline-flex gap-1">
                        <a class="btn btn-primary w-100" data-bs-toggle="collapse" href="#collapseExample" role="button"
                           aria-expanded="false" aria-controls="collapseExample">
                            Aç
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <?php foreach ($faculties as $faculty): ?>
                                <a href="/proje/home/student/faculties/index.php?id=<?= $faculty['id'] ?>"
                                   class="text-decoration-none text-primary">
                                    <?= $faculty['name'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <h1 class="fw-light fs-3 mt-3">Dersler</h1>
                    <ul class="list-group list-group-flush">
                        <?php if (empty($courses)): ?>
                            <li class="list-group list-group-item mb-1 rounded  ">
                                <p class="text-muted mb-0">Henüz ders eklenmemiş.</p>
                            </li>
                        <?php else: ?>
                            <?php foreach ($courses as $course): ?>
                                <li class="list-group list-group-item mb-1 rounded  ">
                                    <a href="/proje/home/student/courses/index.php?code=<?= $course['code'] ?>"
                                       class="text-decoration-none text-primary">
                                        <?= $course['name'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
