<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['medicine_id']) || $_GET['medicine_id'] == NULL) {
    echo "<script>window.location = 'medicine.php';</script>";
} else {

    $medicine_id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['medicine_id']);
}
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Medicine Info</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">medicine Info</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <?php
        $getInfo = $medicine->getMedicineInfo($medicine_id);
        if ($getInfo) {
            while ($result = $getInfo->fetch_assoc()) {
                ?>
                <div class="row" id="printableArea">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body border-top">
                                <h5 class="card-title">
                                    <?php
                                    echo '<b>' . $result ['medicine_name'] . '<b>  <sup>' . $result ['medicine_strength'] . '</sup>' . '  (' . $result ['medicine_form'] . ')';
                                    ?>
                                </h5>
                                <div align="right">
                                    <button id ="printbtn" type="button" value="Print this page" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                                    <button id ="closeButton" onclick="window.close();">Close Page</button>
                                </div>
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading"><b>Generic      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $result ['generic_name']; ?></h4>
                                    <hr>
                                    <h4 class="alert-heading"><b>Company Name &nbsp;&nbsp;:</b> <?php echo $result ['company_name']; ?></h4>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-heading"><b>Indication</b></h4>
                                    <p><?php echo htmlspecialchars_decode($result ['indication']); ?></p>
                                </div>
                                <div class="alert alert-primary" role="alert">
                                    <h4 class="alert-heading"><b>Administration</b></h4>
                                    <p><?php echo htmlspecialchars_decode($result ['administration']); ?></p>
                                </div>
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading"><b>Side Effect</b></h4>
                                    <p><?php echo htmlspecialchars_decode($result ['side_effect']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

    </div>

</div>
<?php include 'footer.php'; ?>