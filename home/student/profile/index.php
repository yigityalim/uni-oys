<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/login/student');
}
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();

$student = $_SESSION['student'];
$season_id = $_GET['season'] ?? SEASON;

$seasons = $db->from('courses')->select('season')->where('department_id', $student['department_id'])->distinct()->all();
$courses = $db->from('courses')->where('season', $season_id)->where('department_id', $student['department_id'])->all();
$faculties = $db->from('faculties')->all();
$departments = $db->from('departments')->all();
$advisors = $db->from('lecturers')->where('department_id', $student['department_id'])->all();
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
            <li><a class="dropdown-item" href="/proje/home/student/grade">Başarı Notlarım</a></li>
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
<main class="container-fluid mb-5" style="margin-top: 56px;">
    <header class="row">
        <div class="col-12 py-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <img src="/proje/<?= $student['image_url'] ?>" class="rounded-circle" width="100" alt="Profil Resmi">
                        <div class="d-flex flex-column justify-content-center align-items-start">
                            <h1 class="fw-bold"><?= $student['name'] ?> <?= $student['surname'] ?></h1>
                            <p class="text-muted mb-0"><?= $student['student_no'] ?></p>
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
            <div class="col-10">
                <div class="p-3 border bg-light rounded-3">
                    <form action="/proje/home/student/profile/update.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Ad Soyad</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $student['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $student['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Bölüm</label>
                            <select class="form-select" id="department" name="department_id">
                                <?php foreach ($departments as $department): ?>
                                    <option value="<?= $department['id'] ?>" <?= $department['id'] === $student['department_id'] ? 'selected' : '' ?>>
                                        <?= $department['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="faculty" class="form-label">Fakülte</label>
                            <select class="form-select" id="faculty" name="faculty_id">
                                <?php foreach ($faculties as $faculty): ?>
                                    <option value="<?= $faculty['id'] ?>" <?= $faculty['id'] === $student['department_id'] ? 'selected' : '' ?>>
                                        <?= $faculty['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="student_no" class="form-label ">Öğrenci No</label>
                            <input type="text" class="form-control" id="student_no" name="student_no" value="<?= $student['student_no'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="advisor" class="form-label">Danışman</label>
                            <select class="form-select" id="advisor" name="advisor_id">
                                <?php foreach ($advisors as $advisor): ?>
                                    <option value="<?= $advisor['id'] ?>" <?= $advisor['id'] === $student['advisor_id'] ? 'selected' : '' ?>>
                                        <?= $advisor['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Profil Resmi</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
