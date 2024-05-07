<?php
include 'Session.php';
include 'helpers.php';
include 'db.php';

Session::checkLogin();

$db = new Database();
$error = null;

if (Helpers::post('student_no') && Helpers::post('password')) {
    $student_no = Helpers::post('student_no');
    $password = Helpers::openssl_enc(Helpers::post('password'));
    $user = $db
        ->from('students')
        ->where('student_no', $student_no)
        ->where('password', $password)
        ->first();

    if ($user) {
        Session::set('user', $user, true);
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
</head>
<body class="bg-[#E1E5E9] text-black min-h-dvh">
<section class="p-4 min-h-svh w-full flex h-full items-center justify-center">
    <div class="bg-white mx-auto max-w-xl p-8 rounded flex flex-col gap-y-4 items-center justify-between shadow-lg">
        <img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg"
             alt="Paket University" class="w-full object-cover">
        <?php if ($error): ?>
            <div class="bg-primary text-white p-2 rounded w-full text-center"><?= $error ?></div>
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
            <button type="submit" class="p-2 bg-primary text-white rounded">Giriş Yap</button>
        </form>
        <div class="w-full flex items-center justify-between">
            <a href="forgot_password.php" class="w-full text-start text-primary">Şifrenizi mi unuttunuz?</a>
            <a href="register.php" class="w-full text-end text-primary">Kayıt ol</a>
        </div>
        <hr class="h-px w-full bg-black">
        <div class="w-full flex flex-col gap-y-2 items-center justify-center">
            <h1 class="text-start w-full mb-4 text-lg">Buraya ilk defa mı geliyorsunuz?</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 place-items-center w-full gap-4">
                <div class="w-full h-full space-y-6">
                    <p class="text-sm">
                        <bold>Öğrenciler için</bold>
                        sadece öğrenci numarası (örn. "21534564") ve Paket Üniversitesi'nin size verdiği şifre ile giriş
                        yapınız. Şifrenizi bilmiyor ya da unuttuysanız, lütfen
                        <a href="#" class="text-primary">buraya tıklayınız</a>.
                    </p>
                    <p>
                        <bold>Öğretim elemanları için</bold>
                        için eposta adresinizin ilk kısmını (örn "aozturk" gibi) giriniz. Şifrenizi unuttuysanız, lütfen
                        <a href="#" class="text-primary">buraya tıklayınız</a>.
                    </p>
                    <p>Tarayıcı adresinin <a href="#" class="text-primary">https://paket.edu.tr</a> olduğundan emin
                        olunuz.</p>
                </div>
                <div class="w-full h-full space-y-6">
                    <p class="text-sm">
                        <bold>For students</bold>
                        , login only with the student number (eg "21534564") and the password given to you by Paket
                        University. If you do not know or forgot your password, you can get it
                        <a href="#" class="text-primary">by clicking here</a>.
                    </p>
                    <p>
                        <bold>For instructors</bold>
                        , please enter the first part of your e-mail address (such as "aozturk"). If you have forgotten your
                        password, you can get it
                        <a href="#" class="text-primary">here</a>.
                    </p>
                    <p>Make sure that the browser address is
                        <a href="#" class="text-primary">https://paket.edu.tr</a>
                    </p>
                </div>
            </div>
        </div>
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