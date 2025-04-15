<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$query = "SELECT * FROM medicine WHERE deletion_status = 0 AND (min_stock = stock OR stock < min_stock) AND min_stock != '-1'";

$pages = $db_handle->numRows($query);
if (!empty($pages)) {
    ?>
    <b><?php echo $pages; ?></b>
<?php } ?>
