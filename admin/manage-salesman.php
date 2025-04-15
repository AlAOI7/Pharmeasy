<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $salesmanDel = $admin->deleteSalesman($id);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Salesman</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">salesman</li>
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
                        <h5 class="card-title">All Salesman</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getSalesman = $admin->getAllSalesman();
                                    if ($getSalesman) {
                                        $i = 0;
                                        while ($result = $getSalesman->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['username']; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><?php echo $result['mobile']; ?></td>
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
                                                    <a href="edit-salesman.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm">Edit</button></a>
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
                                <th>Username</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Status</th>
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