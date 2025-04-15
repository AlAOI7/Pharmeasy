<?php
error_reporting(E_ALL);
include 'connect.php';

$cus_id = $_POST['cus_id'];

$sql = "SELECT *  FROM `customer` WHERE id = '$cus_id'";

$query_result = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query_result);

$paymentCount = $result['balance'];
echo $paymentCount; 
?>


