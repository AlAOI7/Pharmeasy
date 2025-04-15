<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $bankDel = $medicine->deleteBank($delid);
}
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Bank</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">bank</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($bankDel)) {
                        echo $bankDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Bank</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-bank.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add Bank</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Bank Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getBank = $medicine->getAllBank();
                                    if ($getBank) {
                                        $i = 0;
                                        while ($result = $getBank->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['bank_name']; ?></td>
                                                <td>
                                                    <a href="edit-bank.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm">Edit</button></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
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
