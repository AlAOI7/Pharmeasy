<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-bank.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $bankUpdate = $medicine->updateBank($_POST, $sid);
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
                            <li class="breadcrumb-item active" aria-current="page">edit bank</li>
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
                    if (isset($bankUpdate)) {
                        echo $bankUpdate;
                    }
                    ?>
                    <?php
                    $getInfo = $medicine->getBankById($sid);
                    if ($getInfo) {
                        while ($result = $getInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Bank</h4>
                                    <div class="box-tools pull-right" align="right">
                                        <a href="manage-bank.php"><button type="button" class="btn btn-default"><i class="fas fa-arrow-left"></i>Back</button></a>
                                    </div><br>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uname">Bank Name<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="uname" name="bank_name" value ="<?php echo $result['bank_name']; ?>" autocomplete="off" placeholder="Bank Name" required>
                                            </div>
                                        </div>
                                    </div>										
                                </div>
                                <div class="border-top">
                                    <div class="card-body" align="center">
                                        <button type="submit" name = "save" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        <?php }
                    } ?>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
