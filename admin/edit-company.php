<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-company.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $companyUpdate = $medicine->updateCompany($_POST, $sid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Company</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">add company</li>
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
                    if (isset($companyUpdate)) {
                        echo $companyUpdate;
                    }
                    ?>
                    <?php
                    $getInfo = $medicine->getCompanyById($sid);
                    if ($getInfo) {
                        while ($result = $getInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Add Company</h4>
                                    <div class="box-tools pull-right" align="right">
                                        <a href="manage-company.php"><button type="button" class="btn btn-default"><i class="fas fa-arrow-left"></i>Back</button></a>
                                    </div><br>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uname">Company Name<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="uname" value="<?php echo $result['company_name']; ?>" name="company_name" placeholder="Company Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $result['address']; ?>" placeholder="Address" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Phone<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="fname" name="mobile" value="<?php echo $result['mobile']; ?>" placeholder="Mobile number" required autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>										
                                </div>
                                <div class="border-top">
                                    <div class="card-body" align="center">
                                        <button type="submit" name = "update" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>					
        </div>			
    </div>			
</div>
<?php include 'footer.php'; ?>