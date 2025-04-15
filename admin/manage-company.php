<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $genericDel = $medicine->deleteCompany($id);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Company</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">company</li>
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
                    if (isset($genericDel)) {
                        echo $genericDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Company</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-company.php"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add Company</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">SL</th>
                                        <th style="width:200px;">Company Name</th>
                                        <th style="width:200px;">Mobile</th>
                                        <th style="width:200px;">Email</th>
                                        <th style="width:200px;">Balance</th>
                                        <th style="width:40px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getCompany = $medicine->getAllCompany();
                                    if ($getCompany) {
                                        $i = 0;
                                        $totalBalance = 0;
                                        while ($result = $getCompany->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['company_name']; ?></td>
                                                <td><?php echo $result['mobile']; ?></td>
                                                <td><?php echo $result['email']; ?></td>
                                                <td><?php $balance = $result['balance']; echo $balance; ?></td>
                                                <td>
                                                    <a href="edit-company.php?sid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-cyan btn-sm">Edit</button></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $totalBalance += $balance;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <?php
                                    if(isset($totalBalance)){
                                        echo $totalBalance;
                                    }
                                    ?>
                                </th>
                                <th>Action</th>
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