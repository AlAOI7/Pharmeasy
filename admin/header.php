<?php
ob_start();
date_default_timezone_set('Asia/Dhaka');
include 'core/Session.php';
Session::init();
Session::checkSession();
include 'core/Database.php';
include'core/Format.php';
include 'class/Adminlogin.php';
include 'class/Medicine.php';
include 'class/Report.php';

$fm = new Format();
$admin = new Adminlogin();
$medicine = new Medicine();
$report = new Report();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
        <title><?php echo basename($_SERVER['PHP_SELF'], '.php'); ?></title>
        <!-- Custom CSS -->
        <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="dist/css/style.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/jquery-minicolors/jquery.minicolors.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

        <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
        <link href="assets/libs/datatables/jquery.dataTables.min.css" rel="stylesheet">
        <link href="assets/libs/datatables/buttons.dataTables.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<!--        <script>
            $(document).ready(function () {
                $("#search-box").keyup(function () {
                    $.ajax({
                        type: "POST",
                        url: "loadpage/readCountry.php",
                        data: 'keyword=' + $(this).val(),
                        beforeSend: function () {
                            $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $("#suggesstion-box").show();
                            $("#suggesstion-box").html(data);
                            $("#search-box").css("background", "#FFF");
                        }
                    });
                });
            });

            function selectCountry(val) {
                $("#search-box").val(val);
                $("#suggesstion-box").hide();
            }
        </script>
        <script>
            $(document).ready(function () {
                $("#search-box-sup").keyup(function () {
                    $.ajax({
                        type: "POST",
                        url: "loadpage/readSupplier.php",
                        data: 'keyword=' + $(this).val(),
                        beforeSend: function () {
                            $("#search-box-sup").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $("#suggesstion-box-sup").show();
                            $("#suggesstion-box-sup").html(data);
                            $("#search-box-sup").css("background", "#FFF");
                        }
                    });
                });
            });

            function selectCountry(val) {
                $("#search-box-sup").val(val);
                $("#suggesstion-box-sup").hide();
            }
        </script>
        <script>
            $(document).ready(function () {
                $("#search-box-cus").keyup(function () {
                    $.ajax({
                        type: "POST",
                        url: "loadpage/readCustomer.php",
                        data: 'keyword=' + $(this).val(),
                        beforeSend: function () {
                            $("#search-box-cus").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $("#suggesstion-box-cus").show();
                            $("#suggesstion-box-cus").html(data);
                            $("#search-box-cus").css("background", "#FFF");
                        }
                    });
                });
            });

            function selectCountry(val) {
                $("#search-box-cus").val(val);
                $("#suggesstion-box-cus").hide();
            }
        </script>-->
        <style>
            .frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
            #country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
            #country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
            #country-list li:hover{background:#ece3d2;cursor: pointer;}
            #search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
        </style>
        <style>
            .form-control{
                border: 1px solid #07203a;
            }
            .select2-selection--single {
                border: 1px solid #061e3a!important;
                min-height: 37px!important;

            }
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 34px!important;
                margin-left: 14px;
            }
            .tbl th {
                background-color: #2255a4;
                color: white;
                border: 1px solid #ddd;
                padding: 8px;
                font-size: 18px;
                font-weight: bold;
            }

            .supinv th {
                background-color: #d2bbb5;
                color: #010910;
                border: 1px solid #ddd;
                padding: 8px;
                font-size: 18px;
                font-weight: bold;
            }
            .tblReport th {
                background-color: #2255a4;
                color: #ffffff;
                border: 1px solid #ddd;
                padding: 8px;
                font-size: 18px;
                font-weight: bold;
            }
        </style>
        <style>
            @media print {
                #printbtn {
                    display :  none;
                }
                #closeButton {
                    display :  none;
                }
            }
        </style>
    </head>

    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
    
            <div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">
             
            <div id="main-wrapper">
                <header class="topbar" data-navbarbg="skin5">
                    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                        <div class="navbar-header" data-logobg="skin5">
                            <!-- This is for the sidebar toggle which is visible on mobile only -->
                            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                            <a class="navbar-brand" href="dashboard.php">
                                <!-- Logo icon -->
                                <b class="logo-icon p-l-10">
                                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                    <!-- Dark Logo icon -->
                                    <!--<img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />-->

                                </b>
                                <!--End Logo icon -->
                                <!-- Logo text -->
                                <span class="logo-text">
                                    <!-- dark Logo text -->
                                    <img src="assets/images/log.png" width="170px" alt="homepage" class="light-logo" />

                                </span>
                                <!-- Logo icon -->
                                <!-- <b class="logo-icon"> -->
                                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                                <!-- </b> -->
                                <!--End Logo icon -->
                            </a>
                            <!-- ============================================================== -->
                            <!-- End Logo -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Toggle which is visible on mobile only -->
                            <!-- ============================================================== -->
                            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-left mr-auto">
                                <li class="nav-item d-none d-md-block">
                                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i>
                                    </a>
                                </li>
                                <!-- ============================================================== -->
                                <!-- create new -->
                                <!-- ============================================================== -->
                                <ul class="navbar-nav float-left mr-auto">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="d-none d-md-block"></span> 
                                        </a>
                                    </li>
                                </ul>
                                <!-- ============================================================== -->
                                <!-- Search -->
                                <!-- ============================================================== -->

                            </ul>
                            <!-- ============================================================== -->
                            <!-- Right side toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-right">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span style="color: #da542e; font-weight:bold;"> <i class="mdi mdi-bell font-24"></i></span><sup id="customerFollowup">0</sup>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                        <ul class="list-style-none">
                                            <li>
                                                <div class="">
                                                    <!-- Message -->
                                                    <a href="customer-followup.php" class="link border-top">
                                                        <div class="d-flex no-block align-items-center p-10">
                                                            <span class="btn btn-info btn-circle"><i class="fas fa-users"></i></span>
                                                            <div class="m-l-10">
                                                                <h5 class="m-b-0">Pending Collection</h5> 
                                                                <span class="mail-desc" id="customerFollowup2">0</span> 
                                                                <span class="mail-desc">Customer's have pending collection!</span> 
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span style="color: #da542e; font-weight:bold;"> <i class="mdi mdi-bell font-24"></i></span><sup id="totalItemWiseStock">0</sup>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                        <ul class="list-style-none">
                                            <li>
                                                <div class="">
                                                    <!-- Message -->
                                                    <a href="stock-report-item.php" class="link border-top">
                                                        <div class="d-flex no-block align-items-center p-10">
                                                            <span class="btn btn-info btn-circle"><i class="fas fa-tablets"></i></span>
                                                            <div class="m-l-10">
                                                                <h5 class="m-b-0">Out of Stock</h5> 
                                                                <span class="mail-desc" id="totalItemWiseStock2">0</span> 
                                                                <span class="mail-desc">Medicines / Products are going to be out of stock!</span> 
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <ul class="navbar-nav float-right">

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span style="color: #da542e; font-weight:bold;"> <i class="mdi mdi-bell font-24"></i></span><sup id="getTotalMedicineExprieStockh1">0</sup>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                            <ul class="list-style-none">
                                                <li>
                                                    <div class="">
                                                        <!-- Message -->
                                                        <a href="expired-report.php" class="link border-top">
                                                            <div class="d-flex no-block align-items-center p-10">
                                                                <span class="btn btn-info btn-circle"><i class="fas fa-tablets"></i></span>
                                                                <div class="m-l-10">
                                                                    <h5 class="m-b-0">Expired</h5> 
                                                                    <span class="mail-desc" id="getTotalMedicineExprieStockh2">0</span> 
                                                                    <span class="mail-desc"> Medicines / Products are expired already!</span> 
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span style="color: #da542e; font-weight:bold;"> <i class="mdi mdi-bell font-24"></i></span><sup id="getTotalMedicineExprieSoonStockh1"><b><?php echo $totalExpiredSoonStock; ?></b></sup>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                            <ul class="list-style-none">
                                                <li>
                                                    <div class="">
                                                        <!-- Message -->
                                                        <a href="expired-soon-report.php" class="link border-top">
                                                            <div class="d-flex no-block align-items-center p-10">
                                                                <span class="btn btn-info btn-circle"><i class="fas fa-tablets"></i></span>
                                                                <div class="m-l-10">
                                                                    <h5 class="m-b-0">Expired Soon</h5> 
                                                                    <span class="mail-desc" id="getTotalMedicineExprieSoonStockh2"></span> 
                                                                    <span class="mail-desc">Medicines / Products are expired soon.!</span> 
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>


                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span style="color: #da542e; font-weight:bold;"> <i class="mdi mdi-bell font-24"></i></span><sup id="totalOutStock">0</sup>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                            <ul class="list-style-none">
                                                <li>
                                                    <div class="">
                                                        <!-- Message -->
                                                        <a href="out-stock-report.php" class="link border-top">
                                                            <div class="d-flex no-block align-items-center p-10">
                                                                <span class="btn btn-info btn-circle"><i class="fas fa-tablets"></i></span>
                                                                <div class="m-l-10">
                                                                    <h5 class="m-b-0">Out of Stock</h5> 
                                                                    <span class="mail-desc" id="totalOutStock2">0</span> 
                                                                    <span class="mail-desc">Medicines / Products are out of stock!</span> 
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>


                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                                        <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i><?php echo Session::get('adminUser'); ?></a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="changepassword.php"><i class="ti-settings m-r-5 m-l-5"></i>تغيير كبمة السر</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="?id=<?php Session::get('adminId'); ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> خروج</a>
                                            <?php
                                            if (isset($_GET['id'])) {

                                                Session::destroy();
                                            }
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                        </div>
                    </nav>
                </header>
                <!-- ============================================================== -->
                <!-- End Topbar header -->
                <!-- ============================================================== -->