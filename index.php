<?php
include_once 'Model/Sinhvien.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
if ($controller != '') {
    $controller = "Controller/$controller.php";
}
//load layout
include 'View/layout.php';
