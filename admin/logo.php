<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateLogo'])) {

    $logoUpdate = $admin->UpdateLogo($_FILES);
}
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Update Logo</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Logo</li>
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
                    if (isset($logoUpdate)) {
                        echo $logoUpdate;
                    }
                    ?>
                    <form class="form-horizontal" action = "" method = "post" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">Update Logo</h4>
                            <div class="form-group row">
                                <label class="col-md-3">File Upload</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name ="logo" class="custom-file-input" id="validatedCustomFile" required>
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                </div>
                                <?php
                                $GetLogo = $admin->getLogo();

                                if ($GetLogo) {

                                    while ($result = $GetLogo->fetch_assoc()) {
                                        ?>
                                        <img class="rounded-circle" width="60" height = "60" src="images/<?php echo $result['logo']; ?>" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="logo">
                                    <?php }
                                } ?>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name = "updateLogo" class="btn btn-primary">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>