<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">report</li>
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
            $InCash = "InCash";
            foreach ($comma as $sname) {
                if ($sname == $InCash) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="net-capital.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-server"></i></h1>
                                    <h6 class="text-white">Net Capital</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="in-cash.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-server"></i></h1>
                                    <h6 class="text-white">In Cash</h6>
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
            $stkReport = "stkReport";
            foreach ($comma as $sname) {
                if ($sname == $stkReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="stock-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-server"></i></h1>
                                    <h6 class="text-white">Stock Report</h6>
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
            $stkAlert = "stkAlert";
            foreach ($comma as $sname) {
                if ($sname == $stkAlert) {
                    ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="stock-report-item.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-server"></i></h1>
                                    <h6 class="text-white">Stock Report(Itemwise)</h6>
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
            $currentStock = "currentStock";
            foreach ($comma as $sname) {
                if ($sname == $currentStock) {
                    ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="current-stock-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-server"></i></h1>
                                    <h6 class="text-white">Current Stock</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="current-stock-report-brand.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-server"></i></h1>
                                    <h6 class="text-white">Companywise Current Stock</h6>
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
            $outStock = "outStock";
            foreach ($comma as $sname) {
                if ($sname == $outStock) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="out-stock-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-sort-amount-down"></i></h1>
                                    <h6 class="text-white">Out of Stock</h6>
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
            $expStock = "expStock";
            foreach ($comma as $sname) {
                if ($sname == $expStock) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="expired-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-pills"></i></h1>
                                    <h6 class="text-white">Expired Stock</h6>
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
            $purReport = "purReport";
            foreach ($comma as $sname) {
                if ($sname == $purReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="purchase-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fab fa-product-hunt"></i></h1>
                                    <h6 class="text-white">Purchase Report</h6>
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
            $purReportSup = "purReportSup";
            foreach ($comma as $sname) {
                if ($sname == $purReportSup) {
                    ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="purchase-report-supplier.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fab fa-product-hunt"></i></h1>
                                    <h6 class="text-white">Purchase Report (Supplier Wise)</h6>
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
            $purReturnReport = "purReturnReport";
            foreach ($comma as $sname) {
                if ($sname == $purReturnReport) {
                    ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="purchase-return-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fab fa-product-hunt"></i></h1>
                                    <h6 class="text-white">Purchase Return Report</h6>
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
            $salesReport = "salesReport";
            foreach ($comma as $sname) {
                if ($sname == $salesReport) {
                    ?> 
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="sales-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-dollar-sign"></i></h1>
                                    <h6 class="text-white">Sales Report</h6>
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
            $salesReturnReport = "salesReturnReport";
            foreach ($comma as $sname) {
                if ($sname == $salesReturnReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="sales-return-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-dollar-sign"></i></h1>
                                    <h6 class="text-white">Sales Return Report</h6>
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
            $salesReportSalesman = "salesReportSalesman";
            foreach ($comma as $sname) {
                if ($sname == $salesReportSalesman) {
                    ?>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="sales-report-salesman.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-dollar-sign"></i></h1>
                                    <h6 class="text-white">Sales Report (Salesman)</h6>
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
            $salesProfit = "salesProfit";
            foreach ($comma as $sname) {
                if ($sname == $salesProfit) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="sales-profit.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-dollar-sign"></i></h1>
                                    <h6 class="text-white">Sales Profit</h6>
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
            $lossReport = "lossReport";
            foreach ($comma as $sname) {
                if ($sname == $lossReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="loss-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-arrow-down"></i></h1>
                                    <h6 class="text-white">Loss Report</h6>
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
            $paymentReport = "paymentReport";
            foreach ($comma as $sname) {
                if ($sname == $paymentReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="payment-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fab fa-paypal"></i></h1>
                                    <h6 class="text-white">Payment Report</h6>
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
            $collectionReport = "collectionReport";
            foreach ($comma as $sname) {
                if ($sname == $collectionReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="collection-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-hand-holding-usd"></i></h1>
                                    <h6 class="text-white">Collection Report</h6>
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
            $expReport = "expReport";
            foreach ($comma as $sname) {
                if ($sname == $expReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="expense-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-hand-holding-usd"></i></h1>
                                    <h6 class="text-white">Expense Report</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="all-expense-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-hand-holding-usd"></i></h1>
                                    <h6 class="text-white">All Expense Report</h6>
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
            $supplierReport = "supplierReport";
            foreach ($comma as $sname) {
                if ($sname == $supplierReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="supplier-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-user"></i></h1>
                                    <h6 class="text-white">Supplier Report</h6>
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
            $customerReport = "customerReport";
            foreach ($comma as $sname) {
                if ($sname == $customerReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="customer-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                                    <h6 class="text-white">Customer Report</h6>
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
            $netProfit = "netProfit";
            foreach ($comma as $sname) {
                if ($sname == $netProfit) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="net-profit.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-handshake"></i></h1>
                                    <h6 class="text-white">Net Profit</h6>
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
            $overheadReport = "overheadReport";
            foreach ($comma as $sname) {
                if ($sname == $overheadReport) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="overhead-type-report.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-handshake"></i></h1>
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
            $profit = "profit";
            foreach ($comma as $sname) {
                if ($sname == $profit) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="profit.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-dollar-sign"></i></h1>
                                    <h6 class="text-white">Profit</h6>
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
            $sd = "sd";
            foreach ($comma as $sname) {
                if ($sname == $sd) {
                    ?>
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="sales-details.php">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-pills"></i></h1>
                                    <h6 class="text-white">Sales Details</h6>
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

