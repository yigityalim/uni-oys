<?php
session_start();
session_destroy();
$_SESSION['academician'] = [];

header("Location: /proje/login/academician");