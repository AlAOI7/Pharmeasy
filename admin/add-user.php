<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getUtype = $medicine->getUserType();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $uInsert = $admin->save_user_info($_POST);
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
                            <li class="breadcrumb-item active" aria-current="page">add user</li>
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
                    if (isset($uInsert)) {
                        echo $uInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Add User</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">User Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="username" placeholder="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Full Name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="fname" name="adminName" placeholder="Full Name Here" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Type<span style="color: red"> *</span></label>
                                        <select class="form-control" name="user_type" required>
                                            <option>Select Type</option>
                                            <?php
                                            foreach ($getUtype as $row) {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['user_type']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
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
                        <div class="card-body">
                            <h4 class="card-title">Access permission</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" id="checkAll" name="access_permission[]" value="ALL">
                                        <label style="margin-left: 8px;color: green">ALL Permission</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Medicine" class="checkItem">
                                        <label style="margin-left: 8px;">Medicine/Product</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="MedicineList" class="checkItem">
                                                <label style="margin-left: 8px;">Medicine List</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="ProductList" class="checkItem">
                                                <label style="margin-left: 8px;">Product List</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="ProductType" class="checkItem">
                                                <label style="margin-left: 8px;">Product Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="rack" class="checkItem">
                                                <label style="margin-left: 8px;">Rack</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="generic" class="checkItem">
                                                <label style="margin-left: 8px;">Generic</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="company" class="checkItem">
                                                <label style="margin-left: 8px;">Company</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expired" class="checkItem">
                                                <label style="margin-left: 8px;">Expired</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expiredSoon" class="checkItem">
                                                <label style="margin-left: 8px;">Expired Soon</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Purchase" class="checkItem">
                                        <label style="margin-left: 8px;">Purchase</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="addNewPur" class="checkItem">
                                                <label style="margin-left: 8px;">Add New Purchase</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allPur" class="checkItem">
                                                <label style="margin-left: 8px;">All Purchase</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purRet" class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allPurRet" class="checkItem">
                                                <label style="margin-left: 8px;">All Purchase Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deletePur" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Purchase</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deletePurRet" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Purchase Return</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Payment" class="checkItem">
                                        <label style="margin-left: 8px;">Payment</label>
                                    </div>

                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="createPay" class="checkItem">
                                                <label style="margin-left: 8px;">Create Payment</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allPay" class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Payment</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delPay" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Payment</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="POS" class="checkItem">
                                        <label style="margin-left: 8px;">Point of Sale</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="newInv" class="checkItem">
                                                <label style="margin-left: 8px;">New Invoice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allInv" class="checkItem">
                                                <label style="margin-left: 8px;">All Invoice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesRet" class="checkItem">
                                                <label style="margin-left: 8px;">Sales Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="manageAllRet" class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Return</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deleteInv" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Invoice</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="deleteRet" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Sales Return</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Collection" class="checkItem">
                                        <label style="margin-left: 8px;">Collection</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="addCollection" class="checkItem">
                                                <label style="margin-left: 8px;">Add Collection</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allCollection" class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Collection</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delCollection" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Collection</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Customer" class="checkItem">
                                        <label style="margin-left: 8px;">Customer</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="cusType" class="checkItem">
                                                <label style="margin-left: 8px;">Customer Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="newCus" class="checkItem">
                                                <label style="margin-left: 8px;">New Customer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allCus" class="checkItem">
                                                <label style="margin-left: 8px;">Manage All Customer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="editCus" class="checkItem">
                                                <label style="margin-left: 8px;">Edit Customer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delCus" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Customer</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--                                    <div class="form-group">
                                                                            <input type="checkbox" id="checkItem" name="access_permission[]" value="Supplier" <?php //echo(in_array('Supplier', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                            <label style="margin-left: 8px;">Supplier</label>
                                                                        </div>-->
                                    <!--                                    <div class="row offset-2">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="newSupplier" <?php //echo(in_array('newSupplier', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">New Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="allSupplier" <?php //echo(in_array('allSupplier', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">Manage All Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="editSup" <?php //echo(in_array('editSup', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">Edit Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" id="checkItem" name="access_permission[]" value="delSup" <?php //echo(in_array('delSup', $chk) ? "checked='checked'" : "") ?> class="checkItem">
                                                                                    <label style="margin-left: 8px;">Delete Supplier</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Finance" class="checkItem">
                                        <label style="margin-left: 8px;">Finance</label>
                                    </div>
                                    <div class="row offset-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="bank" class="checkItem">
                                                <label style="margin-left: 8px;">Bank</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allIncHead" class="checkItem">
                                                <label style="margin-left: 8px;">All Income head</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="inc" class="checkItem">
                                                <label style="margin-left: 8px;">Income</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="editInc" class="checkItem">
                                                <label style="margin-left: 8px;">Edit Income</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delInc" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Income</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allExpHead" class="checkItem">
                                                <label style="margin-left: 8px;">All Expense Head</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="exp" class="checkItem">
                                                <label style="margin-left: 8px;">Expense</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="editExp" class="checkItem">
                                                <label style="margin-left: 8px;">Edit Expense</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="delExp" class="checkItem">
                                                <label style="margin-left: 8px;">Delete Expense</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="overhead" class="checkItem">
                                                <label style="margin-left: 8px;">Overhead</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="allOverhead" class="checkItem">
                                                <label style="margin-left: 8px;">All Overhead</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Setting" class="checkItem">
                                        <label style="margin-left: 8px;">Setting</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Login History" class="checkItem">
                                        <label style="margin-left: 8px;">Login Log</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Backup" class="checkItem">
                                        <label style="margin-left: 8px;">Backup</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" id="checkItem" name="access_permission[]" value="Report" class="checkItem">
                                        <label style="margin-left: 8px;"><b>Report</b></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="InCash" class="checkItem">
                                                <label style="margin-left: 8px;">In Cash</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="stkReport" class="checkItem">
                                                <label style="margin-left: 8px;">Stock Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="stkAlert" class="checkItem">
                                                <label style="margin-left: 8px;">Stock Alert (Itemwise)</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="currentStock" class="checkItem">
                                                <label style="margin-left: 8px;">Current Stock</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="outStock" class="checkItem">
                                                <label style="margin-left: 8px;">Out of Stock</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expStock" class="checkItem">
                                                <label style="margin-left: 8px;">Expire Stock</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purReport" class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purReportSup" class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Report (Supplier)</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="purReturnReport" class="checkItem">
                                                <label style="margin-left: 8px;">Purchase Return Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesReport" class="checkItem">
                                                <label style="margin-left: 8px;">Sales Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesReturnReport" class="checkItem">
                                                <label style="margin-left: 8px;">Sales Return Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesReportSalesman" class="checkItem">
                                                <label style="margin-left: 8px;">Sales Report (Salesman)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="salesProfit" class="checkItem">
                                                <label style="margin-left: 8px;">Sales Profit</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="lossReport" class="checkItem">
                                                <label style="margin-left: 8px;">Loss Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="paymentReport" class="checkItem">
                                                <label style="margin-left: 8px;">Payment Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="collectionReport" class="checkItem">
                                                <label style="margin-left: 8px;">Collection Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="expReport" class="checkItem">
                                                <label style="margin-left: 8px;">Expense Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="supplierReport" class="checkItem">
                                                <label style="margin-left: 8px;">Supplier Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="customerReport" class="checkItem">
                                                <label style="margin-left: 8px;">Customer Report</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="netProfit" class="checkItem">
                                                <label style="margin-left: 8px;">Net Profit</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="overheadReport" class="checkItem">
                                                <label style="margin-left: 8px;">Overhead</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="profit" class="checkItem">
                                                <label style="margin-left: 8px;">Profit</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="checkItem" name="access_permission[]" value="sd" class="checkItem">
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
