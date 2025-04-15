<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if (isset($_POST['search_supplier'])) {
    $customer_name = $_POST['customer'];
    $getCusReport = $report->getCustomerByName($customer_name);
} else {
    $getCusReport = $report->getAllCustomerReport();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">All Customer Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">customer report</li>
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
                        <h5 class="card-title">All Customer Report</h5>
                        <div class="box-tools pull-right" align="center">
                            <form class="form-horizontal" method = "post" action="">
                                <div class="row">
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="uname">Customer Name</label>
                                            <input type="text" id="search-box-cus" name="customer" class="form-control" autocomplete="off" spellcheck="false" placeholder="Customer Name" required>
                                            <div id="suggesstion-box-cus"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name ="search_supplier" style="width: 120px;" class="btn btn-success">Search</button>
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
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Location</th>
                                        <th style="width:20px;">Mobile</th>
                                        <th style="width:20px;">Opening</th>
                                        <th style="width:20px;">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getCusReport) {
                                        $i = 0;
                                        $Op = 0;
                                        $Due = 0;
                                        while ($result = $getCusReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><?php echo $result['location']; ?></td>
                                                <td><?php echo $result['mobile']; ?></td>
                                                <td><?php echo $op = $result['opening']; ?></td>
                                                <td><?php echo $due = $result['balance']; ?></td>
                                            </tr>
                                            <?php
                                            $Op = $Op + $op;
                                            $Due = $Due + $due;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th></th>
                                <th>
                                    <?php
                                    if (isset($Op)) {
                                        echo $Op;
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






