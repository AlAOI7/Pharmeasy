<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $supplierInsert = $admin->addSupplier($_POST);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Supplier</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">add supplier</li>
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
                    if (isset($supplierInsert)) {
                        echo $supplierInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Add Supplier</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">Full Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="name" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Company Name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="fname" name="company" placeholder="Company Name Here" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Phone<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fname" name="mobile" placeholder="Mobile number" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Status<span style="color: red"> *</span></label>
                                        <select class="form-control" name="status" required>
                                            <option>Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Opening Balance<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fname" name="opening" placeholder="Opening balance">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
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