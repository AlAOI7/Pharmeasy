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

$getDueToday = $report->getCustomerDuesToday();
$dTdy = 0;
if (is_array($getDueToday) || is_object($getDueToday)) {
    foreach ($getDueToday as $numdt) {
        $dTdy += $numdt['inv_due'];
    }
}
?>
<b><?php echo $dTdy; ?></b>





