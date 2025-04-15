<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);

if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));

    $totalSalesInc = $report->totalSalesIncome($from, $to);
    $salesTotal = 0;
    while ($num = mysqli_fetch_assoc($totalSalesInc)) {
        $salesTotal += $num['total_amount'];
    }

    $totalSalesInc = $report->getSalesReport($from, $to);
    $salesTotal = 0;
    while ($num = mysqli_fetch_assoc($totalSalesInc)) {
        $salesTotal += $num['total_amount'] - $num['totalNetAmount'];
    }

   $totalPurRet = $report->totalPurchaseReturn($from, $to);
    $purRetTotal = 0;
    while ($num1 = mysqli_fetch_assoc($totalPurRet)) {
        $purRetTotal += $num1['total_amount'];
    }

    $totalOtherInc = $report->totalOtherIncome($from, $to);
    $incomeTotal = 0;
    while ($num2 = mysqli_fetch_assoc($totalOtherInc)) {
        $incomeTotal += $num2['income_amount'];
    }

    $totalSalesRet = $report->totalSalesReturn($from, $to);
    $salesRetTotal = 0;
    while ($num3 = mysqli_fetch_assoc($totalSalesRet)) {
        $salesRetTotal += $num3['total_amount'];
    }

    $totalPurPro = $report->totalPurchasePro($from, $to);
    $purTotal = 0;
    while ($num4 = mysqli_fetch_assoc($totalPurPro)) {
        $purTotal += $num4['total_amount'];
    }

    $totalOtherExpense = $report->totalOtherExpense($from, $to);
    $expTotal = 0;
    while ($num5 = mysqli_fetch_assoc($totalOtherExpense)) {
        $expTotal += $num5['expense_amount'];
    }

    //Total Income
    $totalInc = $salesTotal + $incomeTotal;

    //Total Expense
    $totalExp = $salesRetTotal + $purTotal + $expTotal;
    $totalExp = $expTotal;

    //Net profit / Loss
    $net = $totalInc - $totalExp;
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Net Profit / Loss</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">net profit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body btn btn-lg btn-block btn-outline-info">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card badge-pill">
                    <div class="card-body badge badge-info badge-pill">
                        <h5 class="card-title text-center">Profit / Loss</h5>
                        <p class="text-center"><?php
                            if (isset($net)) {
                                echo $net;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card badge-pill">
                    <div class="card-body badge badge-success badge-pill">
                        <h5 class="card-title text-center">Total Income</h5>
                        <p class="text-center"><?php
                            if (isset($totalInc)) {
                                echo $totalInc;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card badge-pill">
                    <div class="card-body badge badge-pill badge-success">
                        <h5 class="card-title text-center">Total Sales Profit</h5>
                        <p class="text-center"><?php
                            if (isset($salesTotal)) {
                                echo $salesTotal;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card badge-pill">
                    <div class="card-body badge badge-danger badge-pill">
                        <h5 class="card-title text-center">Other Expense</h5>
                        <p class="text-center"><?php
                            if (isset($totalExp)) {
                                echo $totalExp;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card badge-pill">
                    <div class="card-body badge badge-pill badge-success">
                        <h5 class="card-title text-center">Total Income (Purchase Return)</h5>
                        <p class="text-center"><?php
                            if (isset($purRetTotal)) {
                                echo $purRetTotal;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card badge-pill">
                    <div class="card-body badge badge-pill badge-success">
                        <h5 class="card-title text-center">Other Income</h5>
                        <p class="text-center"><?php
                            if (isset($incomeTotal)) {
                                echo $incomeTotal;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card badge-pill">
                    <div class="card-body badge badge-pill badge-danger">
                        <h5 class="card-title text-center">Total Expense (Sales Return)</h5>
                        <p class="text-center"><?php
                            if (isset($salesRetTotal)) {
                                echo $salesRetTotal;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card badge-pill">
                    <div class="card-body badge badge-pill badge-danger">
                        <h5 class="card-title text-center">Total Expense (Product Purchase)</h5>
                        <p class="text-center"><?php
                            if (isset($purTotal)) {
                                echo $purTotal;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card badge-pill">
                    <div class="card-body badge badge-pill badge-danger">
                        <h5 class="card-title text-center">Other Expense</h5>
                        <p class="text-center"><?php
                            if (isset($expTotal)) {
                                echo $expTotal;
                            } else {
                                echo '0';
                            }
                            ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>