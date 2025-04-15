<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $expenseDel = $report->deleteExpense($delid);
}

if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getExpense = $report->getExpenseByDate($from, $to);
} else {
    $getExpense = $report->getTodaysExpense();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Expense</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">expense</li>
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
                    if (isset($expenseDel)) {
                        echo $expenseDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Expense</h5>
                        <div class="box-tools pull-left" align="center">
                            <form class="form-horizontal" method = "post" action="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">From</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose" name="from" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">To</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose1" name="to" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name ="search" style="width: 120px;" class="btn btn-success">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-expense.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add Expense</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Others Expense</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getExpense) {
                                        $i = 0;
                                        while ($result = $getExpense->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php
                                                    $head = $medicine->getOneCol('expense_head_name', 'expense_head', 'id', $result['expense_head']);
                                                    echo $head;
                                                    ?>
                                                </td>
                                                <td><?php echo $result['expense_amount']; ?></td>
                                                <td><?php echo $fm->formatDate($result['expense_date']); ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                                <td>
                                                    <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $editExp = "editExp";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $editExp) {
                                                            ?>
                                                            <a href="edit-expense.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm"><i class="fas fa-pencil-alt"></i></button></a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $delExp = "delExp";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $delExp) {
                                                            ?>
                                                            <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-danger btn-sm">X</button></a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>



