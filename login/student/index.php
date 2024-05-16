<?php
session_start();
if (isset($_SESSION['student'])) {
    header('Location: /proje/home/student');
}
include '../../db.php';
include '../../constants.php';

$db = new Database();
$error = null;

if (isset($_POST['student_no'], $_POST['password'])) {
    $student_no = $_POST['student_no'];
    $password = openssl_enc($_POST['password']);


    $user = $db
        ->from('students')
        ->where('student_no', $student_no)
        ->where('password', $password)
        ->first();

    if ($user) {
        $_SESSION['student'] = $user;
        header('Location: /proje/home/student');
    } else {
        $error = 'Kullanıcı adı veya şifre hatalı';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Üni | Giriş Yap</title>
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <script src="/js/app.js" defer async type="module"></script>
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
                    <?php if ($error): ?>

                        <div class="alert alert-danger" role="alert">
                            <?= $error; ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="studentNumber" placeholder="Öğrenci Numarası"
                                   required name="student_no">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Şifre" required
                                   name="password">
                        </div>
                        <button type="submit" class="w-100 btn btn-primary btn-block">Giriş yap</button>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="/proje/forgot-password/student" class="text-primary text-decoration-none">Şifrenizi mi unuttunuz?</a>
                            <a href="/proje/login/academician" class="text-secondary text-decoration-none">Akademisyen girişi</a>
                            <a href="/proje/register/student" class="text-primary text-decoration-none">Kayıt ol</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>