<?php
session_start();
if (!isset($_SESSION['academician'])) {
    header('location: /proje/login/student');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <title>ÖYS | Akademisyen</title>
</head>
<body class="bg-light">
<pre>
    <?php
    print_r($_SESSION['academician']);
    ?>
</pre>
<a href="/proje/logout/academician.php" class="btn btn-primary">Çıkış Yap</a>
</body>
</html>
