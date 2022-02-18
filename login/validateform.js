function qGetElementById(id) {
    return document.getElementById(id);
}

function validateMessage(id, mess) {
    return document.getElementById(id).innerHTML = mess;
}

function validate() {
    temp = true;
    
    if( qGetElementById("magv").value.length < 8 || /[^a-z^A-Z^0-9]/.test(qGetElementById("magv").value)){
        validateMessage("validate-magv", "<span id='validate-magv' style='color: red;'>Mã giảng viên gồm 8 kí tự là chữ cái hoặc số</span>")
        qGetElementById("magv").focus();
        temp = false;
        return temp;
    } else {
        validateMessage("validate-magv", "<span id='validate-magv' style='color: red;'></span>");
        temp = true;
    }

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
    if (qGetElementById("fullname").value == "" || /[[^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]/.test(qGetElementById("fullname").value)){
    validateMessage("validate-fullname", "<span id='validate-fullname' style='color: red;'>Vui lòng nhập họ và tên chính xác và không chứa kí tự đặc biệt</span>")
    qGetElementById("fullname").focus();
    temp = false;
        return temp;
    } else {
        validateMessage("validate-fullname", "<span id='validate-fullname' style='color: red;'></span>");
        temp = true;
    }

    if (qGetElementById("email").value == "" || !/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/.test(qGetElementById("email").value)){
        validateMessage("validate-email", "<span id='validate-email' style='color: red;'>Vui lòng nhập email đúng định dạng</span>")
        qGetElementById("email").focus();    
        temp = false;
            return temp;
        } else {
            validateMessage("validate-email", "<span id='validate-email' style='color: red;'></span>");
            temp = true;
        }

        if( qGetElementById("sdt").value.length < 10 || /[^0-9]/.test(qGetElementById("sdt").value)){
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