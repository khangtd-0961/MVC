<?php
namespace Controller;

use Model\SinhVien;

class SinhVienController
{
    public $model;
    public function __construct()
    {
        global $conn;
    }

    public function getAll()
    {
        $sql = 'SELECT classes.class_name, students.*, subject_point.points  FROM students INNER JOIN classes ON students.class_code_id = classes.class_code INNER JOIN subject_point ON students.student_code = subject_point.code_student_id';
        $results =  Sinhvien::getAll($sql);
        require 'View/listsinhvien.php';
    }

    public function toAdd()
    {
        $sql = 'SELECT class_code,class_name FROM classes';
        $result = SinhVien::getAll($sql);
        require 'View/add.php';
    }

    public function add()
    {
        global $conn;
        try {
            $studentCode = $_POST['student_code'];
            $classCodeId = $_POST['class_code_id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $dateBirth = $_POST['date_birth'];

            $sql = 'INSERT INTO students (student_code, class_code_id, name, sex, address, date_birth) 
            VALUES (:studentCode, :classCodeId, :name, :sex, :address, :dateBirth)';

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':studentCode', $studentCode);
            $stmt->bindParam(':classCodeId', $classCodeId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':dateBirth', $dateBirth);

            Sinhvien::execute($stmt);

            $points = $_POST['points'];
            $points1 = $_POST['points1'];
            $points2 = $_POST['points2'];
            $arraySubjectpoint = [
                [
                    $studentCode,
                    'Maths',
                    $points,
                ],
                [
                    $studentCode,
                    'Physical',
                    $points1,
                ],
                [
                    $studentCode,
                    'Chemistry',
                    $points2,
                ],
            ];
            $args = array_fill(0, count($arraySubjectpoint[0]), '?');
            $sql = 'INSERT INTO subject_point (code_student_id, subject, points) 
                VALUES (' . implode(', ', $args) . ')';
            Sinhvien::addDataDiem($sql, $arraySubjectpoint);
            header('location:index.php?controller=SinhVienController&action=getAll');
        } catch (\Throwable $th) {
            echo 'Error: ' . $th->getMessage();
        }
    }

    public function toEdit()
    {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;
        $sql = "SELECT students.*, subject_point.points, subject_point.subject ,subject_point.id FROM students JOIN subject_point ON students.student_code = subject_point.code_student_id WHERE students.id = $id";
        $result =  Sinhvien::getAll($sql);
        $sql2 = 'SELECT class_code,class_name FROM classes';
        $results = SinhVien::getAll($sql2);
        require 'View/edit.php';
    }

    public function edit()
    {
        global $conn;
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            
            $studentCode = $_POST['student_code'];
            $classCodeId = $_POST['class_code_id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $dateBirth = $_POST['date_birth'];

            $sql = "UPDATE students SET student_code = :studentCode, class_code_id = :classCodeId,
            name = :name, sex = :sex, address = :address, date_birth = :dateBirth WHERE id=$id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':studentCode', $studentCode);
            $stmt->bindParam(':classCodeId', $classCodeId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':dateBirth', $dateBirth);

            $points = $_POST['points'];
            $subjecId = $_POST['id'];
            foreach ($points as $key => $value) {
                $sql2 = 'UPDATE subject_point SET points = :points WHERE id = :subjecId';
                $stmt1 = $conn->prepare($sql2);
                $stmt1->bindParam(':points', $value);
                $stmt1->bindParam(':subjecId', $subjecId[$key]);
                Sinhvien::execute($stmt1);
            }
            Sinhvien::execute($stmt);
            header('location:index.php?controller=SinhVienController&action=getAll');
        } catch (\Throwable $th) {
            echo 'Error: ' . $th->getMessage();
        }
    }

    public function delete()
    {
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $codeStudentId = isset($_GET['code_student_id']) ? $_GET['code_student_id'] : null;
            $sql = "DELETE FROM students WHERE id = $id";
            $sql2 = "DELETE FROM subject_point WHERE code_student_id = '$codeStudentId'";
            Sinhvien::delete($sql, $sql2);
            header('location:index.php?controller=SinhVienController&action=getAll');
        } catch (\Throwable $th) {
            echo 'Error: ' . $th->getMessage();
        }
    }
}
new SinhVienController();
