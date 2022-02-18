<?php
session_start();
require_once "../database/fetchdata.php";
if (!isset($_SESSION['username'])) {
    header('Location: ./signIn.php');
    exit("");
}
mysqli_set_charset($conn, "utf8");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Thay đổi mật khẩu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-language" content="vi">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
    <link type="text/css" rel="stylesheet" href="/login/loginStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>
    <div class="login-panel">
        <form class="info-form" action="./changePassHandle.php" onsubmit="return validate();" method="post" id="signup-form" name="signup-form">
            <div class="head">
                <h3>Thay đổi mật khẩu</h3>
            </div>
            <div class="space"></div>
            <div class="form-floating mb-3 mt-3">
                <input id="oldpassword" class="form-control" type="password" name="oldpassword" placeholder=" " required minlength="3" maxlength="20">
                <label for="oldpassword" class="form-label">Mật khẩu hiện tại</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input id="password" class="form-control" type="password" placeholder=" " required name="password" minlength="3" maxlength="20">
                <label for="password" class="form-label">Mật khẩu mới</label>
                <span id="validate-pwd" style="color: red;"></span>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input id="repassword" class="form-control" type="password" placeholder=" " required>
                <label for="repassword" class="form-label">Nhập lại mật khẩu</label>
                <span id="validate-re-pwd" style="color: red;"></span>
            </div>
            <div class="d-grid">
                <input id="savechange" class="btn btn-success" type="button" value="Xác nhận">
            </div>
        </form>
        <div id="alert"></div>
    </div>

    <script>
        oldPwdField = document.getElementById("oldpassword");
        pwdField = document.getElementById("password");
        rePwdField = document.getElementById("repassword");
        pwdField.onkeydown = (() => {
            pwdField.type = "text";
        })
        pwdField.onkeyup = (() => {
            pwdField.type = "password";
        })
        rePwdField.onkeydown = (() => {
            rePwdField.type = "text";
        })
        rePwdField.onkeyup = (() => {
            rePwdField.type = "password";
        })
        oldPwdField.onkeydown = (() => {
            oldPwdField.type = "text";
        })
        oldPwdField.onkeyup = (() => {
            oldPwdField.type = "password";
        })

        function qGetElementById(id) {
            return document.getElementById(id);
        }

        function validateMessage(id, mess) {
            return document.getElementById(id).innerHTML = mess;
        }

        function validate() {
            if (qGetElementById("password").value != qGetElementById("repassword").value) {
                validateMessage("validate-re-pwd", "<span id='validate-pwd' style='color: red;'>Mật khẩu nhập lại không khớp</span>");
                qGetElementById("repassword").focus();
                temp = false;
                return temp;
            } else {
                validateMessage("validate-re-pwd", "<span id='validate-pwd' style='color: red;'></span>");
                temp = true;
            }

            if (/ /.test(qGetElementById("password").value) || qGetElementById("password").value.length < 3) {
                validateMessage("validate-pwd", "<span id='validate-pwd' style='color: red;'> Mật khẩu phải dài hơn 3 kí tự và ngắn hơn 20 kí tự không được chứa khoảng trắng</span>");
                qGetElementById("password").focus();
                temp = false;
                return temp;
            } else {
                validateMessage("validate-pwd", "<span id='validate-pwd' style='color: red;'></span>");
                temp = true;
            }
        }
    </script>

    <script>
        $("#savechange").on("click", function() {
            if (validate() != false) {
                $('#savechange').html('Đang xử lý').prop('disabled',
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
                    url: "changePassHandle.php",
                    method: "POST",
                    data: {
                        oldpass: $("#oldpassword").val(),
                        newpass: $("#password").val(),
                    },
                    success: function(response) {
                        $("#alert").html(response);
                        $('#savechange').html(
                                'Xác nhận')
                            .prop('disabled', false);
                            setTimeout(function() {
                            window.location = './signIn.php';
                        }, 1000);
                    }
                });
            }
        });
    </script>

</body>

</html>