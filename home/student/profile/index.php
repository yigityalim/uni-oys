<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: student.php');
    exit;
}
require 'db.php';
require 'helpers.php';

$user = $_SESSION['user'];
$db = new Database();

$isUpdated = false;

if (isset($_FILES['image'])) :
  $image = Helpers::upload_image($_FILES['image']);
  $db
    ->update('students')
    ->where('id', $user['id'])
    ->set(['image_url' => $image]);
  $user = $db->from('students')->where('id', $user['id'])->first();
  Session::set('user', $user, false);
  $isUpdated = true;
endif;

if (Helpers::isPost()) :
  if (Helpers::post('password')) :
    $password = Helpers::openssl_enc(Helpers::post('password'));
    $db
      ->update('students')
      ->where('id', $user['id'])
      ->set([
        'name' => Helpers::post('name'),
        'email' => Helpers::post('email'),
        'password' => $password
      ]);
    $user = $db->from('students')->where('id', $user['id'])->first();
    Session::set('user', $user, false);
    $isUpdated = true;
  endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paket Üni | Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./js/app.js" defer async type="module"></script>
</head>

<body class="pb-12 bg-white text-black flex flex-col min-h-dvh items-center justify-start">
  <header class="w-full p-4 flex flex-row items-center justify-between">
    <a class="w-1/4" href="index.php"><img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg" alt="Paket Üni"></a>
    <nav>
      <ul class="hidden md:flex flex-row items-center justify-center gap-x-4 *:text-black">
        <li><a href="index.php">Anasayfa</a></li>
        <li><a href="courses.php">Dersler</a></li>
        <li><a href="students.php">Öğrenciler</a></li>
        <li class="relative">
          <button id="toggleBtn" class="md:flex flex-row items-center justify-center gap-x-4">
            <span><?= $user['name'] ?></span>
            <span class="w-8 h-8 rounded-full bg-black"></span>
          </button>
          <div id="menu" class="hidden absolute top-10 right-0 bg-zinc-100 text-black px-2 py-1 rounded flex flex-col items-end justify-center *:px-4 *:py-1 *:w-full *:text-end *:rounded">
            <a class="hover:bg-z
              inc-300" href="profile.php">Profil</a>
            <a class="hover:bg-zinc-300" href="logout.php">Çıkış Yap</a>
          </div>
        </li>
      </ul>
      <span class="md:hidden">☰</span>
    </nav>
  </header>

  <main class="w-full">
    <?php if ($isUpdated) : ?>
      <div class="my-10 mx-auto w-full max-w-md bg-green-100 text-green-700 p-4 text-center">Bilgileriniz başarıyla güncellendi.</div>
    <?php endif; ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="w-full flex flex-col items-center justify-center gap-y-4" enctype="multipart/form-data">
      <div class="max-w-4xl w-full flex flex-col items-center justify-center gap-y-4">
        <div class="relative overflow-hidden w-1/2 flex flex-row items-center justify-between gap-x-4">
          <div class="flex flex-col items-center justify-center gap-y-4">
            <img id="display_image" src="<?= $user['image_url'] ?>" alt="<?= $user['name'] ?>" class="rounded-full">
            <label for="image_upload" class="bg-gray-200 text-sm text-center px-2 py-1 rounded cursor-pointer">Değiştir</label>
          </div>
          <div class="w-3/4 flex flex-col items-end justify-center gap-y-4">
            <h1 class="text-4xl font-bold truncate"><?= $user['name'] ?></h1>
            <h2 class="text-xl font-semibold truncate"><?= $user['student_no'] ?></h2>
          </div>
        </div>
        <label for="image_upload" class="w-1/2 bg-gray-200 text-center p-4 rounded cursor-pointer <?= isset($user['image_url']) ? 'hidden' : '' ?>">Resim Yükle</label>
        <input type="file" id="image_upload" name="image" class="hidden">
        <div class="w-full flex flex-col items-center justify-center gap-y-4">
          <label for="name" class="w-1/2 text-start">Ad Soyad</label>
          <input type="text" id="name" name="name" value="<?= $user['name'] ?>" class="w-1/2 p-2 border border-black rounded">
        </div>
        <div class="w-full flex flex-col items-center justify-center gap-y-4">
          <label for="email" class="w-1/2 text-start">E-posta</label>
          <input type="email" id="email" name="email" value="<?= $user['email'] ?>" class="w-1/2 p-2 border border-black rounded">
        </div>
        <div class="w-full flex flex-col items-center justify-center gap-y-4">
          <label for="password" class="w-1/2 text-start">Şifre</label>
          <input type="password" id="password" name="password" class="w-1/2 p-2 border border-black rounded">
        </div>
        <div class="w-full flex flex-col items-center justify-center gap-y-4">
          <button type="submit" class="btnnnn w-1/2 p-2 bg-black text-white rounded">Güncelle</button>
        </div>
      </div>
    </form>
  </main>

  <footer></footer>

  <script>
    function toggleMenu() {
      var menu = document.getElementById("menu");
      menu.classList.toggle("hidden");
    }
  </script>
</body>

</html>