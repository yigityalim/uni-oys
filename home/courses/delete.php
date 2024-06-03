<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();
$id = $_GET['id'];

// kursu silme işlemi
$db->delete('courses')->where('id', $id)->done();
$db->delete('student_courses')->where('course_id', $id)->done();

header('Location: /proje/home/courses/index.php');


