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

$paymentsToday = $report->getTodaysPayment();
$payToday = 0;
if (is_array($paymentsToday) || is_object($paymentsToday)) {
    foreach ($paymentsToday as $num4) {
        $payToday += $num4['payment'];
    }
}
?>
<b><?php echo $payToday; ?></b>



