<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $bankInsert = $medicine->addBank($_POST);
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
                            <li class="breadcrumb-item active" aria-current="page">add bank</li>
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
                    if (isset($bankInsert)) {
                        echo $bankInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Add Bank</h4>
                            <div class="box-tools pull-right" align="right">
                                <a href="manage-bank.php"><button type="button" class="btn btn-default"><i class="fas fa-arrow-left"></i>Back</button></a>
                            </div><br>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">Unit Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="bank_name" autocomplete="off" placeholder="Bank Name" required>
                                    </div>
                                </div>
                            </div>										
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "save" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
