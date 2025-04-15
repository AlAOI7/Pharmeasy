<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateInfo'])) {

    $infoUpdate = $admin->updateInfo($_POST);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Store Information</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    if (isset($infoUpdate)) {
                        echo $infoUpdate;
                    }
                    ?>
                    <?php
                    $GetInfo = $admin->getInfo();

                    if ($GetInfo) {

                        while ($result = $GetInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action ="">
                                <div class="card-body">
                                    <h4 class="card-title">Update Store Information</h4>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Store Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name = "store_name" value ="<?php echo $result['store_name']; ?>" class="form-control" id="lname" placeholder="Store Name" required>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Address Line 1</h4>
                                            <input type="text" name = "address_line1" value ="<?php echo $result['address_line1']; ?>" class="form-control" id="lname" placeholder="Address Line 1" required="">											
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Address Line 2</h4>
                                            <input type="text" name = "address_line2" value ="<?php echo $result['address_line2']; ?>" class="form-control" id="lname" placeholder="Address Line 2">											
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Phone</h4>
                                            <input type="text" name = "mobile" value ="<?php echo $result['mobile']; ?>" class="form-control" id="lname" placeholder="Phone" required="">											
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" name = "updateInfo" class="btn btn-primary">Save Change</button>
                                    </div>
                                </div>
                            </form>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>