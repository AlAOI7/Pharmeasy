<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);


if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));

    $getSaleReport = $report->getLossReport($from, $to);
} else {
    $getSaleReport = $report->getLossRep();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Loss Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">loss report</li>
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
                        <h5 class="card-title">All Loss Report</h5>
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
                                        <th style="width:20px;">Invoice</th>
                                        <th style="width:20px;">Purchase Price</th>
                                        <th style="width:20px;">Sale Price</th>
                                        <th style="width:20px;">Loss</th>
                                        <th style="width:20px;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getSaleReport) {
                                        $i = 0;
                                        $totalNet = 0;
                                        $totalAmount = 0;
                                        $totalProfit = 0;
                                        while ($result = $getSaleReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <a target="_blank" href="cusrinv.php?invid=<?php echo $result['id']; ?>"><?php echo $result['invoice_number']; ?></a>
                                                </td>
                                                <td>
                                                    <?php echo $tnet = $result['totalNetAmount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $tamt = $result['total_amount']; ?>
                                                </td>

                                                <td><?php echo $profit = $tamt - $tnet; ?></td>
                                                <td>
                                                    <?php echo $fm->formatDate($result['sale_date']); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $totalNet = $totalNet + $tnet;
                                            $totalAmount = $totalAmount + $tamt;
                                            $totalProfit = $totalProfit + $profit;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th colspan="2">Total</th>
                                <th>
                                    <?php
                                    if (isset($totalNet)) {
                                        echo $totalNet;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($totalAmount)) {
                                        echo $totalAmount;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($totalProfit)) {
                                        echo $totalProfit;
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





