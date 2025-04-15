<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$query = "SELECT * FROM income WHERE deletion_status = 0 AND DATE(income_date) = DATE(NOW())";
$pages = $db_handle->numRows($query);
if(!empty($pages)) {
?>
<b><?php echo $pages;?></b>
<?php } ?>
