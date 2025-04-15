<?php
ob_start();
error_reporting(0);
//call the FPDF library
require('fpdf17/fpdf.php');
include 'core/Database.php';
include'core/Format.php';
include 'class/Adminlogin.php';
include 'class/Medicine.php';
$admin = new Adminlogin();
$medicine = new Medicine();
$fm = new Format();
if (!isset($_GET['collid']) || $_GET['collid'] == NULL) {
    echo "<script>window.location = 'manage-collection.php';</script>";
} else {

    $collid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['collid']);
}
$getSingleCollection = $medicine->getAllSingleCollection($collid);
$singleColInfo = mysqli_fetch_assoc($getSingleCollection);

$cusName = $medicine->getOneCol('name', 'customer', 'id', $singleColInfo['customerId']);
$receipt_no = $singleColInfo['collection_receipt'];
$date = $fm->formatDate($singleColInfo['collectionDate']);
$total = $singleColInfo['collection'];
$due = $singleColInfo['current_due'];
$previous_due = $singleColInfo['previous_due'];

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
        $storeDes = html_entity_decode($res['store_description']);
    }
}


$pdf = new FPDF('L', 'mm', array(175, 210));
$pdf->AddPage();
$pdf->SetLineWidth(1.0);
$pdf->SetDrawColor(0, 128, 0); // Border Color
$pdf->Rect(5, 5, 200, 165, 'D');

//Header

$pdf->SetFont('Arial', 'B', 23);
$pdf->Cell(45);

//$pdf->SetDrawColor(0, 0, 0); //Header underline color
$pdf->Image($img, 20, 7, 30);
$pdf->SetTextColor(0, 128, 0);
$pdf->Cell(100, 11, $storeName, 0, 1, 'C');
//$pdf->SetLineWidth(0.2);

//END Header
// Company Details Sector

$pdf->SetFont('arial', "", 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 1, "", 0, 1, "C");
$pdf->Cell(0, 6,'Mohammadpur, Dhaka', 0, 1, "C");
$pdf->Cell(0, 6, "", 0, 1, "C");
$pdf->Cell(0, 6, "", 0, 1, "C");
$pdf->Cell(0, 6, "", 0, 1, "C");
$pdf->Cell(0, 6, "", 0, 1, "C");

//END Company Details Sector

$pdf->SetFont('Arial', 'B', 23);
$pdf->Cell(45);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(100, 12, 'Cash Receipt', 0, 1, 'C');
$pdf->SetLineWidth(0.2);


$pdf->Cell(0, 1, "", 0, 1, "C");
$pdf->SetFont('Arial', "B", 13);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 1, "", 0, 1, "C");

// Cash Receipt and Date
$pdf->Cell(25, 5, 'Receipt #:', 0, 0, 'C', 0);
$pdf->SetFont('Times', "", 13);
$pdf->Cell(45, 5, $receipt_no, 0, 0, 'C', 0); // Cash Receipt Number
$pdf->SetFont('Arial', "B", 13);
$pdf->Cell(50, 5, ' ', 0, 0, 'L', 0);
$pdf->Cell(50, 5, 'Date :', 0, 0, 'C', 0);
$pdf->SetFont('Times', "", 13);
$pdf->Cell(1, 5, $date, 0, 1, 'C', 0); // Date 
//END Cash Receipt and Date

$pdf->Cell(0, 6, "", 0, 1, "C");
$pdf->SetFont('Arial', "B", 14);
$pdf->Cell(0, 5, 'Cash Received From : '.$cusName, 0, 1, 'L');
$pdf->Cell(0, 4, "", 0, 1, "C");
$pdf->SetFont('Arial', "", 12);
$pdf->Cell(0,5,$totConvert,0,1,'C');

// $pdf->Cell(0,10,'For',0,1,"L");
//Amount Table
$pdf->Cell(0, 4,'',0, 1, "C");
$pdf->SetFont('Arial', "", 13);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(80);
$pdf->Cell(50, 6, 'Amount Received', 1, 0, 'C', 0);
$pdf->Cell(60, 6, $total, 1, 1, 'C', 0);
$pdf->Cell(80);
$pdf->Cell(50, 6, 'Previous Due', 1, 0, 'C', 0);
$pdf->Cell(60, 6, $previous_due, 1, 1, 'C', 0);
$pdf->Cell(80);
$pdf->Cell(50, 6, 'Current Due', 1, 0, 'C', 0);
$pdf->Cell(60, 6, $due, 1, 1, 'C', 0);
// END Amount Table
// Payment Status

$pdf->SetFont('Arial', "B", 13);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(35, 6, 'Payment Received', 0, 1, 'C', 0);
$pdf->Cell(0, 2, "", 0, 1, "C");
$pdf->SetFont('Arial', "", 12);
$pdf->Cell(5, 6, 'Cash', 0, 0, 'C', 0);
$pdf->SetDrawColor(0, 0, 0); // Border Color
$pdf->Rect(30, 120, 10, 5, 'D');

$pdf->Cell(0, 7, "", 0, 1, "C");
$pdf->Cell(10, 6, 'Cheque', 0, 0, 'C', 0);
$pdf->SetDrawColor(0, 0, 0); // Border Color
$pdf->Rect(30, 127, 10, 5, 'D');

$pdf->Cell(0, 7, "", 0, 1, "C");
$pdf->Cell(7, 6, 'Other', 0, 0, 'C', 0);
$pdf->SetDrawColor(0, 0, 0); // Border Color
$pdf->Rect(30, 134, 10, 5, 'D');

// END Payment Status


$pdf->SetFont('arial', "B", 14);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 12, "", 0, 1, "C");
$pdf->Cell(140);
$pdf->Cell(0, 6, "       Authorized Signature        ", "T", 1, "C");


$pdf->Output();

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

ob_end_flush();
?>
