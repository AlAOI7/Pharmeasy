<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getSupplier = $medicine->getAllSupplier();
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-unit.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}
$getInfo = $medicine->getProById($sid);
$result = $getInfo->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $proUpdate = $medicine->updatePro($_POST, $sid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Products</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">edit products</li>
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
                    if (isset($proUpdate)) {
                        echo $proUpdate;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Update Product</h4>
                            <div class="box-tools pull-right" align="right">
                                <a href="products.php"><button type="button" class="btn btn-default"><i class="fas fa-arrow-left"></i>Back</button></a>
                            </div><br>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">Product Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="medicine_name" value="<?php echo $result['medicine_name']; ?>" placeholder="Product Name" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Supplier<span style="color: red">*</span></label>
                                        <select name="product_sup_name" id="sup_id" class="form-control select2" style="width: 100%;" required>
                                            <option value="">SELECT SUPPLIER</option>
                                            <?php
                                            while ($supplier = $getSupplier->fetch_assoc()) {
                                                if ($result['company_id'] == $supplier['id']) {
                                                    ?>
                                                    <option value="<?php echo $supplier['id']; ?>" selected="selected"><?php echo $supplier['company_name']; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['company_name']; ?></option>
                                                    <?php
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
                                                <label for="lname">Type<span style="color: red"> *</span></label>
                                                <select class="form-control" name="pro_type" required>
                                                    <option value="1">Select Type</option>
                                                    <?php
                                                    $getType = $medicine->getAllActiveProType();
                                                    if ($getType) {
                                                        while ($res = $getType->fetch_assoc()) {
                                                            if ($result['pro_type'] == $res['id']) {
                                                                ?>
                                                                <option value="<?php echo $res['id']; ?>" selected="selected"><?php echo $res['product_type']; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $res['id']; ?>"><?php echo $res['product_type']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="purchases_price">Purchase Price</label>
                                                <input type="text" class="form-control" id="purchases_price" name="purchases_price" value="<?php echo $result['purchases_price']; ?>" placeholder="0.00" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sale_price">Sale Price</label>
                                                <input type="text" class="form-control" id="sale_price" name="sale_price" value="<?php echo $result['sale_price']; ?>" placeholder="0.00" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>										
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "save" class="btn btn-primary">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>



