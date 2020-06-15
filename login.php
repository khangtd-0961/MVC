<?php
session_start();
include('config.php');
?>
<?php
$msg = '';
if (isset($_POST['submitBtnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username != '' && $password != '') {
        try {
            // $query = 'select * from users where username='.':username'.' and password=' . md5(':password') . '';
            if (stripos($username, '@') !== false) {
                $query = 'select * from users where email = :username and password = md5(:password)';
            } else {
                $query = 'select * from users where username = :username and password = md5(:password)';
            }
            $stmt = $db->prepare($query);
            $stmt->bindParam('username', $username, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($stmt->fetchAll());
            // die();
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
                    header('Location:login.php?error=1');
                }//invalid user
                header('location:home.php');
            } else {
                $msg = 'Invalid username and password!';
            }
        } catch (PDOException $e) {
            echo 'Error : '.$e->getMessage();
        }
    } else {
        $msg = 'Both fields are required!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form method="post">
  <table class="loginTable">
     <tr>
      <th>ADMIN PANEL LOGIN</th>
     </tr>
     <tr>
      <td>
        <label class="firstLabel">Username:</label>
        <input type="text" name="username" id="username" value="" autocomplete="off" />
      </td>
     </tr>
     <tr>
      <td><label>Password:</label>
        <input type="password" name="password" id="password" value="" autocomplete="off" /></td>
     </tr>
     <tr>
      <td><input type="checkbox" name="rememberme" value="1" />&nbsp;Remember Me</td>
     </tr>
     <tr>
      <td>
         <input type="submit" name="submitBtnLogin" id="submitBtnLogin" value="Login" />
         <span class="loginMsg"><?php echo @$msg;?></span>
      </td>
     </tr>
  </table>
</form>
</body>
</html>