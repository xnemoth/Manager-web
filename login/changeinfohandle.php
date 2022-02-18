<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login/signIn.php');
    exit("");
}
require_once "../database/fetchdata.php";
mysqli_set_charset($conn, "utf8");
$username = $_SESSION['username'];

if (!isset($_POST['savechange'])) {
    $email = isset($_POST['email']) ? mysqli_escape_string($conn, $_POST['email']) : '';
    $phone = isset($_POST['sodt']) ? mysqli_escape_string($conn, $_POST['sodt']) : '';
    $gender = isset($_POST['phai']) ? mysqli_escape_string($conn, $_POST['phai']) : '';
    $bday = isset($_POST['ns']) ? mysqli_escape_string($conn, $_POST['ns']) : '';

    $sql = "SELECT email FROM giangvien WHERE email='$email' AND magv!='$username'";
    if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
        echo "<div id='alert'><script>Swal.fire('Cập nhật không thành công', 'Email này đã có người đăng ký','warning');</script></div>";
    } else {
        $sql = "UPDATE giangvien SET email='$email', sodt='$phone', phai='$gender', ngaysinh='$bday' WHERE magv='{$_SESSION['username']}'";
        if (mysqli_query($conn, $sql)) {
            echo "<div id='alert'><script>Swal.fire('Thành công', 'Cập nhật thông tin thành công','success');</script></div>";
        } else {
            echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra!','error');</script></div>";
        }
    }
    mysqli_close($conn);
}
