function qGetElementById(id) {
    return document.getElementById(id);
}

function qSelector(selector) {
    return document.querySelector(selector);
}

function qGetElementByClass(className) {
    return document.getElementsByClassName(className);
}

function toHTML(id, mess) {
    return document.getElementById(id).innerHTML = mess;
}

$(window).on('resize', function() {
    if ($(document).width() < 800){
        document.body.style = "background-color: white;";
        document.body.innerHTML = "<section class='PCResponsive' style='background-color: white; text-align: center;'><h1>Xin lỗi hiện tại trang này chưa hỗ trợ giao diện Mobile</h1><p>Vui lòng sử dụng trên máy tính hoặc màn hình có độ phân giải cao hơn để có trải nghiệm tốt nhất</p></section>"
    }
    else{
        location.reload();
    }
});

function clearVal() {

    if (document.documentURI.indexOf("/homepage/admin/giangvien.php") >= 0){
        document.getElementById("gvmgv").value = "";
        document.getElementById('gvht').value = "";
        document.getElementById("gvsdt").value = "";
        document.getElementById('gve').value = "";
        document.getElementById('gvns').value = "";
        document.getElementById('gvp').value = "";
        document.getElementById('gvdv').value = "";
        document.getElementById('gvtd').value = "";
        document.getElementById('gvn').value = "";
        document.getElementById('gvcv').value = "";
        document.getElementById('gvq').value = "";
    }

    if ((document.documentURI.indexOf("/homepage/admin/donvi.php") >= 0)){
        document.getElementById("dvmdv").value = "";
        document.getElementById('dvtdv').value = "";
        document.getElementById("dvsdt").value = "";
        document.getElementById('dve').value = "";
    }

    if ((document.documentURI.indexOf("/homepage/admin/chucvu.php") >= 0)){
        document.getElementById("cvmcv").value = "";
        document.getElementById('cvtcv').value = "";
    }

    if ((document.documentURI.indexOf("/homepage/admin/trinhdo.php") >= 0)){
        document.getElementById("tdmtd").value = "";
        document.getElementById('tdttd').value = "";
    }

    if ((document.documentURI.indexOf("/homepage/admin/ngachgv.php") >= 0)){
        document.getElementById("ngvmn").value = "";
        document.getElementById('ngvtn').value = "";
        document.getElementById('ngvgd').value = "";
        document.getElementById('ngvgnc').value = "";
        document.getElementById('ngvgk').value = "";
    }

    if ((document.documentURI.indexOf("/homepage/admin/nhiemvu.php") >= 0)){
        document.getElementById("nvmnv").value = "";
        document.getElementById('nvtnv').value = "";
    }

    if ((document.documentURI.indexOf("/homepage/admin/hoatdong.php") >= 0)){
        document.getElementById("hdmhd").value = "";
        document.getElementById('hdnh1').value = "";
        document.getElementById('hdnh2').value = "";
        document.getElementById('hdmgv').value = "";
        document.getElementById('hdst').value = "";
        document.getElementById('hdmnv').value = "";
        document.getElementById('hdctnv').value = "";
        document.getElementById('hdgc').value = "";
    }

    if ((document.documentURI.indexOf("/homepage/home.php") >= 0)){
        document.getElementById("tab2hnh1").value = "";
        document.getElementById("tab2hnh2").value = "";
        document.getElementById("tab2hst").value = "";
        document.getElementById("tab2hmnv").value = "";
        document.getElementById("tab2hctnv").value = "";
        document.getElementById("tab2hmhd").value = "";
        document.getElementById("tab2hgc").value = "";
    }

    if ((document.documentURI.indexOf("/homepage/report.php") >= 0)){
        document.getElementById("reportnh1").value = "";
        document.getElementById("reportnh2").value = "";
        document.getElementById("reportst").value = "";
        document.getElementById("reportmnv").value = "";
    }

}