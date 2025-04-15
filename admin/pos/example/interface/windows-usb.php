<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/../../autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

//Data from database
include '../../../core/Database.php';
//include 'core/Database.php';
include'../../../core/Format.php';
include '../../../class/Adminlogin.php';
include '../../../class/Medicine.php';
$admin = new Adminlogin();
$medicine = new Medicine();
$fm = new Format();
$getInfo = $admin->getInformation();
$info = mysqli_fetch_assoc($getInfo);
$store_name = $info['store_name'];
$address_line1 = $info['address_line1'];
$address_line2 = $info['address_line2'];
$mobile = $info['mobile'];
if (!isset($_GET['inv']) || $_GET['inv'] == NULL) {
    echo "<script>window.location = '../../../manage-invoice.php';</script>";
} else {

    $inv = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['inv']);
}
$logo = $admin->getLogo();
$logo_fetch = mysqli_fetch_assoc($logo);
$logo_filename = $logo_fetch['logo'];

$getCusInv = $medicine->getSingleInvInfo($inv);
$cusInvInfo = mysqli_fetch_assoc($getCusInv);
$cusId = $cusInvInfo['id'];
$getSingleInv = $medicine->singleInvInfo($inv, $cusId);
//$cusInvDetails = mysqli_fetch_assoc($getSingleInv);

$cusName = $medicine->getOneCol('name', 'customer', 'id', $cusInvInfo['customer']);
$cusMobile = $medicine->getOneCol('mobile', 'customer', 'id', $cusInvInfo['customer']);
$cusCurrentDue = $medicine->getOneCol('balance', 'customer', 'id', $cusInvInfo['customer']);
//$invoice_number = $singleInvInfo['invoice_number'];
$date = $fm->formatDate($cusInvInfo['sale_date']);
$total = $cusInvInfo['total_amount'];
$preDue = $cusInvInfo['previous_due'];
$discount = $cusInvInfo['discount'];
$less = $cusInvInfo['less'];
$paid = $cusInvInfo['amount'];
$changeAmount = $cusInvInfo['changeAmount'];
//$invDue = $total - $paid;
$invDue = $cusInvInfo['inv_due'];



try {
    // Enter the share name for your USB printer here
    //$connector = null;
    $connector = new WindowsPrintConnector("RONGTA 80mm Series Printer");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    //$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    //$tux = EscposImage::load("../../../images/" . $logo_filename, false);
    //$printer->bitImage($tux);
    $printer->setTextSize(2, 2);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text($store_name . "\n");
    $printer->setTextSize(1, 1);
    if ($address_line1 != "") {
        $printer->text($address_line1 . "\n");
    }
    if ($address_line2 != "") {
        $printer->text($address_line2 . "\n");
    }
    $printer->text($mobile . "\n");
    $printer->text("\n");
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setEmphasis(true);
    $printer->selectPrintMode(Printer::MODE_UNDERLINE);
    $printer->text("INVOICE\n\n");
    $printer->setEmphasis(false);

    $printer->selectPrintMode();
    $printer->setTextSize(1, 1);
    $printer->text("Invoice: " . $inv . "\n");
    $printer->text("Date: " . $date . "\n");
    $printer->text("Customer: " . $cusName . "\n");
    $printer->text("Phone: " . $cusMobile . "\n");
    $printer->text("Current Due: " . $cusCurrentDue . "\n");

    $printer->selectPrintMode();

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("___________________________________________\n");
    $printer->text(" Price             Qty               Total\n");
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("___________________________________________\n");

    if ($getSingleInv) {
        $tot = 0;
        $i = 0;
        while ($row = $getSingleInv->fetch_assoc()) {
            $i++;

            $proName = $medicine->getOneCol('medicine_name', 'medicine', 'id', $row['medicine']);
            $proStrength = $medicine->getOneCol('medicine_strength', 'medicine', 'id', $row['medicine']);
            $proForm = $medicine->getOneCol('medicine_form', 'medicine', 'id', $row['medicine']);
            $proPrice = $medicine->getOneCol('sale_price', 'medicine', 'id', $row['medicine']);
            $proQty = $row['qty'];
            $sub_total = $row['sub_total'];

            $printer->text($proName . " " . $proStrength . " " . $proForm . "\n");
            $printer->text(" " . $proPrice . "                " . $proQty . "              " . $sub_total . "\n");
            $printer->text("-------------------------------------------\n");
            $tot = $tot + $sub_total;
        }
    }
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $disAmt = $tot * ($discount / 100);
    $printer->text("                Total                " . $tot . "\n");
    if ($discount != "") {
        $printer->text("             Discount(" . $discount . "%)  " . $disAmt . "\n");
    }
    $printer->text("                Less                 " . $less . "\n");
    $printer->text("                Grand Total          " . $total . "\n");
    $printer->text("                Paid                 " . $paid . "\n");
    $printer->text("                Refund               " . $changeAmount . "\n");
    $printer->text("                Due                  " . $invDue . "\n\n\n");

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1, 2);
    $printer->text("Thank You\n");
    $printer->setTextSize(1, 1);
    date_default_timezone_set('Asia/Dhaka');
    $pdate = date('d/m/Y h:i:s a', time());
    $printer->text("Printed on " . $pdate . "\n\n");
    $printer->text("Developed by Mohammad Ali Khan.\n Email: xvirus.bd@gmail.com\n");

    $printer->cut();

    /* Close printer */
    $printer->close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}

echo '<script>window.close</script>';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <script type="text/javascript">
            function closeWindow() {
                setTimeout(function () {
                    window.close();
                }, 1000);
            }
            window.onload = closeWindow();
        </script>
    </head>
    <body>
    </body>
</html>