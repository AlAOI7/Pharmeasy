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

$salesToday = $report->getTodaysSale();
$saleToday = 0;
if (is_array($salesToday) || is_object($salesToday)) {
foreach ($salesToday as $num) {
    $cashPaid = $num['amount'];
    $change = $num['changeAmount'];
    $totSales = $cashPaid + $change;
    $saleToday += $totSales;
    //$saleToday += $num['total_amount'];
}
}
?>
<b><?php echo $saleToday; ?></b>



