<?php 
session_start(); 
 
if (isset($_SESSION['username'])){
    unset($_SESSION['username']); 
    session_destroy();
    //echo "<div id='alert'><script> Swal.fire('Đã đăng xuất', 'Đăng xuất thành công','info');</script></div>";
    sleep(1);
    header('Location: http://www.hieun.tk');
}
?>
