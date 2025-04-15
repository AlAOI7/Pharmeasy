<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">بيع/ارجاع البيع</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">الصفحة الرئيسية </a></li>
                            <li class="breadcrumb-item active" aria-current="page">بيع/ارجاع</li>
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
            $newInv = "newInv";
            foreach ($comma as $sname) {
                if ($sname == $newInv) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="create-invoice.php">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="fas fa-cart-arrow-down"></i></h1>
                            <h6 class="text-white">فاتوره </h6>
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
            $allInv = "allInv";
            foreach ($comma as $sname) {
                if ($sname == $allInv) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="manage-invoice.php">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="fas fa-shopping-cart"></i></h1>
                            <h6 class="text-white">ادارة كل الفواتير</h6>
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
            $salesRet = "salesRet";
            foreach ($comma as $sname) {
                if ($sname == $salesRet) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="add-sales-return.php">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="fas fa-chevron-down"></i></h1>
                            <h6 class="text-white">ارجاع المبيعات</h6>
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
            $manageAllRet = "manageAllRet";
            foreach ($comma as $sname) {
                if ($sname == $manageAllRet) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="manage-sales-return.php">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="fas fa-band-aid"></i></h1>
                            <h6 class="text-white">ادارة كل المرجوعات</h6>
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