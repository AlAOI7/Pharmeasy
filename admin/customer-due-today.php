<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
    if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
     $getCusInv = $report->getAllCustomerDueReportDatewise($from, $to);
} else {
    $getCusInv = $report->getAllCustomerDueReportToday();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">All Customer Due Report Today</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">customer due report</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Customer Due Report Today</h5>
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
                            <table id="buttonTab" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Invoice</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Amount</th>
                                        <th>Todays Dues</th>
                                        <th>Previous Dues</th>
                                        <th>Total Dues</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getCusInv) {
                                        $i = 0;
                                        $total = 0;
                                        $amount = 0;
                                        $tdues = 0;
                                        while ($result = $getCusInv->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a target="_blank" href="cusinv.php?invid=<?php echo $result['id']; ?>"><?php echo $result['invoice_number']; ?></a></td>
                                                <td>
                                                    <?php
                                                    $supName = $medicine->getOneCol('name', 'customer', 'id', $result['customer']);
                                                    echo $supName;
                                                    ?>
                                                </td>
                                                <td><?php echo $tot = $result['total_amount']; ?></td>
                                                <td><?php echo $totA = $result['amount']; ?></td>
                                                <td><?php echo $totD = $result['inv_due']; ?></td>
                                                <td><?php echo $result['previous_due']; ?></td>
                                                <td><?php echo $result['dues']; ?></td>
                                                <td><?php echo $fm->formatDate($result['sale_date']); ?></td>
                                            </tr>
                                            <?php
                                            $total = $total + $tot;
                                            $amount = $amount + $totA;
                                            $tdues = $tdues + $totD;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th><?php
                                    if (isset($total)) {
                                        echo $total;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                <th><?php
                                    if (isset($amount)) {
                                        echo $amount;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                <th><?php
                                    if (isset($tdues)) {
                                        echo $tdues;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                <th></th>
                                <th></th>
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






