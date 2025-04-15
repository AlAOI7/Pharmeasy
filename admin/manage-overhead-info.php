<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $expenseDel = $report->deleteOverheadInfo($delid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Overhead Info</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">overhead info</li>
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
                        <h5 class="card-title">All Overhead Info</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-overhead-info.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add Overhead</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Overhead</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getExpense = $report->getAllOverheadInfo();
                                    if ($getExpense) {
                                        $i = 0;
                                        while ($result = $getExpense->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php
                                                    $head = $medicine->getOneCol('overhead_name', 'overhead', 'id', $result['overhead_info_head']);
                                                    echo $head;
                                                    ?>
                                                </td>
                                                <td><?php echo $result['overhead_info_amount']; ?></td>
                                                <td><?php echo $fm->formatDate($result['overhead_info_date']); ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                                <td>
                                                    <!--<a href="edit-expense.php?sid=<?php //echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm">Edit</button></a>-->
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
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





