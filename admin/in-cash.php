<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));

    $getInfo4 = $report->getCashHistory($from, $to);
}
$getOb = $report->getOpToday();
if($getOb != FALSE){
$row = mysqli_fetch_assoc($getOb);
$opening_balance = $row['incash'];
}
if (isset($_POST['save'])) {
    $date = date('Y-m-d');
    $opening = $_POST['opening'];
    $inc = $_POST['inc'];
    $exp = $_POST['exp'];
    $less = $_POST['less'];
    $access = $_POST['access'];
    $incash = $_POST['incash'];
    $remarks = $_POST['remarks'];
    $saveCashHistory = $report->insertCashHistory($date, $opening, $inc, $exp,$less,$access, $incash, $remarks);
}

//$getInfo = $report->getIncToday();
//$incTdy = 0;
//while ($num1 = mysqli_fetch_assoc($getInfo)) {
//    $incTdy = $num1['amt'];
//}
$getSalesInfo = $report->getSalesToday();
$incTdy = 0;
while ($num1 = mysqli_fetch_assoc($getSalesInfo)) {
    $cashPaid = $num1['amount'];
    $change = $num1['changeAmount'];
    $totSales = $cashPaid + $change;
    $incTdy += $totSales;
}

$getIncomeInfo = $report->getIncomeToday();
$incIncomeTdy = 0;
while ($num11 = mysqli_fetch_assoc($getIncomeInfo)) {
    $income_amount = $num11['income_amount'];
    $incIncomeTdy += $income_amount;
}

//$getIncomeInfo = $report->getIncomeToday();
//$incIncomeTdy = 0;
//while ($num11 = mysqli_fetch_assoc($getIncomeInfo)) {
//    $income_amount = $num11['income_amount'];
//    $incIncomeTdy += $income_amount;
//}

$getCollecInfo = $report->getCollectionToday();
$colIncomeTdy = 0;
if($getCollecInfo != FALSE){
while ($num112 = mysqli_fetch_assoc($getCollecInfo)) {
    $col_amount = $num112['collection'];
    $colIncomeTdy += $col_amount;
}
}
$getPaymentInfo = $report->getPaymentToday();
$expPayTdy = 0;
while ($num22 = mysqli_fetch_assoc($getPaymentInfo)) {
    $expPayTdy += $num22['payment'];
}

$getInfo2 = $report->getExpToday();
$expTdy = 0;
while ($num2 = mysqli_fetch_assoc($getInfo2)) {
    $expTdy += $num2['examt'];
}

$getInfo3 = $report->getOverheadToday();
$ohTdy = 0;
while ($num3 = mysqli_fetch_assoc($getInfo3)) {
    $ohTdy += $num3['ohamt'];
}

$getInfoSR = $report->getSalesReturnToday();
$srTdy = 0;
while ($numsr3 = mysqli_fetch_assoc($getInfoSR)) {
    $srTdy += $numsr3['sramt'];
}

$totalExp = $expTdy + $ohTdy + $expPayTdy + $srTdy;
if(isset($opening_balance) == 0 || isset($opening_balance) != 0){
$inCash = ($opening_balance + $incTdy + $incIncomeTdy + $colIncomeTdy) - ($expTdy + $ohTdy + $expPayTdy + $srTdy);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">In Cash Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">in cash report</li>
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
                        <h5 class="card-title">All In Cash Report</h5>
                        <?php
                        if (isset($saveCashHistory)) {
                            echo $saveCashHistory;
                        }
                        ?>
                        <div class="box-tools pull-right" align="center">
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
                            <form class="form-horizontal" method="post" action="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Opening Balance</label>
                                            <input type="text" class="form-control" name="opening" value="<?php if(isset($opening_balance)){echo $opening_balance;} ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Total Sales with collection</label>
                                            <input type="text" class="form-control" name="inc" value="<?php echo $incTdy + $colIncomeTdy; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Total Expense</label>
                                            <input type="text" class="form-control" name="exp" value="<?php echo $totalExp; ?>" readonly="">
                                        </div>
                                    </div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Less(-)</label>
                                            <input type="number" step="any" class="form-control" name="less" value="" autocomplete="">
                                        </div>
                                    </div>
									<div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Access(+)</label>
                                            <input type="number" step="any" class="form-control" name="access" value="" autocomplete="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Total In Cash</label>
                                            <input type="text" class="form-control" name="incash" value="<?php if(isset($inCash)){echo $inCash;} ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" class="form-control" name="remarks" placeholder="remarks" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name ="save" style="width: 120px;" class="btn btn-success">Submit</button>
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
                                        <th style="width:20px;">Opening Balance</th>
                                        <th style="width:20px;">Total Sales</th>
                                        <th style="width:20px;">Total Expense</th>
                                        <th style="width:20px;">Less</th>
                                        <th style="width:20px;">Access</th>
                                        <th style="width:20px;">Total In Cash</th>
                                        <th style="width:20px;">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getInfo4 != FALSE) {
                                        $i = 0;
                                        $totalOb = 0;
                                        $totalInc = 0;
                                        $totalExp = 0;
                                        $totalIncash = 0;
                                        while ($result = mysqli_fetch_assoc($getInfo4)) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                                <td><?php echo $ob = $result['opening']; ?></td>
                                                <td><?php echo $inc = $result['inc']; ?></td>
                                                <td><?php echo $exp = $result['exp']; ?></td>
                                                <td><?php echo $result['less']; ?></td>
                                                <td><?php echo $result['access']; ?></td>
                                                <td><?php echo $icsh = $result['incash']; ?></td>
                                                <td><?php echo $result['remarks']; ?></td>
                                            </tr>
                                            <?php
                                            $totalOb = $totalOb + $ob;
                                            $totalInc = $totalInc + $inc;
                                            $totalExp = $totalExp + $exp;
                                            $totalIncash = $totalIncash + $icsh;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th>Total</th>
                                <th></th>
                                <th>
                                    <?php
                                    if (isset($totalOb)) {
                                        echo $totalOb;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($totalInc)) {
                                        echo $totalInc;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($totalExp)) {
                                        echo $totalExp;
                                    }
                                    ?>
                                </th>
								<th></th>
								<th></th>
                                <th>
                                    <?php
                                    if (isset($totalIncash)) {
                                        echo $totalIncash;
                                    }
                                    ?>
                                </th>
                                <th></th>
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





