<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
/*$query = "SELECT * FROM expired_stock WHERE deletion_status = 0 
AND (SELECT medicine.stock FROM medicine WHERE deletion_status = 0 AND medicine.id = expired_stock.product AND medicine.stock != 0) 
AND DATEDIFF(edate,curdate()) <= 180
AND curdate() < edate"; */

$query = "SELECT expired_stock.* FROM expired_stock WHERE expired_stock.deletion_status = 0 
AND (SELECT medicine.stock FROM medicine WHERE medicine.deletion_status = 0 AND medicine.id = expired_stock.product AND medicine.stock != 0) 
AND DATEDIFF(expired_stock.edate,curdate()) <= 180
AND curdate() < expired_stock.edate GROUP BY expired_stock.product";
$pages = $db_handle->numRows($query);
if(!empty($pages)) {
?>
<b><?php echo $pages;?></b>
<?php } ?>