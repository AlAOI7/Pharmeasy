<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getPurReport = $report->getAllExpenseReportDate($from, $to);
    $getPurReport2 = $report->getPaymentReportDate($from, $to);
    $getPurReport3 = $report->getSalesReturnDate($from, $to);
} else {
    $getPurReport = $report->getAllExpenseReport();
    $getPurReport2 = $report->getTodPaymentReport();
    $getPurReport3 = $report->getTodSalesReturnReport();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">All Expense Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">all expense report</li>
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
                        <h5 class="card-title">All Expense Report</h5>
                        <div class="box-tools pull-right" align="center">
                            <form class="form-horizontal" method = "post" action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">From</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose" name="from" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">To</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose1" name="to" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
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
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Date</th>
                                        <th style="width:20px;">Others Expense</th>
                                        <th style="width:20px;">Amount</th>
                                        <th style="width:20px;">Purpose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getPurReport) {
                                        $i = 0;
                                        $Tamnt = 0;
                                        while ($result = $getPurReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $fm->formatDate($result['expense_date']); ?></td>
                                                <td>
                                                    <?php
                                                    $expense_head_name = $medicine->getOneCol('expense_head_name', 'expense_head', 'id', $result['expense_head']);
                                                    echo $expense_head_name;
                                                    ?>
                                                </td>
                                                <td><?php echo $ta = $result['expense_amount']; ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                            </tr>
                                            <?php
                                            $Tamnt = $Tamnt + $ta;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th>
                                    <?php
                                    if (isset($Tamnt)) {
                                        echo $Tamnt;
                                    }
                                    ?>
                                </th>
                                <th></th>
                                </tfoot>
                            </table>
                            <table id="zero_config2" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Date</th>
                                        <th style="width:20px;">Supplier Name</th>
                                        <th style="width:20px;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getPurReport2) {
                                        $i = 0;
                                        $Tp = 0;
                                        while ($result2 = $getPurReport2->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $fm->formatDate($result2['paymentDate']); ?></td>
                                                <td>
                                                    <?php
                                                    $supplier_name = $medicine->getOneCol('company_name', 'company', 'id', $result2['supplierId']);
                                                    echo $supplier_name;
                                                    ?>
                                                </td>
                                                <td><?php echo $tp = $result2['payment']; ?></td>
                                            </tr>
                                            <?php
                                            $Tp = $Tp + $tp;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th>
                                    <?php
                                    if (isset($Tp)) {
                                        echo $Tp;
                                    }
                                    ?>
                                </th>
                                </tfoot>
                            </table>
                            <table id="zero_config3" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Date</th>
                                        <th style="width:20px;">Invoice (Sales Return)</th>
                                        <th style="width:20px;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getPurReport3) {
                                        $i = 0;
                                        $Tsr = 0;
                                        while ($result3 = $getPurReport3->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $fm->formatDate($result3['sale_date']); ?></td>
                                                <td><?php echo $result3['invoice_number']; ?></td>
                                                <td><?php echo $tsr = $result3['amount']; ?></td>
                                            </tr>
                                            <?php
                                            $Tsr = $Tsr + $tsr;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th>
                                    <?php
                                    if (isset($Tsr)) {
                                        echo $Tsr;
                                    }
                                    ?>
                                </th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">
                            Total:
                            <?php 
                            if(isset($Tamnt) || isset($Tp) || isset($Tsr)){
                                $totExp = $Tamnt + $Tp + $Tsr; 
								echo $totExp;
                            }
                            
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php'; ?>







