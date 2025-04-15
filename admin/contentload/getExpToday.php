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

$getPaymentInfo = $report->getPaymentToday();
$expPayTdy = 0;
//while ($num22 = mysqli_fetch_assoc($getPaymentInfo)) {
if (is_array($getPaymentInfo) || is_object($getPaymentInfo)) {
    foreach ($getPaymentInfo as $num22) {
        $expPayTdy += $num22['payment'];
    }
}

$getInfo2 = $report->getExpToday();
$expTdy = 0;
while ($num2 = mysqli_fetch_assoc($getInfo2)) {
    $expTdy += $num2['examt'];
}

$getInfo3 = $report->getOverheadToday();
$ohTdy = 0;
while ($num3 = mysqli_fetch_assoc($getInfo3)) {
    $ohTdy += $num3['ohamt'];
}

$getInfoSR = $report->getSalesReturnToday();
$srTdy = 0;
while ($numsr3 = mysqli_fetch_assoc($getInfoSR)) {
    $srTdy += $numsr3['sramt'];
}

$totalExp = $expTdy + $ohTdy + $expPayTdy + $srTdy;
?>
<b><?php echo $totalExp; ?></b>



