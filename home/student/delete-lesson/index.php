<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/login/student');
}
require '../../../db.php';
$db = new Database();

$code = $_GET['code'];
$id = $_GET['id'];

$lesson = $db->delete('lessons')
    ->where('code', $code)
    ->where('id', $id)
    ->done();

header('location: /proje/home/student');