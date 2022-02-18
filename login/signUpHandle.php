<?php
include '../database/connect.php';
mysqli_set_charset($conn, "utf8");

header('Content-Type: text/html; charset=UTF-8');
if (!isset($_POST['signup'])) {
    $username   = isset($_POST['magv']) ? mysqli_escape_string($conn, $_POST['magv']) : '';
    $password   = isset($_POST['matkhau']) ? md5($_POST['matkhau']) : '';
    $email      = isset($_POST['email']) ? mysqli_escape_string($conn, $_POST['email']) : '';
    $fullname   = isset($_POST['hoten']) ? mysqli_escape_string($conn, $_POST['hoten']) : '';
    $phone = isset($_POST['sodt']) ? mysqli_escape_string($conn, $_POST['sodt']) : '';
    $gender = isset($_POST['phai']) ? mysqli_escape_string($conn, $_POST['phai']) : '';
    $bday = isset($_POST['ns']) ? mysqli_escape_string($conn, $_POST['ns']) : '';
    $ngachgv = isset($_POST['mangach']) ? mysqli_escape_string($conn, $_POST['mangach']) : '';
    $bacgv = isset($_POST['matd']) ? mysqli_escape_string($conn, $_POST['matd']) : '';
    $chucvu = isset($_POST['macv']) ? mysqli_escape_string($conn, $_POST['macv']) : '';
    $donvi = isset($_POST['madv']) ? mysqli_escape_string($conn, $_POST['madv']) : '';
    $access = isset($_POST['access']) ? mysqli_escape_string($conn, $_POST['access']) : '';

    $sql = mysqli_query($conn, "SELECT * FROM giangvien WHERE magv='$username' OR email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        echo "<div id='alert'><script>Swal.fire('Đăng ký thất bại', 'Tên đăng nhập hoặc email đã có người sử dụng','error');</script></div>";
        die;
    } else {
        @$sql = "INSERT INTO giangvien(magv, hoten, phai, ngaysinh, sodt, email, madv, matd, mangach, macv, matkhau, maquyen) VALUES ('$username','$fullname','$gender','$bday','$phone','$email','$donvi','$bacgv','$ngachgv','$chucvu','$password','$access')";

        if (mysqli_query($conn, $sql))
        echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đăng ký thành công tài khoản $username','success'); setTimeout(function(){location.reload()}, 1000);</script></div>";
        else
        echo "<div id='alert'><script>Swal.fire('Thất bại', 'Đăng ký thất bại','error');</script></div>";
    }
}
mysqli_close($conn);
?>
