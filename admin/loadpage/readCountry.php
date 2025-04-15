<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM medicine WHERE medicine_name like '" . $_POST["keyword"] . "%' ORDER BY medicine_name LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["medicine_name"]; ?>');"><?php echo $country["medicine_name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>