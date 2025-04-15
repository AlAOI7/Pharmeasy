<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['invid']) || $_GET['invid'] == NULL) {
    echo "<script>window.location = 'manage-purchase-return.php';</script>";
} else {

    $invid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['invid']);
}

$GetInfo = $admin->getNameInfo();
$getPharmacyInfo = mysqli_fetch_assoc($GetInfo);

$storeName = $getPharmacyInfo['store_name'];
$storeDes = html_entity_decode($getPharmacyInfo['store_description']);


$supInvoiceInfo = $medicine->select_supplier_return_invoice_info($invid);
$getSupInv = mysqli_fetch_assoc($supInvoiceInfo);

$supInv = $getSupInv['invoice_number'];
$invDate = $getSupInv['purchase_date'];
$invTotal = $getSupInv['total_amount'];
$invAmount = $getSupInv['amount'];
$previous_due = $getSupInv['previous_due'];
$dues = $getSupInv['dues'];

$supName = $medicine->getOneCol('name', 'supplier', 'id', $getSupInv['supplier']);
$supComName = $medicine->getOneCol('company', 'supplier', 'id', $getSupInv['supplier']);
$supMob = $medicine->getOneCol('mobile', 'supplier', 'id', $getSupInv['supplier']);
$supAdd = $medicine->getOneCol('address', 'supplier', 'id', $getSupInv['supplier']);
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Invoice</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Supplier Invoice</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body" id="printableArea">
                    <h3><b>INVOICE&nbsp;&nbsp;&nbsp;</b> <span class="pull-right">#<?php echo $supInv; ?></span></h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <h3> &nbsp;<b class="text-danger"><?php echo $storeName; ?></b></h3>
                                        <p class="text-muted m-l-5"><?php echo $storeDes; ?></p>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <address>
                                        <h3>To,</h3>
                                        <h4 class="font-bold"><b class="text-info"><?php echo $supName; ?></b></h4>
                                        <p class="text-muted m-l-30"><?php echo $supComName; ?>,
                                            <br/>Address:&nbsp; <?php echo $supAdd; ?>
                                            <br/>Mobile:&nbsp; <?php echo $supMob; ?>
                                        <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> <?php echo $fm->formatDate($invDate); ?></p>
                                    </address>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive m-t-40" style="clear: both;">
                                <table class="table table-hover supinv">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Medicine/Product</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Unit Price</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $GetPurInfo = $medicine->getPurchaseReturnInfo($invid);
                                        if ($GetPurInfo) {
                                            $i = 0;
                                            while ($result = $GetPurInfo->fetch_assoc()) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td>
                                                        <?php
                                                        $mediName = $medicine->getOneCol('medicine_name', 'medicine', 'id', $result['medicine']);
                                                        $mediForm = $medicine->getOneCol('medicine_form', 'medicine', 'id', $result['medicine']);
                                                        $mediStrength = $medicine->getOneCol('medicine_strength', 'medicine', 'id', $result['medicine']);
                                                        echo $mediName . '<sup>' . $mediStrength . '</sup> (' . $mediForm . ')';
                                                        ?>
                                                    </td>
                                                    <td class="text-right"><?php echo $result['qty']; ?></td>
                                                    <td class="text-right"><?php echo $result['purchase_price']; ?></td>
                                                    <td class="text-right"> <?php echo $result['sub_total']; ?></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
<!--                                        <p>Sub - Total amount: $13,848</p>
                                <p>vat (10%) : $138 </p>-->
                                <hr>
                                <h3><b>Total :</b><?php echo $invTotal; ?></h3>
                                <h4><b>Cash Received :</b><?php echo $invAmount; ?></h4>
                                <h4><b>Invoice Due :</b><?php echo $invTotal - $invAmount; ?></h4>
                                <h4><b>Previous Due :</b><?php echo $previous_due; ?></h4>
                                <hr>
                                <h4><b>Total Due :</b><?php echo $dues; ?></h4>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="text-right">
                                <button class="btn btn-danger" id ="printbtn" type="submit" onclick="printDiv('printableArea')"> Print </button>
                                <button class="btn btn-primary" id ="closeButton" onclick="window.close();">Close Page</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center">
        All Rights Reserved. Designed and Developed by <a target="_blank" href="http://softwaresolutioncompany.com/">Universal It</a>.
    </footer>
</div>

<?php include 'footer.php'; ?>

