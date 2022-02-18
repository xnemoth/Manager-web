<?php
session_start();
require_once "./connect.php";
if (!isset($_SESSION['username']) && !isset($_SESSION['access'])) {
    header('Location: /login/signIn.php');
    exit("");
}
if ($_SESSION['access'] == 0) {
    header('Location: /homepage/home.php');
    exit("");
}
$user = $_SESSION['username'];
$xsql = mysqli_query($conn, "SELECT * FROM giangvien WHERE magv='$user'");
$xresult = mysqli_fetch_array($xsql);
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
                            <a href="/homepage/admin/giangvien.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Thông tin giảng viên</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/homepage/admin/hoatdong.php" class="nav-link align-middle px-0 active">
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
                        <input id="hdmhd" class="form-control query-info" type="number" name="hdmhd" placeholder=" ">
                        <label for="hdmhd" class="form-label">Mã hoạt động</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="height:32px;">Năm học</span>
                        <input id="hdnh1" type="number" name="hdnh1" class="form-control" placeholder="Từ" style="width:50%;height:32px;" max="9999" min="0">
                        <input id="hdnh2" type="number" name="hdnh2" class="form-control" placeholder="Đến" style="width:50%;height:32px;" max="9999" min="0">
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="hdmgv" name="hdmgv">
                            <option></option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM giangvien");
                            while ($rows = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $rows["magv"]; ?>"><?php echo $rows["magv"] . ' - ' . $rows["hoten"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="hdmgv" class="form-label">Giảng viên</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="hdst" class="form-control query-info" type="number" name="hdst" placeholder=" " max="5">
                        <label for="hdst" class="form-label">Số tiết</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select query-info" id="hdmnv" name="hdmnv">
                            <option></option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM loainv");
                            while ($rows = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $rows["loainv"]; ?>"><?php echo $rows["tennv"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label for="hdmnv" class="form-label">Loại công việc</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="hdctnv" class="form-control query-info" type="text" name="hdctnv" placeholder=" " size="120">
                        <label for="hdctnv" class="form-label">Chi tiết công việc</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="hdgc" class="form-control query-info" type="text" name="hdgc" placeholder=" " size="120">
                        <label for="hdgc" class="form-label">Ghi chú thêm</label>
                    </div>
                </div>
                <div class="query-btn">
                    <input id="search" class="btn btn-success space admin-btn" type="button" value="Tra cứu"></input>
                    <button id="clear" class="btn btn-success space admin-btn" onclick="clearVal()">Xoá trắng</button>
                    <input id="add" class="btn btn-success space admin-btn" type="button" value="Thêm mới"></input>
                    <input id="update" class="btn btn-success space admin-btn" type="button" value="Cập nhật"></input>
                    <input id="delete" class="btn btn-success space admin-btn" type="button" value="Xóa"></input>
                    <button id="export" class="btn btn-success space admin-btn" type="button">Xuất</button>
                </div>
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
                                <td>BÁO CÁO HOẠT ĐỘNG</td>
                            </tr>
                            <tr class="hiddentr"></tr>
                            <tr class="hiddentr">
                                <td colspan="2">Giảng viên báo cáo: <?php echo $user . " - " . $xresult['hoten']; ?></td>
                            </tr>
                            <tr class="hiddentr"></tr>
                            <tr>
                                <th>Mã hoạt động</th>
                                <th>Mã giảng viên</th>
                                <th>Năm học</th>
                                <th>Loại nhiệm vụ</th>
                                <th>Chi tiết nhiệm vụ</th>
                                <th>Số tiết</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody id="datahd">
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
                                <td><?php echo $xresult["hoten"]; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#search").on("click", function() {
                        $('#search').html('Đang xử lý').prop('disabled',
                            true);
                        $.ajax({
                            url: "datahandle.php",
                            method: "POST",
                            data: {
                                hdadmin: 'true',
                                hdsearch: 'hdsearch',
                                hdmhd: $("#hdmhd").val(),
                                hdnh1: $("#hdnh1").val(),
                                hdnh2: $('#hdnh2').val(),
                                hdmgv: $('#hdmgv').val(),
                                hdst: $('#hdst').val(),
                                hdmnv: $('#hdmnv').val(),
                                hdctnv: $('#hdctnv').val(),
                                hdgc: $('#hdgc').val(),
                            },
                            success: function(response) {
                                $('#search').html(
                                        'Tra cứu')
                                    .prop('disabled', false);
                                $('#datahd').html(response);
                            }
                        });
                    });

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

                    $("#add").on("click", function() {
                        $('#add').html('Đang xử lý').prop('disabled',
                            true);
                        $.ajax({
                            url: "datahandle.php",
                            method: "POST",
                            data: {
                                hdadmin: 'true',
                                hdadd: 'hdadd',
                                hdmhd: $("#hdmhd").val(),
                                hdnh1: $("#hdnh1").val(),
                                hdnh2: $('#hdnh2').val(),
                                hdmgv: $('#hdmgv').val(),
                                hdst: $('#hdst').val(),
                                hdmnv: $('#hdmnv').val(),
                                hdctnv: $('#hdctnv').val(),
                                hdgc: $('#hdgc').val(),
                            },
                            success: function(response) {
                                $('#add').html(
                                        'Thêm mới')
                                    .prop('disabled', false);
                                $('#datahd').html(response);
                            }
                        });
                        $("#search").click();
                    });

                    $("#update").on("click", function() {
                        $('#update').html('Đang xử lý').prop('disabled',
                            true);
                        $.ajax({
                            url: "datahandle.php",
                            method: "POST",
                            data: {
                                hdadmin: 'true',
                                hdupdate: 'hdupdate',
                                hdmhd: $("#hdmhd").val(),
                                hdnh1: $("#hdnh1").val(),
                                hdnh2: $('#hdnh2').val(),
                                hdmgv: $('#hdmgv').val(),
                                hdst: $('#hdst').val(),
                                hdmnv: $('#hdmnv').val(),
                                hdctnv: $('#hdctnv').val(),
                                hdgc: $('#hdgc').val(),
                            },
                            success: function(response) {
                                $('#update').html(
                                        'Cập nhật')
                                    .prop('disabled', false);
                                $('#datahd').html(response);
                            }
                        });
                        $("#search").click();
                    });

                    $("#delete").on("click", function() {
                        $('#delete').html('Xoá').prop('disabled',
                            true);
                        swal({
                                title: "Xóa dữ liệu hoạt động này?",
                                text: "Lưu ý: Xóa mã của hoạt động này sẽ không làm thứ tự của các hoạt động khác thay đổi!",
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
                                            hdadmin: 'true',
                                            hddelete: 'hddelete',
                                            hdmhd: $("#hdmhd").val(),
                                        },
                                        success: function(response) {
                                            $('#delete').html(
                                                    'Xóa')
                                                .prop('disabled', false);
                                            $('#datahd').html(response);
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
        </div>
    </div>
    </div>
</body>

</html>