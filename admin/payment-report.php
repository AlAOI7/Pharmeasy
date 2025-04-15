<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getPayReport = $report->getAllPaymentReportDate($from, $to);
} else {
    $getPayReport = $report->getAllPaymentReport();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Payment Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">payment report</li>
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
                        <h5 class="card-title">All Payment Report</h5>
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
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Receipt</th>
                                        <th style="width:20px;">Supplier</th>
                                        <th style="width:20px;">Previous Due</th>
                                        <th style="width:20px;">Payment</th>
                                        <th style="width:20px;">Current Due</th>
                                        <th style="width:20px;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getPayReport) {
                                        $i = 0;
                                        $PreDue = 0;
                                        $Payment = 0;
                                        $CurrentDue = 0;
                                        while ($result = $getPayReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['payment_receipt']; ?></td>
                                                <td>
                                                    <?php
                                                    $supName = $medicine->getOneCol('company_name', 'company', 'id', $result['supplierId']);
                                                    echo $supName;
                                                    ?>
                                                </td>
                                                <td><?php echo $pd = $result['previous_due']; ?></td>
                                                <td><?php echo $pay = $result['payment']; ?></td>
                                                <td><?php echo $cdue = $result['current_due']; ?></td>
                                                <td><?php echo $fm->formatDate($result['paymentDate']); ?></td>
                                            </tr>
                                            <?php
                                            $PreDue = $PreDue + $pd;
                                            $Payment = $Payment + $pay;
                                            $CurrentDue = $CurrentDue + $cdue;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th>
                                    <?php
                                    if (isset($PreDue)) {
                                        echo $PreDue;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($Payment)) {
                                        echo $Payment;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($CurrentDue)) {
                                        echo $CurrentDue;
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
