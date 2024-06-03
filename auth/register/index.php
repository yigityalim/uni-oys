<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();
$error = null;

$academicians = $db->from('lecturers')->select('id, name, title')->all();

$faculties = $db->from('faculties')->select('id, name')->all();
$departments = $db->from('departments')->select('id, name')->all();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['surname'], $_POST['student_no'], $_POST['mail'], $_POST['password'],
        $_POST['password_confirmation'], $_POST['faculty'], $_POST['department'], $_POST['akademisyen'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $student_no = $_POST['student_no'];
        $mail = $_POST['mail'];
        $password = openssl_enc($_POST['password']);
        $password_confirmation = openssl_enc($_POST['password_confirmation']);
        $faculty = $_POST['faculty'];
        $department = $_POST['department'];
        $academician = $_POST['akademisyen'];

        if ($password !== $password_confirmation) {
            $error = 'Şifreler uyuşmuyor';
        } else {
            $user = $db
                ->from('students')
                ->where('student_no', $student_no)
                ->first();

            if ($user) {
                $error = 'Bu öğrenci numarası ile kayıtlı bir öğrenci bulunmaktadır';
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
                    header('Location: /proje/home');
                } else {
                    $error = 'Kayıt başarısız';
                }
            }
        }
    } else {
        $error = 'Lütfen tüm alanları doldurunuz';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Üni | Kayıt Ol</title>
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <script src="/proje/public/bootstrap.min.js"></script>
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
                    <?php if ($error) : ?>
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
                            <select class="form-select" name="faculty" id="faculty" required>
                                <option selected disabled>Fakülte seçiniz</option>
                                <?php foreach ($faculties as $faculty) : ?>
                                    <option value="<?= $faculty['id'] ?>"><?= $faculty['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="department">Bölüm</label>
                            <select class="form-select" name="department" id="department" required>
                                <option selected disabled>Bölüm seçiniz</option>
                                <?php foreach ($departments as $department) : ?>
                                    <option value="<?= $department['id'] ?>"><?= $department['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <select class="form-select mb-3" name="academician" required>
                            <option selected disabled>Akademisyen seçiniz</option>
                            <?php foreach ($academicians as $academician) : ?>
                                <option value="<?= $academician['id'] ?>"><?= $academician['title'] . ' ' . $academician['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="w-100 btn btn-primary">Kayıt Ol</button>
                    </form>
                    <a href="/proje/auth/login" class="w-100 text-center d-block mt-3">Giriş Yap</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>