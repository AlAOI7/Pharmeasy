<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getStk = $report->getNonmovementMedicineList();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Non Movement Medicine</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Non Movement Medicine</li>
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
                        <h5 class="card-title">All Non Movement Medicine</h5>
                        <div class="box-tools pull-right" align="center">
                        </div><br>
                        <div class="table-responsive">
                            <table id="buttonTab" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Stock</th>
                                        <th style="width:20px;">Total Sale Price</th>
                                        <th style="width:20px;">Total Purchase Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getStk) {
                                        $i = 0;
                                        $stock = 0;
                                        $sprice = 0;
                                        $pprice = 0;
                                        while ($result = $getStk->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php echo $result['medicine_name']; ?>
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
                                                    <?php echo $sp = $stk * $result['sale_price']; ?>
                                                </td>
                                                <td><?php echo $pp = $stk * $result['purchases_price']; ?></td>
                                            </tr>
                                            <?php
                                            $stock = $stock + $stk;
                                            $sprice = $sprice + $sp;
                                            $pprice = $pprice + $pp;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="3">Total</th>
                                <th>
                                    <?php
                                    if (isset($stock)) {
                                        echo $stock;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($sprice)) {
                                        echo $sprice;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($pprice)) {
                                        echo $pprice;
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



