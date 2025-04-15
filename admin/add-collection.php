<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
$getCustomer = $medicine->allCustomer();
//$lastId = $medicine->select_collection_lastId_info();
//$collecId = mysqli_fetch_assoc($lastId);
//$serial = $collecId['id'];
//$commonID = $serial + 1;
//
//$user_id = Session::get('adminId');
//$user_name = Session::get('adminUser');
//
//$s_time = strtotime(date('Y-m-d H:i'));
//$s_date = date("Y-m-d,g:i A", $s_time);
//$splitTimeStamp = explode(",", $s_date);
//$s_Curdate = $splitTimeStamp[0];
//$s_curtime = $splitTimeStamp[1];
//
//$yr = explode("-", $s_Curdate);
//$tm = explode(":", $s_curtime);
//$year = $yr['0'];
//$month = $yr['1'];
//$day = $yr['2'];
//$hr = $tm['0'];
//$mn = $tm['1'];
//$minute = substr($mn, 0, strlen($mn) - 3);
//$receiptNumber = $year . $month . $day . $hr . $minute . "0" . $user_id . $commonID;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $collecDue = $medicine->dueCustomerCollection($_POST, $user_name);
}
?>
<style>
.modal {
    text-align: center;
    padding: 0 !important;
}

.modal:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px;
}

.modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
}

.modal-header,
h4,
.close {
    background-color: #2255a4;
    color: white !important;
    text-align: center;
    font-size: 30px;
}

.modal-header_two {
    background-color: green;
    color: white !important;
    text-align: center;
    font-size: 30px;
}

.modal-header_three {
    background-color: #27a9e3;
    color: white !important;
    text-align: center;
    font-size: 30px;
}

.modal-footer {
    background-color: #154ca5;
}
</style>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h5 class="page-title">المجموعات</h5>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">اضاغه مجموعه</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal w3-animate-zoom" id="waitModal" role="dialog" data-controls-modal="waitModal"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog w3-card-4">
            <!-- Modal content-->
            <div class="modal-content modal-header_three">
                <div class="modal-header_three" style="padding:25px 40px;">
                    <h4><span class="glyphicon glyphicon-exclamation-sign w3-padding-small"></span> Please Wait untill
                        done.</h4>
                    <div class="modal-footer">
                        <a id="closemodal" href="#" class="btn btn-danger">اغلاق</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($_SESSION['messageC'])) {
                        echo $_SESSION['messageC'];
                        unset($_SESSION['messageC']);
                    }
                    ?>
                    <form class="form-horizontal" method="post" action="">
                        <div class="card-body">
                            <h5 class="card-title">اضافة مجموعة</h5>
                            <div class="box-tools pull-right" align="right">
                                <a href="manage-collection.php"><button type="button" class="btn btn-default"><i
                                            class="fas fa-arrow-left"></i>تلااجع</button></a>
                            </div><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname">العميل<span style="color: red"> *</span></label>
                                        <select class="form-control select2" id="cus_id" name="customer" required>
                                            <option>اختار العميل</option>
                                            <?php
                                            if ($getCustomer) {
                                                while ($customer = $getCustomer->fetch_assoc()) {
                                                    ?>
                                            <option value="<?php echo $customer['id']; ?>">
                                                <?php echo $customer['name']; ?></option>
                                            <?php
                                                }
                                            } else {
                                                ?>
                                            <option value="">اضافه العميل الاول</option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment">الدفع<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="paid" onkeyup="sum();" name="paid"
                                            placeholder="0.00" required>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="preDue">الاستخقاق السابق<span style="color: red">
                                                        *</span></label>
                                                <input type="text" class="form-control" id="preDue" name="dues"
                                                    placeholder="Customer dues" required readonly="">
                                            </div>
                                        </div>
                                        <!--                                        <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="">Receipt No.</label>
                                                                                        <input type="text" class="form-control" value="<?php echo $receiptNumber; ?>" name="collectionReceipt" readonly>
                                                                                        <input type="hidden" class="form-control" value="<?php echo $user_id; ?>" name="user_id" readonly>
                                                                                    </div>
                                                                                </div>-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="payment">ارجاع الاستحقاق<span style="color: red">
                                                        *</span></label>
                                                <input type="text" class="form-control" id="currdue" name="currdue"
                                                    placeholder="0.00" required readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="datepicker-autoclose">تاريخ المجموعة </label>
                                                <input type="text" class="form-control" id="datepicker-autoclose"
                                                    name="collectionDate" value="<?php echo date('m/d/Y'); ?>"
                                                    placeholder="mm/dd/yyyy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" onclick="addPurchase()" name="save"
                                    class="btn btn-success">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
<script>
$(document).ready(function() {
    $('#cus_id').change(function() {
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'loadpage/customer_pre_due.php',
            data: {
                'cus_id': id
            },
            success: function(html) {
                console.log(html);
                $('#preDue').val(html);
            }
        });
    });
});
</script>
<script>
function addPurchase() {

    var e = document.getElementById("cus_id");
    var supplier = e.options[e.selectedIndex].value;
    var paid = document.getElementById("paid").value;

    if (supplier != '' && paid != '') {
        $('#waitModal').modal('show');
        $('#waitModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

}

$('#closemodal').click(function() {
    $('#waitModal').modal('hide');
});
</script>
<script>
function sum() {
    var dues = Number($("#preDue").val());
    var paid = Number($("#paid").val());
    var result = parseInt(dues) - parseInt(paid);
    if (!isNaN(result)) {
        document.getElementById('currdue').value = result;
    }
}
</script>