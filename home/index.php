<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/auth/login');
}
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();
$path = rtrim($_SERVER['PHP_SELF'], '/');

$student = $_SESSION['student'];
$season_id = $_GET['season'] ?? SEASON;

$courses = $db->from('courses')->where('season', $season_id)->where('department_id', $student['department_id'])->all();
$seasons = $db->from('seasons')->all();
$faculties = $db->from('faculties')->all();
$departments = $db->from('departments')->all();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <script src="/proje/public/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ÖYS | Öğrenci</title>
</head>

<body class="bg-light">
    <header class="navbar justify-content-start fixed-top bg-white shadow-sm px-3 py-0">
        <a href="/proje/home" class="navbar-brand d-flex align-items-center m-1">
            <img width="50" src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logocompact/300x300/1709033358/kucuk.PNG" class="logo mr-1" alt="ÖYS">
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
                <img src="/proje/<?= $student['image_url'] ?>" width="30" height="30" class="ms-2 rounded-circle object-fit-cover ratio-1x1" alt="Avatar">
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
    <main class="container-fluid" style="margin-top: 56px;">
        <header class="row">
            <div class="col-12 py-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="d-flex w-100 justify-content-between">
                                <h1 class="fw-light">Öğretim Yönetim Sistemi</h1>
                                <div class="d-flex flex-column justify-content-center align-items-end">
                                    <p class="text-muted mb-0"><?= date('d.m.Y') ?></p>
                                    <p class="text-muted mb-0"><?= $db->from('seasons')->where('id', $season_id)->first()['season_name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/proje/home" class="text-decoration-none">Ana sayfa</a>
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
                <div class="col-2">
                    <div class="p-3 border bg-light rounded-3">
                        <h5 class="fw-light">Gezinme</h5>
                        <ul class="nav flex-column">
                            <?php foreach ($courses as $course) : ?>
                                <li class="nav-item">
                                    <a class="nav-link text-primary" href="/proje/home/courses/index.php?code=<?= $course['code'] ?>&season=<?= $season_id ?>">
                                        <?= $course['code'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-10">
                    <div class="p-3 border bg-light rounded-3">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <h1 class="fw-light fs-3">Ders Kategorileri</h1>
                            <a data-bs-toggle="collapse" data-bs-target=".multi-collapse" class="btn btn-primary">
                                Hepsini Görüntüle
                            </a>
                        </div>
                        <form action="/proje/home/index.php" method="get" class="mb-4">
                            <div class="input-group">
                                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
                                    <select name="season" class="form-select" aria-label="Season">
                                        <?php foreach($seasons as $season) : ?>
                                            <option value="<?= $season['id'] ?>" <?= $season['id'] === $season_id ? 'selected' : '' ?> >
                                                <?= $season['season_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                                <button class="btn btn-primary" type="submit">Filtrele</button>
                            </div>
                        </form>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($faculties as $faculty) : ?>
                                <li class="list-group list-group-item mb-1 rounded">
                                    <a onclick="this.querySelector('i').classList.toggle('fa-chevron-down');this.querySelector('i').classList.toggle('fa-chevron-up');" data-bs-toggle="collapse" href="#collapse_course_<?= $faculty['id'] ?>" href="/proje/home/faculties/index.php?id=<?= $faculty['id'] ?>" class="w-100 d-inline-flex justify-content-between align-items-center text-decoration-none text-dark">
                                        <?= $faculty['name'] ?>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </a>
                                    <div class="collapse multi-collapse" id="collapse_course_<?= $faculty['id'] ?>">
                                        <ul class="list-group list-group-flush">
                                            <?php foreach ($db->from('courses')->where(
                                                'season',
                                                $season_id
                                            )->where(
                                                'department_id',
                                                $faculty['id']
                                            )->all() as $faculty_course) : ?>
                                                <?php if ($faculty_course['department_id'] === $faculty['id']) : ?>
                                                    <li class="list-group list-group-item mb-1 rounded">
                                                        <a href="/proje/home/courses/index.php?code=<?= $faculty_course['code'] ?>" class="text-decoration-none text-dark">
                                                            <?= $faculty_course['name'] ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>