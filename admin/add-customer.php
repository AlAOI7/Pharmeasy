<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $customerInsert = $admin->addCustomer($_POST);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">العميل</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">اضافة عميل</li>
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
                    if (isset($customerInsert)) {
                        echo $customerInsert;
                    }
                    ?>
                    <form class="form-horizontal" method="post" action="">
                        <div class="card-body">
                            <h4 class="card-title">اضافة عميل</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">الاسم<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="cusname"
                                            placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="loc">الموقع<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="loc" name="location"
                                            placeholder="Location">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">البريد</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">نوع العميل<span style="color: red"> *</span></label>
                                        <select class="form-control" name="cus_type" required>
                                            <option>اختار النوع</option>
                                            <?php
                                            $getType = $admin->getAllType();
                                            if ($getType) {
                                                while ($result = $getType->fetch_assoc()) {
                                                    ?>
                                            <option value="<?php echo $result['id']; ?>">
                                                <?php echo $result['customer_type']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">الهاتف<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fname" name="mobile"
                                            placeholder="Mobile number" autocomplete="off" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">العنوان</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">الرصيد الافتتاحي</label>
                                        <input type="text" class="form-control" id="fname" name="opening"
                                            placeholder="Opening Balance">
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">الحالة<span style="color: red"> *</span></label>
                                        <select class="form-control" name="status" required>
                                            <option>اختار</option>
                                            <option value="1">نشط</option>
                                            <option value="0">غير نشط</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name="save" class="btn btn-success">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>