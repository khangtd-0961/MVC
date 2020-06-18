<?php
session_start();
include_once 'Model/Sinhvien.php';

use Controller\LoginController;
use Controller\SinhVienController;

$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($controller != '') {
    $controllers = "Controller/$controller.php";
}
//load layout
include 'View/layout.php';
switch ($controller) {
    case 'SinhVienController':
        $controllerName = new SinhVienController();
        switch ($action) {
            case 'getAll':
                return $controllerName->getAll();
                break;
            case 'toAdd':
                return $controllerName->toAdd();
                break;
            case 'add':
                return $controllerName->add();
                break;
            case 'toEdit':
                return $controllerName->toEdit();
                break;
            case 'edit':
                return $controllerName->edit();
                break;
            case 'delete':
                return $controllerName->delete();
                break;
            default:
                # code...
                break;
        }
        break;
    
    case 'LoginController':
        $controllerName = new LoginController();
        switch ($action) {
            case 'logout':
                return $controllerName->logout();
                break;
            
            default:
                # code...
                break;
        }
        break;
}
