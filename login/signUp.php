<?php
session_start();
require_once "../database/fetchdata.php";
if (!isset($_SESSION['username']) && !isset($_SESSION['access'])) {
    header('Location: ../login/signIn.php');
    exit("");
}
if ($_SESSION['access'] == 0) {
    header('Location: ./home.php');
    exit("");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tạo tài khoản</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-language" content="vi">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0ef1d9fe65.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./validateform.js"></script>
    <link type="text/css" rel="stylesheet" href="/login/signupStyle.css">
    <script type="text/javascript" src="/homepage/corehandle.js"></script>
</head>

<body>
    <div class="login-panel">
        <form class="info-form" action="./signUpHandle.php" onsubmit="return validate();" method="post" id="signup-form" name="signup-form">
            <div class="head">
                <h3>Đăng ký</h3>
            </div>
            <div class="space"></div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <input id="fullname" class="form-control" type="name" name="fullname" placeholder=" " required maxlength="30">
                    <label for="fullname" class="form-label">Họ và tên</label>
                    <span id="validate-fullname" style="color: red;"></span>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input id="magv" class="form-control" type="text" name="magv" placeholder=" " required maxlength="8">
                    <label for="magv" class="form-label">Mã giảng viên</label>
                    <span id="validate-magv" style="color: red;"></span>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <input id="email" class="form-control" type="email" name="email" placeholder=" " required maxlength="25">
                    <label for="email" class="form-label">Email</label>
                    <span id="validate-email" style="color: red;"></span>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input id="sdt" class="form-control" type="text" name="sdt" placeholder=" " maxlength="10" required>
                    <label for="sdt" class="form-label">Số điện thoại</label>
                    <span id="validate-sdt" style="color: red;"></span>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <select id="gender" class="form-select form-control" title="Giới tính">
                        <option value="nữ">Nữ</option>
                        <option value="nam">Nam</option>
                    </select>
                    <label for="gender" class="form-label">Phái</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input id="ns" type="date" class="form-control" title="Ngày tháng năm sinh"></input>
                    <label for="ns" class="form-label">Ngày sinh</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <select id="ngach" class="form-select form-control" title="Ngạch giảng viên">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM ngachgv");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $rows["mangach"]; ?>"><?php echo $rows["tenngach"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="ngach" class="form-label">Ngạch</label>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <select id="trinhdo" class="form-select form-control" title="Trình độ giảng viên">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM trinhdo");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $rows["matd"]; ?>">Bậc <?php echo $rows["tentd"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="trinhdo" class="form-label">Trình độ</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <select id="chucvu" class="form-select form-control" title="Chức vụ đương nhiệm">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM chucvu");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $rows["macv"]; ?>"><?php echo $rows["tencv"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="chucvu" class="form-label">Chức vụ</label>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <select id="dv" class="form-select form-control" title="Đơn vị">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM donvi");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $rows["madv"]; ?>"> Đơn vị <?php echo $rows["tendv"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="dv" class="form-label">Đơn vị</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <select id="access" class="form-select form-control" title="Quyền hệ thống">
                        <option value="0">Người dùng</option>
                        <option value="1">Người quản trị</option>
                    </select>
                    <label for="access" class="form-label">Quyền</label>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <input id="password" class="form-control" type="password" placeholder=" " required name="password" minlength="3" maxlength="20">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <span id="validate-pwd" style="color: red;"></span>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input id="repassword" class="form-control" type="password" placeholder=" " required>
                    <label for="repassword" class="form-label">Nhập lại mật khẩu</label>
                    <span id="validate-re-pwd" style="color: red;"></span>
                </div>
            </div>
            <div class="d-grid">
                <input id="signup" class="btn btn-success" type="button" value="Đăng ký">
            </div>
        </form>
        <div id="alert"></div>
        <div><a href="../homepage/home.php"><i class="fas fa-arrow-circle-left" goback></i></a></div>
    </div>
    <script>
        $("#signup").on("click", function() {
            if (validate() == true) {
                $('#signup').html('Đang xử lý').prop('disabled',
                    true);
                Swal.fire({
                    title: '<p style="color: white;">ĐANG XỬ LÝ</p>',
                    text: '',
                    imageUrl: '../img/Loading.gif',
                    imageWidth: 300,
                    imageHeight: 150,
                    imageAlt: 'Loading',
                    background: "#1C273A",
                    width: '28rem',
                    padding: '1rem',
                })
                $.ajax({
                    url: "signUpHandle.php",
                    method: "POST",
                    data: {
                        type: 'signup',
                        magv: $("#magv").val(),
                        matkhau: $("#password").val(),
                        email: $("#email").val(),
                        hoten: $("#fullname").val(),
                        sodt: $("#sdt").val(),
                        phai: $("#gender").val(),
                        ns: $("#ns").val(),
                        mangach: $("#ngach").val(),
                        matd: $("#trinhdo").val(),
                        macv: $("#chucvu").val(),
                        madv: $("#dv").val(),
                        access: $("#access").val()
                    },
                    success: function(response) {
                        $("#alert").html(response);
                        $('#signup').html(
                                'Đăng ký')
                            .prop('disabled', false);
                    }
                });
            }
        });
    </script>
    <script>
        pwdField = document.getElementById("password");
        rePwdField = document.getElementById("repassword");
        pwdField.onkeydown = (() => {
            pwdField.type = "text";
        });
        pwdField.onkeyup = (() => {
            pwdField.type = "password";
        });
        rePwdField.onkeydown = (() => {
            rePwdField.type = "text";
        });
        rePwdField.onkeyup = (() => {
            rePwdField.type = "password";
        });
    </script>
</body>

</html>