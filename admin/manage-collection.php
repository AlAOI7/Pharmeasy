<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['colDelid'])) {
    $colDelid = $_GET['colDelid'];
    $collectionDel = $medicine->deleteCollection($colDelid);
}
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getColl = $medicine->getCollectionByDate($from, $to);
} else {
    $getColl = $medicine->getTodaysCollection();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">المجموعات</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ادارة المجموعات</li>
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
                    if (isset($collectionDel)) {
                        echo $collectionDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">كل المجموعات</h5>
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
                                        <th>Receipt No.</th>
                                        <th>العميل</th>
                                        <th>الاستحقاق السابق</th>
                                        <th>المجموعة</th>
                                        <th>ارجاع الاستحقاق</th>
                                        <th>التاريخ</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getColl) {
                                        $i = 0;
                                        $totalPreDue = 0;
                                        $totalCollection = 0;
                                        $totalCurDue = 0;
                                        while ($result = $getColl->fetch_assoc()) {
                                            $i++;
                                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a target="_blank"
                                                href="cashinv.php?collid=<?php echo $result['collection_receipt']; ?>"><?php echo $preDue = $result['collection_receipt']; ?></a>
                                        </td>
                                        <td>
                                            <?php
                                                    $supName = $medicine->getOneCol('name', 'customer', 'id', $result['customerId']);
                                                    echo $supName;
                                                    ?>
                                        </td>
                                        <td><?php echo $preDue = $result['previous_due']; ?></td>
                                        <td><?php echo $col = $result['collection']; ?></td>
                                        <td><?php echo $totCurDue = $result['current_due']; ?></td>
                                        <td><?php echo $fm->formatDate($result['collectionDate']); ?></td>

                                        <td>
                                            <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $delCollection = "delCollection";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $delCollection) {
                                                            ?>
                                            <a onclick="return confirm('Are you sure to delete?');"
                                                href="?colDelid=<?php echo $result['id']; ?>"><button type="button"
                                                    class="btn btn-danger btn-sm">Delete</button></a>
                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </td>
                                    </tr>
                                    <?php
                                            $totalPreDue = $totalPreDue + $preDue;
                                            $totalCollection = $totalCollection + $col;
                                            $totalCurDue = $totalCurDue + $totCurDue;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th colspan="2">Total</th>
                                    <th><?php
                                    if (isset($totalPreDue)) {
                                        echo $totalPreDue;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                    <th><?php
                                    if (isset($totalCollection)) {
                                        echo $totalCollection;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
                                    <th><?php
                                    if (isset($totalCurDue)) {
                                        echo $totalCurDue;
                                    } else {
                                        echo '0';
                                    }
                                    ?></th>
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