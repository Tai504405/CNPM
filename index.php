<?php
session_start();
require_once 'utils.php';

$msg = "";
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($username) || empty($password)) {
        $msg = "Điền đầy đủ username và password";
    } elseif (!isValidInput($username)) {
        $msg = "username không được dùng kí tự unicode";
    } elseif (!isValidInput($password)) {
        $msg = "password không được dùng kí tự unicode";
    } elseif (!findUser($username, $password)) {
        $msg = "Sai thông tin đăng nhập";
    } else {
        $_SESSION['user'] = $username;
        if ($remember) {
            setcookie("user", $username, time() + (86400 * 30), "/");
        } else {
            setcookie("user", "", time() - 3600, "/");
        }
        header("Location: home.php");
        exit;
    }
}
?>

<!-- HTML FORM -->
<form method="post" action="">
  <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username) ?>">
  <input type="password" name="password" placeholder="Password">
  <label><input type="checkbox" name="remember"> Nhớ đăng nhập</label>
  <button type="submit">Login</button>
  <a href="register.php">Đăng ký</a>
  <a href="forgotpassword.php">Quên mật khẩu</a>
  <p style="color:red"><?= $msg ?></p>
</form>
