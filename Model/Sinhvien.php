<?php
require_once '../config.php';
require 'config.php';

namespace Model\SinhVien;

class SinhVien
{
    public function getAll($sql)
    {
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            
            return $results;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), '\n';
        }
    
    }
}
