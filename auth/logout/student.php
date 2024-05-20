<?php
session_start();
session_destroy();
$_SESSION['student'] = [];

header("Location: /proje/login/student");