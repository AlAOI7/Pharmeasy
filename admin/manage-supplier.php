<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $salesmanDel = $admin->deleteSupplier($id);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Supplier</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">supplier</li>
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
                    if (isset($salesmanDel)) {
                        echo $salesmanDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Supplier</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Company</th>
                                        <th>Mobile</th>
                                        <th>Opening Balance</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getSupplier = $admin->getAllSupplier();
                                    if ($getSupplier) {
                                        $i = 0;
                                        $total = 0;

                                        while ($result = $getSupplier->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><?php echo $result['company']; ?></td>
                                                <td><?php echo $result['mobile']; ?></td>
                                                <td><?php echo $tot = $result['opening']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($result['status'] == 1) {
                                                        echo '<span class="label label-success">Active</span>';
                                                    } else {
                                                        echo '<span class="label label-danger">Inactive</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $editSup = "editSup";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $editSup) {
                                                            ?>
                                                    <a href="edit-supplier.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm"><i class="fas fa-pencil-alt"></i></button></a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $delSup = "delSup";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $delSup) {
                                                            ?>
                                                            <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-danger btn-sm">X</button></a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $tot;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="3">Total</th>
                                <th><?php echo $total; ?></th>
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