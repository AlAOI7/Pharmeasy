<?php
include 'core/Database.php';
include'core/Format.php';
include 'class/Adminlogin.php';
include 'class/Medicine.php';
include 'class/Report.php';
$medicine = new Medicine();
//how we where clause write here ?
// wher name like %a

$name = $_GET['name'];
$sup_id = $_GET['sup_id'];
$getMedicine = $medicine->searchProdctByTitle2(['name'=>$name],['sup_id'=>$sup_id]);
$data = [];
if($getMedicine){
    

    while ($res = $getMedicine->fetch_assoc()) { 
        if(!$res){
        echo json_encode(["message"=>"products not flund starting this letters!!"]);
            
        }
 	$data[] = $res;

 }
 echo json_encode($data,true);
} else {
    echo json_encode(["message"=>"products not flund starting this letters!!"]);
}
 
 ?>
 
