<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$query = "SELECT * FROM admin WHERE deletion_status = 0";

$pages = $db_handle->numRows($query);
if (!empty($pages)) {
    ?>
    <b><?php echo $pages; ?></b>
<?php } ?>



