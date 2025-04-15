<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $exDel = $report->deleteExpenseHead($delid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Expense Head</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">expense head</li>
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
                    if (isset($exDel)) {
                        echo $exDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Expense Head</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-expense-head.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add Expense Head</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Expense Head</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getHead = $report->getAllExpenseHead();
                                    if ($getHead) {
                                        $i = 0;
                                        while ($result = $getHead->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['expense_head_name']; ?></td>
                                                <td>
                                                    <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
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

