<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getSupplier = $medicine->getAllSupplier();
if (isset($_POST['search'])) {
//    $from = $_POST['from'];
//    $to = $_POST['to'];
    $sup = $_POST['product_sup_name'];
    $getPurReport = $report->getAllStockBySupplier($sup);
} 
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">In Stock Report (Supplier wise)</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">in stock report</li>
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
                        <h5 class="card-title">All In Stock Report Report (Supplier wise)</h5>
                        <div class="box-tools pull-right" align="center">
                            <form class="form-horizontal" method = "post" action="">
                                <div class="row">
                                    <div class="col-md-3">
<!--                                        <div class="form-group">
                                            <label for="datepicker-autoclose">From</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose" name="from" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>-->
                                    </div>
                                    <div class="col-md-3">
<!--                                        <div class="form-group">
                                            <label for="datepicker-autoclose">To</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose1" name="to" autocomplete="off" placeholder="mm/dd/yyyy">
                                        </div>-->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Product Supplier<span style="color: red">*</span></label>
                                                <select name="product_sup_name" id="sup_id" class="form-control select2" style="width: 100%;" required>
                                                    <option value="">SELECT SUPPLIER</option>
                                                    <?php while ($supplier = $getSupplier->fetch_assoc()) { ?>
                                                        <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['name']; ?></option>
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
                                        <th style="width:20px;">Invoice</th>
                                        <th style="width:20px;">Supplier</th>
                                        <th style="width:20px;">Medicine</th>
                                        <th style="width:20px;">Current Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($getPurReport)) {
                                        $i = 0;
                                        $totStk = 0;
                                        while ($result = $getPurReport->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a target="_blank" href="supinv.php?invid=<?php echo $result['invoice_number']; ?>"><?php echo $result['invoice_number']; ?></a></td>
                                                <td>
                                                    <?php
                                                    $supName = $medicine->getOneCol('name', 'supplier', 'id', $result['supplier']);
                                                    echo $supName;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $mediId = $medicine->getOneCol('medicine', 'purchase_product_info', 'common_id', $result['invoice_number']);
                                                    $mediName = $medicine->getOneCol('medicine_name', 'medicine', 'id', $mediId);
                                                    $mediStr = $medicine->getOneCol('medicine_strength', 'medicine', 'id', $mediId);
                                                    $medifrm = $medicine->getOneCol('medicine_form', 'medicine', 'id', $mediId);
                                                    echo $mediName.'<sup>'.$mediStr.'</sup>'.$medifrm;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $mediId = $medicine->getOneCol('medicine', 'purchase_product_info', 'common_id', $result['invoice_number']);
                                                    $mediStk = $medicine->getOneCol('stock', 'medicine', 'id', $mediId);
                                                    echo $mediStk;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $totStk = $totStk + $mediStk;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="2">Total</th>
                                <th>
                                   
                                </th>
                                <th>
                                    <?php
                                    if (isset($totStk)) {
                                        echo $totStk;
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
    </div>
</div>
<?php include 'footer.php'; ?>




