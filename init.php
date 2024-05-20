<?php
$succes = false;
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    $server = $_POST['server'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];

    $db = null;

    try {
        $db = new mysqli($server, $username, $password);

        if ($db->connect_error) throw new Exception('Bağlantı hatası: ' . $db->connect_error);

        $db->query("CREATE DATABASE IF NOT EXISTS $database");
        $db->select_db($database);

        $message = "
        <b class='text-primary'>Veritabanı bilgileri:</b><br>
        Sunucu: <span class='text-warning fw-bold'>$server</span><br>
        Kullanıcı adı: <span class='text-warning fw-bold'>$username</span><br>
        Şifre: <span class='text-danger fw-bold'>$password</span><br>
        Veritabanı adı: <span class='text-info fw-bold'>$database</span><br>
        ";
        $succes = true;
    } catch (Exception $e) {
        $message = 'Bağlantı hatası: ' . $e->getMessage();
    }
endif;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Başlangıç</title>
    <link rel="stylesheet" href="/proje/public/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="text-center mt-5">YBS364 Projesi.</h1>
            <p class="text-center">Geliştirenler:</p>
            <div class="d-flex w-100 justify-content-center my-3">
                <a href="" class="btn btn-primary me-2">
                    <img src="/proje/public/images/ozgur.jpeg" alt="Özgür Özgün" class="rounded-circle" width="30">
                    <span class="ms-2">Özgür Özgün</span>
                </a>
                <a href="" class="btn btn-primary">
                    <img src="/proje/public/images/myy-profile.jpeg" alt="Özgür Özgün" class="rounded-circle"
                         width="30">
                    <span class="ms-2">Mehmet Yiğit Yalım</span>
                </a>
            </div>
            <h1 class="text-center mt-5">Veritabanı Bilgilerinizi giriniz: </h1>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="my-3">
                <div class="row">
                    <div class="col">
                        <label class="w-100">
                            <span class="fw-bold">Sunucu:</span>
                            <input type="text" class="form-control" placeholder="Server" aria-label="Server"
                                   name="server" value="localhost">
                        </label>
                    </div>
                    <div class="col">
                        <label class="w-100">
                            <span class="fw-bold">Kullanıcı Adı:</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                   name="username" value="root">
                        </label>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col">
                        <label class="w-100">
                            <span class="fw-bold">Şifre:</span>
                            <input type="text" class="form-control" placeholder="Password" aria-label="Password"
                                   name="password">
                        </label>
                    </div>
                    <div class="col">
                        <label class="w-100">
                            <span class="fw-bold">Veritabanı Adı:</span>
                            <input type="text" class="form-control" placeholder="Database" aria-label="Database"
                                   name="database" value="yigit_yalim_ozgur_ozgun_db">
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Gönder</button>
            </form>
            <?php if (!empty($message)): ?>
                <div class="text-start bg-dark text-light p-3 my-3 rounded-4">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <?php if ($succes): ?>
                <div class="alert alert-success justify-content-between d-flex align-items-center">
                    Veritabanı başarıyla oluşturuldu.
                    <a href="/proje/auth/login/student" class="btn btn-success">Devam Et</a>
                </div>
            <?php else: ?>
                <div class="alert alert-danger justify-content-between d-flex align-items-center">
                    Veritabanı oluşturulurken bir hata oluştu.
                    <button onclick="window.location.reload()" class="btn btn-danger">Tekrar Dene</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
