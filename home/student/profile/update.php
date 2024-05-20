<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/auth/login/student');
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
    $name = post('name', true);
    $email = post('email', true);
    $department_id = post('department_id');
    $lecturer_id = post('advisor_id');
    $image = post('image');
    $password = post('password');

    if (
        !$name || !$email
    ) {
        $errors[] = 'Lütfen tüm alanları doldurunuz.';
    }

    if (empty($errors)) {
        $db->update('students')->where('id', $student['id'])->set([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'department_id' => $department_id,
            'advisor_id' => $lecturer_id,
        ]);
        $student = $db->from('students')->where('id', $student['id'])->first();
        $_SESSION['student'] = $student;
        header('location: /proje/home/student/profile');
    }
}


