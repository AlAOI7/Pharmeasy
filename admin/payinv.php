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
if (!isset($_GET['payid']) || $_GET['payid'] == NULL) {
    echo "<script>window.location = 'manage-payment.php';</script>";
} else {

    $payid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['payid']);
}
$getSinglePay = $medicine->getAllSinglePayment($payid);
$singlePayInfo = mysqli_fetch_assoc($getSinglePay);

$supName = $medicine->getOneCol('name', 'supplier', 'id', $singlePayInfo['supplierId']);
$receipt_no = $singlePayInfo['payment_receipt'];
$date = $fm->formatDate($singlePayInfo['paymentDate']);
$total = $singlePayInfo['payment'];
$due = $singlePayInfo['current_due'];

 try {
        $totConvert = convert_number($total) . " " . "Taka only";
      } catch (Exception $e) {
          echo $e->getMessage();
  }
$GetLogo = $admin->getLogo();
    if ($GetLogo) {
        $result = $GetLogo->fetch_assoc();
        $img = 'images/'.$result['logo'];
  }
$GetInfo = $admin->getNameInfo();
     if ($GetInfo) {
        while ($res = $GetInfo->fetch_assoc()) {
            $storeName = $res['store_name'];
            $storeDes = html_entity_decode($res['store_description']);
     }
  }


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
$pdf = new FPDF('P','mm',array(170,180));

//add new page
$pdf->AddPage();

//Image( file name , x position , y position , width [optional] , height [optional] )
$pdf->Cell(80 ,5,'',0,0);
$pdf->Image( $img,10,10,30,19);

//$pdf->Cell(190 ,5,'',0,1,'R');
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(0,128,0);
$pdf->Cell(160 ,5,$storeName,0,1,'J');
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(160,6,'Ta-98/C, (Gulshan-Badda Link Raod),Middle Badda, Dhaka-1212.',0,1,'R');
// $pdf->Cell(170,3,'Middle Badda, Dhaka-1212.',0,1,'R');
$pdf->Cell(160,3,'',0,1,'R');
// $pdf->Cell(175,3,'Email: support@bntechbd.com',0,1,'R');
$pdf->Cell(160,3,'',0,1,'R');

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,4,'',0,1,'C');//end of line
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,3,'MONEY RECEIPT',0,1,'C');//end of line



//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',10);

// $pdf->Cell(130 ,5,'Customer"s Name :',0,0);

$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(100 ,5,'Date: '.$date,0,0);
$pdf->Cell(59 ,5,'Receipt No: '.$receipt_no,0,1);
$pdf->Cell(130 ,5,'Name: '.$supName,0,1);
// $pdf->Cell(25 ,5,'Invoice Date :',0,1);

$pdf->Cell(130 ,5,'The Sum of (In Word): '.$totConvert,0,1);
// $pdf->Cell(25 ,5,'Challan No. :',0,0);
// $pdf->Cell(34 ,5,'[1234567]',0,1);//end of line

$pdf->Cell(130 ,5,'Amount Paid by:  [ ] Cash',0,1);
$pdf->Cell(140 ,7,'                            [ ] Cheque No:                           Bank Name:                              Dated:',0,1);
$pdf->Cell(140 ,7,'                            [ ] Others No:                            Int. Authority:                              Dated:',0,1);



//make a dummy empty cell as a vertical spacer
$pdf->Cell(100,2,'',0,1,'C');//end of line


$pdf->Cell(70 ,10,'',0,1);
$pdf->Cell(70 ,-5,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'PAID',0,0);
$pdf->Cell(25,10,'= '.$total,1,1);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(25,5,'',0,1);
$pdf->Cell(20,10,'DUE',0,0);
$pdf->Cell(25,10,'= '.$due,1,1);


$pdf->SetFont('times','',13);
$pdf->Cell(110,10,'',0,0);
$pdf->Cell(75,10,'',0,1);//end of line
$pdf->Cell(70,5,'________________',0,0);
$pdf->Cell(75,5,'__________________',0,1,'R');//end of line
$pdf->SetFont('times','',13);
$pdf->Cell(70,5,'Supplier Signature',0,0);
$pdf->Cell(75,5,'Authorized Signature',0,1,'R');//end of line



$pdf->Cell(120 ,5,'',0,0);
//$pdf->Image('foot.png',9,118,160,12);

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

