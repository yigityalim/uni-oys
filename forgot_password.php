<?php
include 'Session.php';
include 'helpers.php';
include 'db.php';
Session::checkLogin();

$db = new Database();
$error = null;

if (Helpers::post('student_no') && Helpers::post('password')) {
    $student_no = Helpers::post('student_no');
    $password = Helpers::post('password');
    $user = $db->from('students')->where('student_no', $student_no)->where('password', Helpers::openssl_enc($password))->first();
    if ($user) {
        $new_password = Helpers::post('new_password');
        $new_password_confirmation = Helpers::post('new_password_confirmation');
        if ($password == $new_password || $password == $new_password_confirmation) {
            $error = 'Yeni şifre eski şifre ile aynı olamaz';
        } else if ($new_password == $new_password_confirmation) {
            $error = null;
            $db->update('students')->where('id', $user['id'])->set([
                'password' => Helpers::openssl_enc($new_password)
            ]);
            Helpers::redirect('login.php');
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
            <img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg" alt="Baskent University" class="w-full object-cover">
            <?php if ($error) : ?>
                <div class="bg-red-500 text-white p-2 rounded w-full text-center"><?= $error ?></div>
            <?php endif; ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="flex flex-col gap-4 w-full">
                <label>
                    <input type="text" name="student_no" placeholder="Öğrenci Numarası" class="p-2 border border-gray-300 rounded w-full">
                </label>
                <label>
                    <input type="password" name="password" placeholder="Eski Şifrenizi giriniz" class="p-2 border border-gray-300 rounded w-full">
                </label>
                <hr class="h-px w-full bg-black">
                <label>
                    <input type="password" name="new_password" placeholder="Yeni Şifrenizi giriniz" class="p-2 border border-gray-300 rounded w-full">
                </label>
                <label>
                    <input type="password" name="new_password_confirmation" placeholder="Yeni Şifrenizi tekrar giriniz" class="p-2 border border-gray-300 rounded w-full">
                </label>
                <button type="submit" class="p-2 bg-primary text-white rounded">Şifremi değiştir</button>
            </form>
            <a href="login.php" class="w-full text-start text-primary">Giriş Yap</a>
            <hr class="h-px w-full bg-black">
            <hr class="h-px w-full bg-black">
            <div class="w-full flex items-center justify-between">
                <a href="#" rel="noopener" target="_blank" class="text-primary">English</a>
            </div>
        </div>
    </section>
    <footer class="bg-white w-full p-4">
        Özgüv ve Yiğit tarafından paket çekilmiştir.
    </footer>
</body>

</html>