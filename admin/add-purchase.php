<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
$user_id = Session::get("adminId");
$getMedicine = $medicine->getAllMedicine();
$getSupplier = $medicine->getAllSupplier();
$bank_info = $medicine->getAllBankName();
$total_purchaseAmount = $medicine->select_all_purches_product_info();
$totalAmount2 = 0;
if (is_array($total_purchaseAmount) || is_object($total_purchaseAmount)) {
    foreach ($total_purchaseAmount as $resultTotalAmount2) {
        $total = $resultTotalAmount2['sub_total'];
        $totalAmount2 = $totalAmount2 + $total;
    }
}

$getInvoiceId = $medicine->getInvoiceIdInfo();
if ($getInvoiceId != FALSE) {
    $invID = mysqli_fetch_assoc($getInvoiceId);
    $serial = $invID['id'];
    $invoiceID = $serial + 1;




//Invoice number generate start
    $s_time = strtotime(date('Y-m-d H:i'));
    $s_date = date("Y-m-d,g:i A", $s_time);
    $splitTimeStamp = explode(",", $s_date);
    $s_Curdate = $splitTimeStamp[0];
    $s_curtime = $splitTimeStamp[1];

    $yr = explode("-", $s_Curdate);
    $tm = explode(":", $s_curtime);
    $year = $yr['0'];
    $month = $yr['1'];
    $day = $yr['2'];
    $hr = $tm['0'];
    $mn = $tm['1'];
    $minute = substr($mn, 0, strlen($mn) - 3);
    $invNum = date('y') . $month . $day . $user_id . $invoiceID;

//Invoice number generate end
}

$query_result = $medicine->select_purComnID_info();
if ($query_result != FALSE) {
    $invID = mysqli_fetch_assoc($query_result);
    $commonID = $invID['common_id'];
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn'])) {
    //$common_id = $_POST['common_id'];
    $product_sup_name = $_POST['product_sup_name'];
    $invoice_number = $_POST['invoice_number'];
    $purchase_date = date('Y-m-d', strtotime($_POST['purchase_date']));
    $totalAmount = $_POST['totalAmount'];
    $payment_method = $_POST['payment_method'];
    $disCnt = $_POST['disCnt'];
    $less = $_POST['less'];
    $cashPaid = $_POST['cashPaid'];
    $dues = $_POST['dues'];
    $predues = $_POST['predues'];
    $currentDue = $predues + $dues;
    $chequeAmount = $_POST['chequeAmount'];
    $bankName = $_POST['bankName'];
    $cheque_num = $_POST['cheque_num'];
    $cheque_app_date = $_POST['ChequeAppDate'];


    $sup_name = $_POST['product_sup_name'];
    $pur_date = date('Y-m-d', strtotime($_POST['purchase_date']));

    $common_id = $medicine->save_purchase_main_invoice_info($product_sup_name, $currentDue, $invoice_number, $purchase_date, $totalAmount, $payment_method, $disCnt, $less, $cashPaid, $dues, $predues, $chequeAmount, $bankName, $cheque_num, $cheque_app_date);


    if ($common_id != '' && $product_sup_name != '') {
        $pId = $_POST['product_id'];
        $savecount = 0;
        for ($i = 0; $i < count($pId); $i++) {

            $product_id = $_POST['product_id'][$i];
            $mdate = $_POST['mdate'][$i];
            $minstk = $_POST['minstk'][$i];
            $edate = $_POST['edate'][$i];
            $cprice = $_POST['cprice'][$i];
            $sprice = $_POST['sprice'][$i];
            $quantity = $_POST['quantity'][$i];


            $preStock = $medicine->getOneCol('stock', 'medicine', 'id', $product_id);
            $inStock = $preStock + $quantity;
            $subTotal = $cprice * $quantity;
            if ($minstk != '' && $minstk != '0') {
                $updateMinStockItem = $medicine->updateMinStock($product_id, $minstk);
            }

            if ($product_id != '' && $quantity != '' && $cprice != '' && $sprice != '') {
                $insertItem = $medicine->addItem($product_id, $mdate, $edate, $cprice, $sprice, $quantity, $subTotal, $invoice_number, $inStock, $sup_name, $pur_date);
                $expiredItem = $medicine->addExpiredItem($product_id, $quantity, $mdate, $edate, $pur_date);
            }
            $savecount++;
        }

        $message2 = $medicine->updateProductStatusFlag($invoice_number);
        if ($message2) {
            $message3 = $medicine->updateSupplierDues($currentDue, $product_sup_name);
        }
    }
}
?>
<style type="text/css">
.list-group {
    list-style-type: none;
    text-align: left;

}

.list-group li {
    padding: 10px;
    background: #fff;
    border-bottom: 1px solid #fff;
    cursor: pointer;
}

.list-group li:hover,
a:active {
    padding: 10px;
    background: #5897fb;
    color: #ffffff;
    width: auto;
}

.sli a:focus {
    padding: 10px;
    color: #ffffff;
    background: #5897fb;
    width: auto;
    display: block;
}

.sli a {
    color: #000000;
}

.sli a:hover {
    color: #ffffff;
}
</style>

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
                <h3 class="page-title">الدواء /منتجات المشتريات</h3><br>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">الصفحة الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">اضافة مشتريات</li>
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
                    <h4><span class="glyphicon glyphicon-exclamation-sign w3-padding-small"></span> من فضبك
                        الانتظار.<br> </h4>
                    <div class="modal-footer">
                        <a id="closemodal" href="#" class="btn btn-danger">اغلاق</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <form class="form-horizontal" method="post" action="">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="lname">الدواء/المنتج<span style="color: red"> *</span></label>
                                <div align="center">
                                    <input type="text" name="search" id="search" class="search form-control"
                                        placeholder="ابحث عن دواء او منتج" autofocus="autofocus" autocomplete="off" />
                                    <ul class="list-group" id="result"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="employee_table">
                        <div class="box4">
                            <div class="bottom table-responsive">
                                <table class="table table-bordered table-striped table-hover tbl"
                                    style="margin-top: 10px;">
                                    <thead>
                                        <tr style="background-color: #ff9900">
                                            <th class="text-center" style="width: 10px">SL</th>
                                            <th class="text-center" style="width: 120px">حقل الاسم</th>
                                            <th class="text-center" style="width: 50px">المخزون الادنى</th>
                                            <th class="text-center" style="width: 50px">تاريخ الانتهاء</th>
                                            <th class="text-center" style="width: 100px">سعر التكلفة</th>
                                            <th class="text-center" style="width: 100px">MRP</th>
                                            <th class="text-center" style="width: 100px">الكمية</th>
                                            <th class="text-center" style="width: 100px">المجموع الكلي</th>
                                            <th class="text-center" style="width: 100px">الاجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>منتجات المورد<span style="color: red">*</span></label>
                                            <select name="product_sup_name" id="sup_id" class="form-control select2"
                                                style="width: 100%;" required>
                                                <option value="">اختار مورد</option>
                                                <?php 
												if($getSupplier != FALSE){
												while ($supplier = $getSupplier->fetch_assoc()) 
												{ ?>
                                                <option value="<?php echo $supplier['id']; ?>">
                                                    <?php echo $supplier['company_name']; ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>المستحقات السابقة<span style="color: red">*</span></label>
                                            <input type="text" name="predues" id="preDue" class="form-control"
                                                placeholder="0.00" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>رقم فاتورة المورد<span style="color: red">*</span></label>
                                            <input type="text" name="invoice_number" class="form-control" value="<?php
                                            if (isset($invNum)) {
                                                echo $invNum;
                                            }
                                            ?>">
                                            <input type="hidden" name="common_id" class="form-control"
                                                value="<?php if(isset($commonID)){echo $commonID; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">التاريخ</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose"
                                                name="purchase_date" value="<?php echo date('m/d/Y'); ?>"
                                                placeholder="mm/dd/yyyy" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>مجموع الكمية<span style="color: red">*</span></label>
                                            <input type="text" name="totalAmount" class="form-control" id="grand_total"
                                                value="" readonly="">
                                            <input type="hidden" class="form-control" id="hiddenTotalamount" value=""
                                                readonly="">
                                            <input type="hidden" name="totalNetAmount" id="totalNetAmount"
                                                class="form-control" value="" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">طرق الدفع</label><br>
                                            <select name="payment_method" class="form-control" id="getFname"
                                                onchange="admSelectCheck(this);" style="width: 100%;">
                                                <option value="Cash">كاش</option>
                                                <option id="admOption" value="Cheque">تحقق</option>
                                                <option value="Pay order">دفع عند الطلب</option>
                                                <option value="Credit Card">بطاقة ائتمان Card</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>الخصم</label>
                                            <input type="text" name="disCnt" class="form-control" id="disCnt"
                                                oninput="calculateDis(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>اقل</label>
                                            <input type="text" name="less" class="form-control" id="less"
                                                oninput="calculateDis(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>القيمة<span style="color: red">*</span></label>
                                            <input type="text" name="cashPaid" class="form-control" id="paid"
                                                oninput="paidamount(this)" placeholder="Amount" autocomplete="off"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>استحقاقات<span style="color: red">*</span></label>
                                            <input type="text" name="dues" id="currdue" class="form-control"
                                                value="<?php echo $totalAmount2; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="admDivCheck4" style="display:none;">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">تحقق من المبلغ</label><br>
                                            <input type="text" name="chequeAmount" class="form-control"
                                                placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="admDivCheck" style="display:none;">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">اسم البنك</label><br>
                                            <select name="bankName" class="form-control" style="width: 100%;">
                                                <option value="">--اختار البنك--</option>
                                                <?php while ($bank = $bank_info->fetch_assoc()) { ?>
                                                <option value="<?php echo $bank['id']; ?>">
                                                    <?php echo $bank['bank_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="admDivCheck2" style="display:none;">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">رقم التحقق</label><br>
                                            <input type="text" name="cheque_num" class="form-control"
                                                placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="admDivCheck3" style="display:none;">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">تحقق من تاريخ الموافقة</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose2"
                                                name="ChequeAppDate" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" onclick="addPurchase()" name="btn" class="btn btn-success"
                                    type="button">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    حفظ
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn btn-danger" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Cancle
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>
<script>
$(document).ready(function() {
    $('#sup_id').change(function() {
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'loadpage/supplierpreDuesLoad.php',
            data: {
                'sup_id': id
            },
            success: function(html) {
                console.log(html);
                $('#preDue').val(html);
            }
        });
    });
});

function addPurchase() {

    var e = document.getElementById("sup_id");
    var supplier = e.options[e.selectedIndex].value;
    var paid = document.getElementById("paid").value;
    var cprice = document.getElementsByClassName("cprice").required = true;
    var cprice1 = document.getElementsByClassName("cprice").value;

    if (supplier != '' && paid != '' && cprice1 != '0.00') {
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
var products = [];
$(document).ready(function() {
    var availableTags = []

    //        $('.search').on('keyup', function () {
    $('.search').on('keypress', function() {
        var li = ""
        var text = ''
        var sup_id = document.getElementById("sup_id").value;
        $.getJSON('product2.php?name=' + $(this).val() + '&&sup_id=' + sup_id, function(response) {
            response.forEach(function(value) {
                var data_field = value.medicine_name + "|" + value.medicine_form +
                    "| " + value.medicine_strength;
                var data_field1 = value.medicine_name + "|" + value.medicine_form +
                    "| " + value.medicine_strength + "| " + value.generic_name + "| " +
                    value.company_name;
                li += "<li class='sli' data-id='" + value.id + "' data-stock='" + value
                    .stock + "' data-cprice='" + value.purchases_price +
                    "' data-sprice='" + value.sale_price + "' data-min_stock='" + value
                    .min_stock + "' id='" + data_field + "'><a href='#'>" +
                    data_field1 + "</a></li>"
            });
            $('.list-group').html(li)
        })

    })

    $('.tbl tbody').on('click', '.delete-row', function() {
        var id = $(this).data('id')
        console.log(id, products)
        products = products.filter(function(value) {
            return value.id != id
        });
        bindTOTemplate(products)
        createTotal()
    })
    $('.tbl tbody').on('change', '.qty', function() {
        console.log($(this).data('id'), products)

    })
    $('.tbl tbody').on('keyup', '.qty', function() {
        console.log($(this).data('id'), products)
        var id = $(this).data('id')
        var p = products.find(function(value) {
            return value.id == id
        })
        p.qtn = $(this).val();
        var total = +p.qtn * +p.cprice;
        $(this).parent('td').siblings('.sub_total').text(total)
        createTotal()

    })

    $('.tbl tbody').on('keyup', '.cprice', function() {
        console.log($(this).data('id'), products)
        var id = $(this).data('id')
        var p = products.find(function(value) {
            return value.id == id
        })
        p.cprice = $(this).val();
        var total = +p.qtn * +p.cprice;
        $(this).parent('td').siblings('.sub_total').text(total)
        createTotal()

    })


    var grand_total = 0;

    function createTotal() {
        grand_total = products.reduce(function(amount, row) {
            return amount += row.subtotal()
        }, 0)
        var grandTotal = roundToTwo(grand_total);
        $('#grand_total').val(grandTotal)
        $('#hiddenTotalamount').val(grandTotal)
    }

    function bindTOTemplate(products) {
        products.reverse();
        $('.tbl tbody').empty()
        if (products) {
            var a = 1;
            products.forEach(function(pro) {

                var product = "<tr>"
                product += "<td style='width: 10px'>" + a++ + "</td>"
                product += "<td style='width: 150px'>" + pro.name + "</td>"
                product += "<td>"
                product +=
                    "<input type = 'number' style='width: 120px' name='minstk[]' class='form-control minstk' onchange='change6(this.value," +
                    pro.id + ")' value='" + pro.minstk + "' data-id='" + pro.id + "' />"
                product += "</td>"
                product += "<td>"
                product += "<input id='edate_" + a + "' type = 'date' style='width: 160px;" + pro.ed() +
                    "' name='edate[]' onchange='changed3(" + a + "),change4(this.value," + pro.id +
                    ")' class='edate form-control' required value='" + pro.edv() + "' data-id='" + pro
                    .id + "' />"
                product += "<input type='hidden' name='product_id[]' class='form-control' value='" + pro
                    .id + "' data-id='" + pro.id + "' />"
                product += "</td>"
                product += "<td><input id='cost_price_" + a +
                    "' type = 'number' step='any' name='cprice[]' style='width: 100px;" + pro.cp() +
                    "' onkeyup='changed(" + a + ")' class='cprice form-control' value='" + pro.cprice +
                    "'  data-id='" + pro.id + "' /></td>"
                product += "<td><input id='sale_price_" + a +
                    "' type = 'number' step='any' style='width: 100px;" + pro.sp() +
                    "' name='sprice[]' onkeyup='changed2(" + a + "),change5(this.value," + pro.id +
                    ")' class='sprice form-control' value='" + pro.sprice + "'  data-id='" + pro.id +
                    "' /></td>"
                product +=
                    "<td><input type = 'number' style='width: 100px' name='quantity[]' class='qty form-control' value='" +
                    pro.qtn + "' data-id='" + pro.id + "' /></td>"
                product += "<td class='sub_total' style='width: 150px'>" + pro.subtotal() + "</td>"
                product +=
                    "<td style='width: 100px'><button class='btn btn-danger delete-row' data-id='" + pro
                    .id + "' >x</button></td>"
                product += "</tr>"
                $('.tbl tbody').append(product)
                createTotal()

            });


        }


    }

    //        var products = [];
    $('body').on('click', '.list-group li', function() {
        $('.search').val($(this).attr('id'));
        var qty = 1
        var discount = 0
        var subtotal = qty * $(this).data('cprice')
        var id = $(this).data('id')
        var prod = products.find(function(value) {
            return value.id == id
        })
        if (prod) {
            alert('already added!!');
            return;
        }

        var p = {
            sl: 1,
            id: $(this).data('id'),
            name: $(this).attr('id'),
            qtn: 1,
            instance: "you can here",
            cprice: $(this).data('cprice'),
            sprice: $(this).data('sprice'),
            //edate: $(this).data('edate'),
            edate: "mm/dd/yyyy",
            minstk: $(this).data('min_stock'),
            discount: 0,
            stock: $(this).data('stock'),
            subtotal: function() {

                var total = +this.qtn * +this.cprice;
                return total;

            },
            sprce: function() {
                var sprc = this.sprice;
                return sprc;
            },
            cp: function() {

                console.log(this.edate);

                if (this.cprice == '0.00')
                    return "background-color:red;color:white;";
                else
                    return "black";

            },
            sp: function() {
                if (this.sprice == '0.00')
                    return "background-color:red;color:white;";
                else
                    return "black";
            },
            ed: function() {
                if (this.edate == "mm/dd/yyyy")
                    return "background-color:red;color:white;";
                else
                    return "black";
            },
            edv: function() {
                return this.edate;
                console.log(this.edate);
            }
        }
        products.push(p)
        bindTOTemplate(products)
        clearSearch()
    })

    function clearSearch() {
        $('#search').val('')
        var ele = document.getElementById('search');
        var newVal = '';

        ele.value = newVal;
        ele.focus();

        // To update cursor position to recently added character in textBox
        ele.setSelectionRange(newVal.length, newVal.length);
    }
    $('body').click(function() {
        var li = ""

        $('.list-group').html(li)

    })

});

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}


function checkData(value) {
    console.log(value);
}


function changed(id) {
    var docId = document.getElementById('cost_price_' + id);
    docId.style.backgroundColor = "white";
    docId.style.color = "black";

    console.log(id);
}

function changed2(id) {
    var docId = document.getElementById('sale_price_' + id);
    docId.style.backgroundColor = "white";
    docId.style.color = "black";

    console.log(id);
}

function changed3(id) {
    var docId = document.getElementById('edate_' + id);
    docId.style.background = "white";
    docId.style.color = "black";

    console.log(id);
}

function change4(date, id) {
    var productsLog = [];

    products.forEach(function(product) {
        if (product.id == id) {
            product.edate = date;
        }

        productsLog.push(product);
    });

    products = productsLog;
}

function change5(spv, id) {
    var productsLog = [];

    products.forEach(function(product) {
        if (product.id == id) {
            product.sprice = spv;
        }

        productsLog.push(product);
    });

    products = productsLog;
}

function change6(minstk, id) {
    var productsLog = [];

    products.forEach(function(product) {
        if (product.id == id) {
            product.minstk = minstk;
        }

        productsLog.push(product);
    });

    products = productsLog;
}


function calculateDis(id) {
    var hiddenTotalamount = $('#hiddenTotalamount').val();
    var disCnt = $('#disCnt').val();

    $('#grand_total').val(0);

    var less = $('#less').val();
    var disCntRes = Number(hiddenTotalamount) * Number(disCnt);
    var totl = Number(disCntRes) / 100;
    var result = Number(hiddenTotalamount) - Number(totl);
    var res = Number(result) - Number(less);
    $('#currdue').val(res);
    $('#grand_total').val(res);
}

function paidamount(id) {
    var totalAmount = $('#grand_total').val();
    var paid = $('#paid').val();
    $('#currdue').val(0);
    var currentDues = Number(totalAmount) - Number(paid);
    if (currentDues > 0) {
        $('#currdue').val(currentDues).css('border', '5px solid red');
    } else if (currentDues < 0) {
        $('#currdue').val(currentDues).css('border', '5px solid red');
    } else {
        $('#currdue').val(currentDues).css('border', '5px solid green');
    }
}

function roundToTwo(num) {
    return num.toFixed(2);
    //return +(Math.round(num + "e+2")  + "e-2");
}
</script>