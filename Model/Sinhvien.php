<?php
namespace Model;

require 'config.php';
class SinhVien
{
    public function getAll($sql)
    {
        global $conn;
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            return $results;
        } catch (\Throwable $th) {
            echo 'Caught exception: ',  $th->getMessage(), '\n';
        }
    }

    public function execute($stmt)
    {
        global $conn;
        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo 'Caught exception: ',  $th->getMessage(), '\n';
        }
    }

    public function addDataDiem($sql, $arraySubjectpoint)
    {
        global $conn;
        try {
            $stmt1 = $conn->prepare($sql);
            foreach ($arraySubjectpoint as $value) {
                $stmt1->execute($value);
            }
        } catch (\Throwable $th) {
            echo 'Caught exception: ',  $th->getMessage(), '\n';
        }
    }

    public function delete($sql, $sql2)
    {
        global $conn;
        try {
            $conn->exec($sql);
            $conn->exec($sql2);
        } catch (\Throwable $th) {
            echo 'Caught exception: ',  $th->getMessage(), '\n';
        }
    }
}
