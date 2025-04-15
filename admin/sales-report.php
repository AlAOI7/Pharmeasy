<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getSalesReport = $report->getAllSalesReportDate($from, $to);
} else {
    $getSalesReport = $report->getAllSalesReport();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Sales Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">sales report</li>
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
                        <h5 class="card-title">All Sales Report</h5>
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
                        </div><br>
                        <div class="table-responsive">
                            <table id="buttonTab" class="table table-striped table-bordered display tblReport small">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Invoice</th>
                                        <th style="width:20px;">Customer</th>
                                        <th style="width:20px;">Total (Cash + Due)</th>
                                        <th style="width:20px;">Received</th>
                                        <th style="width:20px;">Refund</th>
                                        <th style="width:20px;">Total Due</th>
                                        <th style="width:20px;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getSalesReport) {
                                        $i = 0;
                                        $Tamnt = 0;
                                        $Paid = 0;
                                        $Refund = 0;
                                        $Due = 0;
                                        while ($result = $getSalesReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a target="_blank" href="cusinv.php?invid=<?php echo $result['id']; ?>"><?php echo $result['invoice_number']; ?></a></td>
                                                <td>
                                                    <?php
                                                    $cusName = $medicine->getOneCol('name', 'customer', 'id', $result['customer']);
                                                    echo $cusName;
                                                    ?>
                                                </td>
                                                <td><?php echo $ta = $result['total_amount']; ?></td>
                                                <td><?php echo $pay = $result['amount']; ?></td>
                                                <td><?php echo $ref = abs($result['changeAmount']); ?></td>
                                                <td><?php echo $due = $result['dues']; ?></td>
                                                <td><?php echo $fm->formatDate($result['sale_date']); ?></td>
                                            </tr>
                                            <?php
                                            $Tamnt = $Tamnt + $ta;
                                            $Paid = $Paid + $pay;
                                            $Refund = $Refund + $ref;
                                            $Due = $Due + $due;
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
                                <th>
                                    <?php
                                    if (isset($Paid)) {
                                        echo $Paid;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($Refund)) {
                                        echo $Refund;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($Due)) {
                                        echo $Due;
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




