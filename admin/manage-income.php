<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $incomeDel = $report->deleteIncome($delid);
}
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $getIncome = $report->getIncomeByDate($from, $to);
} else {
    $getIncome = $report->getTodaysIncome();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Income</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">income</li>
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
                    if (isset($incomeDel)) {
                        echo $incomeDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Income</h5>
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
                            <a href="add-income.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add Income</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Income Head</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getIncome) {
                                        $i = 0;
                                        while ($result = $getIncome->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php
                                                    $head = $medicine->getOneCol('income_head_name', 'income_head', 'id', $result['income_head']);
                                                    echo $head;
                                                    ?>
                                                </td>
                                                <td><?php echo $result['income_amount']; ?></td>
                                                <td><?php echo $result['income_date']; ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                                <td>
                                                    <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $editInc = "editInc";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $editInc) {
                                                            ?>
                                                            <a href="edit-income.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm"><i class="fas fa-pencil-alt"></i></button></a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php
                                                    $ab = $_SESSION['access_permission'];
                                                    $comma = explode(",", $ab);
                                                    $delInc = "delInc";
                                                    foreach ($comma as $sname) {
                                                        if ($sname == $delInc) {
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

