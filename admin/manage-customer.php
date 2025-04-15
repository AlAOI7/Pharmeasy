<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $cusDel = $admin->deleteCustomer($id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['followup_date_submit'])) {
    $id = $_POST['cus_id'];
    $followup_date = $_POST['followup_date'];
    $followup_date_cus = $admin->customerFolloup($id, $followup_date);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Customer</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">customer</li>
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
                    if (isset($cusDel)) {
                        echo $cusDel;
                    }
                    if (isset($followup_date_cus)) {
                        echo $followup_date_cus;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Customer</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Location</th>
                                        <th>Followup Date</th>
                                        <th>Dues</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getCus = $admin->getAllCustomer();
                                    if ($getCus) {
                                        $i = 0;
                                        $totalDue = 0;
                                        while ($result = $getCus->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a target="_blank" href="customer-ledger.php?clid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></td>
                                                <td><?php echo $result['mobile']; ?></td>
                                                <td><?php echo $result['location']; ?></td>
                                                <form class="form-horizontal" method="post" action="">
                                                    <td>
                                                        <input type="date" class="form-control" name="followup_date" value="<?php echo $result['followup_date']; ?>" required="">
                                                        <input type="hidden" class="form-control" name="cus_id" value="<?php echo $result['id']; ?>" required="">
                                                        <button type="submit" name="followup_date_submit" class="btn btn-danger btn-sm">Submit</button>
                                                    </td>
                                                </form>
                                        <td><?php echo $totD = $result['balance']; ?></td>
                                        <td>
                                            <?php
                                            if ($result['status'] == 1) {
                                                echo '<span class="label label-success">Active</span>';
                                            } else {
                                                echo '<span class="label label-danger">Inactive</span>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($result['id'] != '1') {
                                                ?>
                                                <?php
                                                $ab = $_SESSION['access_permission'];
                                                $comma = explode(",", $ab);
                                                $editCus = "editCus";
                                                foreach ($comma as $sname) {
                                                    if ($sname == $editCus) {
                                                        ?>
                                                        <a href="edit-customer.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm"><i class="fas fa-pencil-alt"></i></button></a>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php
                                                $ab = $_SESSION['access_permission'];
                                                $comma = explode(",", $ab);
                                                $delCus = "delCus";
                                                foreach ($comma as $sname) {
                                                    if ($sname == $delCus) {
                                                        ?>
                                                        <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-danger btn-sm">x</button></a>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        </tr>
                                        <?php
                                        $totalDue = $totalDue + $totD;
                                    }
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="4">Total</th>
                                <th><?php
                                    if (isset($totalDue)) {
                                        echo $totalDue;
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