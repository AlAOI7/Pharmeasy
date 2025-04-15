<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-income.php';</script>";
} else {
    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $incomeUpdate = $report->updateIncome($_POST, $sid);
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
                            <li class="breadcrumb-item active" aria-current="page">edit income</li>
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
                    if (isset($incomeUpdate)) {
                        echo $incomeUpdate;
                    }
                    ?>
                    <?php
                    $getInfo = $report->getIncomeById($sid);
                    if ($getInfo) {
                        while ($res = $getInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Income</h4>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lname">Income Head<span style="color: red"> *</span></label>
                                                <select class="form-control" name="incomeHead" required>
                                                    <option>Select</option>
                                                    <?php
                                                    $getType = $report->getAllIncomeHead();
                                                    if ($getType) {
                                                        while ($result = $getType->fetch_assoc()) {
                                                            if ($res['income_head'] == $result['id']) {
                                                                ?>
                                                    <option value="<?php echo $result['id']; ?>" selected="selected"><?php echo $result['income_head_name']; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $result['id']; ?>"><?php echo $result['income_head_name']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="uname">Amount<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="uname" name="income_amount" value="<?php echo $res['income_amount'];?>" placeholder="Amount" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker-autoclose">Date</label>
                                                <input type="text" class="form-control" id="datepicker-autoclose" autocomplete="off" name="incomeDate" value="<?php echo $res['income_date'];?>" placeholder="mm/dd/yyyy">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Purpose</label>
                                                <input type="text" class="form-control" id="address" name="purpose" value="<?php echo $res['purpose'];?>" placeholder="Purpose">
                                            </div>
                                        </div>
                                    </div>										
                                </div>
                                <div class="border-top">
                                    <div class="card-body" align="center">
                                        <button type="submit" name = "save" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

