<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-unit.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}

$getInfo = $medicine->getExpDatetById($sid);
$result = $getInfo->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $unitUpdate = $medicine->updateExpireDate($_POST, $sid);
    ?>
    <script type="text/javascript">
        function closeWindow() {
            setTimeout(function () {
                window.close();
            }, 1000);
        }
        window.onload = closeWindow();
    </script>
    <?php
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Expire</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">edit expire date</li>
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
                    if (isset($unitUpdate)) {
                        echo $unitUpdate;
                    }
                    ?>
                    <?php
                    if ($getInfo) {
                        ?>
                        <form class="form-horizontal" method = "post" action="">
                            <div class="card-body">
                                <h4 class="card-title">Update Expire Date</h4>
                                <div class="box-tools pull-right" align="right">
                                    <a href="expired-stock.php"><button type="button" class="btn btn-default"><i class="fas fa-arrow-left"></i>Back</button></a>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="uname">Expire Date<span style="color: red"> *</span></label>
                                            <input type="date" class="form-control" id="da" value ="<?php echo $result['edate']; ?>" name="edate" placeholder="" required>
                                        </div>
                                    </div>
                                </div>										
                            </div>
                            <div class="border-top">
                                <div class="card-body" align="center">
                                    <button type="submit" name = "update" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>

