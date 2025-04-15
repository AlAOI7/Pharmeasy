<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getStk = $report->getCurrentStock();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Current Stock Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">current stock</li>
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
                        <h5 class="card-title">All Current Stock</h5>
                        <div class="box-tools pull-right" align="center">
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Company</th>
                                        <th style="width:20px;">Stock</th>
                                        <th style="width:20px;">Total Sale Price</th>
                                        <th style="width:20px;">Total Purchase Price</th>
                                        <th style="width:20px;">Action</th>
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
                                                    <?php 
                                                    $company_name = $medicine->getOneCol('company_name', 'company', 'id', $result['company_id']);
                                                    echo $company_name;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $stk = $result['stock']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $sp = $stk * $result['sale_price']; ?>
                                                </td>
                                                <td><?php echo $pp = $stk * $result['purchases_price']; ?></td>
                                                <td><a target="_blank" href="edit-medicine.php?medicine_id=<?php echo $result['id']; ?>"><span class="label label-info"><i class="far fa-edit"></i></span></a></td>
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
                                <th colspan="4">Total</th>
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



