<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('Location: /proje/login/student');
    exit;
}
include '../../../db.php';

$db = new Database();
$error = null;

if (isset($_POST['student_no']) && isset($_POST['password'])) {
    $student_no = $_POST['student_no'];
    $password = openssl_enc($_POST['password']);
    $student = $db
        ->from('students')
        ->where('student_no', $student_no)
        ->where('password', $password)
        ->first();

    if ($student) {
        $_SESSION['student'] = $student;
        header('Location: /proje/home/student');
        exit;
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f6cbf',
                    }
                }
            }
        }
    </script>
    <script src="./js/app.js" defer async type="module"></script>
</head>

<body class="bg-[#E1E5E9] text-black min-h-dvh">
    <section class="p-4 min-h-svh w-full flex h-full items-center justify-center">
        <div class="bg-white mx-auto max-w-xl p-8 rounded flex flex-col gap-y-4 items-center justify-between shadow-lg">
            <img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg" alt="Paket University" class="w-full object-cover">
            <?php if ($error) : ?>
                <div class="bg-red-500 text-white p-2 rounded w-full text-center"><?= $error ?></div>
            <?php endif; ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="flex flex-col gap-4 w-full">
                <label>
                    <input type="text" name="student_no" placeholder="Öğrenci Numarası" class="p-2 border border-gray-300 rounded w-full focus:outline-primary">
                </label>
                <label>
                    <input type="password" name="password" placeholder="Şifre" class="p-2 border border-gray-300 rounded w-full focus:outline-primary">
                </label>
                <button type="submit" class="p-2 bg-primary text-white rounded">Kaydet</button>
                <a href="logout.php" class="text-primary">Çıkış Yap</a>
            </form>
        </div>
    </section>
    <footer class="bg-white w-full p-4">
        Özgüv ve Yiğit tarafından paket çekilmiştir.
    </footer>
</body>

</html>