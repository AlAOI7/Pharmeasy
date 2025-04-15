<?php
include '../core/Database.php';
include'../core/Format.php';
include '../class/Adminlogin.php';
include '../class/Medicine.php';
include '../class/Report.php';

$fm = new Format();
$admin = new Adminlogin();
$medicine = new Medicine();
$report = new Report();

$purchasesToday = $report->getTodaysPurchase();
$purToday = 0;
if (is_array($purchasesToday) || is_object($purchasesToday)) {
    foreach ($purchasesToday as $num3) {
        $purToday += $num3['total_amount'];
    }
}
?>
<b><?php echo $purToday; ?></b>



