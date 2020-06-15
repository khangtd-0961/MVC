<?php
namespace Model;

require 'config.php';

class SinhVien
{
    public function getAll($sql)
    {
        global $conn;
        try {
            // $sql = 'SELECT classes.class_name, students.*, subject_point.points  FROM students INNER JOIN classes ON students.class_code_id = classes.class_code INNER JOIN subject_point ON students.student_code = subject_point.code_student_id';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            
            return $results;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), '\n';
        }
    
    }
}
// var_dump( SinhVien::getAll());
