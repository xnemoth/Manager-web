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
    <title>Nhà </title>
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
                    <a class="nav-link active" data-bs-toggle="pill" href="#home"><i class="fas fa-home nav nav-icon"></i></a>
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
                <div id="home" class="tab-pane active"><br>
                    <div id="canvas" class="carousel slide" data-bs-ride="carousel">

                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#canvas" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#canvas" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#canvas" data-bs-slide-to="2"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../img/myInfo.jpg" alt="Hiếu Nguyễn" class="d-block w-100 h-10">
                            </div>
                            <div class="carousel-item">
                                <a href="https://cntt.blu.edu.vn" target="_blank"><img src="../img/CNTT_BLU.png" alt="Công nghệ thông tin BLU" class="d-block w-100 h-10"></a>
                            </div>
                            <div class="carousel-item">
                                <a href="https://facebook.com/hieun1042" target="_blank">
                                    <img src="../img/ThankYou.png" alt="Cảm ơn" class="d-block w-100 h-10"></a>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#canvas" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#canvas" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                    <hr size="4px" style="color: blue;">
                    <div class="container-fluid">
                        <div class="row flex-nowrap">
                            <div class="col-auto col-md-2 col-xl-2 px-sm-2 px-0">
                                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100 vl">
                                    <ul class="nav nav-pills flex-column align-items-center align-items-sm-start" id="sidebar" role="tablist">
                                        <li id="tab1" class="nav-item">
                                            <a id="tablink1" href="#datatab1" data-bs-toggle="pill" class="nav-link align-middle px-0 active">
                                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin</span>
                                            </a>
                                        </li>
                                        <li id="tab2" class="nav-item">
                                            <a id="tablink2" href="#datatab2" data-bs-toggle="pill" class="nav-link align-middle px-0">
                                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Truy xuất</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <hr>
                                </div>
                            </div>
                            <div class="col py-3">
                                <div class="tab-content">
                                    <div id="datatab1" class="tab-pane active">
                                        <div class='table-responsive'>
                                            <table class='table table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>Nhiệm vụ</th>
                                                        <th>Năm học</th>
                                                        <th>Số tiết</th>
                                                        <th>Ghi chú</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='datahome'>
                                                </tbody>
                                            </table>
                                            <br>
                                            <div class="info-box">
                                                <div class="input-group mb-3 query-info">
                                                    <span class="input-group-text" style="height:32px;">Năm học</span>
                                                    <input id="hnh1" type="number" name="hnh1" class="form-control" placeholder="Từ" style="width:50%;height:32px;" max="9999" min="0">
                                                    <input id="hnh2" type="number" name="hnh2" class="form-control" placeholder="Đến" style="width:50%;height:32px;" max="9999" min="0">
                                                </div>
                                                <div class="form-floating mb-3 mt-3">
                                                    <input id="hst" class="form-control query-info" type="number" name="hst" placeholder=" " max="5">
                                                    <label for="hst" class="form-label">Số tiết</label>
                                                </div>
                                                <div class="form-floating mb-3 mt-3">
                                                    <select class="form-select query-info" id="hmnv" name="hmnv" style="height:75px;">
                                                        <option></option>
                                                        <?php
                                                        $lnv = mysqli_query($conn, "SELECT * FROM loainv");
                                                        while ($rows = mysqli_fetch_array($lnv)) {
                                                        ?>
                                                            <option value="<?php echo $rows["loainv"]; ?>"><?php echo $rows["tennv"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="hmnv" class="form-label">Loại công việc</label>
                                                </div>
                                                <div class="form-floating mb-3 mt-3">
                                                    <textarea id="hctnv" class="form-control query-info" type="text" name="hctnv" placeholder="" style="height:100px"></textarea>
                                                    <label for="hctnv" class="form-label">Chi tiết công việc</label>
                                                </div>
                                                <div class="form-floating mb-3 mt-3">
                                                    <textarea id="hgc" class="form-control query-info" type="text" name="hgc" placeholder=" " style="height:120px"></textarea>
                                                    <label for="hgc" class="form-label">Ghi chú thêm</label>
                                                </div>
                                            </div>
                                            <div class="query-btn">
                                                <input id="add" class="btn btn-success space home-btn" type="button" value="Thêm mới"></input>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="datatab2" class="tab-pane fade"><br>
                                        <div class="query-box">
                                            <div class="form-floating mb-3 mt-3">
                                                <input id="tab2hmhd" class="form-control query-info" type="number" name="tab2hmhd" placeholder=" ">
                                                <label for="tab2hmhd" class="form-label">Mã hoạt động</label>
                                            </div>
                                            <div class="input-group mb-3 query-info" style="width:25%;height:69px;">
                                                <span class="input-group-text" style="height:32px;">Năm học</span>
                                                <input id="tab2hnh1" type="number" name="tab2hnh1" class="form-control" placeholder="Từ" style="width:50%;height:32px;" max="9999" min="0">
                                                <input id="tab2hnh2" type="number" name="tab2hnh2" class="form-control" placeholder="Đến" style="width:50%;height:32px;" max="9999" min="0">
                                            </div>
                                            <div class="form-floating mb-3 mt-3">
                                                <input id="tab2hst" class="form-control query-info" type="number" name="tab2hst" placeholder=" " max="5">
                                                <label for="tab2hst" class="form-label">Số tiết</label>
                                            </div>
                                            <div class="form-floating mb-3 mt-3">
                                                <select class="form-select query-info" id="tab2hmnv" name="tab2hmnv">
                                                    <option></option>
                                                    <?php
                                                    $tab2result2 = mysqli_query($conn, "SELECT * FROM loainv");
                                                    while ($rows = mysqli_fetch_array($tab2result2)) {
                                                    ?>
                                                        <option value="<?php echo $rows["loainv"]; ?>"><?php echo $rows["tennv"]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <label for="tab2hmnv" class="form-label">Loại công việc</label>
                                            </div>
                                            <div class="form-floating mb-3 mt-3">
                                                <input id="tab2hctnv" class="form-control query-info" type="text" name="tab2hctnv" placeholder=" " size="120">
                                                <label for="tab2hctnv" class="form-label">Chi tiết công việc</label>
                                            </div>
                                            <div class="form-floating mb-3 mt-3">
                                                <input id="tab2hgc" class="form-control query-info" type="text" name="tab2hgc" placeholder=" " size="120">
                                                <label for="tab2hgc" class="form-label">Ghi chú thêm</label>
                                            </div>
                                            <input id="search" class="btn btn-success space admin-btn" type="button" value="Tra cứu"></input>
                                            <button id="clear" class="btn btn-success space admin-btn" onclick="clearVal()">Xoá trắng</button>
                                            <input id="update" class="btn btn-success space admin-btn" type="button" value="Cập nhật"></input>
                                        </div>
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Mã hoạt động</th>
                                                    <th>Năm học</th>
                                                    <th>Loại nhiệm vụ</th>
                                                    <th>Chi tiết nhiệm vụ</th>
                                                    <th>Số tiết</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tab2datahome">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr size="3px" style="color: blue; width: 60%; margin-left: 20%;">
                        <div class="info-footer">
                            <i>
                                <p>Phát triển bởi &copy Nemoth</p>
                                <p>Hiếu Nguyễn</p>
                                <p>Contact: 0948399769</p>
                                <p>tronghieu1042@gmail.com</p>
                            </i>
                        </div>
                    </div>
                </div>
            </div>
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
                            <a href=" /homepage/admin/giangvien.php">Quản lý</a>
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

        function getdata() {
            $.ajax({
                url: 'getdatauser.php',
                method: 'POST',
                data: {
                    homeinfo: 'true',
                },
                success: function(response) {
                    $('#datahome').html(response);
                }
            });
            document.getElementById('hnh1').value = "";
            document.getElementById('hnh2').value = "";
            document.getElementById('hst').value = "";
            document.getElementById('hmnv').value = "";
            document.getElementById('hctnv').value = "";
            document.getElementById('hgc').value = "";
        }

        $(document).ready(function() {
            getdata();

            $("#search").on("click", function() {
                $('#search').html('Đang xử lý').prop('disabled',
                    true);
                $.ajax({
                    url: "getdatauser.php",
                    method: "POST",
                    data: {
                        tab2hsearch: 'tab2hsearch',
                        tab2hmhd: $("#tab2hmhd").val(),
                        tab2hnh1: $("#tab2hnh1").val(),
                        tab2hnh2: $('#tab2hnh2').val(),
                        tab2hst: $('#tab2hst').val(),
                        tab2hmnv: $('#tab2hmnv').val(),
                        tab2hctnv: $('#tab2hctnv').val(),
                        tab2hgc: $('#tab2hgc').val(),
                    },
                    success: function(response) {
                        $('#search').html(
                                'Tra cứu')
                            .prop('disabled', false);
                        $('#tab2datahome').html(response);
                    }
                });
            });

            $("#update").on("click", function() {
                $('#update').html('Đang xử lý').prop('disabled',
                    true);
                $.ajax({
                    url: "getdatauser.php",
                    method: "POST",
                    data: {
                        tab2hupdate: 'tab2hupdate',
                        tab2hmhd: $("#tab2hmhd").val(),
                        tab2hnh1: $("#tab2hnh1").val(),
                        tab2hnh2: $('#tab2hnh2').val(),
                        tab2hmgv: $('#tab2hmgv').val(),
                        tab2hst: $('#tab2hst').val(),
                        tab2hmnv: $('#tab2hmnv').val(),
                        tab2hctnv: $('#tab2hctnv').val(),
                        tab2hgc: $('#tab2hgc').val(),
                    },
                    success: function(response) {
                        $('#update').html(
                                'Cập nhật')
                            .prop('disabled', false);
                        $('#tab2datahome').html(response);
                    }
                });
                $("#search").click();
            });

            $("#add").on("click", function() {
                $('#add').html('Đang xử lý').prop('disabled',
                    true);
                $.ajax({
                    url: "getdatauser.php",
                    method: "POST",
                    data: {
                        homeadd: 'homeadd',
                        hnh1: $("#hnh1").val(),
                        hnh2: $("#hnh2").val(),
                        hst: $("#hst").val(),
                        hmnv: $("#hmnv").val(),
                        hctnv: $("#hctnv").val(),
                        hgc: $("#hgc").val(),
                    },
                    success: function(response) {
                        $('#add').html(
                                'Thêm mới')
                            .prop('disabled', false);
                        $('#alert').html(response);
                        getdata();
                    }
                });
            });
        });

        tab1 = document.getElementById("tab1");
        tab2 = document.getElementById("tab2");
        tablink1 = document.getElementById("tablink1");
        tablink2 = document.getElementById("tablink2");

        tab1.addEventListener("click", function() {
            tablink2.classList.remove("active");
            tablink1.classList.add("active");
        });

        tab2.addEventListener("click", function() {
            tablink1.classList.remove("active");
            tablink2.classList.add("active");
        });
    </script>
    <script type="text/javascript" src="./corehandle.js"></script>
</body>

</html>