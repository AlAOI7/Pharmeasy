<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$query = "SELECT * FROM customer_collection WHERE DATE(collectionDate) = DATE(NOW())";
$pages = $db_handle->numRows($query);
if (!empty($pages)) {
    ?>
    <b><?php echo $pages; ?></b>
<?php } ?>



