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
                            <a href="/homepage/admin/ngachgv.php" class="nav-link align-middle px-0 active">
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
                        <input id="ngvmn" class="form-control query-info" type="text" name="ngvmn" placeholder=" " maxlength="6">
                        <label for="ngvmn" class="form-label">Mã ngạch</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="ngvtn" class="form-control query-info" type="text" name="ngvtn" placeholder=" " maxlength="20">
                        <label for="ngvtn" class="form-label">Tên ngạch</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="ngvgd" class="form-control query-info" type="text" name="ngvgd" placeholder=" " >
                        <label for="ngvgd" class="form-label">Số giờ dạy</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="ngvgnc" class="form-control query-info" type="text" name="ngvgnc" placeholder=" ">
                        <label for="ngvgnc" class="form-label">Số giờ NCKH</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input id="ngvgk" class="form-control query-info" type="text" name="ngvgk" placeholder=" ">
                        <label for="ngvgk" class="form-label">Số giờ khác</label>
                    </div>
                </div>
                <div class="query-btn">
                    <input id="search" class="btn btn-success space admin-btn" type="button" value="Tra cứu"></input>
                    <button id="clear" class="btn btn-success space admin-btn" onclick="clearVal()">Xoá trắng</button>
                    <input id="add" class="btn btn-success space admin-btn" type="button" value="Thêm mới"></input>
                    <input id="update" class="btn btn-success space admin-btn" type="button" value="Cập nhật"></input>
                    <input id="delete" class="btn btn-success space admin-btn" type="button" value="Xóa"></input>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã ngạch</th>
                                <th>Tẻn ngạch</th>
                                <th>Số giờ dạy</th>
                                <th>Số giờ NCKH</th>
                                <th>Số giờ khác</th>
                            </tr>
                        </thead>
                        <tbody id="datangv">
                        </tbody>
                    </table>
                </div>
            </div>
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
                        ngvadmin: 'true',
                        ngvsearch: 'ngvsearch',
                        ngvmn: $("#ngvmn").val(),
                        ngvtn: $('#ngvtn').val(),
                        ngvgd: $('#ngvgd').val(),
                        ngvgnc: $('#ngvgnc').val(),
                        ngvgk: $('#ngvgk').val(),
                    },
                    success: function(response) {
                        $('#search').html(
                                'Tra cứu')
                            .prop('disabled', false);
                        $('#datangv').html(response);
                    }
                });
            });

            $("#add").on("click", function() {
                $('#add').html('Đang xử lý').prop('disabled',
                    true);
                $.ajax({
                    url: "datahandle.php",
                    method: "POST",
                    data: {
                        ngvadmin: 'true',
                        ngvadd: 'ngvadd',
                        ngvmn: $("#ngvmn").val(),
                        ngvtn: $('#ngvtn').val(),
                        ngvgd: $('#ngvgd').val(),
                        ngvgnc: $('#ngvgnc').val(),
                        ngvgk: $('#ngvgk').val(),
                    },
                    success: function(response) {
                        $('#add').html(
                                'Thêm mới')
                            .prop('disabled', false);
                        $('#datangv').html(response);
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
                        ngvadmin: 'true',
                        ngvupdate: 'ngvupdate',
                        ngvmn: $("#ngvmn").val(),
                        ngvtn: $('#ngvtn').val(),
                        ngvgd: $('#ngvgd').val(),
                        ngvgnc: $('#ngvgnc').val(),
                        ngvgk: $('#ngvgk').val(),
                    },
                    success: function(response) {
                        $('#update').html(
                                'Cập nhật')
                            .prop('disabled', false);
                        $('#datangv').html(response);
                    }
                });
                $("#search").click();
            });

            $("#delete").on("click", function() {
                $('#delete').html('Xoá').prop('disabled',
                    true);
                swal({
                        title: "Xóa dữ liệu ngạch giảng viên này?",
                        text: "Lưu ý: Mọi dữ liệu liên quan đến ngạch này phải được xóa trước!",
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
                                    ngvadmin: 'true',
                                    ngvdelete: 'ngvdelete',
                                    ngvmn: $("#ngvmn").val(),
                                    ngvtn: $('#ngvtn').val(),
                                    ngvgd: $('#ngvgd').val(),
                                    ngvgnc: $('#ngvgnc').val(),
                                    ngvgk: $('#ngvgk').val(),
                                },
                                success: function(response) {
                                    $('#delete').html(
                                            'Xóa')
                                        .prop('disabled', false);
                                    $('#datangv').html(response);
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