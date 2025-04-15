<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['delid'];
    $proID = $_POST['proID'];
    $rmStk = $_POST['rmStk'];
    $eProDel = $medicine->deleteExpireStk($id, $proID, $rmStk);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Expired Medicine/Product</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">expired stock</li>
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
                    if (isset($eProDel)) {
                        echo $eProDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Expired Medicine/Stock</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Purchase Stock</th>
                                        <th style="width:20px;">Expire</th>
                                        <th style="width:20px;">Remove</th>
                                        <th style="width:20px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getStk = $medicine->getExpStock();
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
                                                    echo $result['qty'];
                                                    ?>
                                                </td>
                                                <td><?php echo $fm->formatDate($result['edate']); ?></td>

                                        <form class="form-horizontal" method="post" action="">
                                            <td>
                                                <input type="number" class="form-control" value="0" name="rmStk" required="">
                                                <input type="hidden" class="form-control" name="proID" value="<?php echo $result['product']; ?>" required="">
                                                <input type="hidden" class="form-control" name="delid" value="<?php echo $result['id']; ?>" required="">
                                            </td>
                                            <td>   
                                                <a target="_blank" href="edit-exp.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm">Edit</button></a>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </form>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>

