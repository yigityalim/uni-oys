<?php
require 'db.php';
require 'helpers.php';
session_start();
if (!session('user')) redirect('login.php');

$db = new Database();
$error = null;

if (post('student_no') && post('password')) {
    $student_no = post('student_no');
    $password = openssl_enc(post('password'));
    $user = $db
        ->from('students')
        ->where('student_no', $student_no)
        ->where('password', $password)
        ->first();

    if ($user) {
        session('user', $user);
        redirect('index.php');
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
                        primary: '#FF3131',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#E1E5E9] text-black min-h-dvh">
<section class="p-4 min-h-svh w-full flex h-full items-center justify-center">
    <div class="bg-white mx-auto max-w-xl p-8 rounded flex flex-col gap-y-4 items-center justify-between shadow-lg">
        <img src="./images/paket1.png"
             alt="Paket University" class="w-full object-cover">
        <?php if ($error): ?>
            <div class="bg-red-500 text-white p-2 rounded w-full text-center"><?= $error ?></div>
        <?php endif; ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="flex flex-col gap-4 w-full">
            <label>
                <input type="text" name="student_no" placeholder="Öğrenci Numarası"
                       class="p-2 border border-gray-300 rounded w-full focus:outline-primary">
            </label>
            <label>
                <input type="password" name="password" placeholder="Şifre"
                       class="p-2 border border-gray-300 rounded w-full focus:outline-primary">
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