<?php
require_once("../loadpage/dbcontroller.php");
$db_handle = new DBController();
$query = "select name,mobile,location,address,balance,t.id 
                    from customer t where t.balance != 0.00 AND
                      not exists (
                          select 1 
                            from customer_invoice_info where 
                            customer = t.id
                            and
                            datediff(curdate(),customer_invoice_info.sale_date) <= 30)";
$pages = $db_handle->numRows($query);
if (!empty($pages)) {
    ?>
    <b><?php echo $pages; ?></b>
<?php } ?>



