<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div id="menu">
    <ul>
        <li><a href="index.php?controller=SinhVienController&action=getAll">Trang chủ</a></li>
        <li><a href="index.php?controller=SinhVienController&action=all">Sinh viên</a></li>
        <li><a href="#">Điểm</a></li>
        <li><a href="#">Lớp</a></li>
        <li><a href="#">Môn Học</a></li>
        <li><a href="index.php?controller=LoginController&action=logout">Logout</a></li>
    </ul>
</div>
<?php

if (file_exists($controllers) === true) {
    include_once $controllers;
}
?>
</body>
</html>