<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getStk = $report->getAllMedicineExprieSoonStock();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Expire Soon Stock Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">expire soon stock</li>
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
                        <h5 class="card-title">All Expire Soon Stock</h5>
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
                                        <th style="width:20px;">Expire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getStk) {
                                        $i = 0;
                                        while ($result = $getStk->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php
                                                    $mediName = $medicine->getOneCol('medicine_name', 'medicine', 'id', $result['product']);
                                                    echo $mediName;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $genericId = $medicine->getOneCol('generic_id', 'medicine', 'id', $result['product']);
                                                    $genericName = $medicine->getOneCol('generic_name', 'generic', 'id', $genericId);
                                                    echo $genericName;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $mediForm = $medicine->getOneCol('medicine_form', 'medicine', 'id', $result['product']);
                                                    echo $mediForm;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $mediStrength = $medicine->getOneCol('medicine_strength', 'medicine', 'id', $result['product']);
                                                    echo $mediStrength;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $stock = $medicine->getOneCol('stock', 'medicine', 'id', $result['product']);
                                                    echo $stock;
                                                    ?>
                                                </td>
                                                <td><?php echo $fm->formatDate($result['edate']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="3"></th>
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

