<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$pages = $db_handle->numRows("SELECT * FROM expired_stock WHERE deletion_status = 0 AND edate < DATE(NOW())");
if(!empty($pages)) {
?>
<b><?php echo $pages;?></b>
<?php } ?>

