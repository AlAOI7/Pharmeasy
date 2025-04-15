<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$pages = $db_handle->numRows("SELECT * FROM medicine WHERE deletion_status = 0 AND stock != 0");
if(!empty($pages)) {
?>
<b><?php echo $pages;?></b>
<?php } ?>
