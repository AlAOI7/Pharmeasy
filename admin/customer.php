<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Customer</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">customer</li>
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
            $cusType = "cusType";
            foreach ($comma as $sname) {
                if ($sname == $cusType) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="customer-type.php">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-user-circle"></i></h1>
                                    <h6 class="text-white">Customer Type</h6>
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
            $newCus = "newCus";
            foreach ($comma as $sname) {
                if ($sname == $newCus) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="add-customer.php">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-user-circle"></i></h1>
                                    <h6 class="text-white">New Customer</h6>
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
            $allCus = "allCus";
            foreach ($comma as $sname) {
                if ($sname == $allCus) {
                    ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="manage-customer.php">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-donate"></i></h1>
                                    <h6 class="text-white">Manage All Customer</h6>
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




