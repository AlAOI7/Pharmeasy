<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $salesmanInsert = $admin->addSalesman($_POST);
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
                            <li class="breadcrumb-item active" aria-current="page">add salesman</li>
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
                    if (isset($salesmanInsert)) {
                        echo $salesmanInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Add Salesman</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">User Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="username" placeholder="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Full Name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="fname" name="name" placeholder="Full Name Here" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Phone<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fname" name="mobile" placeholder="Mobile number">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">NID/Passport<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fname" name="nid" placeholder="NID/Passport/Birth Registration" required>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datepicker-autoclose">Birth Date</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose" name="birth" placeholder="mm/dd/yyyy">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Password<span style="color: red"> *</span></label>
                                        <input type="password" name = "password" class="form-control" id="lname" placeholder="Password Here" required>
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