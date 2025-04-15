<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php" aria-expanded="false">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span class="hide-menu">لوحة التحكم</span>
                </a>
            </li>
                <?php
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Medicine = "Medicine";
                foreach ($comma as $sname) {
                    if ($sname == $Medicine) {
                        ?>
                        <li class="sidebar-item">
                             <a class="sidebar-link waves-effect waves-dark" href="medicine-product.php" aria-expanded="false">
                                <i class="fas fa-capsules"></i><span class="hide-menu">الدواء/المنتج</span></a></li>
                        <?php
                    }
                }
                ?>
                <?php
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Purchase = "Purchase";
                foreach ($comma as $sname) {
                    if ($sname == $Purchase) {
                        ?>
                        <li class="sidebar-item">
                             <a class="sidebar-link waves-effect waves-dark" href="purchase.php" aria-expanded="false">
                            <i class="fab fa-product-hunt"></i><span class="hide-menu">المشتريات</span></a>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    $ab = $_SESSION['access_permission'];
                    $comma = explode(",", $ab);
                    $Payment = "Payment";
                    foreach ($comma as $sname) {
                        if ($sname == $Payment) {
                            ?>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark" href="payment.php" aria-expanded="false">
                                <i class="fab fa-amazon-pay"></i><span class="hide-menu">الدفع</span></a>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    $ab = $_SESSION['access_permission'];
                    $comma = explode(",", $ab);
                    $POS = "POS";
                    foreach ($comma as $sname) {
                        if ($sname == $POS) {
                            ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="pos.php" aria-expanded="false">
                            <i class="fas fa-cart-plus"></i><span class="hide-menu">نقاط البيع</span></a>
                            <?php
                        }
                    }
                    ?>

                    <?php
                    $ab = $_SESSION['access_permission'];
                    $comma = explode(",", $ab);
                    $POS = "Collection";
                    foreach ($comma as $sname) {
                        if ($sname == $POS) {
                            ?>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark" href="collection.php" aria-expanded="false">
                                <i class="fas fa-dollar-sign"></i><span class="hide-menu">المجموعات</span></a></li>

                        <?php
                    }
                }
                ?>
                <?php
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Customer = "Customer";
                foreach ($comma as $sname) {
                    if ($sname == $Customer) {
                        ?>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark" href="customer.php" aria-expanded="false">
                                <i class="fas fa-user"></i><span class="hide-menu">العملاء</span></a></li>

                        <?php
                    }
                }
                ?>
                <?php
               $ab = $_SESSION['access_permission'];
               $comma = explode(",", $ab);
               $Supplier = "Supplier";
               foreach ($comma as $sname) {
                   if ($sname == $Supplier) {
                        ?>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark" href="supplier.php" aria-expanded="false">
                                <i class="fas fa-users"></i><span class="hide-menu">الموردين</span></a></li>

                        <?php
                   }
               }
                ?>
                <?php
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Finance = "Finance";
                foreach ($comma as $sname) {
                    if ($sname == $Finance) {
                        ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="finance.php" aria-expanded="false"><i class="far fa-credit-card">

                        </i><span class="hide-menu">التمويل</span></a></li>
                        <?php
                    }
                }
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Setting = "Setting";
                foreach ($comma as $sname) {
                    if ($sname == $Setting) {
                        ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="setting.php" aria-expanded="false">
                            <i class="fas fa-cogs"></i><span class="hide-menu">الاعدادات</span></a>
                        </li>
                <?php
                    }
                }
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Backup = "Backup";
                foreach ($comma as $sname) {
                    if ($sname == $Backup) {
                ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="exp-imp.php" aria-expanded="false">
                            <i class="fas fa-arrow-down"></i><span class="hide-menu">التسخة الاحتياطية</span></a>
                        </li>
                        <?php
                    }
                }
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Lh = "Login History";
                foreach ($comma as $sname) {
                    if ($sname == $Lh) {
                        ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="admin-login-history.php" aria-expanded="false"><i class="fas fa-sign-in-alt">

                        </i><span class="hide-menu">سجل تسجيل الدخول</span></a>
                            <!--                            <ul aria-expanded="false" class="collapse  first-level">
                                                            <li class="sidebar-item"><a href="admin-login-history.php" class="sidebar-link"><i class="fas fa-user"></i><span class="hide-menu">User</span></a></li>
                                                            <li class="sidebar-item"><a href="salesman-login-history.php" class="sidebar-link"><i class="fas fa-user"></i><span class="hide-menu">Salesman</span></a></li>
                                                        </ul>-->
                        </li>
                        <?php
                    }
                }
                $ab = $_SESSION['access_permission'];
                $comma = explode(",", $ab);
                $Report = "Report";
                foreach ($comma as $sname) {
                    if ($sname == $Report) {
                        ?>
                        <li class="sidebar-item">
                             <a class="sidebar-link waves-effect waves-dark" href="report.php" aria-expanded="false">
                                <i class="fas fa-chart-area"></i><span class="hide-menu">التقارير</span></a>

                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </nav>
    </div>
</aside>