<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $typeDel = $admin->deleteCusType($id);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Customer Type</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">customer type</li>
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
                    if (isset($typeDel)) {
                        echo $typeDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Customer Type</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-type.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add Customer Type</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Customer Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getType = $admin->getAllCustomerType();
                                    if ($getType) {
                                        $i = 0;
                                        while ($result = $getType->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['customer_type']; ?></td>
                                                <td>
                                                    <a href="edit-type.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm">Edit</button></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Action</th>
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