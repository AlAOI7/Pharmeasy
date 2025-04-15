<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['payDelid'])) {
    $payDelid = $_GET['payDelid'];
    $paymentDel = $medicine->deletePayment($payDelid);
}

if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getPay = $medicine->getPaymentByDate($from, $to);
} else {
    $getPay = $medicine->getTodaysPayment();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">الدفع</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ادارة الدفع</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($paymentDel)) {
                        echo $paymentDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">كل الدفع</h5>
                        <div class="box-tools pull-right" align="center">
                            <form class="form-horizontal" method="post" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">من</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose"
                                                name="from" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">الى</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose1" name="to"
                                                autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name="search" style="width: 120px;"
                                                class="btn btn-success">بحث</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>الايصال No.</th>
                                        <th>المورد</th>
                                        <th>الاستخقاق السابق</th>
                                        <th>الدفع</th>
                                        <th>المستحق الحالي</th>
                                        <th>تاريخ الدفع</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getPay) {
                                        $i = 0;
                                        $totalPreDue = 0;
                                        $totalPayment = 0;
                                        $totalCurDue = 0;
                                        while ($result = $getPay->fetch_assoc()) {
                                            $i++;
                                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a target="_blank"
                                                href="payinv.php?payid=<?php echo $result['payment_receipt']; ?>"><?php echo $preDue = $result['payment_receipt']; ?></a>
                                        </td>
                                        <td>
                                            <?php
                                                    $supName = $medicine->getOneCol('company_name', 'company', 'id', $result['supplierId']);
                                                    echo $supName;
                                                    ?>
                                        </td>
                                        <td><?php echo $preDue = $result['previous_due']; ?></td>
                                        <td><?php echo $pay = $result['payment']; ?></td>
                                        <td><?php echo $totCurDue = $result['current_due']; ?></td>
                                        <td><?php echo $fm->formatDate($result['paymentDate']); ?></td>

                                        <td>
                                            <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $delPay = "delPay";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $delPay) {
                                                            ?>
                                            <a onclick="return confirm('Are you sure to delete?');"
                                                href="?payDelid=<?php echo $result['id']; ?>"><button type="button"
                                                    class="btn btn-danger btn-sm">Delete</button></a>
                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </td>
                                    </tr>
                                    <?php
                                            $totalPreDue = $totalPreDue + $preDue;
                                            $totalPayment = $totalPayment + $pay;
                                            $totalCurDue = $totalCurDue + $totCurDue;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th colspan="2">Total</th>
                                    <th>
                                        <?php
                                    if (isset($totalPreDue)) {
                                        echo $totalPreDue;
                                    } else {
                                        echo '0';
                                    };
                                    ?>
                                    </th>
                                    <th>
                                        <?php
                                    if (isset($totalPayment)) {
                                        echo $totalPayment;
                                    } else {
                                        echo '0';
                                    };
                                    ?>
                                    </th>
                                    <th>
                                        <?php
                                    if (isset($totalCurDue)) {
                                        echo $totalCurDue;
                                    } else {
                                        echo '0';
                                    };
                                    ?>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>