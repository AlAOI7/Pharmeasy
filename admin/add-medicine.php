<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getGeneric = $medicine->getAllGenericList();
$getCompany = $medicine->getAllCompanyist();
$getRack = $medicine->getAllRackist();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $medicineInsert = $medicine->addMedicine($_POST);
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
                            <li class="breadcrumb-item active" aria-current="page">add medicine</li>
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
                    if (isset($medicineInsert)) {
                        echo $medicineInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">اضافة دواء</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uname">الاسم<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="medicine_name" placeholder="اسم الدواء" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="loc">نوع<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="loc" name="medicine_form" placeholder="نوع الدواء" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="purchases_price">القيمة الشرائية</label>
                                                <input type="text" class="form-control" id="purchases_price" name="purchases_price" placeholder="القيمة الشرائية" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">الضركة<span style="color: red"> *</span></label>
                                        <select class="form-control select2" name="company_id" required>
                                            <option>اختار الشركة</option>
                                            <?php while ($row = $getCompany->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">العلامة</label>									
                                        <textarea class="ckeditor" name="indication" id="editor2"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname">الاسم العام<span style="color: red"> *</span></label>
                                        <select class="form-control select2" style="width: 100%;" name="generic_id" required>
                                            <option>اختار الاسم</option>
                                            <?php while ($result = $getGeneric->fetch_assoc()) { ?>
                                                <option value="<?php echo $result['id']; ?>"><?php echo $result['generic_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sale_price">سعر البيع</label>
                                                <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Sale Price" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">القوة<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="address" name="medicine_strength" placeholder="Medicine Strength" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lname">الرف</label>
                                                <select class="form-control select2" name="rack_id">
                                                    <option>اختار الرف</option>
                                                    <?php while ($res = $getRack->fetch_assoc()) { ?>
                                                        <option value="<?php echo $res['id']; ?>"><?php echo $res['rack_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="min_stock">مخزون الحد الدنا</label>
                                                <input type="text" class="form-control" id="min_stock" name="min_stock" placeholder="Minimum Stock for Alert" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">الاثار الجانبية  </label>
                                        <textarea class="ckeditor" name="side_effect" id="editor3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="lname">الادارة</label>
                                        <textarea class="ckeditor" name="administration" id="editor4"></textarea>
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