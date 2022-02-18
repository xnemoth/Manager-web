<?php
require_once 'vendor/autoload.php';
require_once __DIR__ . '\..\datahandle.php';

$user = $_SESSION['username'];
$sql = mysqli_query($conn, "SELECT * FROM giangvien WHERE magv='$user'");
$result = mysqli_fetch_array($sql);
mysqli_set_charset($conn, "utf8");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$PHPSS = new Spreadsheet();
$currentSheet = $PHPSS->setActiveSheetIndex(0);

$fileName = 'HD' . $user . '_' . time() . '.xlsx';
$ngay = date("d");
$thang = date("m");
$nam = date("Y");

$PHPSS->getActiveSheet()->setTitle('Hoạt động giảng viên ' . $user);
$PHPSS->getActiveSheet()->setCellValue('A1', 'UBND TỈNH BẠC LIÊU');
$PHPSS->getActiveSheet()->setCellValue('C1', 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
$PHPSS->getActiveSheet()->setCellValue('A2', 'TRƯỜNG ĐẠI HỌC BẠC LIÊU');
$PHPSS->getActiveSheet()->setCellValue('C2', 'Độc lập - Tự do - Hạnh phúc');
$PHPSS->getActiveSheet()->setCellValue('C3', 'Bạc Liêu, Ngày ' . $ngay . ' tháng ' . $thang . ' năm ' . $nam);
$PHPSS->getActiveSheet()->setCellValue('B5', 'BÁO CÁO HOẠT ĐỘNG');
$PHPSS->getActiveSheet()->setCellValue('A7', 'Giảng viên báo cáo: ' . $user . ' - ' . $result['hoten']);

$PHPSS->getActiveSheet()->setCellValue('A8', 'Năm học');
$PHPSS->getActiveSheet()->setCellValue('B8', 'Loại nhiệm vụ');
$PHPSS->getActiveSheet()->setCellValue('C8', 'Chi tiết');
$PHPSS->getActiveSheet()->setCellValue('D8', 'Số tiết');
$PHPSS->getActiveSheet()->setCellValue('E8', 'Ghi chú');

$rowNumber = 9;
$data = mysqli_query($conn, $exsql);
while ($reportdata = mysqli_fetch_array($data)) {
    $PHPSS->getActiveSheet()->setCellValue('A' . $rowNumber, $reportdata[0]);
    $PHPSS->getActiveSheet()->setCellValue('B' . $rowNumber, $reportdata[1]);
    $PHPSS->getActiveSheet()->setCellValue('C' . $rowNumber, $reportdata[2]);
    $PHPSS->getActiveSheet()->setCellValue('D' . $rowNumber, $reportdata[3]);
    $PHPSS->getActiveSheet()->setCellValue('E' . $rowNumber, $reportdata[4]);
    $rowNumber++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$Writer = IOFactory::createWriter($PHPSS, 'Xlsx');
if (isset($Writer)) {
    $Writer->save('php://output');
}
