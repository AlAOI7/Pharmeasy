<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getColReport = $report->getAllCollectionReportDate($from, $to);
} else {
    $getColReport = $report->getAllCollectionReport();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Collection Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">collecton report</li>
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
                        <h5 class="card-title">All Collection Report</h5>
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
                                        <th style="width:20px;">Customer</th>
                                        <th style="width:20px;">Previous Due</th>
                                        <th style="width:20px;">Collection</th>
                                        <th style="width:20px;">Current Due</th>
                                        <th style="width:20px;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getColReport) {
                                        $i = 0;
                                        $PreDue = 0;
                                        $Collection = 0;
                                        $CurrentDue = 0;
                                        while ($result = $getColReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['collection_receipt']; ?></td>
                                                <td>
                                                    <?php
                                                    $supName = $medicine->getOneCol('name', 'customer', 'id', $result['customerId']);
                                                    echo $supName;
                                                    ?>
                                                </td>
                                                <td><?php echo $pd = $result['previous_due']; ?></td>
                                                <td><?php echo $col = $result['collection']; ?></td>
                                                <td><?php echo $cdue = $result['current_due']; ?></td>
                                                <td><?php echo $fm->formatDate($result['collectionDate']); ?></td>
                                            </tr>
                                            <?php
                                            $PreDue = $PreDue + $pd;
                                            $Collection = $Collection + $col;
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
                                    if (isset($Collection)) {
                                        echo $Collection;
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


