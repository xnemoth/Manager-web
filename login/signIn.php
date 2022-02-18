<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: ../homepage/home.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

    <title>Đăng nhập</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-language" content="vi">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/login/loginStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>
    <div class="login-panel">
        <form class="info-form" method="POST" action="./signInHandle.php">
            <div class="head">
                <h3>Đăng nhập</h3>
            </div>
            <div class="space"></div>

            <div class="form-floating mb-3 mt-3">
                <input id="username" class="form-control" type="username" name="username" placeholder=" " required>
                <label for="username" class="form-label">Tên đăng nhập</label>
            </div>  
            <div class="form-floating mb-3 mt-3">
                <input id="password" class="form-control" type="password" name="password" placeholder=" " required>
                <label for="password" class="form-label">Mật khẩu</label>
            </div>
            <div class="d-grid">
                <input id="login" class="btn btn-success" type="button" value="Đăng nhập"></input>
            </div>
            <div id="alert"></div>
        </form>
    <script type="text/javascript">
        $("#login").on("click", function() {

            $('#login').html('Đang xử lý').prop('disabled',
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
                url: "/login/signInHandle.php",
                method: "POST",
                data: {
                    type: 'login',
                    username: $("#username").val(),
                    password: $("#password").val()
                },
                success: function(response) {
                    $("#alert").html(response);
                    $('#login').html(
                            'Đăng nhập')
                        .prop('disabled', false);
                }
            });
        });
    </script>

    <script>
        pwdField = document.getElementById("password");
        pwdField.onkeydown = (() => {
            pwdField.type = "text";
        })
        pwdField.onkeyup = (() => {
            pwdField.type = "password";
        })
    </script>
</body>

</html>