<?php
session_start();
if (isset($_SESSION['academician'])) {
    header('Location: /proje/home/academician');
}
include '../../db.php';
include '../../constants.php';

$db = new Database();
$error = null;

$academicians = $db->from('academicians')->select('id, name, password')->all();

if (isset($_POST['academician_id'], $_POST['password'])) {
    $academician_id = $_POST['academician_id'];
    $password = openssl_enc($_POST['password']);

    $academician = $db
        ->from('academicians')
        ->where('id', $academician_id)
        ->where('password', $password)
        ->first();

    if ($academician) {
        $_SESSION['academician'] = $academician;
        header('Location: /proje/home/academician');
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
    <style>
        .form-select:focus, .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 .25rem rgba(108, 117, 125, .25);
        }
    </style>
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
                            <select class="form-select" id="studentNumber" required name="academician_id">
                                <option selected disabled>Öğretim Görevlisi Seçiniz</option>
                                <?php foreach ($academicians as $academician): ?>
                                    <option value="<?= $academician['id']; ?>"><?= $academician['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Şifre" required
                                   style=""
                                   name="password">
                        </div>
                        <button type="submit" class="w-100 btn btn-secondary btn-block">Giriş yap</button>
                        <div class="text-center mt-3">
                            <a href="/proje/login/student" class="text-primary text-decoration-none">Öğrenci girişi</a>
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