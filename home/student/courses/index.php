<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/login/student');
}
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();
$error = false;

$student = $_SESSION['student'];
$season_id = SEASON;
$course = null;

$seasons = $db->from('courses')->select('season')->where('department_id', $student['department_id'])->distinct()->all();
$courses = $db->from('courses')->where('season', $season_id)->where('department_id', $student['department_id'])->all();
if (isset($_GET['code'])) {
    $course = $db->from('courses')->where('code', $_GET['code'])->first();
}
if (!$course) {
    $error = true;
}

$dates = [
    'Genel',
    '12 Şubat - 18 Şubat',
    '19 Şubat - 25 Şubat',
    '26 Şubat - 3 Mart',
    '4 Mart - 10 Mart',
    '11 Mart - 17 Mart',
    '18 Mart - 24 Mart',
    '25 Mart - 31 Mart',
    '1 Nisan - 7 Nisan',
    '8 Nisan - 14 Nisan',
    '15 Nisan - 21 Nisan',
    '22 Nisan - 28 Nisan',
    '29 Nisan - 5 Mayıs',
    '6 Mayıs - 12 Mayıs',
    '13 Mayıs - 19 Mayıs',
];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
            <li><a class="dropdown-item text-danger" href="/proje/logout/student.php">Çıkış Yap</a></li>
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
                            <h1 class="fw-light">
                                <?php if ($course): ?>
                                    <?= $course['code'] ?>
                                    <?= $course['name'] ?>
                                <?php else: ?>
                                    Tüm Dersler
                                <?php endif; ?>
                            </h1>
                            <div class="d-flex flex-column justify-content-center align-items-end">
                                <p class="text-muted mb-0"><?= date('d.m.Y') ?></p>
                                <p class="text-muted mb-0"><?= $season_id ?></p>
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
                                    <a href="/proje/home/student/courses/" class="text-decoration-none">Dersler</a>
                                </li>
                                <?php if ($course): ?>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?= $course['name'] ?>
                                    </li>
                                <?php else: ?>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Ders içeriği
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-start fs-3 mb-3 mt-2">Hoşgeldin, <?= $student['name'] ?>!</h1>
    </header>
    <section class="mb-5 ">
        <div class="row gx-3">
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
                <?php if (isset($_GET['code'])): ?>
                    <div class="p-3 border bg-light rounded-3 mt-3">
                        <h5 class="fw-light">Ders Yönetimi</h5>
                        <a href="/proje/home/student/courses/delete.php?code=<?= $course['code'] ?>"
                           class="btn btn-primary w-100">Dersi Kaldır</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-10">
                <div class="p-3 border bg-light rounded-3">
                    <?php if (!$error && isset($_GET['code'])): ?>
                        <div class="d-flex flex-column gap-3 align-items-start justify-content-center">
                            <?php foreach ($dates as $index => $week) : ?>
                                <a
                                        data-bs-toggle="collapse"
                                        href="#collapse-<?= $index ?>"
                                        class="text-black text-decoration-none border-bottom w-100 p-3 d-flex gap-3 align-items-center justify-content-start"
                                        style="<?= (getMatchingDateRange($week)) ? 'border-left: 5px solid #0d6efd;' : ''; ?>">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <h4 class="fw-light mb-0"><?= htmlspecialchars($week, ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <?php if (getMatchingDateRange($week)): ?>
                                        <span class="badge bg-primary">Bu Hafta</span>
                                    <?php endif; ?>
                                </a>
                                <div class="collapse" id="collapse-<?= $index ?>">
                                    <div class="card card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by
                                        default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <?php foreach ($courses as $course): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $course['name'] ?></h5>
                                    <p class="card-text"><?= $course['code'] ?></p>
                                    <a href="/proje/home/student/courses/index.php?code=<?= $course['code'] ?>"
                                       class="btn btn-primary">Ders içeriğine git</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
