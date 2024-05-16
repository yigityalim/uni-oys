<?php
session_start();
if (!isset($_SESSION['student'])) {
    header('location: /proje/login/student');
}
require '../../db.php';
require '../../constants.php';

$db = new Database();

$student = $_SESSION['student'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/proje/public/bootstrap.min.css" rel="stylesheet">
    <title>ÖYS | Öğrenci</title>
</head>
<body class="bg-light">
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mt-5">Öğrenci Paneli</h1>
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="card-title mb-0">Öğrenci Bilgileri</h5>
                    <a href="/proje/logout/student.php" class="btn btn-danger mt-3">Çıkış Yap</a>
                </div>
                <div class="card-body">
                    <p><strong>Ad Soyad:</strong> <?php echo $student['name']; ?></p>
                    <p><strong>Öğrenci No:</strong> <?php echo $student['student_no']; ?></p>
                    <p><strong>Bölüm:</strong> <?php echo $student['department']; ?></p>
                    <p><strong>Sınıf:</strong> <?php echo $student['class']; ?></p>
                    <p><strong>Telefon:</strong> <?php echo $student['phone']; ?></p>
                    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dersler</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Ders Kodu</th>
                            <th>Ders Adı</th>
                            <th>Ders Kredisi</th>
                            <th>Öğretim Görevlisi</th>
                            <th>Not</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = $db->query('SELECT * FROM student_courses WHERE student_id = :student_id');
                        $query->execute(['student_id' => $student['id']]);
                        $studentCourses = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($studentCourses as $studentCourse) {
                            $query = $db->query('SELECT * FROM courses WHERE id = :course_id');
                            $query->execute(['course_id' => $studentCourse['course_id']]);
                            $course = $query->fetch(PDO::FETCH_ASSOC);

                            $query = $db->query('SELECT * FROM teachers WHERE id = :teacher_id');
                            $query->execute(['teacher_id' => $course['teacher_id']]);
                            $teacher = $query->fetch(PDO::FETCH_ASSOC);

                            $query = $db->query('SELECT * FROM grades WHERE student_id = :student_id AND course_id = :course_id');
                            $query->execute(['student_id' => $student['id'], 'course_id' => $course['id']]);
                            $grade = $query->fetch(PDO::FETCH_ASSOC);

                            echo '<tr>';
                            echo '<td>' . $course['code'] . '</td>';
                            echo '<td>' . $course['name'] . '</td>';
                            echo '<td>' . $course['credit'] . '</td>';
                            echo '<td>' . $teacher['name'] . '</td>';
                            echo '<td>' . ($grade ? $grade['grade'] : 'Henüz not girilmemiş') . '</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
