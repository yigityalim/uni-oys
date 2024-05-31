<?php
session_start();
if (isset($_SESSION['student'])) {
    header('Location: /proje/home/student');
    exit;
}

require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();
$error = null;

if (isset($_POST['student_no'], $_POST['password'])) {
    $student_no = $_POST['student_no'];
    $password = openssl_enc($_POST['password']);
    $user = $db->from('students')->where('student_no', $student_no)->where('password', $password)->first();
    if ($user) {
        $new_password = $_POST['new_password'];
        $new_password_confirmation = $_POST['new_password_confirmation'];
        if ($password == $new_password || $password == $new_password_confirmation) {
            $error = 'Yeni şifre eski şifre ile aynı olamaz';
        } else if ($new_password == $new_password_confirmation) {
            $error = null;
            $db->update('students')->where('id', $user['id'])->set([
                'password' => openssl_enc($new_password)
            ]);
            header('Location: /proje/login');
        } else {
            $error = 'Şifreler uyuşmuyor';
        }
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
    <title>Paket Üni | Şifrenizi mi unuttunuz?</title>
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg" alt="Baskent University" class="img-fluid">
                        </div>
                        <?php if ($error) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error; ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group mb-3">
                                <label for="student_no">Öğrenci Numarası</label>
                                <input type="text" name="student_no" id="student_no" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">En son hatırladığınız şifre</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <label for="new_password">Yeni Şifre</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password_confirmation">Yeni Şifre Tekrar</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="w-100 btn btn-primary">Şifremi Değiştir</button>
                            <a href="/proje/auth/login" class="btn btn-link">Giriş Yap</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>