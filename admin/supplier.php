<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Supplier</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">supplier</li>
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
            $newSupplier = "newSupplier";
            foreach ($comma as $sname) {
                if ($sname == $newSupplier) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="add-supplier.php">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-user-circle"></i></h1>
                                    <h6 class="text-white">New Supplier</h6>
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
            $allSupplier = "allSupplier";
            foreach ($comma as $sname) {
                if ($sname == $allSupplier) {
                    ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="manage-supplier.php">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                                    <h6 class="text-white">Manage All Supplier</h6>
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






