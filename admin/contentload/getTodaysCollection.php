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

$collectionsToday = $report->getTodaysCollection();
$collectionToday = 0;
if (is_array($collectionsToday) || is_object($collectionsToday)) {
foreach ($collectionsToday as $num2) {
    $collectionToday += $num2['collection'];
}
}
?>
<b><?php echo $collectionToday; ?></b>



