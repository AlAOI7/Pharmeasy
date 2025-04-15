<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));

    $getInfo4 = $report->getNetcapital($from, $to);
}
$getPurInfo = $report->getTotalPurchase();
$pur = 0;

while ($num1 = mysqli_fetch_assoc($getPurInfo)) {
    $purchases_price = $num1['stock'] * $num1['purchases_price'];
    $pur += $purchases_price;
}

$getDuesInfo = $report->getTotalCustomerDues();
$dues = 0;
while ($num11 = mysqli_fetch_assoc($getDuesInfo)) {
    $dues += $num11['balance'];
}

$getCash = $report->getTotalDues();
$cash = 0;
$cashPaid = 0;
$change = 0;
while ($num121 = mysqli_fetch_assoc($getCash)) {
    $cashPaid = $num121['amount'];
    $change = $num121['changeAmount'];
    $totSales = $cashPaid + $change;
    $cash += $totSales;
}
$getCol = $report->getTotalCollection();
$collec = 0;

while ($num121 = mysqli_fetch_assoc($getCol)) {

    $collec += $num121['collection'];
}

$getSupDuesInfo = $report->getTotalSupplierDues();
$supDues = 0;
while ($num1113 = mysqli_fetch_assoc($getSupDuesInfo)) {
    $supDues += $num1113['balance'];
}

$getExpInfo = $report->getTotalExpense();
$exp = 0;
while ($num1114 = mysqli_fetch_assoc($getExpInfo)) {
    $exp += $num1114['expense_amount'];
}

$getOp = $report->getOP();
$num1115 = mysqli_fetch_assoc($getOp);
$opb = $num1115['incash'];

if (isset($_POST['save'])) {

    $saveCashHistory = $report->saveNetCapital($_POST);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Net capital Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">net capital report</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Net Capital Report</h5>
                        <?php
                        if (isset($saveCashHistory)) {
                            echo $saveCashHistory;
                        }
                        if ($_SESSION['message']) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        ?>
                        <div class="box-tools pull-right" align="center">

                            <form class="form-horizontal" method="post" action="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Total Purchase</label>
                                            <input type="text" class="form-control" name="total_purchase" value="<?php echo $pur; ?>" readonly=""> 
                                        </div>
                                    </div>
                                    <br><label style="margin-top:34px;">+</label>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Total Due</label>
                                            <input type="text" class="form-control" name="total_due" value="<?php echo $dues; ?>" readonly="">
                                        </div>
                                    </div>
                                    <br><label style="margin-top:34px;">+</label>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Opening Balance</label>
                                            <input type="text" class="form-control" name="opening_balance" value="<?php echo $opb; ?>" readonly="">
                                        </div>
                                    </div>
                                    <br><label style="margin-top:34px;">=</label>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Total</label>
                                            <input type="text" class="form-control" name="total" value="<?php echo ($pur + $dues + $opb); ?>" readonly="">
                                        </div>
                                    </div>
                                    <br><label style="margin-top:34px;">-</label>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Total Supplier Dues</label>
                                            <input type="text" class="form-control" name="total_supplier_due" value="<?php echo $supDues; ?>" readonly="">
                                        </div>
                                    </div>
                                    <br><label style="margin-top:34px;">=</label>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Net Capital</label>
                                            <input type="text" class="form-control" name="net_capital" value="<?php echo ($pur + $dues + $opb) - $supDues; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name ="save" style="width: 120px;" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal" method = "post" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">From</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose" name="from" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">To</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose1" name="to" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name ="search" style="width: 120px;" class="btn btn-success">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                        <div class="table-responsive">

                            <table id="buttonTab" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">Sl</th>
                                        <th style="width:20px;">Date</th>
                                        <th style="width:20px;">Total Purchase</th>
                                        <th style="width:20px;">Total Due</th>
                                        <th style="width:20px;">Opening Balance</th>
                                        <th style="width:20px;">Total</th>
                                        <th style="width:20px;">Total Supplier Dues</th>
                                        <th style="width:20px;">Net Capital</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getInfo4) {
                                        $i = 0;
                                        while ($result = mysqli_fetch_assoc($getInfo4)) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                                <td><?php echo $ob = $result['total_purchase']; ?></td>
                                                <td><?php echo $inc = $result['total_due']; ?></td>
                                                <td><?php echo $exp = $result['opening_balance']; ?></td>
                                                <td><?php echo $result['total']; ?></td>
                                                <td><?php echo $result['total_supplier_due']; ?></td>
                                                <td><?php echo $icsh = $result['net_capital']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>







