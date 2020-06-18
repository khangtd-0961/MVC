<?php
namespace Controller;

use Model\SinhVien;

class LoginController
{
    public function login()
    {
        global $conn;
        $msg = '';
        if (isset($_POST['submitBtnLogin'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            die();
            if ($username != '' && $password != '') {
                die();
                try {
                    if (stripos($username, '@') !== false) {
                        $query = 'select * from users where email = :username and password = md5(:password)';
                    } else {
                        $query = 'select * from users where username = :username and password = md5(:password)';
                    }
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam('username', $username, PDO::PARAM_STR);
                    $stmt->bindValue('password', $password, PDO::PARAM_STR);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($count == 1 && !empty($row)) {
                        /******************** Your code ***********************/
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['logged'] = 1;
                        $_SESSION['valid_user'] =1;
                        if (($_POST['remember_me'] == 1) || ($_POST['remember_me'] == 'on')) {
                            $hour = time()+3600 *24 * 30;
                            setcookie('id', $row['id'], $hour);
                            setcookie('username', $username, $hour);
                            setcookie('active', 1, $hour);
                        } else {
                            header('Location:index.php?error=1');
                        }//invalid user
                        header('location:index.php?controller=SinhVienController&action=getAll');
                    } else {
                        $msg = 'Invalid username and password!';
                    }
                } catch (PDOException $e) {
                    echo 'Error : '.$e->getMessage();
                }
            } else {
                header('Location:login.php?error=1');
                $msg = 'Both fields are required!';
            }
        }
        include 'View/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('location:index.php');
    }
}
