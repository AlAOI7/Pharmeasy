<?php
date_default_timezone_set('Asia/Dhaka');
include 'admin/core/Database.php';
include 'admin/core/Format.php';
include 'admin/class/Adminlogin.php';

$admin = new Adminlogin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>نظام ادارة الصيدلية </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="asset/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">

        </style>
        <script src="asset/jquery-1.11.1.min.js"></script>
        <script src="asset/bootstrap.min.js"></script>
    </head>
    <body>

        <!DOCTYPE html>
    <html class=''>
        <head>
            <meta charset='UTF-8'>
            <meta name="robots" content="noindex">
            <style class="cp-pen-styles">@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300);
                * {
                    box-sizing: border-box;
                    margin: 0;
                    padding: 0;
                    font-weight: 300;
                }
                body {
                    font-family: 'Source Sans Pro', sans-serif;
                    color: white;
                    font-weight: 300;
                }
                body ::-webkit-input-placeholder {
                    /* WebKit browsers */
                    font-family: 'Source Sans Pro', sans-serif;
                    color: white;
                    font-weight: 300;
                }
                body :-moz-placeholder {
                    /* Mozilla Firefox 4 to 18 */
                    font-family: 'Source Sans Pro', sans-serif;
                    color: white;
                    opacity: 1;
                    font-weight: 300;
                }
                body ::-moz-placeholder {
                    /* Mozilla Firefox 19+ */
                    font-family: 'Source Sans Pro', sans-serif;
                    color: white;
                    opacity: 1;
                    font-weight: 300;
                }
                body :-ms-input-placeholder {
                    /* Internet Explorer 10+ */
                    font-family: 'Source Sans Pro', sans-serif;
                    color: white;
                    font-weight: 300;
                }
                .wrapper {
                    background: #50a3a2;
                    background: -webkit-linear-gradient(top left, #50a3a2 0%, #53e3a6 100%);
                    background: linear-gradient(to bottom right, #50a3a2 0%, #53e3a6 100%);
                    position: absolute;
                    top: 0%;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    margin-top: 0px;
                    overflow: hidden;
                }
                .wrapper.form-success .container h1 {
                    -webkit-transform: translateY(85px);
                    transform: translateY(85px);
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    top: 10%;
                    padding: 80px 0;
                    height: 400px;
                    text-align: center;
                }
                .container h1 {
                    font-size: 40px;
                    -webkit-transition-duration: 1s;
                    transition-duration: 1s;
                    -webkit-transition-timing-function: ease-in-put;
                    transition-timing-function: ease-in-put;
                    font-weight: 200;
                }
                form {
                    padding: 20px 0;
                    position: relative;
                    z-index: 2;
                }

                form button {
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    appearance: none;
                    outline: 0;
                    background-color: white;
                    border: 0;
                    padding: 10px 15px;
                    color: #000000;
                    border-radius: 3px;
                    width: 250px;
                    cursor: pointer;
                    font-size: 18px;
                    font-weight: bold;
                    -webkit-transition-duration: 0.25s;
                    transition-duration: 0.25s;
                }
                form button:hover {
                    background-color: #f5f7f9;
                }
                .bg-bubbles {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 1;
                }
                .bg-bubbles li {
                    position: absolute;
                    list-style: none;
                    display: block;
                    width: 40px;
                    height: 40px;
                    background-color: rgba(255, 255, 255, 0.15);
                    bottom: -160px;
                    -webkit-animation: square 25s infinite;
                    animation: square 25s infinite;
                    -webkit-transition-timing-function: linear;
                    transition-timing-function: linear;
                }
                .bg-bubbles li:nth-child(1) {
                    left: 10%;
                }
                .bg-bubbles li:nth-child(2) {
                    left: 20%;
                    width: 80px;
                    height: 80px;
                    -webkit-animation-delay: 2s;
                    animation-delay: 2s;
                    -webkit-animation-duration: 17s;
                    animation-duration: 17s;
                }
                .bg-bubbles li:nth-child(3) {
                    left: 25%;
                    -webkit-animation-delay: 4s;
                    animation-delay: 4s;
                }
                .bg-bubbles li:nth-child(4) {
                    left: 40%;
                    width: 60px;
                    height: 60px;
                    -webkit-animation-duration: 22s;
                    animation-duration: 22s;
                    background-color: rgba(255, 255, 255, 0.25);
                }
                .bg-bubbles li:nth-child(5) {
                    left: 70%;
                }
                .bg-bubbles li:nth-child(6) {
                    left: 80%;
                    width: 120px;
                    height: 120px;
                    -webkit-animation-delay: 3s;
                    animation-delay: 3s;
                    background-color: rgba(255, 255, 255, 0.2);
                }
                .bg-bubbles li:nth-child(7) {
                    left: 32%;
                    width: 160px;
                    height: 160px;
                    -webkit-animation-delay: 7s;
                    animation-delay: 7s;
                }
                .bg-bubbles li:nth-child(8) {
                    left: 55%;
                    width: 20px;
                    height: 20px;
                    -webkit-animation-delay: 15s;
                    animation-delay: 15s;
                    -webkit-animation-duration: 40s;
                    animation-duration: 40s;
                }
                .bg-bubbles li:nth-child(9) {
                    left: 25%;
                    width: 10px;
                    height: 10px;
                    -webkit-animation-delay: 2s;
                    animation-delay: 2s;
                    -webkit-animation-duration: 40s;
                    animation-duration: 40s;
                    background-color: rgba(255, 255, 255, 0.3);
                }
                .bg-bubbles li:nth-child(10) {
                    left: 90%;
                    width: 160px;
                    height: 160px;
                    -webkit-animation-delay: 11s;
                    animation-delay: 11s;
                }
                @-webkit-keyframes square {
                    0% {
                        -webkit-transform: translateY(0);
                        transform: translateY(0);
                    }
                    100% {
                        -webkit-transform: translateY(-700px) rotate(600deg);
                        transform: translateY(-700px) rotate(600deg);
                    }
                }
                @keyframes square {
                    0% {
                        -webkit-transform: translateY(0);
                        transform: translateY(0);
                    }
                    100% {
                        -webkit-transform: translateY(-700px) rotate(600deg);
                        transform: translateY(-700px) rotate(600deg);
                    }
                }
                .txt1 {
                    font-family: sans-serif;
                    font-size: 18px;
                    line-height: 1.4;
                    color: #ffffff;
                    z-index: 1000;
                }
            </style>
        </head>
        <body>
            <div class="wrapper">
                <div class="container">
                    <?php
                    $GetInfo = $admin->getNameInfo();
                    if ($GetInfo) {
                        while ($result = $GetInfo->fetch_assoc()) {
                            ?>
                            <h1><?php echo $result['store_name']; ?></h1>
                            <?php
                        }
                    }
                    ?>
                    <form class="form" action="admin/admin-login.php">
                        <button type="submit" id="login-button1">تسجيل دخول</button><br><br><br>
                        <a href="#" class="txt1"  style="color:#f00;">تطوير من قبل alaoi</a>
                    </form>
                </div>
                <ul class="bg-bubbles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <script src='asset/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
            <script src='asset/jquery.min.js'></script>
            <script >
                $("#login-button").click(function (event) {
                    event.preventDefault();

                    $('form').fadeOut(500);
                    $('.wrapper').addClass('form-success');
                });
                //# sourceURL=pen.js
            </script>
        </body></html>
    <script type="text/javascript">

    </script>
</body>
</html>
