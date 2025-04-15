<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$current_date = date('Y-m-d');
$query = "SELECT * FROM customer WHERE deletion_status = 0 AND '$current_date'<= followup_date";

$pages = $db_handle->numRows($query);
if (!empty($pages)) {
    ?>
    <b><?php echo $pages; ?></b>
<?php } ?>