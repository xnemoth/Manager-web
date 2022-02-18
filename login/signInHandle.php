<?php
session_start();
require_once '../database/connect.php';
mysqli_set_charset($conn, "utf8");
if (isset($_SESSION['username'])) {
    exit("logged");
} else {
    if (!isset($_POST['login'])) {
        $username   = isset($_POST['username']) ? mysqli_escape_string($conn, $_POST['username']) : '';
        $password   = isset($_POST['password']) ? md5($_POST['password']) : '';

        $sql = mysqli_query($conn, "SELECT * FROM giangvien WHERE magv='$username'");
        $result = mysqli_fetch_array($sql);
        if (mysqli_num_rows($sql) > 0 && $password == $result['matkhau']) {
            $_SESSION['username'] = $username;
            $_SESSION['access'] = $result['maquyen'];
            echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đăng nhập thành công','success'); setTimeout(function(){location.reload()}, 1000);</script></div>";
        } else {
            echo "<div id='alert'><script>Swal.fire('Thất bại', 'Sai tên đăng nhập hoặc mật khẩu','error');</script></div>";
        }
    }
}
mysqli_close($conn);
?>
