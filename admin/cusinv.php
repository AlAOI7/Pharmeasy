<?php
ob_start();
error_reporting(E_ALL);
//call the FPDF library
require('fpdf17/fpdf.php');
include 'core/Database.php';
include'core/Format.php';
include 'class/Adminlogin.php';
include 'class/Medicine.php';
$admin = new Adminlogin();
$medicine = new Medicine();
$fm = new Format();
if (!isset($_GET['invid']) || $_GET['invid'] == NULL) {
    echo "<script>window.location = 'manage-invoice.php';</script>";
} else {

    $invid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['invid']);
}
$getProductInv = $medicine->getAllProductInvoice($invid);
$getSingleInv = $medicine->getAllSingleInvoice($invid);
$singleInvInfo = mysqli_fetch_assoc($getSingleInv);

$cusName = $medicine->getOneCol('name', 'customer', 'id', $singleInvInfo['customer']);
$cusMobile = $medicine->getOneCol('mobile', 'customer', 'id', $singleInvInfo['customer']);
$invoice_number = $singleInvInfo['invoice_number'];
$date = $fm->formatDate($singleInvInfo['sale_date']);
$total = $singleInvInfo['total_amount'];
$preDue = $singleInvInfo['previous_due'];
$discount = $singleInvInfo['discount'];
$less = $singleInvInfo['less'];
$paid = $singleInvInfo['amount'];
$changeAmount = $singleInvInfo['changeAmount'];
$dues = $singleInvInfo['dues'];
$invDue = $total - $paid;

try {
    $totConvert = convert_number($total) . " " . "Taka only";
} catch (Exception $e) {
    echo $e->getMessage();
}
$GetLogo = $admin->getLogo();
if ($GetLogo) {
    $result = $GetLogo->fetch_assoc();
    $img = 'images/' . $result['logo'];
}
$GetInfo = $admin->getNameInfo();
if ($GetInfo) {
    while ($res = $GetInfo->fetch_assoc()) {
        $storeName = $res['store_name'];

        $addressLine1 = $res['address_line1'];
        $addressLine2 = $res['address_line2'];
        $mobile = $res['mobile'];
    }
}

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
//create pdf object
$pdf = new FPDF('P', 'mm', 'A4');

//add new page
$pdf->AddPage();

//Image( file name , x position , y position , width [optional] , height [optional] )
$pdf->Cell(110, 5, '', 0, 0);
$pdf->Image($img, 10, 10, 50, 24);

//$pdf->Cell(190 ,5,'',0,1,'R');
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(0, 128, 0);
$pdf->Cell(110, 5, $storeName, 0, 1, 'J');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(182, 6,$addressLine1, 0, 1, 'R');
$pdf->Cell(182, 4,$addressLine2, 0, 1, 'R');
$pdf->Cell(182, 4,$mobile, 0, 1, 'R');
//$pdf->Cell(170, 3, 'Middle Badda, Dhaka-1212.', 0, 1, 'R');
//$pdf->Cell(168, 3, 'Phone: +88 01841 000 779', 0, 1, 'R');
//$pdf->Cell(175, 3, 'eMail: support@bntechbd.com', 0, 1, 'R');
//$pdf->Cell(166, 3, 'Facebook: FB/bntechbd', 0, 1, 'R');
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 4, '', 0, 1, 'C'); //end of line
$pdf->Cell(189, 8, '', 0, 1, 'C'); //end of line
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'INVOCE', 0, 1, 'C'); //end of line
//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 10);

// $pdf->Cell(130 ,5,'Customer"s Name :',0,0);

$pdf->Cell(59, 5, '', 0, 1); //end of line
$pdf->Cell(59, 5, '', 0, 1); //end of line

$pdf->Cell(130, 5, 'Customer Name : ' . $cusName, 0, 0);
$pdf->Cell(59, 5, 'Invoice No : ' . $invoice_number, 0, 1);
$pdf->Cell(130, 5, 'Phone : ' . $cusMobile, 0, 0);
$pdf->Cell(25, 5, 'Invoice Date : ' . $date, 0, 1);

//$pdf->Cell(130, 5, 'Phone Number :', 0, 0);
//$pdf->Cell(25, 5, 'Challan No. :', 0, 0);
//$pdf->Cell(34, 5, '[1234567]', 0, 1); //end of line
//
//$pdf->Cell(130, 5, 'Sales Order No :', 0, 0);
//$pdf->Cell(25, 5, 'Sold By :', 0, 0);
//$pdf->Cell(34, 5, '[1234567]', 0, 1); //end of line
//make a dummy empty cell as a vertical spacer
$pdf->Cell(100, 2, '', 0, 1, 'C'); //end of line
//invoice contents
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(10, 5, 'SL', 1, 0);
$pdf->Cell(100, 5, 'Description', 1, 0, 'C');
$pdf->Cell(25, 5, 'Quantity', 1, 0, 'C');
$pdf->Cell(25, 5, 'Unit Price', 1, 0, 'C');
$pdf->Cell(25, 5, 'Amount', 1, 1); //end of line

$pdf->SetFont('Arial', '', 11);

if ($getProductInv) {
    $i = 0;
    $subTot = 0;
    while ($row = $getProductInv ->fetch_assoc()) {
        $i++;
        $proName = $medicine->getOneCol('medicine_name', 'medicine', 'id', $row['medicine']);
        $medicine_strength = $medicine->getOneCol('medicine_strength', 'medicine', 'id', $row['medicine']);
        $medicine_form = $medicine->getOneCol('medicine_form', 'medicine', 'id', $row['medicine']);
        $qty = $row['qty'];
        $unit_price = $row['unit_price'];
        $sub_total = $row['sub_total'];
        
        $pdf->Cell(10, 5, $i, 1, 0);
        $pdf->Cell(100, 5, $proName.' '.$medicine_strength.' '.$medicine_form, 1, 0, 'C');
        $pdf->Cell(25, 5, $qty, 1, 0, 'C');
        $pdf->Cell(25, 5, $unit_price, 1, 0, 'C');
        $pdf->Cell(25, 5, $sTot = $sub_total, 1, 1, 'C'); //end of line
        
        
        $subTot = $subTot + $sTot;
    }
}



//summary
$pdf->Cell(120, 5, $totConvert, 0, 0);
$pdf->Cell(50, 5, 'Sub Total', 1, 0);
// $pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(15, 5, $subTot, 1, 1,'C'); //end of line

$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Discount (%)', 1, 0);
// $pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(15, 5, $discount, 1, 1,'C'); //end of line
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Less', 1, 0);
// $pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(15, 5, $less, 1, 1,'C'); //end of line

$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Invoice Total', 1, 0);
// $pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(15, 5, $total, 1, 1, 'R'); //end of line
// $pdf->Cell(120 ,5,'Seven Thousand Five Hundred Taka only',0,1);
$pdf->Cell(70, 20, '', 0, 1);
$pdf->Cell(70, -25, '', 1, 1);
$pdf->Cell(40, 5, 'Previous Due', 0, 0);
$pdf->Cell(30, 5, $preDue, 0, 1, 'R');
$pdf->Cell(40, 5, 'Invoice Amount', 0, 0);
$pdf->Cell(30, 5, $total, 0, 1, 'R');
$pdf->Cell(40, 5, 'Paid', 0, 0);
$pdf->Cell(30, 5, $paid, 0, 1, 'R');
$pdf->Cell(40, 5, 'Return', 0, 0);
$pdf->Cell(30, 5, abs($changeAmount), 0, 1, 'R');
$pdf->Cell(40, 5, 'Total Due', 0, 0);
$pdf->Cell(30, 5, $dues, 0, 1, 'R');

$pdf->SetFont('times', '', 13);
$pdf->Cell(110, 10, '', 0, 0);
$pdf->Cell(75, 10, '', 0, 1); //end of line
$pdf->Cell(110, 5, '________________', 0, 0);
$pdf->Cell(75, 5, '__________________', 0, 1, 'R'); //end of line
$pdf->SetFont('times', '', 13);
$pdf->Cell(110, 5, 'Customer Signature', 0, 0);
$pdf->Cell(75, 5, 'Authorized Signature', 0, 1, 'R'); //end of line

$pdf->SetFont('times', '', 10);
$pdf->Cell(40, 19, 'NOTE', 0, 1);

$pdf->SetFont('times', '', 9);
$pdf->Cell(100, 0, '', 0, 1);
$pdf->Cell(100, 0, '1. All cheques and payments should be made on ' . $storeName, 0, 1);
$pdf->Cell(100, 10, '2. Warrenty will be void in case of damage coused by mechanical, Electrical, or other accidental or', 0, 1);
$pdf->Cell(100, 0, 'intended
 damages caused by customer use or due to wind, rain, fire or other acts of nature. (If any)', 0, 1);
$pdf->Cell(100, 9, '3. Goods once sold will not be taken back.', 0, 1);


$pdf->output();

function convert_number($number) {
    $my_number = $number;
    if (($number < 0) || ($number > 999999999)) {
        throw new Exception("Number is out of range");
    }
    $Kt = floor($number / 10000000); /* Koti */
    $number -= $Kt * 10000000;
    $Gn = floor($number / 100000);  /* lakh  */
    $number -= $Gn * 100000;
    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = $number % 10;               /* Ones */
    $res = "";
    if ($Kt) {
        $res .= convert_number($Kt) . " Koti ";
    }
    if ($Gn) {
        $res .= convert_number($Gn) . " Lakh";
    }
    if ($kn) {
        $res .= (empty($res) ? "" : " ") .
                convert_number($kn) . " Thousand";
    }
    if ($Hn) {
        $res .= (empty($res) ? "" : " ") .
                convert_number($Hn) . " Hundred";
    }
    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
        "Seventy", "Eigthy", "Ninety");
    if ($Dn || $n) {
        if (!empty($res)) {
            $res .= " and ";
        }
        if ($Dn < 2) {
            $res .= $ones[$Dn * 10 + $n];
        } else {
            $res .= $tens[$Dn];
            if ($n) {
                $res .= "-" . $ones[$n];
            }
        }
    }
    if (empty($res)) {
        $res = "zero";
    }
    return $res;
}
?>

