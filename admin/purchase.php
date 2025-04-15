<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">المشتريات/ارجاع الطلب/المنتجات</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلب المشتريات/المنتجات</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php
            $ab = $_SESSION['access_permission'];
            $comma = explode(",", $ab);
            $addNewPur = "addNewPur";
            foreach ($comma as $sname) {
                if ($sname == $addNewPur) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="add-purchase.php">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="fas fa-plus"></i></h1>
                            <h6 class="text-white">اضافة مشتريات جديدة</h6>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                }
            }
            ?>
            <?php
            $ab = $_SESSION['access_permission'];
            $comma = explode(",", $ab);
            $allPur = "allPur";
            foreach ($comma as $sname) {
                if ($sname == $allPur) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="manage-purchase.php">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="fab fa-readme"></i></h1>
                            <h6 class="text-white">كل المشتريات</h6>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                }
            }
            ?>
            <?php
            $ab = $_SESSION['access_permission'];
            $comma = explode(",", $ab);
            $purRet = "purRet";
            foreach ($comma as $sname) {
                if ($sname == $purRet) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="add-purchase-return.php">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="fas fa-minus"></i></h1>
                            <h6 class="text-white">ارجاع المشتريات</h6>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                }
            }
            ?>
            <?php
            $ab = $_SESSION['access_permission'];
            $comma = explode(",", $ab);
            $allPurRet = "allPurRet";
            foreach ($comma as $sname) {
                if ($sname == $allPurRet) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="manage-purchase-return.php">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="fab fa-readme"></i></h1>
                            <h6 class="text-white">كل المشتريات المرجعة</h6>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                }
            }
            ?>

        </div>
        <?php include 'footer.php'; ?>