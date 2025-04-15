<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">الدفع</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">الدفع</li>
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
            $createPay = "createPay";
            foreach ($comma as $sname) {
                if ($sname == $createPay) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="create-payment.php">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="fab fa-cc-amazon-pay"></i></h1>
                            <h6 class="text-white">الدفع</h6>
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
            $allPay = "allPay";
            foreach ($comma as $sname) {
                if ($sname == $allPay) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="manage-payment.php">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="fas fa-credit-card"></i></h1>
                            <h6 class="text-white">ادارة الدفع</h6>
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