<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $proDel = $medicine->deletePro($id);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">المنتجات</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">المنتجات</li>
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
                    if (isset($proDel)) {
                        echo $proDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">كل المنتجات</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-product.php"><button type="button" class="btn btn-success">
                                <i class="fas fa-plus"></i>اضافة منتج</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>اسم المنتج</th>
                                        <th>نوع المنتج</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getType = $medicine->getAllProduct();
                                    if ($getType) {
                                        $i = 0;
                                        while ($result = $getType->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['medicine_name']; ?></td>
                                                <td>
                                                    <?php
                                                    $proType = $medicine->getOneCol('product_type', 'product_type', 'id', $result['pro_type']);
                                                    echo $proType;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="edit-pro.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm">تعديل</button></a>
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



