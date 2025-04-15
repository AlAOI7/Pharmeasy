<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getEH = $medicine->getAllActiveExpenseHead();
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $expense_head = $_POST['expense_head'];
    $getPurReport = $report->getAllExpenseReportDateSupplier($from, $to, $expense_head);
} else {
    $getPurReport = $report->getAllExpenseReport();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Expense Report</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">expense report</li>
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
                    <div class="card-body">
                        <h5 class="card-title">All Expense Report</h5>
                        <div class="box-tools pull-right" align="center">
                            <form class="form-horizontal" method = "post" action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">From</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose" name="from" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">To</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose1" name="to" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Expense Head</label>
                                                <select name="expense_head" id="expense_head" class="form-control select2" style="width: 100%;">
                                                    <option value="">SELECT EXPENSE</option>
                                                    <?php while ($eh = $getEH->fetch_assoc()) { ?>
                                                        <option value="<?php echo $eh['id']; ?>"><?php echo $eh['expense_head_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name ="search" style="width: 120px;" class="btn btn-success">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                        <div class="table-responsive">
                            <table id="buttonTab" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Date</th>
                                        <th style="width:20px;">Expense Head</th>
                                        <th style="width:20px;">Amount</th>
                                        <th style="width:20px;">Purpose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getPurReport) {
                                        $i = 0;
                                        $Tamnt = 0;
                                        while ($result = $getPurReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $fm->formatDate($result['expense_date']); ?></td>
                                                <td>
                                                    <?php
                                                    $expense_head_name = $medicine->getOneCol('expense_head_name', 'expense_head', 'id', $result['expense_head']);
                                                    echo $expense_head_name;
                                                    ?>
                                                </td>
                                                <td><?php echo $ta = $result['expense_amount']; ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                            </tr>
                                            <?php
                                            $Tamnt = $Tamnt + $ta;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th>
                                    <?php
                                    if (isset($Tamnt)) {
                                        echo $Tamnt;
                                    }
                                    ?>
                                </th>
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





