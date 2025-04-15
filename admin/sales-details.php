<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
$getMedicine = $medicine->getAllMedicineProduct();
if (isset($_POST['search'])) {
    $from = date('Y-m-d', strtotime($_POST['from']));
    $to = date('Y-m-d', strtotime($_POST['to']));
    $item = $_POST['item'];
    $getStk = $report->getSalesDetailsByDate($from, $to, $item);
} else {
    $getStk = $report->getSalesDetails();
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Sales Summary</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">sales summary</li>
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
                        <h5 class="card-title">Sales Summary</h5>
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
<!--                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item</label>
                                            <select name="item" id="item" class="form-control select2" style="width: 100%;">
                                                <option value="">Select Item</option>
                                                <?php while ($item = $getMedicine->fetch_assoc()) { ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['medicine_name'] . '-' . $item['medicine_form'] . '-' . $item['medicine_strength']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="col-md-2">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" name ="search" style="width: 120px;" class="btn btn-success">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                        <div class="box-tools pull-right" align="center">
                        </div><br>
                        <div class="table-responsive">
                            <table id="buttonTab" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:10px;">Date</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Opening Stock</th>
                                        <th style="width:20px;">Purchase</th>
                                        <th style="width:20px;">Total</th>
                                        <th style="width:20px;">Sale</th>
                                        <th style="width:20px;">Stock Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getStk) {
                                        $i = 0;
//                                        $Qty = 0;
//                                        $Uprice = 0;
//                                        $Tprice = 0;
                                        while ($result = $getStk->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php echo $fm->formatDate($result['date']); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $mediName = $medicine->getOneCol('medicine_name', 'medicine', 'id', $result['medicine']);
                                                    echo $mediName;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $mediForm = $medicine->getOneCol('medicine_form', 'medicine', 'id', $result['medicine']);
                                                    echo $mediForm;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $mediStrength = $medicine->getOneCol('medicine_strength', 'medicine', 'id', $result['medicine']);
                                                    echo $mediStrength;
                                                    ?>
                                                </td>
                                                <td><?php  $pos = $result['product_os']; echo $pos; ?></td>
                                                <td>
                                                    <?php 
                                                     $getPurchaseStock = $report->purchasedStock($result['medicine'],$from,$to);
                                                     $res = mysqli_fetch_assoc($getPurchaseStock);
                                                     $tP = $res['totPQty'];
                                                     echo $tP;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $pos + $tP; ?>
                                                </td>
                                                <td><?php $sale = $result['totQty']; echo $sale; ?></td>
                                                <td><?php echo ($pos + $tP) - $sale; ?></td>
                                            </tr>
                                            <?php
//                                            $Qty = $Qty + $qty;
//                                            $Uprice = $Uprice + $unit_price;
//                                            $Tprice = $Tprice + $sub_total;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="4">Total</th>
                                <th>
                                    <?php
//                                    if (isset($Qty)) {
//                                        echo $Qty;
//                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
//                                    if (isset($Uprice)) {
//                                        echo $Uprice;
//                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
//                                    if (isset($Tprice)) {
//                                        echo $Tprice;
//                                    }
                                    ?>
                                </th>
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





