<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
$user_id = Session::get('adminId');
$user_name = Session::get('adminUser');

$getMedicine = $medicine->getAllMedicineProduct();
$getCustomer = $medicine->getAllCustomer();
$bank_info = $medicine->getAllBankName();


$getInvoiceId = $medicine->getCustomerReturnInvoiceIdInfo();
if($getInvoiceId != FALSE){
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
$invNum = $user_name . $year . $month . $day . "0" . $invoiceID;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn'])) {
//    $common_id = $_POST['common_id'];
    $cus_name = $_POST['cus_name'];
    $invoice_number = $_POST['invoice_number'];
    $sale_date = date('Y-m-d', strtotime($_POST['sale_date']));
    $totalAmount = $_POST['totalAmount'];
//    $totalNetAmount = $_POST['to-talNetAmount'];
    $totalNetAmount = 0;
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


    $common_id = $medicine->save_customer_return_invoice_info($cus_name, $predues, $invoice_number, $sale_date, $totalAmount, $totalNetAmount, $payment_method, $disCnt, $less, $cashPaid, $currentDue, $dues, $chequeAmount, $bankName, $cheque_num, $cheque_app_date, $user_id, $user_name);

    if ($common_id != '' && $cus_name != '') {
        $pId = $_POST['product_id'];
        $savecount = 0;
        for ($i = 0; $i < count($pId); $i++) {

            $product_id = $_POST['product_id'][$i];
            $quantity = $_POST['quantity'][$i];
            $discount = $_POST['discount'][$i];

            $preStock = $medicine->getOneCol('stock', 'medicine', 'id', $product_id);
            $sale_price = $medicine->getOneCol('sale_price', 'medicine', 'id', $product_id);
            $purchases_price = $medicine->getOneCol('purchases_price', 'medicine', 'id', $product_id);
            $inStock = $preStock + $quantity;
            $subTotal = $sale_price * $quantity;
            $netCosAmount = $purchases_price * $quantity;
            $netSalesamount = $subTotal - ($subTotal * $discount / 100);

            if ($product_id != '' && $quantity != '') {
                $insertSales = $medicine->insertReturnItem($product_id, $quantity, $sale_price, $discount, $netSalesamount, $netCosAmount, $invoice_number, $common_id, $user_id, $user_name, $inStock);
            }
            $savecount++;
        }
        $message3 = $medicine->updateReturnCustomerDues($currentDue, $cus_name);
    }
    $total_netAmount = $medicine->select_return_sale_product_info($invoice_number, $common_id);
    $totalAmount3 = 0;
    foreach ($total_netAmount as $resultTotalAmount2) {
        $total2 = $resultTotalAmount2['net_cost'];
        $totalAmount3 = $totalAmount3 + $total2;
    }
    $message4 = $medicine->updateReturnTotalNetCost($invoice_number, $totalAmount3);
}
?>
<style type="text/css">
    .list-group{
        list-style-type: none;
        text-align: left;

    }
    .list-group li{
        padding: 10px;
        background: #fff;
        border-bottom: 1px solid #fff;
        cursor: pointer;
    }
    .list-group li:hover, a:active {
        padding: 10px;
        background: #5897fb;
        color: #ffffff;
        width: auto;
    }
    .sli a:focus{
        padding: 10px;
        color: #ffffff;
        background: #5897fb;
        width: auto;
        display:block;
    }
    .sli a{
        color: #000000;
    }
    .sli a:hover{
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

    .modal-header, h4, .close {
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
                <h3 class="page-title">Medicine / Product Return</h3>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">sale medicine/product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal w3-animate-zoom" id="waitModal" role="dialog" data-controls-modal="waitModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog w3-card-4">
            <!-- Modal content-->
            <div class="modal-content modal-header_three">
                <div class="modal-header_three" style="padding:25px 40px;">
                    <h4><span class="glyphicon glyphicon-exclamation-sign w3-padding-small"></span> Please Wait untill done.</h4>
                    <div class="modal-footer">
                        <a id="closemodal" href="#" class="btn btn-danger">close</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <form id="formid" class="form-horizontal" method="post" action="">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">   
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="lname">Medicine/Product<span style="color: red"> *</span></label>
                                <div align="center">
                                    <input type="text" name="search" id="search" class="search form-control" placeholder="Search Medicine or product" autofocus="autofocus" autocomplete="off"/>
                                    <ul class="list-group" id="result"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="employee_table">
                        <div class="box4">
                            <div class="bottom">
                                <table id="tbl_id" class="table table-bordered table-striped table-hover tbl" style="margin-top: 10px;">
                                    <thead>
                                        <tr style="background-color: #ff9900">
                                            <th class="text-center">SL</th>
                                            <th class="text-center">Item Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Unit Price</th>
                                            <th class="text-center">Discount</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        ?>

                        <div class="card-body">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Date</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose" name="sale_date" value="<?php echo date('m/d/Y'); ?>" placeholder="mm/dd/yyyy" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Customer<span style="color: red">*</span></label>
                                            <select name="cus_name" id="cus_id" class="form-control select2" style="width: 100%;" required>
                                                <option value="">Select Customer</option>
                                                <?php while ($customer = $getCustomer->fetch_assoc()) { ?>
                                                    <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- /.col -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Previous Dues<span style="color: red">*</span></label>
                                            <input type="text" name="predues" id="preDue" class="form-control"  placeholder="0.00" readonly="">
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label>Invoice Number<span style="color: red">*</span></label>
                                                                                <input type="text" name="invoice_number" class="form-control" value="<?php
//                                            if (isset($invNum)) {
////                                                echo $invNum;
//                                            }
                                    ?>">
                                                                                <input type="hidden" name="common_id" class="form-control"  value="<?php echo $commonID; ?>">
                                                                            </div>
                                                                        </div>-->

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Total Amount<span style="color: red">*</span></label>
                                            <input type="text" name="totalAmount" class="form-control" id="grand_total" value="" readonly="">
                                            <input type="hidden" class="form-control" id="hiddenTotalamount" value="" readonly="">
                                            <input type="hidden" name="totalNetAmount" id="totalNetAmount" class="form-control" value="" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">P Method</label><br>
                                            <select name="payment_method" class="form-control"  id="getFname" onchange="admSelectCheck(this);" style="width: 100%;">
                                                <option value="Cash">Cash</option>
                                                <option id="admOption" value="Cheque">Cheque</option>
                                                <option value="Pay order">Pay order</option>
                                                <option value="Credit Card">Credit Card</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input type="text" name="disCnt" class="form-control" id="disCnt" oninput="calculateDis(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Less</label>
                                            <input type="text" name="less" class="form-control" id="less" oninput="calculateDis(this)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Amount<span style="color: red">*</span></label>
                                            <input type="text" name="cashPaid" class="form-control" id="paid" oninput="paidamount(this)" placeholder="Amount" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Dues<span style="color: red">*</span></label>
                                            <input type="text" name="dues" id="currdue" class="form-control" value="<?php echo $totalAmount2; ?>" readonly="">
                                        </div>
                                    </div> 
                                    <div class="col-md-12" id="admDivCheck4" style="display:none;">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">Check Amount</label><br>
                                            <input type="text" name="chequeAmount" class="form-control" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="admDivCheck" style="display:none;">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">Bank Name</label><br>
                                            <select name="bankName" class="form-control" style="width: 100%;">
                                                <option value="">--SELECT BANK--</option>
                                                <?php while ($bank = $bank_info->fetch_assoc()) { ?>
                                                    <option value="//<?php echo $bank['id']; ?>"><?php echo $bank['bank_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="admDivCheck2" style="display:none;">
                                        <div class="form-group">
                                            <label style="font-size: 14px;">Cheque Number</label><br>
                                            <input type="text" name="cheque_num" class="form-control" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="admDivCheck3" style="display:none;">
                                        <div class="form-group">
                                            <label for="datepicker-autoclose">Cheque Approval Date</label>
                                            <input type="text" class="form-control" id="datepicker-autoclose2" name="ChequeAppDate" placeholder="mm/dd/yyyy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" onclick="addPurchase()" name="btn" class="btn btn-success" type="button">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Submit
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn btn-danger" type="reset">
                                    <i class="ace-icon fa fa-crosshairs bigger-110"></i>
                                    Cancel
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
    function addPurchase() {
var tbody = $("#tbl_id tbody");

        if (tbody.children().length === 0) {
            alert("Add item. You can not submit without item.");
            $('#formid').submit(function (evt) {
                evt.preventDefault();
                window.history.back();
                window.location = 'create-invoice.php';
            });
        } else {
			 var e = document.getElementById("cus_id");
        var supplier = e.options[e.selectedIndex].value;
        var paid = document.getElementById("paid").value;
        var qty = document.getElementsByClassName("qty").required = true;
        var qty1 = document.getElementsByClassName("cprice").value;

        if (supplier != '' && paid != '' && qty1 != '0.00') {
            $('#waitModal').modal('show');
            $('#waitModal').modal({backdrop: 'static', keyboard: false});
        }
		}
       

    }

    $('#closemodal').click(function () {
        $('#waitModal').modal('hide');
    });
</script>
<script>
    $(document).ready(function () {
        $('#cus_id').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'loadpage/customerDuesLoad.php',
                data: {'cus_id': id},
                success: function (html) {
                    console.log(html);
                    $('#preDue').val(html);
                }
            });
        });
        var availableTags = []

        $('.search').on('keypress', function () {
            var li = ""
            var text = ''
            $.getJSON('product.php?name=' + $(this).val(), function (response) {
                response.forEach(function (value) {
                    var data_field = value.medicine_name + "|" + value.medicine_form + "| " + value.medicine_strength;
                    var data_field1 = value.medicine_name + "|" + value.medicine_form + "| " + value.medicine_strength + "| " + value.generic_name + "| " + value.company_name;
                    li += "<li class='sli' data-id='" + value.id + "' data-stock='" + value.stock + "' data-price='" + value.sale_price + "' id='" + data_field + "'><a href='#'>" + data_field1 + "</a></li>"
                });
                $('.list-group').html(li)
            })

        })




        $('.tbl tbody').on('click', '.delete-row', function () {
            var id = $(this).data('id')
            console.log(id, products)
            products = products.filter(function (value) {
                return value.id != id
            });
            bindTOTemplate(products)
            createTotal()
        })
        $('.tbl tbody').on('change', '.qty', function () {
            console.log($(this).data('id'), products)

        })
        $('.tbl tbody').on('keyup', '.qty', function () {
            console.log($(this).data('id'), products)
            var id = $(this).data('id')
            var p = products.find(function (value) {
                return value.id == id
            })
            p.qtn = $(this).val();
            var total = +p.qtn * +p.price;
            // this.price = this.price-this.discount*100
            total = total - total * p.discount / 100;
            $(this).parent('td').siblings('.sub_total').text(total)
            var stock = +p.stock + +p.qtn;
            $(this).parent('td').siblings('.stock').text(stock)
            // bindTOTemplate(products)
            createTotal()

        })

        $('.tbl tbody').on('keyup', '.discount', function () {
            console.log($(this).data('id'), products)
            var id = $(this).data('id')
            var p = products.find(function (value) {
                return value.id == id
            })
            p.discount = $(this).val();
            // bindTOTemplate(products)
            var total = +p.qtn * +p.price;
            // this.price = this.price-this.discount*100
            total = total - total * p.discount / 100;
            $(this).parent('td').siblings('.sub_total').text(total)
            var stock = p.stock + p.qtn;
            $(this).parent('td').siblings('.stock').text(stock)
            createTotal()

        })
        var grand_total = 0;

        function createTotal() {
            grand_total = products.reduce(function (amount, row) {
                return amount += row.subtotal()
            }, 0)
            var grandTotal = roundToTwo(grand_total);
            $('#grand_total').val(grandTotal)
            $('#hiddenTotalamount').val(grandTotal)
        }
        function bindTOTemplate(products) {
            $('.tbl tbody').empty()
            if (products) {
                var a = 1;
                products.forEach(function (pro) {

                    var product = "<tr>"
                    product += "<td>" + a++ + "</td>"
                    product += "<td>" + pro.name + "</td>"
                    product += "<td>"
                    product += "<input type'text' name='quantity[]' class='qty form-control' value='" + pro.qtn + "' data-id='" + pro.id + "' />"
                    product += "<input type='hidden' name='product_id[]' class='form-control' value='" + pro.id + "' data-id='" + pro.id + "' />"
                    product += "</td>"

                    product += "<td>" + pro.price + "</td>"

                    product += "<td><input type'text' name='discount[]' class='discount form-control' value='" + pro.discount + "' data-id='" + pro.id + "' /></td>"
                    product += "<td class='sub_total'>" + pro.subtotal() + "</td>"
                    product += "<td class='stock' >" + pro.stk() + "</td>"
                    product += "<td><button class='btn btn-danger delete-row' data-id='" + pro.id + "' >x</button></td>"
                    product += "</tr>"
                    $('.tbl tbody').append(product)
                    createTotal()

                });


            }


        }

        var products = [];
        $('body').on('click', '.list-group li', function () {
            $('.search').val($(this).attr('id'));
            var qty = 1
            var discount = 0
            var subtotal = qty * $(this).data('price')
            var id = $(this).data('id')
            var prod = products.find(function (value) {
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
                price: $(this).data('price'),
                discount: 0,
                stock: $(this).data('stock'),
                subtotal: function () {
                    var total = +this.qtn * +this.price;
                    // this.price = this.price-this.discount*100
                    total = total - total * this.discount / 100;
                    return total;
                },
                stk: function () {
                    var totalStk = +this.stock + +this.qtn;
                    return totalStk;
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
        $('body').click(function () {
            var li = ""

            $('.list-group').html(li)

        })

    });


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
        $('#currdue').val(currentDues);

    }

    function roundToTwo(num) {
        return num.toFixed(2);
        //return +(Math.round(num + "e+2")  + "e-2");
    }
</script>
