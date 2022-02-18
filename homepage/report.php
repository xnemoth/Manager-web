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
    <title>Tổng hợp</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    </script>
</head>

<body>
    <div id="main-page">
        <div class="header fixed-top">
            <div class="head-bar">
                <a href="https://blu.edu.vn"><img class="nav-pic" src="../img/blu.png"></img></a>
                <div class="banner">
                    <marquee scrollamount="8"> Chào mừng bạn đến với website của nemoth, hôm nay ngày <?php echo date("d"); ?> tháng <?php echo date("m"); ?> năm <?php echo date("Y"); ?></marquee>
                </div>
            </div>
            <ul class="nav nav-pills nav-justified" id="headNav">
                <li class="nav-item">
                    <a class="nav-link" href="./home.php"><i class="fas fa-home nav nav-icon"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#home"><i class="fas fa-print nav-icon"></i></a>
                </li>
                <li class="nav-item">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu"><i class="fas fa-bars nav-icon menu"></i></button>
                </li>
            </ul>
        </div>
        <br>
        <div class="container mt-3">
            <div class="tab-content">
                <div id="home" class=" tab-pane active"><br>
                    <div class="query-box">
                        <div class="input-group mb-3 query-info" style="width:25%;height:69px;">
                            <span class="input-group-text" style="height:32px;">Năm học</span>
                            <input id="reportnh1" type="number" name="reportnh1" class="form-control" placeholder="Từ" style="width:50%;height:32px;" max="9999" min="0">
                            <input id="reportnh2" type="number" name="reportnh2" class="form-control" placeholder="Đến" style="width:50%;height:32px;" max="9999" min="0">
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input id="reportst" class="form-control query-info" type="number" name="reportst" placeholder=" " max="5" style="height:65px;">
                            <label for="reportst" class="form-label">Số tiết</label>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <select class="form-select query-info" id="reportmnv" name="reportmnv" style="height:65px;">
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
                            <label for="reportmnv" class="form-label">Loại công việc</label>
                        </div>
                    </div>
                    <div class="query-btn">
                        <input id="search" class="btn btn-success space admin-btn" type="button" value="Tìm kiếm"></input>
                        <button id="clear" class="btn btn-success space admin-btn" onclick="clearVal()">Xoá trắng</button>
                        <button id="export" class="btn btn-success space admin-btn" type="button">Xuất</button>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="table2excel" class="table table-bordered">
                            <thead>
                                <tr class="hiddentr">
                                    <td colspan="2">UBND TỈNH BẠC LIÊU</td>
                                    <td></td>
                                    <td colspan="2">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
                                </tr>
                                <tr class="hiddentr">
                                    <td colspan="2">TRƯỜNG ĐẠI HỌC BẠC LIÊU</td>
                                    <td></td>
                                    <td colspan="2">Độc lập - Tự do - Hạnh phúc </td>
                                </tr>
                                <tr class="hiddentr">
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">Bạc Liêu, <?php echo date("d"); ?> tháng <?php echo date("m"); ?> năm <?php echo date("Y"); ?></td>
                                </tr>
                                <tr class="hiddentr"></tr>
                                <tr class="hiddentr" style="font-size: 20px;">
                                    <td></td>
                                    <td>BẢNG THỐNG KÊ GIỜ CÔNG TÁC CỦA GIẢNG VIÊN</td>
                                </tr>
                                <tr class="hiddentr"></tr>
                                <tr class="hiddentr">
                                    <td colspan="2">Người báo cáo:</td>
                                    <td colspan="2"><?php echo $user . " - " . $result['hoten']; ?></td>
                                </tr>
                                <tr class="hiddentr">
                                    <td colspan="2">Đơn vị</td>
                                    <td colspan="2"><?php $q = mysqli_query($conn, "SELECT tendv FROM donvi,giangvien WHERE magv='$user' AND giangvien.madv=donvi.madv");
                                            $kq = mysqli_fetch_array($q);
                                            echo $kq['tendv']; ?></td>
                                </tr>
                                <tr class="hiddentr noExl"></tr>
                                <tr class='noExl'>
                                    <th>Năm học</th>
                                    <th>Loại nhiệm vụ</th>
                                    <th>Chi tiết nhiệm vụ</th>
                                    <th>Số tiết</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody id="reportdata">
                            </tbody>
                            <tfoot>
                            <tr class="hiddentr"></tr>
                            <tr class="hiddentr">
                                <td>Xác nhận của đơn vị</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Người lập báo cáo</td>
                            </tr>
                            <tr class="hiddentr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Ký tên</td>
                            </tr>
                            <tr class="hiddentr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $result["hoten"]; ?></td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
                <div class="footer">
                    <hr size="3px" style="color: blue; width: 60%; margin-left: 20%;">
                    <div class="info-footer">
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

            $("#export").click(function() {
                var fulldate = new Date();
                var filename = "HD_" + fulldate.getHours() + fulldate.getMinutes() + fulldate.getDate() + fulldate.getSeconds() + fulldate.getMonth() + fulldate.getYear();
                $("#table2excel").table2excel({
                    exclude: ".noExl",
                    name: "Báo cáo hoạt động",
                    filename: filename,
                    fileext: ".xls",
                });
            });

            $(document).ready(function() {
                $("#search").on("click", function() {
                    $('#search').html('Đang xử lý').prop('disabled',
                        true);
                    $.ajax({
                        url: "getdatauser.php",
                        method: "POST",
                        data: {
                            reportsearch: 'reportsearch',
                            reportnh1: $("#reportnh1").val(),
                            reportnh2: $('#reportnh2').val(),
                            reportst: $('#reportst').val(),
                            reportmnv: $('#reportmnv').val(),
                        },
                        success: function(response) {
                            $('#search').html(
                                    'Tra cứu')
                                .prop('disabled', false);
                            $('#reportdata').html(response);
                        }
                    });
                });

                // $("#export").on("click", function() {
                //     $('#export').html('Đang xử lý').prop('disabled',
                //         true);
                //     $.ajax({
                //         url: "/data/exportExcel.php",
                //         method: "POST",
                //         data: {
                //             reportexport: 'reportexport',
                //             reportnh1: $("#reportnh1").val(),
                //             reportnh2: $('#reportnh2').val(),
                //             reportst: $('#reportst').val(),
                //             reportmnv: $('#reportmnv').val(),
                //         },
                // success: function(response) {
                //     $('#search').html(
                //             'Tra cứu')
                //         .prop('disabled', false);
                // }
                // });
                // });

            });
        </script>
        <script type="text/javascript" src="./corehandle.js"></script>
</body>

</html>