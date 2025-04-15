<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getSupplier = $medicine->getAllSupplier();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $proInsert = $medicine->addPro($_POST);
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
                            <li class="breadcrumb-item active" aria-current="page">add products</li>
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
                    if (isset($proInsert)) {
                        echo $proInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">اضافة منتج</h4>
                            <div class="box-tools pull-right" align="right">
                                <a href="products.php"><button type="button" class="btn btn-default"><i class="fas fa-arrow-left"></i>Back</button></a>
                            </div><br>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">اسم المنتج<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="medicine_name" placeholder="اسم المنتج" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>مورد المنتج<span style="color: red">*</span></label>
                                        <select name="product_sup_name" id="sup_id" class="form-control select2" style="width: 100%;" required>
                                            <option value="">اختار المورد</option>
                                            <?php while ($supplier = $getSupplier->fetch_assoc()) { ?>
                                                <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['company_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lname">نوع<span style="color: red"> *</span></label>
                                                <select class="form-control" name="نوع المنتج" required>
                                                    <option value="1">Select Type</option>
                                                    <?php
                                                    $getType = $medicine->getAllActiveProType();
                                                    if ($getType) {
                                                        while ($result = $getType->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $result['id']; ?>"><?php echo $result['product_type']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="purchases_price">سعر الشراء</label>
                                                <input type="text" class="form-control" id="purchases_price" name="purchases_price" placeholder="0.00" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sale_price">سعر البيع</label>
                                                <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="0.00" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>										
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "save" class="btn btn-success">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>



