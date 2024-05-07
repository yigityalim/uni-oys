<?php

include 'Session.php';
include 'helpers.php';
include 'db.php';

Session::checkLogin();

$db = new Database();
$error = null;


if (
    Helpers::post('name') &&
    Helpers::post('surname') &&
    Helpers::post('student_no') &&
    Helpers::post('mail') &&
    Helpers::post('password') &&
    Helpers::post('password_confirmation') &&
    Helpers::post('faculty') &&
    Helpers::post('department')
) {
    $name = Helpers::post('name');
    $surname = Helpers::post('surname');
    $student_no = Helpers::post('student_no');
    $mail = Helpers::post('mail');
    $password = Helpers::openssl_enc(Helpers::post('password'));
    $password_confirmation = Helpers::openssl_enc(Helpers::post('password_confirmation'));
    $faculty = Helpers::post('faculty');
    $department = Helpers::post('department');

    if ($password !== $password_confirmation) {
        $error = 'Şifreler uyuşmuyor';
    } else {
        $user = $db
            ->from('students')
            ->where('student_no', $student_no)
            ->first();

        if ($user) {
            $error = 'Bu öğrenci numarası ile kayıtlı bir kullanıcı bulunmaktadır';
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
                Session::set('user', $user, true);
            } else {
                $error = 'Kayıt başarısız';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Üni | Kayıt Ol</title>
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
            <img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg" alt="Baskent University" class="w-full object-cover">
            <?php if ($error) : ?>
                <div class="bg-red-500 text-white p-2 rounded w-full text-center"><?= $error ?></div>
            <?php endif; ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="flex flex-col gap-4 w-full">
                <label>
                    <input type="text" name="name" placeholder="Adınız" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>
                <label>
                    <input type="text" name="surname" placeholder="Soyadınız" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>
                <label>
                    <input type="text" name="student_no" placeholder="Öğrenci Numarası" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>
                <label>
                    <input type="text" name="mail" placeholder="Mail Adresiniz:" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>
                <label>
                    <input type="password" name="password" placeholder="Şifre" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>
                <label>
                    <input type="password" name="password_confirmation" placeholder="Şifrenizi tekrar giriniz" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>

                <label>
                    <input type="text" name="faculty" placeholder="Fakülteniz" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>
                <label>
                    <input type="text" name="department" placeholder="Bölümünüz" class="p-2 border border-gray-300 rounded w-full focus:outline-blue-500">
                </label>
                <button type="submit" class="p-2 bg-primary text-white rounded">Kayıt ol</button>
            </form>
            <div class="w-full flex items-center justify-end">
                <a href="login.php" class="w-full text-end text-primary">Giriş Yap</a>
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