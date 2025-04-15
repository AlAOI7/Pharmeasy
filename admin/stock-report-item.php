<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getStk = $report->getItemwiseStockAlertReport();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Stock Report (Itemwise)</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">expire stock</li>
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
                        <h5 class="card-title">All Itemwise Stock Alert</h5>
                        <div class="box-tools pull-right" align="center">
                        </div><br>
                        <div class="table-responsive">
                            <table id="buttonTab" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Generic</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Stock</th>
                                        <th style="width:20px;">Company</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getStk) {
                                        $i = 0;
                                        $stkTot = 0;
                                        while ($result = $getStk->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php echo $result['medicine_name']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $genericName = $medicine->getOneCol('generic_name', 'generic', 'id', $result['generic_id']);
                                                    echo $genericName;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['medicine_form']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['medicine_strength']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $stk = $result['stock']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $company = $medicine->getOneCol('company_name', 'company', 'id', $result['company_id']);
                                                    echo $company;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $stkTot = $stkTot + $stk;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <?php
                                    if (isset($stkTot)) {
                                        echo $stkTot;
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

