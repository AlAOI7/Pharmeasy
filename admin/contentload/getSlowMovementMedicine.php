<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$query = "select medicine,SUM(qty) as totQty from sale_product_info where datediff(curdate(),date) <= 120 GROUP BY medicine HAVING totQty < ROUND((select stock from medicine where medicine.stock != 0 AND medicine.id = sale_product_info.medicine) * 0.4)";
$pages = $db_handle->numRows($query);
if (!empty($pages)) {
    ?>
    <b><?php echo $pages; ?></b>
<?php } ?>



