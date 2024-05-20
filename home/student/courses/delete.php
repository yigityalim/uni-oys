<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje'. '/constants.php';

$db = new Database();
$course_code = $_GET['code'] ?? header('Location: /proje/home/student/courses/index.php');

// kursu silme işlemi
if (isset($_POST['delete'])) {
    $db->delete('courses')->where('code', $course_code)->done();
    header('Location: /proje/home/student/courses/index.php');
}


