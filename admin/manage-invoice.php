<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $stkUpd = $medicine->updateProductStock($delid);
    if ($stkUpd) {
        $cusID = $medicine->getOneCol('customer', 'customer_invoice_info', 'id', $delid);
        $due = $medicine->getOneCol('inv_due', 'customer_invoice_info', 'id', $delid);
        $preDue = $medicine->getOneCol('balance', 'customer', 'id', $cusID);
        $currentDue = $preDue - $due;
        $cusDueUpd = $medicine->cusDueUpdate($cusID, $currentDue);
        if ($cusDueUpd) {
            $supInvDel = $medicine->deleteInv($delid);
        }
    }
}

if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getCusInv = $medicine->select_all_customer_invoice_info_datewise($from, $to);
} else {
    $getCusInv = $medicine->select_all_customer_invoice_info();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">ادارة الفاتورة/h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">الفاتورة</li>
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
//                    if (isset($supInvDel)) {
//                        echo $supInvDel;
//                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">كل الفواتير</h5>
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
                                                class="btn btn-success">البحث</button>
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
                                        <th>الفواتير</th>
                                        <th>العميل</th>
                                        <th>Cash</th>
                                        <th>المجموع (Cash + Due)</th>
                                        <th>القيمة </th>
                                        <th>المستحق</th>
                                        <th>طرق الدفع</th>
                                        <th>التاريخ</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getCusInv) {
                                        $i = 0;
                                        $total = 0;
                                        $amount = 0;
                                        $tdues = 0;
                                        $saleToday = 0;
                                        while ($result = $getCusInv->fetch_assoc()) {
                                            $i++;
                                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a target="_blank"
                                                href="cusinv.php?invid=<?php echo $result['id']; ?>"><?php echo $result['invoice_number']; ?></a>
                                        </td>
                                        <td>
                                            <?php
                                                    $supName = $medicine->getOneCol('name', 'customer', 'id', $result['customer']);
                                                    echo $supName;
                                                    ?>
                                        </td>
                                        <td>
                                            <?php
                                                    $cashPaid = $result['amount'];
                                                    $change = $result['changeAmount'];
                                                    echo $totSales = $cashPaid + $change;
                                                    ?>
                                        </td>
                                        <td><?php echo $tot = $result['total_amount']; ?></td>
                                        <td><?php echo $totA = $result['amount']; ?></td>
                                        <td><?php echo $totD = $result['dues']; ?></td>
                                        <td><?php echo $result['payment_method']; ?></td>
                                        <td><?php echo $fm->formatDate($result['sale_date']).' at '.$fm->formatTime($result['invdatetime']); ?>
                                        </td>

                                        <td>
                                            <a target="_blank"
                                                href="pos/example/interface/windows-usb.php?inv=<?php echo $result['invoice_number']; ?>"><i
                                                    class="fas fa-print"></i></a>
                                            <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $deleteInv = "deleteInv";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $deleteInv) {
                                                            ?>
                                            <a onclick="return confirm('Are you sure to delete?');"
                                                href="?delid=<?php echo $result['id']; ?>"><button type="button"
                                                    class="btn btn-danger btn-sm">حذف</button></a>
                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </td>
                                    </tr>
                                    <?php
                                            $total = $total + $tot;
                                            $amount = $amount + $totA;
                                            $tdues = $tdues + $totD;
                                            $saleToday += $totSales;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th colspan="2">Total</th>
                                    <th><?php
                                    if (isset($saleToday)) {
                                        echo $saleToday;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                    <th><?php
                                    if (isset($total)) {
                                        echo $total;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                    <th><?php
                                    if (isset($amount)) {
                                        echo $amount;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                    <th><?php
                                    if (isset($tdues)) {
                                        echo $tdues;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                    <th></th>
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