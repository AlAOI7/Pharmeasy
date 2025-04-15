<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getGeneric = $medicine->getAllGenericList();
$getCompany = $medicine->getAllCompanyist();
$getRack = $medicine->getAllRackist();

if (!isset($_GET['medicine_id']) || $_GET['medicine_id'] == NULL) {
    echo "<script>window.location = 'medicine.php';</script>";
} else {

    $medicine_id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['medicine_id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $medicineUpdate = $medicine->updateMedicine($_POST, $medicine_id);
    ?>
    <script type="text/javascript">
        function closeWindow() {
            setTimeout(function () {
                window.close();
            }, 2000);
        }
        window.onload = closeWindow();
    </script>
    <?php
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Medicine</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">edit medicine</li>
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
                    if (isset($medicineUpdate)) {
                        echo $medicineUpdate;
                    }
                    ?>
                    <?php
                    $getInfo = $medicine->getMedicineById($medicine_id);
                    if ($getInfo) {
                        while ($info = $getInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Medicine</h4>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uname">Name<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="uname" value="<?php echo $info['medicine_name']; ?>" name="medicine_name" placeholder="Medicine Name" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loc">Form<span style="color: red">*</span></label>
                                                        <input type="text" class="form-control" id="loc" value="<?php echo $info['medicine_form']; ?>" name="medicine_form" placeholder="Medicine Form" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="loc">Purchase Price<span style="color: red">*</span></label>
                                                        <input type="text" class="form-control" id="loc" value="<?php echo $info['purchases_price']; ?>" name="purchases_price" placeholder="Purchase Price" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="sale_price">Sale Price<span style="color: red">*</span></label>
                                                        <input type="text" class="form-control" id="sale_price" value="<?php echo $info['sale_price']; ?>" name="sale_price" placeholder="Sale Price" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="lname">Company<span style="color: red"> *</span></label>
                                                <select class="form-control select2" name="company_id" required>
                                                    <option>Select Company</option>
                                                    <?php
                                                    while ($row = $getCompany->fetch_assoc()) {
                                                        if ($info[company_id] == $row['id']) {
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>" selected="selected"><?php echo $row['company_name']; ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php
                                            if (Session::get('admin_type') == 1) {
                                                ?>
                                                <div class="form-group">
                                                    <label for="stock">Stock</label>
                                                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $info['stock']; ?>" placeholder="Minimum Stock for Alert" autocomplete="off">
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label for="lname">Indication</label>									
                                                <textarea class="ckeditor" name="indication" id="editor2"><?php echo $info['indication']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lname">Generic<span style="color: red"> *</span></label>
                                                <select class="form-control select2" style="width: 100%;" name="generic_id" required>
                                                    <option>Select Generic</option>
                                                    <?php
                                                    while ($result = $getGeneric->fetch_assoc()) {
                                                        if ($info[generic_id] == $result['id']) {
                                                            ?>
                                                            <option value="<?php echo $result['id']; ?>" selected="selected"><?php echo $result['generic_name']; ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option value="<?php echo $result['id']; ?>"><?php echo $result['generic_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Strength<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="address" value="<?php echo $info['medicine_strength']; ?>" name="medicine_strength" placeholder="Medicine Strength">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lname">Rack</label>
                                                        <select class="form-control select2" name="rack_id">
                                                            <option>Select Rack</option>
                                                            <?php
                                                            while ($res = $getRack->fetch_assoc()) {
                                                                if ($info[rack_id] == $res['id']) {
                                                                    ?>
                                                                    <option value="<?php echo $res['id']; ?>" selected="selected"><?php echo $res['rack_name']; ?></option>
                                                                <?php } else {
                                                                    ?>
                                                                    <option value="<?php echo $res['id']; ?>"><?php echo $res['rack_name']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="min_stock">Minimum Stock for Alert</label>
                                                        <input type="text" class="form-control" id="min_stock" name="min_stock" value="<?php echo $info['min_stock']; ?>" placeholder="Minimum Stock for Alert" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lname">Side Effect</label>
                                                <textarea class="ckeditor" name="side_effect" id="editor3"><?php echo $info['side_effect']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="lname">Administration</label>
                                                <textarea class="ckeditor" name="administration" id="editor4"><?php echo $info['administration']; ?></textarea>
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