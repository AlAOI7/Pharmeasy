<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Finance</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">finance</li>
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
            $bank = "bank";
            foreach ($comma as $sname) {
                if ($sname == $bank) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-bank.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-university"></i></h1>
                                    <h6 class="text-white">Bank</h6>
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
            $allIncHead = "allIncHead";
            foreach ($comma as $sname) {
                if ($sname == $allIncHead) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-income-head.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="far fa-money-bill-alt"></i></h1>
                                    <h6 class="text-white">All Income Head</h6>
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
            $inc = "inc";
            foreach ($comma as $sname) {
                if ($sname == $inc) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-income.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="far fa-money-bill-alt"></i></h1>
                                    <h6 class="text-white">Income</h6>
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
            $allExpHead = "allExpHead";
            foreach ($comma as $sname) {
                if ($sname == $allExpHead) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-expense-head.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-ban"></i></h1>
                                    <h6 class="text-white">All Expense Head</h6>
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
            $exp = "exp";
            foreach ($comma as $sname) {
                if ($sname == $exp) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-expense.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-ban"></i></h1>
                                    <h6 class="text-white">Expense</h6>
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
            $overhead = "overhead";
            foreach ($comma as $sname) {
                if ($sname == $overhead) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="overhead.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-ban"></i></h1>
                                    <h6 class="text-white">Overhead</h6>
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
            $allOverhead = "allOverhead";
            foreach ($comma as $sname) {
                if ($sname == $allOverhead) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="manage-overhead-info.php">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-ban"></i></h1>
                                    <h6 class="text-white">All Overhead</h6>
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








