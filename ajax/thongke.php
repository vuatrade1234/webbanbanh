<?php
include '../Carbon/autoload.php';
include '../lib/database.php';
use Carbon\Carbon;
use Carbon\CarbonInterval;

$db = new Database();

if (isset($_POST['thoigian'])) {
    $thoigian = $_POST['thoigian'];
} else {
    $thoigian = '';
    // Xác định subdays dựa trên giá trị text trực tiếp từ dropdown
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
}

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
if ($thoigian == '7ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString(); // 365 ngày
} elseif ($thoigian == '30ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString(); // 28 ngày
} elseif ($thoigian == '90ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString(); // 90 ngày
}else{
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString(); // 90 ngày
}


$sql = "SELECT *, DATE(ngaydat) AS ngay FROM thongke WHERE DATE(ngaydat) BETWEEN '$subdays' AND '$now' ORDER BY ngaydat ASC";
$result = $db->select($sql);

$chart_data = array();

while ($row = $result->fetch_assoc()) {
    $chart_data[] = array(
        'year' => $row['ngaydat'],
        'donhang' => $row['donhang'],
        'danhthu' => $row['danhthu'],
        'soluong' => $row['soluong'],
        'selected_duration' => $thoigian, // Sử dụng $thoigian thay vì $text
    );
}

echo json_encode($chart_data);
header('Content-Type: application/json');
?>