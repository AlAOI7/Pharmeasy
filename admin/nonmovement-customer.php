<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getCus = $report->getNonmovementCustomer();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Non Movement Customer List</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">customer</li>
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
                    <?php
                    if (isset($cusDel)) {
                        echo $cusDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Non Movement Customer List</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Location</th>
                                        <th>Dues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getCus) {
                                        $i = 0;
                                        $totalDue = 0;
                                        while ($result = $getCus->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a target="_blank" href="customer-ledger.php?clid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></td>
                                                <td><?php echo $result['mobile']; ?></td>
                                                <td><?php echo $result['location']; ?></td>
                                                <td><?php echo $totD = $result['balance']; ?></td>
                                            </tr>
                                            <?php
                                            $totalDue = $totalDue + $totD;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="3">Total</th>
                                <th><?php
                                    if (isset($totalDue)) {
                                        echo $totalDue;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>

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