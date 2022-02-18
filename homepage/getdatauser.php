<?php
session_start();
require_once "../database/fetchdata.php";
mysqli_set_charset($conn, "utf8");
if (!isset($_SESSION['username'])) {
    header('Location: ../login/signIn.php');
    exit("");
}
$user = $_SESSION['username'];

if (isset($_POST['homeadd'])) {
    $hnh1 = isset($_POST['hnh1']) ? mysqli_escape_string($conn, $_POST['hnh1']) : '';
    $hnh2 = isset($_POST['hnh2']) ? mysqli_escape_string($conn, $_POST['hnh2']) : '';
    $hst = isset($_POST['hst']) ? mysqli_escape_string($conn, $_POST['hst']) : '';
    $hmnv = isset($_POST['hmnv']) ? mysqli_escape_string($conn, $_POST['hmnv']) : '';
    $hctnv = isset($_POST['hctnv']) ? mysqli_escape_string($conn, $_POST['hctnv']) : '';
    $hgc = isset($_POST['hgc']) ? mysqli_escape_string($conn, $_POST['hgc']) : '';


    if ($hnh1 != "" && $hnh2 != "" && $hst != "" && $hmnv != "" && $hctnv != "") {
        $nh = $hnh1 . '-' . $hnh2;
        $sql = "INSERT INTO chitiethd(mact, magv, namhoc, loainv, chitietnv, sotiet, ghichu) VALUES (NULL,'$user','$nh', '$hmnv', '$hctnv', '$hst', '$hgc')";
        if (mysqli_query($conn, $sql))
            echo "<div id='alert'><script>Swal.fire('Thành công', 'Đã thêm hoạt động','success');</script></div>";
        else
            echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra','error');</script></div>";
    } else {
        echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đầy đủ thông tin','warning');</script></div>";
    }
}

if (isset($_POST['homeinfo'])) {

    $sql = "SELECT chitietnv, namhoc, sotiet, ghichu FROM chitiethd WHERE magv=$user";
    $data = mysqli_query($conn, $sql);
    $result = "";
    while ($rows = mysqli_fetch_array($data)) {
        $result = $result . "<tr></td>
            <td>$rows[0]</td>
            <td>$rows[1]</td>
            <td>$rows[2]</td>
            <td>$rows[3]</td>
            </tr>";
    }
    echo "$result";
}

if (isset($_POST['tab2hsearch'])) {

    $tab2hmhd   = isset($_POST['tab2hmhd']) ? mysqli_escape_string($conn, $_POST['tab2hmhd']) : '';
    $tab2hnh1 = isset($_POST['tab2hnh1']) ? mysqli_escape_string($conn, $_POST['tab2hnh1']) : '';
    $tab2hnh2 = isset($_POST['tab2hnh2']) ? mysqli_escape_string($conn, $_POST['tab2hnh2']) : '';
    $tab2hst = isset($_POST['tab2hst']) ? mysqli_escape_string($conn, $_POST['tab2hst']) : '';
    $tab2hmnv = isset($_POST['tab2hmnv']) ? mysqli_escape_string($conn, $_POST['tab2hmnv']) : '';
    $tab2hctnv = isset($_POST['tab2hctnv']) ? mysqli_escape_string($conn, $_POST['tab2hctnv']) : '';
    $tab2hgc = isset($_POST['tab2hgc']) ? mysqli_escape_string($conn, $_POST['tab2hgc']) : '';

    $sql = "SELECT mact, namhoc, loainv, chitietnv, sotiet, ghichu FROM chitiethd WHERE magv='$user'";

    if ($tab2hmhd != "") {
        $sql = $sql . " AND mact='$tab2hmhd'";
    }
    if ($tab2hnh1 != "" && $tab2hnh2 != "") {
        $sql = $sql . " AND namhoc LIKE '{$tab2hnh1}-{$tab2hnh2}'";
    } else  if ($tab2hnh2 == "" && $tab2hnh1 != "") {
        $sql = $sql . " AND namhoc LIKE '$tab2hnh1%'";
    } else {
        $sql = $sql . " AND namhoc LIKE '%$tab2hnh2'";
    }
    if ($tab2hst != "") {
        $sql = $sql . " AND sotiet LIKE '$tab2hst'";
    }
    if ($tab2hmnv != "") {
        $sql = $sql . " AND loainv LIKE '%$tab2hmnv%'";
    }
    if ($tab2hctnv != "") {
        $sql = $sql . " AND chitietnv LIKE '%$tab2hctnv%'";
    }
    if ($tab2hgc != "") {
        $sql = $sql . " AND ghichu LIKE '%$tab2hgc%'";
    }

    $data = mysqli_query($conn, $sql);
    $result = "";
    while ($rows = mysqli_fetch_array($data)) {
        $result = $result . "<tr></td>
        <td>$rows[0]</td>
        <td>$rows[1]</td>
        <td>$rows[2]</td>
        <td>$rows[3]</td>
        <td>$rows[4]</td>
        <td>$rows[5]</td>
        </tr>";
    }
    echo "$result";
}

if (isset($_POST['tab2hupdate'])) {

    $tab2hmhd   = isset($_POST['tab2hmhd']) ? mysqli_escape_string($conn, $_POST['tab2hmhd']) : '';
    $tab2hnh1 = isset($_POST['tab2hnh1']) ? mysqli_escape_string($conn, $_POST['tab2hnh1']) : '';
    $tab2hnh2 = isset($_POST['tab2hnh2']) ? mysqli_escape_string($conn, $_POST['tab2hnh2']) : '';
    $tab2hst = isset($_POST['tab2hst']) ? mysqli_escape_string($conn, $_POST['tab2hst']) : '';
    $tab2hmnv = isset($_POST['tab2hmnv']) ? mysqli_escape_string($conn, $_POST['tab2hmnv']) : '';
    $tab2hctnv = isset($_POST['tab2hctnv']) ? mysqli_escape_string($conn, $_POST['tab2hctnv']) : '';
    $tab2hgc = isset($_POST['tab2hgc']) ? mysqli_escape_string($conn, $_POST['tab2hgc']) : '';

    $updvalue = "";
    if ($tab2hst != "") {
        if ($updvalue == "") {
            $updvalue = $updvalue . " sotiet='$tab2hst'";
        } else {
            $updvalue = $updvalue . ", sotiet='$tab2hst'";
        }
    }
    if ($tab2hmnv != "") {
        if ($updvalue == "") {
            $updvalue = $updvalue . " loainv='$tab2hmnv'";
        } else {
            $updvalue = $updvalue . ", loainv='$tab2hmnv'";
        }
    }
    if ($tab2hctnv != "") {
        if ($updvalue == "") {
            $updvalue = $updvalue . " chitietnv='$tab2hctnv'";
        } else {
            $updvalue = $updvalue . ", chitietnv='$tab2hctnv'";
        }
    }
    if ($tab2hgc != "") {
        if ($updvalue == "") {
            $updvalue = $updvalue . " ghichu='$tab2hgc'";
        } else {
            $updvalue = $updvalue . ", ghichu='$tab2hgc'";
        }
    }
    if ($updvalue == "") {
        if ($tab2hnh1 != "" && $tab2hnh2 != "") {
            $updvalue = $updvalue . " namhoc='{$tab2hnh1}-{$tab2hnh2}'";
        } else if (($tab2hnh1 == "" && $tab2hnh2 != "") || ($tab2hnh2 == "" && $tab2hnh1 != "")) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đẩy đủ thông tin năm học','error');</script></div>";
            die;
        }
    } else {
        if ($tab2hnh1 != "" && $tab2hnh2 != "") {
            $updvalue = $updvalue . ", namhoc='{$tab2hnh1}-{$tab2hnh2}'";
        } else if (($tab2hnh1 == "" && $tab2hnh2 != "") || ($tab2hnh2 == "" && $tab2hnh1 != "")) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đẩy đủ thông tin năm học','error');</script></div>";
            die;
        }
    }

    if ($updvalue != "") {
        $sql = "UPDATE chitiethd SET" . $updvalue . " WHERE mact='$tab2hmhd' AND magv='$user'";
        mysqli_query($conn, $sql);
    }
}

if (isset($_POST['reportsearch'])) {

    $reportnh1 = isset($_POST['reportnh1']) ? mysqli_escape_string($conn, $_POST['reportnh1']) : '';
    $reportnh2 = isset($_POST['reportnh2']) ? mysqli_escape_string($conn, $_POST['reportnh2']) : '';
    $reportst = isset($_POST['reportst']) ? mysqli_escape_string($conn, $_POST['reportst']) : '';
    $reportmnv = isset($_POST['reportmnv']) ? mysqli_escape_string($conn, $_POST['reportmnv']) : '';

    $sql = "SELECT namhoc, loainv, chitietnv, sotiet, ghichu FROM chitiethd WHERE magv='$user'";
    $sum = "SELECT SUM(sotiet) FROM chitiethd WHERE magv='$user'";

    if ($reportnh1 != "" && $reportnh2 != "") {
        $sql = $sql . " AND namhoc LIKE '{$reportnh1}-{$reportnh2}'";
        $sum = $sum . " AND namhoc LIKE '{$reportnh1}-{$reportnh2}'";
    } else  if ($reportnh2 == "" && $reportnh1 != "") {
        $sql = $sql . " AND namhoc LIKE '$reportnh1%'";
        $sum = $sum . " AND namhoc LIKE '$reportnh1%'";
    } else {
        $sql = $sql . " AND namhoc LIKE '%$reportnh2'";
        $sum = $sum . " AND namhoc LIKE '%$reportnh2'";
    }
    if ($reportst != "") {
        $sql = $sql . " AND sotiet LIKE '$reportst'";
        $sum = $sum . " AND sotiet LIKE '$reportst'";
    }
    if ($reportmnv != "") {
        $sql = $sql . " AND loainv LIKE '%$reportmnv%'";
        $sum = $sum . " AND loainv LIKE '%$reportmnv%'";
    }
    
    $sql = $sql . " ORDER BY loainv";

    $data = mysqli_query($conn, $sql);
    $TGD = mysqli_fetch_array(mysqli_query($conn, $sum));
    $result = "";
    $i = 1;
    $stv = $TGD[0] - 586;
    while ($rows = mysqli_fetch_array($data)) {
        $nht = $rows[0];
        $result = $result . "<tr></td>
        <td class='hiddentr'>$i</td>
        <td class='noExl'>$rows[0]</td>
        <td>$rows[1]</td>
        <td>$rows[2]</td>
        <td>$rows[3]</td>
        <td>$rows[4]</td>
        </tr>";
        $i++;
    }
    echo "<tr class='hiddentr'><td>Năm học</td><td>$nht</td></tr><tr class='hiddentr'><th>STT</th><th>Loại nhiệm vụ</th><th>Chi tiết nhiệm vụ</th><th>Số tiết</th><th>Ghi chú</th></tr>" .$result . "<tr></tr><tr class='hiddentr'><td></td><td></td><td>Tổng số tiết:</td><td> $TGD[0]</td></tr><tr class='hiddentr'><td></td><td></td><td>Số tiết vượt:</td><td> $stv</td></tr>";
}
