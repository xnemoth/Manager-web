<?php
session_start();
require_once "../database/fetchdata.php";
if (!isset($_SESSION['username']) && !isset($_SESSION['access'])) {
    header('Location: ../login/signIn.php');
    exit("");
} else {
    $user = $_SESSION['username'];
    $sql = mysqli_query($conn, "SELECT * FROM giangvien WHERE magv='$user'");
    $result = mysqli_fetch_array($sql);
}
mysqli_set_charset($conn, "utf8");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cá nhân</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-language" content="vi">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0ef1d9fe65.js" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="/homepage/homestyle.css">
</head>

<body>
    <div id="main-page">
        <div class="header fixed-top">
            <div class="head-bar">
                <a href="https://blu.edu.vn" target="_blank"><img class="nav-pic" src="../img/blu.png"></img></a>
                <div class="banner">
                    <marquee scrollamount="8"> Chào mừng bạn đến với website của nemoth, hôm nay ngày <?php echo date("d"); ?> tháng <?php echo date("m"); ?> năm <?php echo date("Y"); ?></marquee>
                </div>
            </div>
            <ul class="nav nav-pills nav-justified" id="headNav">
                <li class="nav-item">
                    <a class="nav-link" href="./home.php"><i class="fas fa-home nav nav-icon"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#home"><i class="fas fa-user nav-icon"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./report.php"><i class="fas fa-print nav-icon"></i></a>
                </li>
                <li class="nav-item">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu"><i class="fas fa-bars nav-icon menu"></i></button>
                </li>
            </ul>
        </div>
        <br>
        <div class="container mt-3">
            <div class="tab-content">
                <div id="home" class=" tab-pane active">
                <hr size="4px" style="color: blue;">
                    <div class="container-fluid">
                        <div class="row flex-nowrap">
                            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
                                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100 vl">
                                    <ul class="nav nav-pills flex-column align-items-center align-items-sm-start" id="sidebar">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link align-middle px-0 active">
                                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">sidebar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#submenu1" data-bs-toggle="collapse" data-bs-target="#sidebarcollapse1" class="nav-link px-0 align-middle">
                                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">sidebar collapse</span> </a>
                                            <div id="sidebarcollapse1" class="collapse">
                                                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                                    <li class="w-100">
                                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr>
                                </div>
                            </div>
                            <div class="col py-3">
                                content
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <hr size="3px" style="color: blue; width: 60%; margin-left: 20%;">
                <div class="info">
                    <i>
                        <p>Phát triển bởi &copy Nemoth</p>
                        <p>Hiếu Nguyễn</p>
                        <p>Contact: 0948399769 - tronghieu1042@gmail.com</p>
                    </i>
                </div>
            </div>
        </div>

        <div id="alert">
            <script></script>
        </div>

        <div class="offcanvas offcanvas-end" id="menu">
            <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="header-username">Xin chào <?php echo $result['matd'] . ". " . $result['hoten']; ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <hr size="3px" width="50%" style="color: #0D6EFD; margin-left: 25%">
            <div class="offcanvas-body">
            <?php
                if ($_SESSION['access'] == 1) {
                    echo ('<div class="body-item">
                            <a href="/homepage/admin/giangvien.php">Quản lý</a>
                            <hr>
                        </div>
                        <div class="body-item">
                            <a href="../login/signUp.php">Tạo tài khoản</a>
                            <hr>
                        </div>');
                }
                ?>
                <div class="body-item">
                    <a href="../login/changeinfo.php">Cập nhật thông tin</a>
                    <hr>
                </div>
                <div class="body-item">
                    <a href="../login/changepass.php">Đổi mật khẩu</a>
                    <hr>
                </div>
                <button type="button" id="logout" onclick="location.href='../login/signOut.php'" value="Log out"><i class="fas fa-sign-out-alt"></i></a></button>
            </div>
        </div>


    </div>

    <script>
        $("#logout").on("click", function() {
            Swal.fire({
                title: 'Đã đăng xuất',
                text: 'Đăng xuất thành công',
                type: 'info'
            })
        })
    </script>
    <script type="text/javascript" src="./corehandle.js"></script>
</body>

</html>