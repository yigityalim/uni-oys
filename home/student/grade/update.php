<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/login/student');
}
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proje' . '/constants.php';

$db = new Database();

$student = $_SESSION['student'];
$data = $_POST;

function post($key, $reqired = false)
{
    if ($reqired && !isset($_POST[$key])) {
        return null;
    }
    return $_POST[$key] ?? null;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = post('student_id', true);
    $course_code = post('course_code', true);
    $season = post('season', true);

    if (
        !$student_id || !$course_code || !$season
    ) {
        $errors[] = 'Lütfen tüm alanları doldurunuz.';
    }

    if (empty($errors)) {
        $db->update('student_courses')->where('student_id', $student_id)->where('course_code', $course_code)->where('season', $season)->set([
            'student_id' => $student_id,
            'course_code' => $course_code,
            'season' => $season,
            'grade' => post('grade'),
        ]);
        $student = $db->from('students')->where('id', $student['id'])->first();
        $_SESSION['student'] = $student;
        header('location: /proje/home/student/profile');
    }
}


