<?php
require_once 'Helpers.php';
require_once 'db.php';
require_once 'Session.php';
$db = new Database();

$code = Helpers::get('code');
$id = Helpers::get('id');

$lesson = $db->delete('lessons')
    ->where('code', $code)
    ->where('id', $id)
    ->done();

Helpers::redirect('courses.php');