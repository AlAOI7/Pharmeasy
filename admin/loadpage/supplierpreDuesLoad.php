<?php
error_reporting(E_ALL);
include 'connect.php';

$sup_id = $_POST['sup_id'];

$sql = "SELECT *  FROM `company` WHERE id = '$sup_id'";

$query_result = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query_result);

$paymentCount = $result['balance'];
echo $paymentCount; 
?>
