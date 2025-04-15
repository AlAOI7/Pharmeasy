<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $incomeDate = date('Y-m-d', strtotime($_POST['incomeDate']));
    $income_amount = $_POST['income_amount'];
    $customerInsert = $report->addIncome($_POST);
    $inCshInc = $medicine->in_cash_income($incomeDate, $income_amount);
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
                            <li class="breadcrumb-item active" aria-current="page">add income</li>
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
                    if (isset($customerInsert)) {
                        echo $customerInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Add Income</h4>
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
                                                    ?>
                                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['income_head_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="uname">Amount<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="uname" name="income_amount" placeholder="Amount" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datepicker-autoclose">Date</label>
                                        <input type="text" class="form-control" id="datepicker-autoclose" autocomplete="off" name="incomeDate" placeholder="mm/dd/yyyy">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Purpose</label>
                                        <input type="text" class="form-control" id="address" name="purpose" placeholder="Purpose">
                                    </div>
                                </div>
                            </div>										
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "save" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
