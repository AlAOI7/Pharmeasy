<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-customer.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cusUpdate = $admin->updateCustomer($_POST, $sid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Customer</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">update customer</li>
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
                    if (isset($cusUpdate)) {
                        echo $cusUpdate;
                    }
                    ?>
                    <?php
                    $getInfo = $admin->getCustomerInfoById($sid);
                    if ($getInfo) {
                        while ($result = $getInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Update Customer</h4>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uname">Name<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="uname" value ="<?php echo $result['name']; ?>" name="cusname" placeholder="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fname">Location<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="fname" value ="<?php echo $result['location']; ?>" name="location" placeholder="Full Name Here" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" value ="<?php echo $result['email']; ?>" name="email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="lname">Customer Type<span style="color: red"> *</span></label>
                                                <select class="form-control" name="cus_type" required>
                                                    <option>Select Type</option>
                                                    <?php
                                                    $getType = $admin->getAllType();
                                                    if ($getType) {
                                                        while ($res = $getType->fetch_assoc()) {
                                                            if ($result['cus_type'] == $res['id']) {
                                                                ?>
                                                                <option value="<?php echo $res['id']; ?>" selected="selected"><?php echo $res['customer_type']; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $res['id']; ?>"><?php echo $res['customer_type']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
										<div class="row">
										  <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Phone<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="fname" value ="<?php echo $result['mobile']; ?>" name="mobile" placeholder="Mobile number">
                                            </div>
										  </div>
										  <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Opening Balance</label>
                                                <input type="text" class="form-control" id="fname" value ="<?php echo $result['opening']; ?>" name="opening" placeholder="Opening Balance" required>
                                            </div>
										  </div>
										</div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" value ="<?php echo $result['address']; ?>" name="address" placeholder="Address">
                                            </div>
											<div class="form-group">
                                                <label for="address">Medicine</label>
                                                <input type="text" class="form-control" id="medicine" value ="<?php echo $result['medicine']; ?>" name="medicine" placeholder="Medicine" autocomplete="">
                                            </div>
                                            <div class="form-group">
                                                <label for="lname">Status<span style="color: red"> *</span></label>
                                                <select class="form-control" name="status" required>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
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