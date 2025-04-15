<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$query = "select medicine_name,t.id 
        from medicine t where stock != 0 AND 
        not exists 
        ( select 1 from sale_product_info where medicine = t.id and datediff(curdate(),sale_product_info.date) <= 120 ) 
        AND not exists
        ( select 1 from purchase_product_info where medicine = t.id and datediff(curdate(),purchase_product_info.pur_date) <= 120 )";

$pages = $db_handle->numRows($query);
if (!empty($pages)) {
    ?>
    <b><?php echo $pages; ?></b>
<?php } ?>



