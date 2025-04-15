<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'users.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}
$getUtype = $medicine->getUserType();
$user_query = $admin->getUserById($sid);
$result_f = $user_query->fetch_assoc();
$chk2 = $result_f['access_permission'];
$chk = explode(",", $chk2);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userUpdate = $admin->updateUser($_POST, $sid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">User</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">edit user</li>
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
                    if (isset($userUpdate)) {
                        echo $userUpdate;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Update User</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">User Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="username" value="<?php echo $result_f['adminUser']; ?>" placeholder="username" readonly="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Full Name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="fname" name="adminName" value="<?php echo $result_f['adminName']; ?>" placeholder="Full Name Here" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Phone<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="fname" name="mobile" value="<?php echo $result_f['mobile']; ?>" placeholder="Mobile " required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!--                                    <div class="form-group">
                                                                            <label for="lname">Password<span style="color: red"> *</span></label>
                                                                            <input type="password" name = "password" class="form-control" id="lname" placeholder="Password Here" required>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label for="lname">Type<span style="color: red"> *</span></label>
                                        <select class="form-control" name="user_type" required>
                                            <option>Select Type</option>
                                            <?php
                                            foreach ($getUtype as $row) {
                                                if ($result_f['user_type'] == $row['id']) {
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>" selected="selected"><?php echo $row['user_type']; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['user_type']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Status<span style="color: red"> *</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Password</label>
                                        <input type="password" name = "password" class="form-control" id="lname" placeholder="Password Here">
                                    </div>
                                </div>
                            </div>										
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "save" class="btn btn-success">Save Change</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Access permission</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" id="checkAll" name="access_permission[]" value="ALL" <?php echo(in_array('ALL', $chk) ? "checked='checked'" : "") ?>>
                                        <label style="margin-left: 8px;color: green">ALL Permission</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Medicine" <?php echo(in_array('Medicine', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Medicine/Product</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="MedicineList" <?php echo(in_array('MedicineList', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Medicine List</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="ProductList" <?php echo(in_array('ProductList', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Product List</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="ProductType" <?php echo(in_array('ProductType', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Product Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="rack" <?php echo(in_array('rack', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Rack</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="generic" <?php echo(in_array('generic', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Generic</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="company" <?php echo(in_array('company', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Company</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expired" <?php echo(in_array('expired', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Expired</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expiredSoon" <?php echo(in_array('expiredSoon', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Expired Soon</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Purchase" <?php echo(in_array('Purchase', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Purchase</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="addNewPur" <?php echo(in_array('addNewPur', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Add New Purchase</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allPur" <?php echo(in_array('allPur', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">All Purchase</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purRet" <?php echo(in_array('purRet', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allPurRet" <?php echo(in_array('allPurRet', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">All Purchase Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deletePur" <?php echo(in_array('deletePur', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Purchase</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deletePurRet" <?php echo(in_array('deletePurRet', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Purchase Return</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Payment" <?php echo(in_array('Payment', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Payment</label>
                                    </div>

                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="createPay" <?php echo(in_array('createPay', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Create Payment</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allPay" <?php echo(in_array('allPay', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Payment</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delPay" <?php echo(in_array('delPay', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Payment</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="POS" <?php echo(in_array('POS', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Point of Sale</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="newInv" <?php echo(in_array('newInv', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">New Invoice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allInv" <?php echo(in_array('allInv', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">All Invoice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesRet" <?php echo(in_array('salesRet', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Sales Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="manageAllRet" <?php echo(in_array('manageAllRet', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deleteInv" <?php echo(in_array('deleteInv', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Invoice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deleteRet" <?php echo(in_array('deleteRet', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Sales Return</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Collection" <?php echo(in_array('Collection', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Collection</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="addCollection" <?php echo(in_array('addCollection', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Add Collection</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allCollection" <?php echo(in_array('allCollection', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Collection</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delCollection" <?php echo(in_array('delCollection', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Collection</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Customer" <?php echo(in_array('Customer', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Customer</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="cusType" <?php echo(in_array('cusType', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Customer Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="newCus" <?php echo(in_array('newCus', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">New Customer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allCus" <?php echo(in_array('allCus', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Customer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="editCus" <?php echo(in_array('editCus', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Edit Customer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delCus" <?php echo(in_array('delCus', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Customer</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--                                    <div class="form-group">
                                                                            <input type="checkbox" id="checkItem" name="access_permission[]" value="Supplier" <?php echo(in_array('Supplier', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                            <label style="margin-left: 8px;">Supplier</label>
                                                                        </div>-->
                                    <!--                                    <div class="row offset-2">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="newSupplier" <?php echo(in_array('newSupplier', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">New Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="allSupplier" <?php echo(in_array('allSupplier', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">Manage All Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="editSup" <?php echo(in_array('editSup', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">Edit Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="delSup" <?php echo(in_array('delSup', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">Delete Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Finance" <?php echo(in_array('Finance', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Finance</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="bank" <?php echo(in_array('bank', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Bank</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allIncHead" <?php echo(in_array('allIncHead', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">All Income head</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="inc" <?php echo(in_array('inc', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Income</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="editInc" <?php echo(in_array('editInc', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Edit Income</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delInc" <?php echo(in_array('delInc', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Income</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allExpHead" <?php echo(in_array('allExpHead', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">All Expense Head</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="exp" <?php echo(in_array('exp', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Expense</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="editExp" <?php echo(in_array('editExp', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Edit Expense</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delExp" <?php echo(in_array('delExp', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Delete Expense</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="overhead" <?php echo(in_array('overhead', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Overhead</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allOverhead" <?php echo(in_array('allOverhead', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">All Overhead</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Setting" <?php echo(in_array('Setting', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Setting</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Login History" <?php echo(in_array('Login History', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Login Log</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Backup" <?php echo(in_array('Backup', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;">Backup</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Report" <?php echo(in_array('Report', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                        <label style="margin-left: 8px;"><b>Report</b></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="InCash" <?php echo(in_array('InCash', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">In Cash</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="stkReport" <?php echo(in_array('stkReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Stock Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="stkAlert" <?php echo(in_array('stkAlert', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Stock Alert (Itemwise)</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="currentStock" <?php echo(in_array('currentStock', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Current Stock</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="outStock" <?php echo(in_array('outStock', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Out of Stock</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expStock" <?php echo(in_array('expStock', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Expire Stock</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purReport" <?php echo(in_array('purReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purReportSup" <?php echo(in_array('purReportSup', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Report (Supplier)</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purReturnReport" <?php echo(in_array('purReturnReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Return Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesReport" <?php echo(in_array('salesReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Sales Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesReturnReport" <?php echo(in_array('salesReturnReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Sales Return Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesReportSalesman" <?php echo(in_array('salesReportSalesman', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Sales Report (Salesman)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesProfit" <?php echo(in_array('salesProfit', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Sales Profit</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="lossReport" <?php echo(in_array('lossReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Loss Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="paymentReport" <?php echo(in_array('paymentReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Payment Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="collectionReport" <?php echo(in_array('collectionReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Collection Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expReport" <?php echo(in_array('expReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Expense Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="supplierReport" <?php echo(in_array('supplierReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Supplier Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="customerReport" <?php echo(in_array('customerReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Customer Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="netProfit" <?php echo(in_array('netProfit', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Net Profit</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="overheadReport" <?php echo(in_array('overheadReport', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Overhead</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="profit" <?php echo(in_array('profit', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Profit</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="sd" <?php echo(in_array('sd', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                <label style="margin-left: 8px;">Sales Details</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
<script>
    $('#checkAll').click(function () {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
</script>

