<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$pages = $db_handle->runQuery("SELECT * FROM company WHERE deletion_status = 0 AND balance != '0'");
$supBalance = 0;
if(!empty($pages)) {
    foreach($pages as $row) {
        $supBalance += $row['balance'];
    }
?>
<b><?php echo $supBalance;?></b>

<?php } ?>



