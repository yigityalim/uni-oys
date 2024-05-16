<?php
session_start();
if (isset($_SESSION['student'])) {
    header('Location: /proje/home/student');
    exit;
}
include '../../db.php';
include '../../constants.php';

$db = new Database();
$error = null;

$academicians = $db->from('academicians')->select('id, name, title')->all();

if (isset($_POST['name'], $_POST['surname'], $_POST['student_no'], $_POST['mail'], $_POST['password'], $_POST['password_confirmation'], $_POST['faculty'], $_POST['department'], $_POST['academician'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $student_no = $_POST['student_no'];
    $mail = $_POST['mail'];
    $password = openssl_enc($_POST['password']);
    $password_confirmation = openssl_enc($_POST['password_confirmation']);
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $academician = $_POST['academician'];

    echo "<h1>$academician</h1>";

    if ($password !== $password_confirmation) {
        $error = 'Şifreler uyuşmuyor';
    } else {
        $user = $db
            ->from('students')
            ->where('student_no', $student_no)
            ->first();

        if ($user) {
            $error = 'Bu öğrenci numarası ile kayıtlı bir kullanıcı bulunmaktadır';
            exit;
        } else {
            $query = $db->insert('students')->set([
                'name' => $name,
                'surname' => $surname,
                'student_no' => $student_no,
                'email' => $mail,
                'password' => $password,
                'faculty' => $faculty,
                'start_time' => date('Y-m-d H:i:s'),
                'department' => $department,
            ]);

            if ($query) {
                $_SESSION['user'] = $db->from('students')->where('student_no', $student_no)->first();
                header('Location: /proje/home/student');
            } else {
                $error = 'Kayıt başarısız';
            }
        }
    }
} else {
    $error = 'Lütfen tüm alanları doldurunuz';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Üni | Kayıt Ol</title>
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <script src="./js/app.js" defer async type="module"></script>
</head>

<body class="bg-light">
<div class="container mt-5 mb-5">
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
                            <label for="name">Ad</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="surname">Soyad</label>
                            <input type="text" name="surname" id="surname" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="student_no">Öğrenci Numarası</label>
                            <input type="text" name="student_no" id="student_no" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="mail">Mail</label>
                            <input type="email" name="mail" id="mail" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Şifre</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Şifre Tekrar</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="faculty">Fakülte</label>
                            <input type="text" name="faculty" id="faculty" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="department">Bölüm</label>
                            <input type="text" name="department" id="department" class="form-control" required>
                        </div>
                        <select class="form-select mb-3" name="academician" required>
                            <option selected disabled>Akademisyen seçiniz</option>
                            <?php foreach ($academicians as $academician): ?>
                                <option value="<?= $academician['id'] ?>"><?= $academician['title'] . ' ' . $academician['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="w-100 btn btn-primary">Kayıt Ol</button>
                    </form>
                    <a href="/proje/login/student" class="w-100 text-center d-block mt-3">Giriş Yap</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>