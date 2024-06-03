<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/auth/login');
}
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();

$student = $_SESSION['student'];
$season_id = $_GET['season'] ?? SEASON;

$seasons = $db->from('courses')->select('season')->where('department_id',
    $student['department_id'])->distinct()->all();
$courses = $db->from('courses')->where('season', $season_id)->where('department_id',
    $student['department_id'])->all();
$faculties = $db->from('faculties')->all();
$departments = $db->from('departments')->all();
$student_department = $db->from('departments')->where('id', $student['department_id'])->first();
$advisors = $db->from('lecturers')->where('department_id', $student['department_id'])->all();

$student_courses = $db->from('student_courses')
    ->join('courses', 'courses.id = student_courses.course_id')
    ->join('course_status', 'course_status.id = student_courses.status')
    ->where('student_id', $student['id'])
    ->select('courses.*, student_courses.*, course_status.*')
    ->all();

function calcStyleOnStatus($status): string
{
    return match ($status) {
        'Alındı' => 'table-success',
        'Kaldı' => 'table-danger',
        'Muaf' => 'table-warning',
        'Sayıldı' => 'table-info',
        'Tekrar' => 'table-primary',
        'Şu an Almakta' => 'table-secondary',
        default => '',
    };
}

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
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</head>

<body class="bg-light">
<header class="navbar justify-content-start fixed-top bg-white shadow-sm px-3 py-0">
    <a href="/proje/home" class="navbar-brand d-flex align-items-center m-1">
        <img width="50"
             src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logocompact/300x300/1709033358/kucuk.PNG"
             class="logo mr-1" alt="ÖYS">
    </a>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home">Anasayfa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home/courses/">Dersler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home/grade">Başarı Notlarım</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="/proje/home/academician">Akademisyen</a>
            </li>
        </ul>
    </nav>
    <div class="dropdown ms-auto">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $student['name'] ?>
            <img src="/proje/<?= $student['image_url'] ?>" width="30" height="30"
                 class="ms-2 rounded-circle object-fit-cover ratio-1x1" alt="Avatar">
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="/proje/home/profile">Profil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="/proje/home/academician">Akademisyen</a></li>
            <li><a class="dropdown-item" href="/proje/home/grade">Başarı Notlarım</a></li>
            <li>
                <a class="dropdown-item" href="/proje/home/courses">Tüm Dersler</a>
            </li>
            <li>
                <a class="dropdown-item" href="/proje/home/faculties">Fakülteler ve Dersler</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item text-primary" href="/proje/home">Anasayfa</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="/proje/auth/logout">Çıkış Yap</a></li>
        </ul>
    </div>
</header>
<main class="container-fluid mb-5" style="margin-top: 56px;">
    <header class="row">
        <div class="col-12 py-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <img src="/proje/<?= $student['image_url'] ?>" class="rounded-circle" width="100"
                             alt="Profil Resmi">
                        <div class="d-flex flex-column justify-content-center align-items-start">
                            <h1 class="fw-bold"><?= $student['name'] ?> <?= $student['surname'] ?></h1>
                            <p class="text-muted mb-0"><?= $student['student_no'] ?></p>
                        </div>
                        <div class="ms-auto">
                            <small class="text-muted">Bölüm: <?= $student_department['name'] ?></small>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/proje/home/student" class="text-decoration-none">Ana sayfa</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/proje/home/student/profile" class="text-decoration-none">Profil</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="row gx-3">
            <div class="col-2">
                <div class="p-3 border bg-light rounded-3">
                    <h5 class="fw-light">Gezinme</h5>
                    <ul class="nav flex-column">
                        <?php foreach ($courses as $course) : ?>
                            <li class="nav-item">
                                <a class="nav-link text-primary"
                                   href="/proje/home/courses/index.php?code=<?= $course['code'] ?>">
                                    <?= $course['code'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-10">
                <div class="p-3 border bg-light rounded-3">
                    <h2 class="fw-normal">Aldığım Dersler</h2>
                    <?php if (empty($student_courses)): ?>
                        <div class="alert alert-danger" role="alert">
                            Bu öğrenciye ders eklenmemiş. Ekleyip tekrar deneyiniz.
                        </div>
                    <?php else: ?>
                        <table class="table table-striped table-hover table-bordered table-responsive
                        table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
                            <thead>
                            <tr>
                                <th>Yarıyıl</th>
                                <th>Ders Kodu</th>
                                <th>AKTS</th>
                                <th>Ders Adı</th>
                                <th>Ders Notu</th>
                                <th>Durum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($student_courses as $student_course) : ?>
                                <tr>
                                    <td><?= $student_course['semester'] ?></td>
                                    <td><?= $student_course['code'] ?></td>
                                    <td><?= $student_course['credit'] ?></td>
                                    <td><?= $student_course['name'] ?></td>
                                    <td class="<?= calcStyleOnStatus($student_course['status_name']) ?>">
                                        <p type="button" class="mb-0 h-100 w-100 d-inline-flex flex-column gap-2 text-center"
                                           data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           data-bs-custom-class="custom-tooltip"
                                           data-bs-title="<?= $student_course['grade'] ?>"
                                        >
                                        <span class="fw-bold">
                                            <?= $student_course['code'] ?>
                                        </span>
                                            (<?= $student_course['grade'] ?>)
                                        </p>
                                    </td>
                                    <td class="<?= calcStyleOnStatus($student_course['status_name']) ?>">
                                        <?= $student_course['status_name'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-muted">Öğrenci Katalog Akts Toplamı = 245</p>
                            <p class="text-muted">Öğrenci Aldığı Dersler Akts Toplamı
                                = <?= array_sum(array_column($student_courses, 'credit')) ?></p>
                        </div>
                        <h5 class="fw-normal mt-5">Renk Açıklamaları</h5>
                        <table class="table table-striped table-hover table-bordered table-responsive
                        table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl">
                            <thead>
                            <tr>
                                <th>Not</th>
                                <th>Durum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="table-success">AA</td>
                                <td>Alındı</td>
                            </tr>
                            <tr>
                                <td class="table-danger">FF</td>
                                <td>Kaldı</td>
                            </tr>
                            <tr>
                                <td class="table-warning">MM</td>
                                <td>Muaf</td>
                            </tr>
                            <tr>
                                <td class="table-info text-dark">DD</td>
                                <td>Sayıldı</td>
                            </tr>
                            <tr>
                                <td class="table-primary">DC</td>
                                <td>Tekrar</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">XX</td>
                                <td>Şu an Almakta</td>
                            </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
</body>

</html>