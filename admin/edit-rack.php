<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-rack.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $rackUpdate = $admin->updateRack($_POST, $sid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Rack</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">edit rack</li>
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
                    if (isset($rackUpdate)) {
                        echo $rackUpdate;
                    }
                    ?>
                    <?php
                    $getInfo = $admin->getRackById($sid);
                    if ($getInfo) {
                        while ($result = $getInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Update Rack</h4>
                                    <div class="box-tools pull-right" align="right">
                                        <a href="manage-rack.php"><button type="button" class="btn btn-default"><i class="fas fa-arrow-left"></i>Back</button></a>
                                    </div><br>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uname">Rack Name<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="uname" value ="<?php echo $result['rack_name']; ?>" name="rack_name" placeholder="Rack Name" required>
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
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>