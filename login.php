<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($koneksi, $sql);
    $user = mysqli_fetch_assoc($result);

    // Untuk keamanan, gunakan password hash pada produksi
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = $user['level'];
        header("Location: admin.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .login-box {
            background: #fff; width: 320px; margin: 100px auto; padding: 24px 30px;
            border: 1px solid #ddd; border-radius: 4px;
        }
        .login-box h2 { text-align: center; }
        .login-box input { width: 100%; padding: 8px 6px; margin: 8px 0; }
        .login-box button { width: 100%; padding: 8px; background: #2980b9; border: none; color: #fff; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if($error) echo '<div class="error">'.$error.'</div>'; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required autocomplete="off">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
