<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$pages = $db_handle->runQuery("SELECT * FROM customer WHERE deletion_status = 0 AND balance != '0'");
$cusBalance = 0;
if(!empty($pages)) {
    foreach($pages as $row) {
        $cusBalance += $row['balance'];
    }
    
?>
<b><?php echo $cusBalance;?></b>

<?php } ?>

