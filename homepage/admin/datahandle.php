<?php
if ((!isset($_SESSION['username']))) {
    session_start();
}
require_once "./connect.php";
mysqli_set_charset($conn, "utf8");
if (!isset($_SESSION['username'])) {
    header('Location: ../login/signIn.php');
    exit("");
}

if (isset($_POST['gvadmin'])) {

    $gvmgv   = isset($_POST['gvmgv']) ? mysqli_escape_string($conn, $_POST['gvmgv']) : '';
    $gvsdt = isset($_POST['gvsdt']) ? mysqli_escape_string($conn, $_POST['gvsdt']) : '';
    $gve = isset($_POST['gve']) ? mysqli_escape_string($conn, $_POST['gve']) : '';
    $gvns = isset($_POST['gvns']) ? mysqli_escape_string($conn, $_POST['gvns']) : '';
    $gvht = isset($_POST['gvht']) ? mysqli_escape_string($conn, $_POST['gvht']) : '';
    $gvp = isset($_POST['gvp']) ? mysqli_escape_string($conn, $_POST['gvp']) : '';
    $gvdv = isset($_POST['gvdv']) ? mysqli_escape_string($conn, $_POST['gvdv']) : '';
    $gvtd = isset($_POST['gvtd']) ? mysqli_escape_string($conn, $_POST['gvtd']) : '';
    $gvn = isset($_POST['gvn']) ? mysqli_escape_string($conn, $_POST['gvn']) : '';
    $gvcv = isset($_POST['gvcv']) ? mysqli_escape_string($conn, $_POST['gvcv']) : '';
    $gvq = isset($_POST['gvq']) ? mysqli_escape_string($conn, $_POST['gvq']) : '';

    if (isset($_POST['gvsearch'])) {

        $sql = "SELECT magv, hoten, phai, ngaysinh, sodt, email, madv, matd, mangach, macv, maquyen FROM giangvien WHERE 1=1";

        if ($gvmgv != "") {
            $sql = $sql . " AND magv LIKE '%$gvmgv%'";
        }
        if ($gvsdt != "") {
            $sql = $sql . " AND sodt LIKE '%$gvsdt%'";
        }
        if ($gve != "") {
            $sql = $sql . " AND email LIKE '%$gve%'";
        }
        if ($gvns != "") {
            $sql = $sql . " AND ngaysinh LIKE '%$gvns%'";
        }
        if ($gvht != "") {
            $sql = $sql . " AND hoten LIKE '%$gvht%'";
        }
        if ($gvp != "") {
            $sql = $sql . " AND phai='$gvp'";
        }
        if ($gvdv != "") {
            $sql = $sql . " AND madv='$gvdv'";
        }
        if ($gvtd != "") {
            $sql = $sql . " AND matd='$gvtd'";
        }
        if ($gvn != "") {
            $sql = $sql . " AND mangach='$gvn'";
        }
        if ($gvcv != "") {
            $sql = $sql . " AND macv='$gvcv'";
        }
        if ($gvq != "") {
            $sql = $sql . " AND maquyen='$gvq'";
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
            <td>$rows[6]</td>
            <td>$rows[7]</td>
            <td>$rows[8]</td>
            <td>$rows[9]</td>
            <td class='noExl'>$rows[10]</td>
            </tr>";
        }
        echo "$result";
    }

    if (isset($_POST['gvupdate'])) {
        if ($gvq != "" && $gvmgv == $_SESSION['username']) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không được thay đổi quyền của tài khoản hiện tại','warning');</script></div>";
        } else {
            $updvalue = "";
            if ($gvht != "") {
                $updvalue = $updvalue . " hoten='$gvht'";
            }
            if ($gvsdt != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " sodt='$gvsdt'";
                } else {
                    $updvalue = $updvalue . ", sodt='$gvsdt'";
                }
            }
            if ($gve != "") {
                $sql = mysqli_query($conn, "SELECT email FROM giangvien WHERE email='$gve'");
                if (mysqli_num_rows($sql) > 0) {
                    echo "<div id='alert'><script>Swal.fire('Lỗi', 'Email đã có người sử dụng','warning');</script></div>";
                    die;
                } else {
                    if ($updvalue == "") {
                        $updvalue = $updvalue . " email='$gve'";
                    } else {
                        $updvalue = $updvalue . ", email='$gve'";
                    }
                }
            }
            if ($gvns != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " ngaysinh='$gvns'";
                } else {
                    $updvalue = $updvalue . ", ngaysinh='$gvns'";
                }
            }
            if ($gvp != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " phai='$gvp'";
                } else {
                    $updvalue = $updvalue . ", phai='$gvp'";
                }
            }
            if ($gvdv != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " madv='$gvdv'";
                } else {
                    $updvalue = $updvalue . ", madv='$gvdv'";
                }
            }
            if ($gvtd != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " matd='$gvtd'";
                } else {
                    $updvalue = $updvalue . ", matd='$gvtd'";
                }
            }
            if ($gvn != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " mangach='$gvn'";
                } else {
                    $updvalue = $updvalue . ", mangach='$gvn'";
                }
            }
            if ($gvcv != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " macv='$gvcv'";
                } else {
                    $updvalue = $updvalue . ", macv='$gvcv'";
                }
            }
            if ($gvq != "") {
                if ($updvalue == "") {
                    $updvalue = $updvalue . " maquyen='$gvq'";
                } else {
                    $updvalue = $updvalue . ", maquyen='$gvq'";
                }
            }
            if ($updvalue != "") {
                $sql = "UPDATE giangvien SET" . $updvalue . " WHERE magv='$gvmgv'";
                mysqli_query($conn, $sql);
            }
        }
    }

    if (isset($_POST['gvdelete'])) {
        $sql = mysqli_query($conn, "SELECT magv FROM giangvien WHERE magv='$gvmgv'");
        if (mysqli_num_rows($sql) <= 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không có dữ liệu của giảng viên $gvmgv','error');</script></div>";
        } else {
            $sql = mysqli_query($conn, "SELECT magv FROM chitiethd WHERE magv='$gvmgv'");
            if (mysqli_num_rows($sql) > 0) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vẫn còn dữ liệu hoạt động của giảng viên $gvmgv','error');</script></div>";
            } else {
                if ($gvmgv == $_SESSION['username']) {
                    echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không được xóa tài khoản giảng viên $gvmgv','error');</script></div>";
                } else {
                    $sql = "DELETE FROM giangvien WHERE magv='$gvmgv'";
                    mysqli_query($conn, $sql);
                }
            }
        }
    }
}

if (isset($_POST['dvadmin'])) {

    $dvmdv   = isset($_POST['dvmdv']) ? mysqli_escape_string($conn, $_POST['dvmdv']) : '';
    $dvtdv = isset($_POST['dvtdv']) ? mysqli_escape_string($conn, $_POST['dvtdv']) : '';
    $dvsdt = isset($_POST['dvsdt']) ? mysqli_escape_string($conn, $_POST['dvsdt']) : '';
    $dve = isset($_POST['dve']) ? mysqli_escape_string($conn, $_POST['dve']) : '';

    if (isset($_POST['dvsearch'])) {

        $sql = "SELECT * FROM donvi WHERE 1=1";

        if ($dvmdv != "") {
            $sql = $sql . " AND madv LIKE '%$dvmdv%'";
        }
        if ($dvtdv != "") {
            $sql = $sql . " AND tendv LIKE '%$dvtdv%'";
        }
        if ($dvsdt != "") {
            $sql = $sql . " AND sodt LIKE '%$dvsdt%'";
        }
        if ($dve != "") {
            $sql = $sql . " AND email LIKE '%$dve%'";
        }

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

    if (isset($_POST['dvupdate'])) {

        $updvalue = "";
        if ($dvtdv != "") {
            $updvalue = $updvalue . " tendv='$dvtdv'";
        }
        if ($dvsdt != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " sodt='$dvsdt'";
            } else {
                $updvalue = $updvalue . ", sodt='$dvsdt'";
            }
        }
        if ($dve != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " email='$dve'";
            } else {
                $updvalue = $updvalue . ", email='$dve'";
            }
        }
        if ($updvalue != "") {
            $sql = "UPDATE donvi SET" . $updvalue . " WHERE madv='$dvmdv'";
            mysqli_query($conn, $sql);
        }
    }

    if (isset($_POST['dvadd'])) {
        $sql = mysqli_query($conn, "SELECT * FROM donvi WHERE madv='$dvmdv'");
        if (mysqli_num_rows($sql) > 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Đã có dữ liệu mã đơn vị $dvtdv','error');</script></div>";
            die;
        } else {
            if ($dvmdv != "" && $dvtdv != "" && $dvsdt != "" && $dve != "") {
                @$sql = "INSERT INTO donvi(madv, tendv, sodt, email) VALUES ('$dvmdv','$dvtdv','$dvsdt', '$dve')";
                if (mysqli_query($conn, $sql))
                    echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đã thêm đơn vị $dvtdv','success');</script></div>";
                else
                    echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra','error');</script></div>";
            } else {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đầy đủ thông tin','warning');</script></div>";
            }
        }
    }

    if (isset($_POST['dvdelete'])) {
        $sql = mysqli_query($conn, "SELECT madv FROM donvi WHERE madv='$dvmdv'");
        if (mysqli_num_rows($sql) <= 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không có dữ liệu của đơn vị $dvtdv','error');</script></div>";
        } else {
            $sql = mysqli_query($conn, "SELECT madv FROM giangvien WHERE madv='$dvmdv'");
            if (mysqli_num_rows($sql) > 0) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vẫn còn dữ liệu của đơn vị $dvtdv, vui lòng hủy tất cả dữ liệu liên quan trước khi xóa','error');</script></div>";
            } else {
                $sql = "DELETE FROM donvi WHERE madv='$dvmdv'";
                mysqli_query($conn, $sql);
            }
        }
    }
}

if (isset($_POST['cvadmin'])) {

    $cvmcv   = isset($_POST['cvmcv']) ? mysqli_escape_string($conn, $_POST['cvmcv']) : '';
    $cvtcv = isset($_POST['cvtcv']) ? mysqli_escape_string($conn, $_POST['cvtcv']) : '';

    if (isset($_POST['cvsearch'])) {

        $sql = "SELECT * FROM chucvu WHERE 1=1";

        if ($cvmcv != "") {
            $sql = $sql . " AND macv LIKE '%$cvmcv%'";
        }
        if ($cvtcv != "") {
            $sql = $sql . " AND tencv LIKE '%$cvtcv%'";
        }

        $data = mysqli_query($conn, $sql);
        $result = "";
        while ($rows = mysqli_fetch_array($data)) {
            $result = $result . "<tr></td>
            <td>$rows[0]</td>
            <td>$rows[1]</td>
            </tr>";
        }
        echo "$result";
    }

    if (isset($_POST['cvupdate'])) {

        $updvalue = "";
        if ($cvtcv != "") {
            $updvalue = $updvalue . " tencv='$cvtcv'";
        }

        if ($updvalue != "") {
            $sql = "UPDATE chucvu SET" . $updvalue . " WHERE macv='$cvmcv'";
            mysqli_query($conn, $sql);
        }
    }

    if (isset($_POST['cvadd'])) {
        $sql = mysqli_query($conn, "SELECT * FROM chucvu WHERE macv='$cvmcv'");
        if (mysqli_num_rows($sql) > 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Đã có dữ liệu mã chức $cvmcv','error');</script></div>";
            die;
        } else {
            if ($cvmcv != "" && $cvtcv != "" &&  strlen($cvmcv) == 2) {
                @$sql = "INSERT INTO chucvu(macv, tencv) VALUES ('$cvmcv','$cvtcv')";
                if (mysqli_query($conn, $sql))
                    echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đã thêm chức vụ $cvtcv','success');</script></div>";
                else
                    echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra','error');</script></div>";
            } else {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đầy đủ thông tin và mã chức vụ gồm 2 kí tự','warning');</script></div>";
            }
        }
    }

    if (isset($_POST['cvdelete'])) {
        $sql = mysqli_query($conn, "SELECT macv FROM chucvu WHERE macv='$cvmcv'");
        if (mysqli_num_rows($sql) <= 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không có dữ liệu của vị trí $cvtcv','error');</script></div>";
        } else {
            $sql = mysqli_query($conn, "SELECT macv FROM giangvien WHERE macv='$cvmcv'");
            if (mysqli_num_rows($sql) > 0) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vẫn còn dữ liệu của vị trí $cvtcv, vui lòng hủy tất cả dữ liệu liên quan trước khi xóa','error');</script></div>";
            } else {
                $sql = "DELETE FROM chucvu WHERE macv='$cvmcv'";
                mysqli_query($conn, $sql);
            }
        }
    }
}

if (isset($_POST['tdadmin'])) {

    $tdmtd   = isset($_POST['tdmtd']) ? mysqli_escape_string($conn, $_POST['tdmtd']) : '';
    $tdttd = isset($_POST['tdttd']) ? mysqli_escape_string($conn, $_POST['tdttd']) : '';

    if (isset($_POST['tdsearch'])) {

        $sql = "SELECT * FROM trinhdo WHERE 1=1";

        if ($tdmtd != "") {
            $sql = $sql . " AND matd LIKE '%$tdmtd%'";
        }
        if ($tdttd != "") {
            $sql = $sql . " AND tentd LIKE '%$tdttd%'";
        }

        $data = mysqli_query($conn, $sql);
        $result = "";
        while ($rows = mysqli_fetch_array($data)) {
            $result = $result . "<tr></td>
            <td>$rows[0]</td>
            <td>$rows[1]</td>
            </tr>";
        }
        echo "$result";
    }

    if (isset($_POST['tdupdate'])) {

        $updvalue = "";
        if ($tdttd != "") {
            $updvalue = $updvalue . " tentd='$tdttd'";
        }

        if ($updvalue != "") {
            $sql = "UPDATE trinhdo SET" . $updvalue . " WHERE matd='$tdmtd'";
            mysqli_query($conn, $sql);
        }
    }

    if (isset($_POST['tdadd'])) {
        $sql = mysqli_query($conn, "SELECT * FROM trinhdo WHERE matd='$tdmtd'");
        if (mysqli_num_rows($sql) > 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Đã có dữ liệu mã trình độ $tdmtd','error');</script></div>";
            die;
        } else {
            if ($tdmtd != "" && $tdttd != "" &&  strlen($tdmtd) == 2) {
                @$sql = "INSERT INTO trinhdo(matd, tentd) VALUES ('$tdmtd','$tdttd')";
                if (mysqli_query($conn, $sql))
                    echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đã thêm trình độ $tdttd','success');</script></div>";
                else
                    echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra','error');</script></div>";
            } else {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đầy đủ thông tin và mã trình độ gồm 2 kí tự','warning');</script></div>";
            }
        }
    }

    if (isset($_POST['tddelete'])) {
        $sql = mysqli_query($conn, "SELECT matd FROM trinhdo WHERE matd='$tdmtd'");
        if (mysqli_num_rows($sql) <= 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không có dữ liệu của trình độ $tdmtd','error');</script></div>";
        } else {
            $sql = mysqli_query($conn, "SELECT matd FROM giangvien WHERE matd='$tdmtd'");
            if (mysqli_num_rows($sql) > 0) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vẫn còn dữ liệu của trình độ $tdmtd, vui lòng hủy tất cả dữ liệu liên quan trước khi xóa','error');</script></div>";
            } else {
                $sql = "DELETE FROM trinhdo WHERE matd='$tdmtd'";
                mysqli_query($conn, $sql);
            }
        }
    }
}

if (isset($_POST['ngvadmin'])) {

    $ngvmn   = isset($_POST['ngvmn']) ? mysqli_escape_string($conn, $_POST['ngvmn']) : '';
    $ngvtn = isset($_POST['ngvtn']) ? mysqli_escape_string($conn, $_POST['ngvtn']) : '';
    $ngvgd = isset($_POST['ngvgd']) ? mysqli_escape_string($conn, $_POST['ngvgd']) : '';
    $ngvgnc = isset($_POST['ngvgnc']) ? mysqli_escape_string($conn, $_POST['ngvgnc']) : '';
    $ngvgk = isset($_POST['ngvgk']) ? mysqli_escape_string($conn, $_POST['ngvgk']) : '';

    if (isset($_POST['ngvsearch'])) {

        $sql = "SELECT * FROM ngachgv WHERE 1=1";

        if ($ngvmn != "") {
            $sql = $sql . " AND mangach LIKE '%$ngvmn%'";
        }
        if ($ngvtn != "") {
            $sql = $sql . " AND tenngach LIKE '%$ngvtn%'";
        }
        if ($ngvgd != "") {
            $sql = $sql . " AND gioday LIKE '%$ngvgd%'";
        }
        if ($ngvgnc != "") {
            $sql = $sql . " AND gionckh LIKE '%$ngvgnc%'";
        }
        if ($ngvgk != "") {
            $sql = $sql . " AND giokhac LIKE '%$ngvgk%'";
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
            </tr>";
        }
        echo "$result";
    }

    if (isset($_POST['ngvupdate'])) {

        $updvalue = "";
        if ($ngvtn != "") {
            $updvalue = $updvalue . " tenngach='$ngvtn'";
        }
        if ($ngvgd != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " gioday='$ngvgd'";
            } else {
                $updvalue = $updvalue . ", gioday='$ngvgd'";
            }
        }
        if ($ngvgnc != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " gionckh='$ngvgnc'";
            } else {
                $updvalue = $updvalue . ", gionckh='$ngvgnc'";
            }
        }
        if ($ngvgk != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " giokhac='$ngvgk'";
            } else {
                $updvalue = $updvalue . ", giokhac='$ngvgk'";
            }
        }
        if ($updvalue != "") {
            $sql = "UPDATE ngachgv SET" . $updvalue . " WHERE mangach='$ngvmn'";
            mysqli_query($conn, $sql);
        }
    }

    if (isset($_POST['ngvadd'])) {
        $sql = mysqli_query($conn, "SELECT * FROM ngachgv WHERE mangach='$ngvmn'");
        if (mysqli_num_rows($sql) > 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Đã có dữ liệu mã ngạch $ngvmn','error');</script></div>";
            die;
        } else {
            if ($ngvmn != "" && $ngvtn != "" && $ngvgd != "" && $ngvgnc != "" && $ngvgk != "") {
                @$sql = "INSERT INTO ngachgv(mangach, tenngach, gioday, gionckh, giokhac) VALUES ('$ngvmn','$ngvtn', '$ngvgd', '$ngvgnc', '$ngvgk')";
                if (mysqli_query($conn, $sql))
                    echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đã thêm ngạch $ngvtn','success');</script></div>";
                else
                    echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra','error');</script></div>";
            } else {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đầy đủ thông tin và mã ngạch gồm 6 kí tự','warning');</script></div>";
            }
        }
    }

    if (isset($_POST['ngvdelete'])) {
        $sql = mysqli_query($conn, "SELECT mangach FROM ngachgv WHERE mangach='$ngvmn'");
        if (mysqli_num_rows($sql) <= 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không có dữ liệu của mức ngạch $ngvmn','error');</script></div>";
        } else {
            $sql = mysqli_query($conn, "SELECT mangach FROM giangvien WHERE mangach='$ngvmn'");
            if (mysqli_num_rows($sql) > 0) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vẫn còn dữ liệu của mức ngạch $ngvmn, vui lòng hủy tất cả dữ liệu liên quan trước khi xóa','error');</script></div>";
            } else {
                $sql = "DELETE FROM ngachgv WHERE mangach='$ngvmn'";
                mysqli_query($conn, $sql);
            }
        }
    }
}

if (isset($_POST['nvadmin'])) {

    $nvmnv   = isset($_POST['nvmnv']) ? mysqli_escape_string($conn, $_POST['nvmnv']) : '';
    $nvtnv = isset($_POST['nvtnv']) ? mysqli_escape_string($conn, $_POST['nvtnv']) : '';

    if (isset($_POST['nvsearch'])) {

        $sql = "SELECT * FROM loainv WHERE 1=1";

        if ($nvmnv != "") {
            $sql = $sql . " AND loainv LIKE '%$nvmnv%'";
        }
        if ($nvtnv != "") {
            $sql = $sql . " AND tennv LIKE '%$nvtnv%'";
        }

        $data = mysqli_query($conn, $sql);
        $result = "";
        while ($rows = mysqli_fetch_array($data)) {
            $result = $result . "<tr></td>
            <td>$rows[0]</td>
            <td>$rows[1]</td>
            </tr>";
        }
        echo "$result";
    }

    if (isset($_POST['nvupdate'])) {

        $updvalue = "";
        if ($nvtnv != "") {
            $updvalue = $updvalue . " tennv='$nvtnv'";
        }

        if ($updvalue != "") {
            $sql = "UPDATE loainv SET" . $updvalue . " WHERE loainv='$nvmnv'";
            mysqli_query($conn, $sql);
        }
    }

    if (isset($_POST['nvadd'])) {
        $sql = mysqli_query($conn, "SELECT * FROM loainv WHERE loainv='$nvmnv'");
        if (mysqli_num_rows($sql) > 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Đã có dữ liệu về nhiệm vụ $nvmnv','error');</script></div>";
            die;
        } else {
            if ($nvmnv != "" && $nvtnv != "" &&  strlen($nvmnv) == 2) {
                @$sql = "INSERT INTO loainv(loainv, tennv) VALUES ('$nvmnv','$nvtnv')";
                if (mysqli_query($conn, $sql))
                    echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đã thêm công việc $nvtnv','success');</script></div>";
                else
                    echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra','error');</script></div>";
            } else {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đầy đủ thông tin và mã loại nhiệm vụ gồm 2 kí tự','warning');</script></div>";
            }
        }
    }

    if (isset($_POST['nvdelete'])) {
        $sql = mysqli_query($conn, "SELECT loainv FROM loainv WHERE loainv='$nvmnv'");
        if (mysqli_num_rows($sql) <= 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không có dữ liệu của công việc $nvtnv','error');</script></div>";
        } else {
            $sql = mysqli_query($conn, "SELECT loainv FROM chitiethd WHERE loainv='$nvmnv'");
            if (mysqli_num_rows($sql) > 0) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vẫn còn dữ liệu của công việc $nvtnv, vui lòng hủy tất cả dữ liệu liên quan trước khi xóa','error');</script></div>";
            } else {
                $sql = "DELETE FROM loainv WHERE loainv='$nvmnv'";
                mysqli_query($conn, $sql);
            }
        }
    }
}

if (isset($_POST['hdadmin'])) {

    $hdmhd   = isset($_POST['hdmhd']) ? mysqli_escape_string($conn, $_POST['hdmhd']) : '';
    $hdnh1 = isset($_POST['hdnh1']) ? mysqli_escape_string($conn, $_POST['hdnh1']) : '';
    $hdnh2 = isset($_POST['hdnh2']) ? mysqli_escape_string($conn, $_POST['hdnh2']) : '';
    $hdmgv = isset($_POST['hdmgv']) ? mysqli_escape_string($conn, $_POST['hdmgv']) : '';
    $hdst = isset($_POST['hdst']) ? mysqli_escape_string($conn, $_POST['hdst']) : '';
    $hdmnv = isset($_POST['hdmnv']) ? mysqli_escape_string($conn, $_POST['hdmnv']) : '';
    $hdctnv = isset($_POST['hdctnv']) ? mysqli_escape_string($conn, $_POST['hdctnv']) : '';
    $hdgc = isset($_POST['hdgc']) ? mysqli_escape_string($conn, $_POST['hdgc']) : '';

    if (isset($_POST['hdsearch'])) {

        $sql = "SELECT * FROM chitiethd WHERE 1=1";
        $sum = "SELECT SUM(sotiet) FROM chitiethd WHERE 1=1";

        if ($hdmhd != "") {
            $sql = $sql . " AND mact='$hdmhd'";
            $sum = $sum . " AND mact='$hdmhd'";
        }
        if ($hdnh1 != "" && $hdnh2 != "") {
            $sql = $sql . " AND namhoc LIKE '{$hdnh1}-{$hdnh2}'";
            $sum = $sum . " AND namhoc LIKE '{$hdnh1}-{$hdnh2}'";
        } else  if ($hdnh2 == "" && $hdnh1 != "") {
            $sql = $sql . " AND namhoc LIKE '$hdnh1%'";
            $sum = $sum . " AND namhoc LIKE '$hdnh1%'";
        } else {
            $sql = $sql . " AND namhoc LIKE '%$hdnh2'";
            $sum = $sum . " AND namhoc LIKE '%$hdnh2'";
        }
        if ($hdmgv != "") {
            $sql = $sql . " AND magv LIKE '%$hdmgv%'";
            $sum = $sum . " AND magv LIKE '%$hdmgv%'";
        }
        if ($hdst != "") {
            $sql = $sql . " AND sotiet LIKE '$hdst'";
            $sum = $sum . " AND sotiet LIKE '$hdst'";
        }
        if ($hdmnv != "") {
            $sql = $sql . " AND loainv LIKE '%$hdmnv%'";
            $sum = $sum . " AND loainv LIKE '%$hdmnv%'";
        }
        if ($hdctnv != "") {
            $sql = $sql . " AND chitietnv LIKE '%$hdctnv%'";
            $sum = $sum . " AND chitietnv LIKE '%$hdctnv%'";
        }
        if ($hdgc != "") {
            $sql = $sql . " AND ghichu LIKE '%$hdgc%'";
            $sum = $sum . " AND ghichu LIKE '%$hdgc%'";
        }

        $data = mysqli_query($conn, $sql);
        $result = "";
        $TGD = mysqli_fetch_array(mysqli_query($conn, $sum));
        while ($rows = mysqli_fetch_array($data)) {
            $result = $result . "<tr></td>
            <td>$rows[0]</td>
            <td>$rows[1]</td>
            <td>$rows[2]</td>
            <td>$rows[3]</td>
            <td>$rows[4]</td>
            <td>$rows[5]</td>
            <td>$rows[6]</td>
            </tr>";
        }
        echo $result . "<tr></tr><tr class='hiddentr'><td></td><td></td><td></td><td></td><td></td><td></td><td>Tổng số tiết: $TGD[0]</td></tr>";
    }

    if (isset($_POST['hdupdate'])) {

        $updvalue = "";
        if ($hdmgv != "") {
            $updvalue = $updvalue . " magv='$hdmgv'";
        }
        if ($hdst != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " sotiet='$hdst'";
            } else {
                $updvalue = $updvalue . ", sotiet='$hdst'";
            }
        }
        if ($hdmnv != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " loainv='$hdmnv'";
            } else {
                $updvalue = $updvalue . ", loainv='$hdmnv'";
            }
        }
        if ($hdctnv != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " chitietnv='$hdctnv'";
            } else {
                $updvalue = $updvalue . ", chitietnv='$hdctnv'";
            }
        }
        if ($hdgc != "") {
            if ($updvalue == "") {
                $updvalue = $updvalue . " ghichu='$hdgc'";
            } else {
                $updvalue = $updvalue . ", ghichu='$hdgc'";
            }
        }
        if ($updvalue == "") {
            if ($hdnh1 != "" && $hdnh2 != "") {
                $updvalue = $updvalue . " namhoc='{$hdnh1}-{$hdnh2}'";
            } else if (($hdnh1 == "" && $hdnh2 != "") || ($hdnh2 == "" && $hdnh1 != "")) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đẩy đủ thông tin năm học','error');</script></div>";
                die;
            }
        } else {
            if ($hdnh1 != "" && $hdnh2 != "") {
                $updvalue = $updvalue . ", namhoc='{$hdnh1}-{$hdnh2}'";
            } else if (($hdnh1 == "" && $hdnh2 != "") || ($hdnh2 == "" && $hdnh1 != "")) {
                echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đẩy đủ thông tin năm học','error');</script></div>";
                die;
            }
        }

        if ($updvalue != "") {
            $sql = "UPDATE chitiethd SET" . $updvalue . " WHERE mact='$hdmhd'";
            mysqli_query($conn, $sql);
        }
    }

    if (isset($_POST['hdadd'])) {
        if ($hdnh1 != "" && $hdnh2 != "" && $hdst != "" && $hdmgv != "" && $hdmnv != "" && $hdctnv != "") {
            $nh = $hdnh1 . '-' . $hdnh2;
            @$sql = "INSERT INTO chitiethd(mact, magv, namhoc, loainv, chitietnv, sotiet, ghichu) VALUES (NULL,'$hdmgv','$nh', '$hdmnv', '$hdctnv', '$hdst', '$hdgc')";
            if (mysqli_query($conn, $sql))
                echo "<div id='alert'><script>Swal.fire('Thành Công', 'Đã thêm công việc của giảng viên $hdmgv','success');</script></div>";
            else
                echo "<div id='alert'><script>Swal.fire('Thất bại', 'Có lỗi xảy ra','error');</script></div>";
        } else {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Vui lòng điền đầy đủ thông tin','warning');</script></div>";
        }
    }

    if (isset($_POST['hddelete'])) {
        $sql = mysqli_query($conn, "SELECT mact FROM chitiethd WHERE mact='$hdmhd'");
        if (mysqli_num_rows($sql) <= 0) {
            echo "<div id='alert'><script>Swal.fire('Lỗi', 'Không có dữ liệu của hoạt động $hdmhd này','error');</script></div>";
            die;
        } else {
            $sql = "DELETE FROM chitiethd WHERE mact='$hdmhd'";
            mysqli_query($conn, $sql);
        }
    }
}
