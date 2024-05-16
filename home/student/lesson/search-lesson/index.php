<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: student.php');
    exit;
}
require 'helpers.php';
require 'db.php';
$user = $_SESSION['user'];

$query = strtolower(trim($_GET['q']));

$db = new Database();
$students = $db->from('students')->all();
$lessons = $db->from('lessons')->where('id', $user['id'])->all();

$results = [
  'huk101' => [
    'name' => 'Hukuk 101',
    'code' => 'huk101',
  ],
  'mat101' => [
    'name' => 'Matematik 101',
    'code' => 'mat101',
  ],
  'fiz101' => [
    'name' => 'Fizik 101',
    'code' => 'fiz101',
  ],
  'kim101' => [
    'name' => 'Kimya 101',
    'code' => 'kim101',
  ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paket Üni Öğretim Yönetim Sistemi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./js/app.js" defer async type="module"></script>
</head>
<body class="bg-white text-black flex flex-col min-h-dvh items-center justify-start">
  <header class="w-full p-4 flex flex-row items-center justify-between">
    <a class="w-1/4" href="index.php"><img src="https://oys2.baskent.edu.tr/pluginfile.php/1/core_admin/logo/0x200/1709033358/oys_banner.jpg" alt="Paket Üni"></a>
    <nav>
      <ul class="hidden md:flex flex-row items-center justify-center gap-x-4 *:text-black">
        <li><a href="index.php">Anasayfa</a></li>
        <li><a href="courses.php">Dersler</a></li>
        <li class="relative">
          <button id="toggleBtn" class="md:flex flex-row items-center justify-center gap-x-4">
            <span><?= $user['name'] ?></span>
            <img src="<?= $user['image_url'] ?>" alt="<?= $user['name'] ?>" class="w-8 h-8 rounded-full">
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
  <main class="flex-1 w-full h-full p-4">
    <div class="w-full border border-zinc-200 p-8 rounded-md">
      <h1 class="text-4xl font-medium text-start text-black mb-4 w-full">Ders ara: <?= $query ?></h1>
      <a class="text-blue-500 font-bold mt-4 inline-block text-center" href="index.php">Anasayfa</a>
    </div>
    <div class="w-full flex flex-row gap-x-4 mt-4 h-full">
      <div class="w-1/5 flex flex-col gap-y-2 items-center justify-start">
        <div class="w-full border border-zinc-200 bg-[#f8f9fa] p-4 rounded-md">
          <h2 class="text-2xl font-medium text-start text-black mb-2 w-full">Gezinme</h2>
          <ul>
            <li>
              <a class="text-blue-500 font-bold text-sm inline-flex gap-2" href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down">
                  <path d="m6 9 6 6 6-6" />
                </svg>
                Anasayfa
              </a>
              <ul class="pl-2 my-2">
                <li>
                  <a class="text-blue-500 font-bold text-sm inline-flex gap-2" href="profile.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-gauge">
                      <path d="M15.6 2.7a10 10 0 1 0 5.7 5.7" />
                      <circle cx="12" cy="12" r="2" />
                      <path d="M13.4 10.6 19 5" />
                    </svg>
                    Kontrol Paneli
                  </a>
                  <ul class="pl-2 my-2">
                    <li>
                      <a class="text-blue-500 font-bold text-sm inline-flex gap-2" href="my-courses.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down">
                          <path d="m6 9 6 6 6-6" />
                        </svg>
                        Derslerim
                      </a>
                      <ul class="pl-2 pt-1 space-y-2">
                        <?php foreach ($lessons as $lesson) : ?>
                          <li>
                            <a class="transition font-bold text-sm inline-flex gap-2 text-blue-500 cursor-pointer <?= $lesson['code'] === $courses['code'] ? 'bg-blue-500 text-white rounded-md p-1' : 'hover:bg-blue-500 hover:text-white rounded-md p-1' ?>" href="lesson.php?code=<?= $lesson['code'] ?>">
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap">
                                <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                                <path d="M22 10v6" />
                                <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                              </svg>
                              <?= $lesson['code'] ?>
                            </a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="w-full border border-zinc-200 p-4 rounded-md h-full">
        <form class="flex flex-row items-center justify-start p-2 rounded-md mt-4" action="search-lesson.php" method="GET">
          <input type="text" class="p-2 bg-zinc-100" placeholder="Ara..." name="q">
          <button type="submit" class="rounded-r-md bg-blue-500 text-white font-bold text-sm p-2 flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </button>
        </form>
        <div>
          <h1 class="text-2xl font-medium text-start text-black mb-2 w-full">Arama Sonuçları: <?= count($lessons) ?></h1>
          <ul>
            <?php foreach ($results as $result) : ?>
              <li class="border border-zinc-200 p-4 rounded-md mb-4">
                <a class="text-xl font-medium text-start text-blue-500 hover:underline cursor-pointer mb-2" href="lesson.php?code=<?= $result['code'] ?>"><?= $result['name'] ?></a>
                <a class="text-blue-500 font-bold text-sm inline-flex gap-2" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right">
                    <polyline points="9 18 15 12 9 6" />
                  </svg>
                  <?= $result['code'] ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </main>
  <footer class="bg-zinc-300 p-4 w-full">footer</footer>
</body>

</html>