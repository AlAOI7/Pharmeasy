<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));

    $getSaleReport = $report->getSalesReport($from, $to);
    $getIncReport = $report->getIncomeReport($from, $to);
    $getOhReport = $report->getOhReport($from, $to);
    $getExReport = $report->getExpReport($from, $to);
}
//else {
//    $getSaleReport = $report->getSalesRep();
//}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Profit</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">profit</li>
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
                        <h5 class="card-title">All Profit Report</h5>
                        <div class="box-tools pull-right" align="center">
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
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table id="zero_config2" class="table table-striped table-bordered display tblReport">
                                        <thead>
                                            <tr>
                                                <th style="width:10px;">SL</th>
                                                <th style="width:20px;">Head</th>
                                                <th style="width:20px;">Date</th>
                                                <th style="width:20px;">Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($getSaleReport)) {
                                                $i = 0;
                                                $totalProfit = 0;
                                                while ($result = $getSaleReport->fetch_assoc()) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo 'Sales'; ?></td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($result['sale_date'])); ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $tnet = $result['totalNetAmount'];
                                                            $tamt = $result['total_amount'];
                                                            echo $profit = $tamt - $tnet;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $totalProfit = $totalProfit + $profit;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <?php
                                            if (isset($totalProfit)) {
                                                echo $totalProfit;
                                            }
                                            ?>
                                        </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered display tblReport">
                                        <thead>
                                            <tr>
                                                <th style="width:10px;">SL</th>
                                                <th style="width:20px;">Overhead</th>
                                                <th style="width:20px;">Date</th>
                                                <th style="width:20px;">Overhead Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($getOhReport) {
                                                $i = 0;
                                                $totalOhCost = 0;
                                                while ($res = $getOhReport->fetch_assoc()) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <?php
                                                            $overhead_name = $medicine->getOneCol('overhead_name', 'overhead', 'id', $res['overhead']);
                                                            echo $overhead_name;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($res['overhead_info_date'])); ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $ohCost = $res['overhead_info_amount'];
                                                            ;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $totalOhCost = $totalOhCost + $ohCost;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <?php
                                            if (isset($totalOhCost)) {
                                                echo $totalOhCost;
                                            }
                                            ?>
                                        </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table id="zero_config3" class="table table-striped table-bordered display tblReport">
                                        <thead>
                                            <tr>
                                                <th style="width:10px;">SL</th>
                                                <th style="width:20px;">Head</th>
                                                <th style="width:20px;">Date</th>
                                                <th style="width:20px;">Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($getIncReport) {
                                                $i = 0;
                                                $totalInc = 0;
                                                while ($result = $getIncReport->fetch_assoc()) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <?php
                                                            $mediForm = $medicine->getOneCol('income_head_name', 'income_head', 'id', $result['income_head']);
                                                            echo $mediForm;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($result['income_date'])); ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $income_amount = $result['income_amount'];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $totalInc = $totalInc + $income_amount;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <?php
                                            if (isset($totalInc)) {
                                                echo $totalInc;
                                            }
                                            ?>
                                        </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table id="zero_config4" class="table table-striped table-bordered display tblReport">
                                        <thead>
                                            <tr>
                                                <th style="width:10px;">SL</th>
                                                <th style="width:10px;">Expense</th>
                                                <th style="width:20px;">Date</th>
                                                <th style="width:20px;">Expense Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($getExReport) {
                                                $i = 0;
                                                $totalEXCost = 0;
                                                while ($res = $getExReport->fetch_assoc()) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <?php
                                                            $expense_head_name = $medicine->getOneCol('expense_head_name', 'expense_head', 'id', $res['expense_head']);
                                                            echo $expense_head_name;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($res['expense_date'])); ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $exCost = $res['expense_amount'];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $totalEXCost = $totalEXCost + $exCost;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <?php
                                            if (isset($totalEXCost)) {
                                                echo $totalEXCost;
                                            }
                                            ?>
                                        </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <table id="" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">Total Sales Profit</th>
                                        <th style="width:20px;">Other Income</th>
                                        <th style="width:20px;">Total Overhead Cost</th>
                                        <th style="width:20px;">Other Expense</th>
                                        <th style="width:20px;">Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $totalProfit; ?></td>
                                        <td><?php echo $totalInc; ?></td>
                                        <td><?php echo $totalOhCost; ?></td>
                                        <td><?php echo $totalEXCost; ?></td>
                                        <td><?php echo ($totalProfit + $totalInc) - ($totalOhCost + $totalEXCost); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>






