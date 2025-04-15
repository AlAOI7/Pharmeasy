<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
?>

    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">لوحة التحكم</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لوحة التحكم</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <?php //if( Session::get('admin_type') == '1'){   ?>
            <div class="row">
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="medicine.php">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-pill"></i></h1>
                                <!--<h5 class="text-white"><?php // echo $totalMedicine;          ?></h5>-->
                                <h5 class="text-white" id="totalMedicine">0</h5>
                                <h6 class="text-white">الطلب الكلي</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="products.php">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="fas fa-boxes"></i></h1>
                                <h5 class="text-white" id="totalProduct">0</h5>
                                <h6 class="text-white">المنتجات</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->

                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="current-stock-report.php">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="fas fa-capsules"></i></h1>
                                <h5 class="text-white" id="totalInStock">0</h5>
                                <h6 class="text-white">في مخزون الطلب</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="current-stock-report.php">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="fas fa-pills"></i></h1>
                                <h5 class="text-white" id="totalStockBalance">0</h5>
                                <h6 class="text-white">رصيد المخزون </h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="manage-customer.php">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="fas fa-boxes"></i></h1>
                                <h5 class="text-white" id="totalCustomerDue">0</h5>
                                <h6 class="text-white">العميل المستحق</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="supplier-report.php"><div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-arrow-all"></i></h1>
                                <h5 class="text-white" id="totalSupplierDue">0</h5>
                                <h6 class="text-white">المورد</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="expired-report.php"><div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="fas fa-pills"></i></h1>
                                <h5 class="text-white" id="getTotalMedicineExprieStock"></h5>
                                <h6 class="text-white">منتهي الصلاحية</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="expired-soon-report.php"><div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="fas fa-pills"></i></h1>
                                <h5 class="text-white" id="getTotalMedicineExprieSoonStock">0</h5>
                                <h6 class="text-white">قريب انتهاء الصلاحية</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="all-expense-report.php"><div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="fas fa-pills"></i></h1>
                                <h5 class="text-white" id="getExpToday">0</h5>
                                <h6 class="text-white">انتهة صلاحيتة اليوم</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="manage-invoice.php"> <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-cart-plus"></i></h1>
                                <h5 class="text-white" id="getTodaysSale"></h5>
                                <h6 class="text-white">مبيعات اليوم</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="manage-collection.php">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="fas fa-hand-holding-usd"></i></h1>
                                <h5 class="text-white" id="getTodaysCollection">0</h5>
                                <h6 class="text-white">جمع اليوم</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="manage-purchase.php">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="fab fa-product-hunt"></i></h1>
                                <h5 class="text-white" id="getTodaysPurchase">0</h5>
                                <h6 class="text-white">شراء اليوم</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="manage-payment.php">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="fab fa-cc-amazon-pay"></i></h1>
                                <h5 class="text-white" id="getTodaysPayment">0</h5>
                                <h6 class="text-white">الدفع اليومي</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="customer-due-today.php">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="fas fa-dollar-sign"></i></h1>
                                <h5 class="text-white" id="getCustomerDuesToday">0</h5>
                                <h6 class="text-white">مستحقات اليوم</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="nonmovement-customer.php">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h3 class="font-light text-white"><i class="fas fa-user"></i></h3>
                                <h6 class="text-white" id="getTotalInactiveCustomer">0</h6>
                                <h6 class="text-white">حركات العميل</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="nonmovement-medicine.php">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h3 class="font-light text-white"><i class="fas fa-user"></i></h3>
                                <h6 class="text-white" id="getTotalNonmovementMedicine">0</h6>
                                <h6 class="text-white">حركات الدواء</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="slowmovement-medicine.php">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h3 class="font-light text-white"><i class="fas fa-user"></i></h3>
                                <h6 class="text-white" id="getSlowMovementMedicine">0</h6>
                                <h6 class="text-white">الحركة البطيئة للدواء</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php //}    ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6 m-t-15">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="fa fa-user m-b-5 font-16"></i>
                                <h5 class="m-b-0 m-t-5" id="getTotalAdmin">0</h5>
                                <small class="font-light">مجموع المستخدمين</small>
                            </div>
                        </div>
                        <div class="col-6 m-t-15">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                <h5 class="m-b-0 m-t-5" id="getTotalSaleToday">0</h5>
                                <small class="font-light">مجموع البيع</small>
                            </div>
                        </div>
                        <div class="col-6 m-t-15">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="fa fa-tag m-b-5 font-16"></i>
                                <h5 class="m-b-0 m-t-5" id="getTotalSaleReturnToday">0</h5>
                                <small class="font-light">مجموع المردودات
                                </small>
                            </div>
                        </div>
                        <div class="col-6 m-t-15">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="fa fa-table m-b-5 font-16"></i>
                                <h5 class="m-b-0 m-t-5" id="getTotalCollectionToday">0</h5>
                                <small class="font-light">مجموع المجموعات</small>
                            </div>
                        </div>
                        <div class="col-6 m-t-15">
                            <div class="bg-dark p-10 text-white text-center">
                                <i class="far fa-money-bill-alt m-b-5 font-16"></i>
                                <h5 class="m-b-0 m-t-5" id="getTodaysIncome">0</h5>

                                <small class="font-light">مصدر دخل اخر</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- column -->
            </div>
        </div>
    
    <script type="text/javascript">
        function getTotalMedicine(id) {
            $('#totalMedicine').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/totalMedicine.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    $('#totalMedicine').html(data);
                }
            });
        }

        function totalProduct(id) {
            $('#totalProduct').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/totalProduct.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    $('#totalProduct').html(data);
                }
            });
        }
        function totalInStock(id) {
            $('#totalInStock').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/totalInStock.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    $('#totalInStock').html(data);
                }
            });
        }
        function totalStockBalance(id) {
            $('#totalStockBalance').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/totalStockBalance.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    $('#totalStockBalance').html(data);
                }
            });
        }
        function totalCustomerDue(id) {
            $('#totalCustomerDue').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/totalCustomerDue.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
//                    $('#totalCustomerDue').html(data);
                    if (data.trim() == '') {
                        $('#totalCustomerDue').html(0);
                    } else {
                        $('#totalCustomerDue').html(data);
                    }

                }
            });
        }
        function totalSupplierDue(id) {
            $('#totalSupplierDue').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/totalSupplierDue.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
//                    $('#totalCustomerDue').html(data);
                    if (data.trim() == '') {
                        $('#totalSupplierDue').html(0);
                    } else {
                        $('#totalSupplierDue').html(data);
                    }

                }
            });
        }
        function getExpToday(id) {
            $('#getExpToday').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getExpToday.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getExpToday').html(0);
                    } else {
                        $('#getExpToday').html(data);
                    }

                }
            });
        }
        function getTodaysSale(id) {
            $('#getTodaysSale').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTodaysSale.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTodaysSale').html(0);
                    } else {
                        $('#getTodaysSale').html(data);
                    }

                }
            });
        }
        function getTodaysCollection(id) {
            $('#getTodaysCollection').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTodaysCollection.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTodaysCollection').html(0);
                    } else {
                        $('#getTodaysCollection').html(data);
                    }

                }
            });
        }
        function getTodaysPurchase(id) {
            $('#getTodaysPurchase').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTodaysPurchase.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTodaysPurchase').html(0);
                    } else {
                        $('#getTodaysPurchase').html(data);
                    }

                }
            });
        }
        function getTodaysPayment(id) {
            $('#getTodaysPayment').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTodaysPayment.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTodaysPayment').html(0);
                    } else {
                        $('#getTodaysPayment').html(data);
                    }

                }
            });
        }
        function getCustomerDuesToday(id) {
            $('#getCustomerDuesToday').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getCustomerDuesToday.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getCustomerDuesToday').html(0);
                    } else {
                        $('#getCustomerDuesToday').html(data);
                    }

                }
            });
        }
        function getTotalInactiveCustomer(id) {
            $('#getTotalInactiveCustomer').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTotalInactiveCustomer.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTotalInactiveCustomer').html(0);
                    } else {
                        $('#getTotalInactiveCustomer').html(data);
                    }

                }
            });
        }
        function getTotalNonmovementMedicine(id) {
            $('#getTotalNonmovementMedicine').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTotalNonmovementMedicine.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTotalNonmovementMedicine').html(0);
                    } else {
                        $('#getTotalNonmovementMedicine').html(data);
                    }

                }
            });
        }
        function getSlowMovementMedicine(id) {
            $('#getSlowMovementMedicine').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getSlowMovementMedicine.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getSlowMovementMedicine').html(0);
                    } else {
                        $('#getSlowMovementMedicine').html(data);
                    }

                }
            });
        }
        function getTotalAdmin(id) {
            $('#getTotalAdmin').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTotalAdmin.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTotalAdmin').html(0);
                    } else {
                        $('#getTotalAdmin').html(data);
                    }

                }
            });
        }
        function getTotalSaleToday(id) {
            $('#getTotalSaleToday').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTotalSaleToday.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTotalSaleToday').html(0);
                    } else {
                        $('#getTotalSaleToday').html(data);
                    }

                }
            });
        }
        function getTotalSaleReturnToday(id) {
            $('#getTotalSaleReturnToday').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTotalSaleReturnToday.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTotalSaleReturnToday').html(0);
                    } else {
                        $('#getTotalSaleReturnToday').html(data);
                    }

                }
            });
        }
        function getTotalCollectionToday(id) {
            $('#getTotalCollectionToday').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTotalCollectionToday.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTotalCollectionToday').html(0);
                    } else {
                        $('#getTotalCollectionToday').html(data);
                    }

                }
            });
        }
        function getTodaysIncome(id) {
            $('#getTodaysIncome').html('<img src="LoaderIcon.gif" />');
            jQuery.ajax({
                url: "contentload/getTodaysIncome.php",
                data: 'id=' + id,
                type: "POST",
                success: function (data) {
                    if (data.trim() == '') {
                        $('#getTodaysIncome').html(0);
                    } else {
                        $('#getTodaysIncome').html(data);
                    }

                }
            });
        }

        getTotalMedicine(1);
        totalProduct(1);
        totalInStock(1);
        totalStockBalance(1);
        totalCustomerDue(1);
        totalSupplierDue(1);
        getExpToday(1);
        getTodaysSale(1);
        getTodaysCollection(1);
        getTodaysPurchase(1);
        getTodaysPayment(1);
        getCustomerDuesToday(1);
        getTotalInactiveCustomer(1);
        getTotalNonmovementMedicine(1);
        getSlowMovementMedicine(1);
        getTotalAdmin(1);
        getTotalSaleToday(1);
        getTotalSaleReturnToday(1);
        getTotalCollectionToday(1);
        getTodaysIncome(1);
    </script>
    <?php include 'footer.php'; ?>
    