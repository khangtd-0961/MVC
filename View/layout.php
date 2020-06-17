<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div id="menu">
    <ul>
        <li><a href="index.php?controller=SinhVienController">Trang chủ</a></li>
        <li><a href="index.php?controller=SinhVienController">Sinh viên</a></li>
        <li><a href="#">Điểm</a></li>
        <li><a href="#">Lớp</a></li>
        <li><a href="#">Môn Học</a></li>
    </ul>
</div>
<?php

if (file_exists($controller) === true) {
    include_once $controller;
}
?>
</body>
</html>