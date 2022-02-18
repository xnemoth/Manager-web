<?php
session_start();
require_once './connect.php';
if (!isset($_SESSION['username']) && !isset($_SESSION['access'])) {
    header('Location: /login/signIn.php');
    exit("");
}
if ($_SESSION['access'] == 0) {
    header('Location: /homepage/home.php');
    exit("");
}
$user = $_SESSION['username'];
$sqlss = mysqli_query($conn, "SELECT * FROM giangvien WHERE magv='$user'");
$ss = mysqli_fetch_array($sqlss);
mysqli_set_charset($conn, "utf8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-language" content="vi">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0ef1d9fe65.js" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="/homepage/homestyle.css">
    <link type="text/css" rel="stylesheet" href="/homepage/admin/admin.css">
    <script type="text/javascript" src="/homepage/corehandle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100 vl">
                    <ul class="nav nav-pills flex-column align-items-center align-items-sm-start" id="sidebar">
                        <li class="nav-item">
                            <a href="/homepage/home.php" class="nav-link align-middle px-0 ">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Trang chủ</span>
                            </a>
                        </li>
                        <li>
                            <hr style="color: #0D6EFD;" size="4px">
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/giangvien.php" class="nav-link align-middle px-0 active">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin giảng viên</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/hoatdong.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin hoạt động</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/donvi.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin đơn vị</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/chucvu.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin chức vụ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/trinhdo.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin trình độ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/ngachgv.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin ngạch giảng viên</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/nhiemvu.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin loại nhiệm vụ</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="col py-3">
                <div class="query-box">
                    <div class="form-floating mb-3 mt-3">
                        <input id="gvmgv" class="form-control query-info" type="text" name="gvmgv" placeholder=" ">
                        <label for="gvmgv" class="form-label">Mã giảng viên</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="gvht" class="form-control query-info" type="text" name="gvht" placeholder=" " maxlength="30">
                        <label for="gvht" class="form-label">Họ tên giảng viên</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="gvsdt" class="form-control query-info" type="text" name="gvsdt" placeholder=" " maxlength="10">
                        <label for="gvsdt" class="form-label">Số điện thoại</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="gve" class="form-control query-info" type="text" name="gve" placeholder=" " maxlength="25">
                        <label for="gve" class="form-label">Email</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="gvns" class="form-control query-info" type="date" name="gvns" placeholder=" ">
                        <label for="gvns" class="form-label">Ngày sinh</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="gvp" name="gvp">
                            <option></option>
                            <option>Nữ</option>
                            <option>Nam</option>
                        </select>
                        <label for="gvp" class="form-label">Phái</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="gvdv" name="gvdv">
                            <option></option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM donvi");
                            while ($rows = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $rows["madv"]; ?>"><?php echo $rows["tendv"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="gvdv" class="form-label">Đơn vị</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="gvtd" name="gvtd">
                            <option></option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM trinhdo");
                            while ($rows = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $rows["matd"]; ?>"><?php echo $rows["tentd"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="gvtd" class="form-label">Trình độ</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="gvn" name="gvn">
                            <option></option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM ngachgv");
                            while ($rows = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $rows["mangach"]; ?>"><?php echo $rows["tenngach"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="gvn" class="form-label">Ngạch</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="gvcv" name="gvcv">
                            <option></option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM chucvu");
                            while ($rows = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $rows["macv"]; ?>"><?php echo $rows["tencv"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="gvcv" class="form-label">Chức vụ</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="gvq" name="gvq">
                            <option></option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM taikhoan");
                            while ($rows = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $rows["maquyen"]; ?>"><?php echo $rows["tenquyen"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="gvq" class="form-label">Quyền tài khoản</label>
                    </div>
                </div>
                <div class="query-btn">
                    <input id="search" class="btn btn-success space admin-btn" type="button" value="Tra cứu"></input>
                    <button id="clear" class="btn btn-success space admin-btn" onclick="clearVal()">Xoá trắng</button>
                    <input id="update" class="btn btn-success space admin-btn" type="button" value="Cập nhật"></input>
                    <input id="delete" class="btn btn-success space admin-btn" type="button" value="Xóa"></input>
                    <button id="export" class="btn btn-success space admin-btn">Xuất</button>
                </div>
                <div class="table-responsive">
                    <table id="exporttable" class="table table-bordered">
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
                                <td>DANH SÁCH GIẢNG VIÊN</td>
                            </tr>
                            <tr class="hiddentr"></tr>
                            <tr class="hiddentr">
                                <td colspan="2">Tài khoản lập báo cáo: <?php echo $user . " - " . $ss['hoten']; ?></td>
                            </tr>
                            <tr class="hiddentr"></tr>
                            <tr>
                                <td>Mã giảng viên</td>
                                <td>Họ và tên</td>
                                <td>Giới tính</td>
                                <td>Ngày sinh</td>
                                <td>Số điện thoại</td>
                                <td>Email</td>
                                <td>Đơn vị</td>
                                <td>Trình độ</td>
                                <td>Ngạch</td>
                                <td>Chức vụ</td>
                                <td class="noExl">Quyền tài khoản</td>
                            </tr>
                        </thead>
                        <tbody id="datagv">
                        </tbody>
                        <tfoot>
                            <tr class="hiddentr"></tr>
                            <tr class="hiddentr">
                                <td></td>
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
                                <td><?php echo $ss["hoten"]; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#export").click(function() {
                var fulldate = new Date();
                var filename = "HD_" + fulldate.getHours() + fulldate.getMinutes() + fulldate.getDate() + fulldate.getSeconds() + fulldate.getMonth() + fulldate.getYear();
                $("#exporttable").table2excel({
                    name: "Danh sách",
                    filename: filename,
                });
            });

            $("#search").on("click", function() {
                $('#search').html('Đang xử lý').prop('disabled',
                    true);
                $.ajax({
                    url: "datahandle.php",
                    method: "POST",
                    data: {
                        gvadmin: 'true',
                        gvsearch: 'gvsearch',
                        gvmgv: $("#gvmgv").val(),
                        gvsdt: $("#gvsdt").val(),
                        gve: $('#gve').val(),
                        gvns: $('#gvns').val(),
                        gvht: $('#gvht').val(),
                        gvp: $('#gvp').val(),
                        gvdv: $('#gvdv').val(),
                        gvtd: $('#gvtd').val(),
                        gvn: $('#gvn').val(),
                        gvcv: $('#gvcv').val(),
                        gvq: $('#gvq').val(),
                    },
                    success: function(response) {
                        $('#search').html(
                                'Tra cứu')
                            .prop('disabled', false);
                        $('#datagv').html(response);
                    }
                });
            });

            $("#update").on("click", function() {
                $('#update').html('Đang xử lý').prop('disabled',
                    true);
                $.ajax({
                    url: "datahandle.php",
                    method: "POST",
                    data: {
                        gvadmin: 'true',
                        gvupdate: 'gvupdate',
                        gvmgv: $("#gvmgv").val(),
                        gvsdt: $("#gvsdt").val(),
                        gve: $('#gve').val(),
                        gvns: $('#gvns').val(),
                        gvht: $('#gvht').val(),
                        gvp: $('#gvp').val(),
                        gvdv: $('#gvdv').val(),
                        gvtd: $('#gvtd').val(),
                        gvn: $('#gvn').val(),
                        gvcv: $('#gvcv').val(),
                        gvq: $('#gvq').val(),
                    },
                    success: function(response) {
                        $('#update').html(
                                'Cập nhật')
                            .prop('disabled', false);
                        $('#datagv').html(response);
                    }
                });
                $("#search").click();
            });

            $("#delete").on("click", function() {
                $('#delete').html('Xoá').prop('disabled',
                    true);
                swal({
                        title: "Xóa dữ liệu giảng viên này?",
                        text: "Lưu ý: cần phải xóa dữ liệu hoạt động của giảng viên trước!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "datahandle.php",
                                method: "POST",
                                data: {
                                    gvadmin: 'true',
                                    gvdelete: 'gvdelete',
                                    gvmgv: $("#gvmgv").val(),
                                },
                                success: function(response) {
                                    $('#delete').html(
                                            'Xóa')
                                        .prop('disabled', false);
                                    $('#datagv').html(response);
                                }
                            });
                        } else {
                            $('#delete').html(
                                    'Xóa')
                                .prop('disabled', false);
                        }
                        $("#search").click();
                    });
            });
        });
    </script>
</body>

</html>