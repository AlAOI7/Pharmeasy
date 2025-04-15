<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">الدواء /المنتج</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">الدواء/المنتج</li>
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
            $MedicineList = "MedicineList";
            foreach ($comma as $sname) {
                if ($sname == $MedicineList) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="medicine.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-pills"></i></h1>
                                    <h6 class="text-white">قائمة الدواء</h6>
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
            $ProductList = "ProductList";
            foreach ($comma as $sname) {
                if ($sname == $ProductList) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="products.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fab fa-palfed"></i></h1>
                                    <h6 class="text-white">قائمة المنتج</h6>
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
            $ProductType = "ProductType";
            foreach ($comma as $sname) {
                if ($sname == $ProductType) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="pro-type.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-briefcase-check"></i></h1>
                                    <h6 class="text-white">نوع المنتج</h6>
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
            $rack = "rack";
            foreach ($comma as $sname) {
                if ($sname == $rack) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-rack.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-map-signs"></i></h1>
                                    <h6 class="text-white">رف</h6>
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
            $generic = "generic";
            foreach ($comma as $sname) {
                if ($sname == $generic) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-generic.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-crosshairs"></i></h1>
                                    <h6 class="text-white">الاسم العام</h6>
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
            $company = "company";
            foreach ($comma as $sname) {
                if ($sname == $company) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-company.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fab fa-houzz"></i></h1>
                                    <h6 class="text-white">الشركة</h6>
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
            $expired = "expired";
            foreach ($comma as $sname) {
                if ($sname == $expired) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="expired-stock.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-crosshairs"></i></h1>
                                    <h6 class="text-white">تاريخ الانتهاء</h6>
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
            $expiredSoon = "expiredSoon";
            foreach ($comma as $sname) {
                if ($sname == $expiredSoon) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="expired-soon-stock.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-crosshairs"></i></h1>
                                    <h6 class="text-white">تاريخ الانتهاء القريب</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
            <?php
                if (Session::get('admin_type') == 1) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="update-current_stock.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-crosshairs"></i></h1>
                                    <h6 class="text-white">تحرير المخزون الحالي</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
