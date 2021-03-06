<?php
namespace Controller;

echo 'ok';
class SinhVienController
{
    public $model;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    switch ($action) {
        case 'add':
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
                foreach ($arraySubjectpoint as $value) {
                    $sql = 'INSERT INTO subject_point (code_student_id, subject, points) 
                    VALUES (' . implode(', ', $args) . ')';
                    Sinhvien::addDataDiem($sql, $value);
                }
                header('location:index.php');
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            break;
    
        case 'delete':
            try {
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $codeStudentId = isset($_GET['code_student_id']) ? $_GET['code_student_id'] : null;
                $sql = "DELETE FROM students WHERE id = $id";
                $sql2 = "DELETE FROM subject_point WHERE code_student_id = '$codeStudentId'";
                Sinhvien::delete($sql, $sql2);
                header('location:index.php');
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            break;
    
        case 'edit':
            try {
                $id = isset($_GET['id']) ? $_GET['id'] : null;
    
                $studentCode = $_POST['student_code'];
                $classCodeId = $_POST['class_code_id'];
                $name = $_POST['name'];
                $sex = $_POST['sex'];
                $address = $_POST['address'];
                $dateBirth = $_POST['date_birth'];
                $subjecId = $_POST['id'];
                $points = $_POST['points'];
    
                $sql = "UPDATE students SET student_code = :studentCode, class_code_id = :classCodeId,
                name = :name, sex = :sex, address = :address, date_birth = :dateBirth WHERE id=$id";
    
                $stmt = $conn->prepare($sql);
    
                $stmt->bindParam(':studentCode', $studentCode);
                $stmt->bindParam(':classCodeId', $classCodeId);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':sex', $sex);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':dateBirth', $dateBirth);
    
                
                foreach ($points as $key => $value) {
                    $sql2 = 'UPDATE subject_point SET points = :points WHERE id = :subjecId';
                    $stmt1 = $conn->prepare($sql2);
                    $stmt1->bindParam(':points', $value);
                    $stmt1->bindParam(':subjecId', $subjecId[$key]);
                    Sinhvien::execute($stmt1);
                }
                Sinhvien::execute($stmt);
                header('location:index.php');
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            break;
    }
    $sql = 'SELECT classes.class_name, students.*, subject_point.points  FROM students INNER JOIN classes ON students.class_code_id = classes.class_code INNER JOIN subject_point ON students.student_code = subject_point.code_student_id';
    $result = Sinhvien::getAll($sql);
}
$a = new SinhVienController();
