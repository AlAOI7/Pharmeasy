<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">المجموعات</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">المجموعات</li>
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
            $addCollection = "addCollection";
            foreach ($comma as $sname) {
                if ($sname == $addCollection) {
                    ?>
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="add-collection.php">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="fas fa-hand-holding-usd"></i></h1>
                            <h6 class="text-white">المجموعات</h6>
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
            $allCollection = "allCollection";
            foreach ($comma as $sname) {
                if ($sname == $allCollection) {
                    ?>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="manage-collection.php">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="fas fa-donate"></i></h1>
                            <h6 class="text-white">اداارة كل المجموعات</h6>
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