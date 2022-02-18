<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login/signIn.php');
    exit("");
}
require_once "../database/fetchdata.php";
mysqli_set_charset($conn, "utf8");

if (!isset($_POST['savechange'])) {
    $oldpass   = isset($_POST['oldpass']) ? md5($_POST['oldpass']) : '';
    $newpass   = isset($_POST['newpass']) ? md5($_POST['newpass']) : '';

    $sql = "SELECT matkhau FROM giangvien WHERE magv='{$_SESSION['username']}'";
    $result = fetchResultArray($sql);
    // echo "<div id='alert'><script>Swal.fire('{$oldpass}', '{$newpass} and {$result['matkhau']}','success');</script></div>";
    if ($oldpass == $result['matkhau']){
        $sql = "UPDATE giangvien SET matkhau='$newpass' WHERE magv='{$_SESSION['username']}'";
        mysqli_query($conn, $sql);
        echo "<div id='alert'><script>Swal.fire('Thành công', 'Thay đổi mật khẩu thành công vui lòng đăng nhập lại','success');</script></div>";
        session_destroy();
    }else{
        echo "<div id='alert'><script>Swal.fire('Thất bại', 'Mật khẩu hiện tại chưa chính xác','error');</script></div>";
    }
}
mysqli_close($conn);
?>