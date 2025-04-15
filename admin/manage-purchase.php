<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $cmnId = $medicine->getOneCol('invoice_number', 'supplier_invoice_info', 'id', $delid);
    $stkUpd = $medicine->updateProductPurchaseStock($cmnId);
    if ($stkUpd) {
        $supID = $medicine->getOneCol('supplier', 'supplier_invoice_info', 'id', $delid);
        $due = $medicine->getOneCol('dues', 'supplier_invoice_info', 'id', $delid);
        $preDue = $medicine->getOneCol('balance', 'company', 'id', $supID);
        $currentDue = $preDue - $due;
        $cusDueUpd = $medicine->supDueUpdate($supID, $currentDue);
        if ($cusDueUpd) {
            $supInvDel = $medicine->deleteSupInv($delid);
        }
    }
}
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getSupInv = $medicine->select_all_supplier_invoice_info_datewise($from, $to);
} else {
    $getSupInv = $medicine->select_all_supplier_invoice_info();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">ادارة المشتريات</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">المشتريات</li>
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
                    if (isset($supInvDel)) {
                        echo $supInvDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">كل المشتريات</h5>
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
                                                class="btn btn-success">بحث </button>
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
                                        <th>فاتورة</th>
                                        <th>موردين</th>
                                        <th>مجموع</th>
                                        <th>القيمة</th>
                                        <th>استحقاق</th>
                                        <th>طرف الدفع</th>
                                        <th>تاريخ الشراء</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getSupInv) {
                                        $i = 0;
                                        $total = 0;
                                        $amount = 0;
                                        $tdues = 0;
                                        while ($result = $getSupInv->fetch_assoc()) {
                                            $i++;
                                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a target="_blank"
                                                href="supinv.php?invid=<?php echo $result['invoice_number']; ?>"><?php echo $result['invoice_number']; ?></a>
                                        </td>
                                        <td>
                                            <?php
                                                    $supName = $medicine->getOneCol('company_name', 'company', 'id', $result['supplier']);
                                                    echo $supName;
                                                    ?>
                                        </td>
                                        <td><?php echo $tot = $result['total_amount']; ?></td>
                                        <td><?php echo $totA = $result['amount']; ?></td>
                                        <td><?php echo $totD = $result['dues']; ?></td>
                                        <td><?php echo $result['payment_method']; ?></td>
                                        <td><?php echo $fm->formatDate($result['purchase_date']); ?></td>

                                        <td>
                                            <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $deletePur = "deletePur";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $deletePur) {
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
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th colspan="2">Total</th>
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
                                    if (isset($amount)) {
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