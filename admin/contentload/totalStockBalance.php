<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$pages = $db_handle->runQuery("SELECT * FROM medicine WHERE deletion_status = 0 AND stock != '0'");
$stkBalance = 0;
if(!empty($pages)) {
    foreach($pages as $row) {
        $stkBalance += $row['purchases_price'] * $row['stock'];
    }
    
?>
<b><?php echo $stkBalance;?></b>
<?php } ?>

