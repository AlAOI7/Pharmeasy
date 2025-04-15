<?php
ob_start();
date_default_timezone_set('Asia/Dhaka'); 
include 'core/Session.php';
Session::init();
Session::checkLogin();
include 'class/Adminlogin.php';
include 'core/Database.php';
include'core/Format.php';
$al = new Adminlogin();
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['adminUser']) && isset($_POST['adminPass'])) {
        $adminUser = $_POST['adminUser'];
        $adminPass = md5($_POST['adminPass']);
        $loginChk = $al->adminLogin($adminUser, $adminPass);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
        <title>تسجيل دخول ادارة الصيدلية</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
        <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
            .login-block{
                background: #DE6262;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                float:left;
                width:100%;
                height: 100%;
                padding : 100px 0;
            }

            .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
            .carousel-inner{border-radius:0 10px 10px 0;}
            .carousel-caption{text-align:left; left:5%;}
            .login-sec{padding: 50px 30px; position:relative;}
            .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
            .login-sec .copy-text i{color:#FEB58A;}
            .login-sec .copy-text a{color:#E36262;}
            .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
            .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
            .btn-login{background: #DE6262; color:#fff; font-weight:600;}
            .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
            .banner-text h2{color:#fff; font-weight:600;}
            .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
            .banner-text p{color:#fff;}
        </style>
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
        <!------ Include the above in your HEAD tag ---------->

        <section class="login-block">
            <div class="container">
                <div class="row">
                        <div class="col-md-4 login-sec">
                            <div class="text-center">
                                <?php
                                $GetLogo = $al->getLogo();
                                if ($GetLogo) {
                                    $result = $GetLogo->fetch_assoc();
                                    ?>
                                    
                                    <img class="rounded-circle" src="images/log.png" width="110" height="110" alt="logo" data-toggle="tooltip" data-placement="top" title="" data-original-title="logo" />
                                    <!-- <img class="rounded-circle" src="images/<?php echo $result['logo']; ?>" width="110" height="110" alt="logo" data-toggle="tooltip" data-placement="top" title="" data-original-title="logo" /> -->
                                <?php } ?>
                            </div>
                            <h2 class="text-center">تسجيل دخول</h2>
                            <span style="color:#e81848;font-size:18px;">
                                <h4 class="text-center"><?php
                                    if (isset($loginChk)) {
                                        echo $loginChk;
                                    }
                                    ?></h4>
                            </span>

                            <form class="login-form" method ="post" action="">
                                <div class="form-group">
                                    <label for="adminUser" class="text-uppercase">اسم المستخدم</label>
                                    <input type="text" name="adminUser" id="adminUser" class="form-control" placeholder="ادخل اسم المستخدم" autocomplete="off">

                                </div>
                                <div class="form-group">
                                    <label for="adminPass" class="text-uppercase">كلمة السر</label>
                                    <input type="password" name="adminPass" class="form-control" placeholder="ادخال كلمة السر" autocomplete="off">
                                </div>


                                <div class="form-check">
                                    <label class="form-check-label">
                                        <a href="../index.php" class="btn btn-primary float-right">الرجوع الى الصفحة الرئيسية</a>
                                    </label>
                                    <button type="submit" class="btn btn-login float-right">دخول</button>
                                </div>

                            </form>
                            <div class="copy-text">تطوير  <i class="fa fa-heart"></i> من قبل <a href="#">Alaoi</a></div>
                        </div>
                    <div class="col-md-8 banner-sec">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid" src="images/p1.jpg" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <!--                                        <div class="banner-text">
                                                                                    <h2>This is Heaven</h2>
                                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                                                                </div>	-->
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="images/p2.jpg" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <!--                                        <div class="banner-text">
                                                                                    <h2>This is Heaven</h2>
                                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                                                                </div>	-->
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="images/p3.jpg" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <!--                                        <div class="banner-text">
                                                                                    <h2>This is Heaven</h2>
                                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                                                                </div>	-->
                                    </div>
                                </div>
                            </div>	   

                        </div>
                    </div>
                </div>
        </section>
        <script type="text/javascript">

        </script>
    </body>
</html>
<?php ob_end_flush(); ?>