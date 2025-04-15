<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getCompany = $medicine->getAllActiveCompanyList();
if (isset($_POST['search'])) {
    $com = $_POST['company'];
    $company_name = $medicine->getOneCol('company_name','company','id',$com);
    $getStk = $report->getCurrentStockByCompany($com);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Current Stock Report (Companywise)</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">current stock (companyise)</li>
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
                        <h5 class="card-title">All Current Stock</h5>
                        <div class="box-tools pull-right" align="center">
                            <form class="form-horizontal" method = "post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Company<span style="color: red">*</span></label>
                                                <select name="company" id="company" class="form-control select2" style="width: 100%;" required>
                                                    <option value="">SELECT COMPANY</option>
                                                    <?php while ($company = $getCompany->fetch_assoc()) { ?>
                                                        <option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
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
                        <h3 class="card-title"><?php if(isset($company_name)){echo $company_name;} ?></h3>
                        <div class="box-tools pull-right" align="center">
                        </div><br>
                        <div class="table-responsive">
                            <table id="buttonTab" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Stock</th>
                                        <th style="width:20px;">Total Sale Price</th>
                                        <th style="width:20px;">Total Purchase Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($getStk)) {
                                        $i = 0;
                                        $stock = 0;
                                        $sprice = 0;
                                        $pprice = 0;
                                        while ($result = $getStk->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php echo $result['medicine_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['medicine_form']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['medicine_strength']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $stk = $result['stock']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $sp = $stk * $result['sale_price']; ?>
                                                </td>
                                                <td><?php echo $pp = $stk * $result['purchases_price']; ?></td>
                                            </tr>
                                            <?php
                                            $stock = $stock + $stk;
                                            $sprice = $sprice + $sp;
                                            $pprice = $pprice + $pp;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th colspan="3">Total</th>
                                <th>
                                    <?php
                                    if (isset($stock)) {
                                        echo $stock;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($sprice)) {
                                        echo $sprice;
                                    }
                                    ?>
                                </th>
                                <th>
                                    <?php
                                    if (isset($pprice)) {
                                        echo $pprice;
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



