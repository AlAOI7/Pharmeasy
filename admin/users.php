<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $unitDel = $medicine->deleteUser($delid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Users</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">users</li>
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
                    if (isset($unitDel)) {
                        echo $unitDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All User</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-user.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add User</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getU = $medicine->getAllUser();
                                    if ($getU) {
                                        $i = 0;
                                        while ($result = $getU->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['adminUser']; ?></td>
                                                <td><?php echo $result['adminName']; ?></td>
                                                <td>
                                                    <?php
                                                    $user_type = $medicine->getOneCol('user_type', 'tbl_user_type', 'id', $result['user_type']);
                                                    echo $user_type;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="edit-user.php?sid=<?php echo $result['adminId']; ?>"><button type="button" class="btn btn-cyan btn-sm">Edit</button></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['adminId']; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
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



