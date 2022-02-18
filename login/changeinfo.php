<?php
session_start();
require_once "../database/fetchdata.php";
if (!isset($_SESSION['username']) && !isset($_SESSION['access'])) {
    header('Location: ../login/signIn.php');
    exit("");
}
$user = $_SESSION['username'];
$sql = mysqli_query($conn, "SELECT * FROM giangvien WHERE magv='$user'");
$result0 = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cập nhật thông tin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-language" content="vi">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0ef1d9fe65.js" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="/login/signupStyle.css">
    <script type="text/javascript" src="/homepage/corehandle.js"></script>
</head>

<body>
    <div class="login-panel">
        <form class="info-form" action="./signUpHandle.php" onsubmit="return validate();" method="post" id="signup-form" name="signup-form" title="Họ và tên">
            <div class="space"></div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <input id="fullname" class="form-control" type="name" name="fullname" placeholder=" " disabled required>
                    <label for="fullname" class="form-label">
                        <?php
                        echo $result0["hoten"];
                        ?></label>
                    <span id="validate-fullname" style="color: red;"></span>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input id="magv" class="form-control" type="text" name="magv" placeholder=" " disabled required maxlength="8" title="Mã giảng viên">
                    <label for="magv" class="form-label">
                        <?php
                        echo $user;
                        ?>
                    </label>
                    <span id="validate-magv" style="color: red;"></span>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <input id="email" class="form-control" type="email" name="email" value="<?php echo $result0["email"]; ?>" placeholder=" " required>
                    <label for="email" class="form-label">
                    </label>
                    <span id="validate-email" style="color: red;"></span>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input id="sdt" class="form-control" type="text" name="sdt" placeholder=" " value="<?php echo $result0["sodt"]; ?>" maxlength="10" required>
                    <label for="sdt" class="form-label">
                    </label>
                    <span id="validate-sdt" style="color: red;"></span>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <select id="gender" class="form-select form-control" title="Giới tính">
                        <option value="nữ" <?php if ($result0['phai'] == "nữ") {
                                                echo ('selected');
                                            } ?>>Nữ</option>
                        <option value="nam" <?php if ($result0['phai'] == "nam") {
                                                echo ('selected');
                                            } ?>>Nam</option>
                    </select>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input id="ns" type="date" class="form-control" title="Ngày tháng năm sinh" value="<?php echo $result0['ngaysinh']; ?>"></input>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <select id="ngach" class="form-select form-control" title="Ngạch giảng viên" disabled>
                        <?php
                        $ngach = $result0['mangach'];
                        $result = mysqli_query($conn, "SELECT * FROM ngachgv, giangvien WHERE ngachgv.mangach = giangvien.mangach AND ngachgv.mangach = '$ngach'");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option> Ngạch <?php echo $rows["tenngach"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <select id="trinhdo" class="form-select form-control" title="Trình độ giảng viên" disabled>
                        <?php
                        $tdo = $result0['matd'];
                        $result = mysqli_query($conn, "SELECT * FROM trinhdo, giangvien WHERE trinhdo.matd = giangvien.matd AND trinhdo.matd = '$tdo'");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option>Bậc <?php echo $rows["tentd"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <select id="chucvu" class="form-select form-control" title="Chức vụ đương nhiệm" disabled>
                        <?php
                        $cvu = $result0['macv'];
                        $result = mysqli_query($conn, "SELECT * FROM chucvu, giangvien WHERE chucvu.macv = giangvien.macv AND chucvu.macv = '$cvu'");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option><?php echo $rows["tencv"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="info-group">
                <div class="form-floating mb-3 mt-3">
                    <select id="dv" class="form-select form-control" title="Đơn vị" disabled>
                        <?php
                        $donvi = $result0['madv'];
                        $result = mysqli_query($conn, "SELECT * FROM donvi, giangvien WHERE donvi.madv = giangvien.madv AND donvi.madv = '$donvi'");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option> Đơn vị <?php echo $rows["tendv"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <select id="access" class="form-select form-control" title="Quyền hệ thống" disabled>
                        <?php
                        $quyen = $result0['maquyen'];
                        $result = mysqli_query($conn, "SELECT * FROM taikhoan, giangvien WHERE giangvien.maquyen = taikhoan.maquyen AND taikhoan.maquyen = '$quyen'");
                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <option><?php echo $rows["tenquyen"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="d-grid">
                <input id="signup" class="btn btn-success" type="button" value="Cập nhật">
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
                    url: "changeinfohandle.php",
                    method: "POST",
                    data: {
                        type: 'signup',
                        email: $("#email").val(),
                        sodt: $("#sdt").val(),
                        phai: $("#gender").val(),
                        ns: $("#ns").val(),
                    },
                    success: function(response) {
                        $("#alert").html(response);
                        $('#signup').html(
                                'Đăng ký')
                            .prop('disabled', false);
                        setTimeout(function() {
                            location.reload()
                        }, 1000);
                    }
                });
            }
        });
    </script>
    <script>
        function qGetElementById(id) {
            return document.getElementById(id);
        }

        function validateMessage(id, mess) {
            return document.getElementById(id).innerHTML = mess;
        }

        function validate() {
            temp = true;

            if (qGetElementById("email").value == "" || !/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/.test(qGetElementById("email").value)) {
                validateMessage("validate-email", "<span id='validate-email' style='color: red;'>Vui lòng nhập email đúng định dạng</span>")
                qGetElementById("email").focus();
                temp = false;
                return temp;
            } else {
                validateMessage("validate-email", "<span id='validate-email' style='color: red;'></span>");
                temp = true;
            }

            if (qGetElementById("sdt").value.length < 10 || /[^0-9]/.test(qGetElementById("sdt").value)) {
                validateMessage("validate-sdt", "<span id='validate-sdt' style='color: red;'>Vui lòng nhập đúng thông tin</span>")
                qGetElementById("sdt").focus();
                temp = false;
                return temp;
            } else {
                validateMessage("validate-sdt", "<span id='validate-sdt' style='color: red;'></span>");
                temp = true;
            }
            return temp;
        }
    </script>
</body>

</html>