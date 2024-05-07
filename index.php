<?php
require 'Session.php';
$user = Session::get('user');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Üni Öğretim Yönetim Sistemi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-black flex flex-col min-h-dvh items-center justify-start">
    <header class="w-full p-4 flex flex-row items-center justify-between">
        <a class="w-1/2" href="index.php"><img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg" alt="Paket Üni"></a>
        <nav>
            <ul class="hidden md:flex flex-row items-center justify-center gap-x-4 *:text-black">
                <li><a href="index.php">Anasayfa</a></li>
                <li><a href="courses.php">Dersler</a></li>
                <li><a href="students.php">Öğrenciler</a></li>
                <li class="relative">
                    <button onclick="toggleMenu()" class="md:flex flex-row items-center justify-center gap-x-4">
                        <span><?= $user['name'] ?></span>
                        <span class="w-8 h-8 rounded-full bg-black"></span>
                    </button>
                    <div id="menu" class="hidden absolute top-10 right-0 bg-zinc-100 text-black px-2 py-1 rounded flex flex-col items-end justify-center *:px-4 *:py-1 *:w-full *:text-end *:rounded">
                        <a class="hover:bg-zinc-300" href="profile.php">Profil</a>
                        <a class="hover:bg-zinc-300" href="logout.php">Çıkış Yap</a>
                    </div>
                </li>
            </ul>
            <span class="md:hidden">☰</span>
        </nav>
    </header>
    <main class="flex-1 container mx-auto bg-zinc-200">
        main içerik gelecek
    </main>
    <footer class="bg-zinc-300 p-4 w-full">footer</footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("menu");
            menu.classList.toggle("hidden");
        }
    </script>
</body>

</html>