<?php
require 'db.php';
require 'helpers.php';
session_start();
if (!session('user')) redirect('login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Üni Öğretim Yönetim Sistemi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {}
    </script>
</head>
<body class="bg-white text-black p-4 flex flex-col min-h-dvh items-center justify-center">
<?= session('user')['name'] ?>, Hoşgeldin
<a href="logout.php" class="bg-red-500 text-white p-2 rounded">Çıkış Yap</a>
<a href="edit_profile.php" class="bg-red-500 text-white p-2 rounded">Profili Düzenle</a>
<pre>
    <?= print_r(session('user'), true) ?>
</pre>
</body>
</html>