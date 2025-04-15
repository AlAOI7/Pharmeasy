<footer class="footer text-center">
    All Rights Reserved. Developed byalaoi</a> team.
</footer>
</div>
</div>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="dist/js/pages/dashboards/dashboard1.js"></script> 
<!-- Charts js Files -->
<script src="assets/libs/flot/excanvas.js"></script>
<script src="assets/libs/flot/jquery.flot.js"></script>
<script src="assets/libs/flot/jquery.flot.pie.js"></script>
<script src="assets/libs/flot/jquery.flot.time.js"></script>
<script src="assets/libs/flot/jquery.flot.stack.js"></script>
<script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="dist/js/pages/chart/chart-page-init.js"></script>
<script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="dist/js/pages/mask/mask.init.js"></script>
<script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.min.js"></script>
<script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/quill/dist/quill.min.js"></script>
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2({
        tags: "true",
        minimumInputLength: 2,
        placeholder: "Select an option",
        allowClear: true
    });
    $(".select22").select2({
        tags: "true",
        //minimumInputLength: 2,
        placeholder: "Select an option",
        allowClear: true
    });

    /*datwpicker*/
    jQuery('.mydatepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose1').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose4').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose3').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

</script>

<!-- this page js -->
<script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="assets/extra-libs/DataTables/datatables.min.js"></script>

<script src="assets/extra-libs/buttondt/buttons.flash.min.js"></script>
<script src="assets/extra-libs/buttondt/buttons.html5.min.js"></script>
<script src="assets/extra-libs/buttondt/buttons.print.min.js"></script>
<script src="assets/extra-libs/buttondt/dataTables.buttons.min.js"></script>

<script src="assets/extra-libs/buttondt/jszip.min.js"></script>
<script src="assets/extra-libs/buttondt/pdfmake.min.js"></script>
<script src="assets/extra-libs/buttondt/vfs_fonts.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
    $('#zero_config2').DataTable();
    $('#zero_config3').DataTable();
    $('#zero_config4').DataTable();
</script>
<script>
    $(document).ready(function () {
        $('#buttonTab').DataTable({
            responsive: true,
//            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
//	    dom: 'lfrtiBp',	
            dom: 'lBfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'csv', 'print'
            ]
        });
    });
</script>


<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

<script>
    $("#show").change(function () {
        if ($(this).val() == "Box")
        {
            $("#box").show();
        } else
        {
            $("#box").hide();
        }
        if ($(this).val() == "Carton")
        {
            $("#cqty").show();
            $("#bqty").show();
        } else
        {
            $("#cqty").hide();
            $("#bqty").hide();
        }
    });

</script>
<script>
    function admSelectCheck(nameSelect)
    {
        if (nameSelect) {
            admOptionValue = document.getElementById("admOption").value;
            if (admOptionValue == nameSelect.value) {
                document.getElementById("admDivCheck").style.display = "block";
                document.getElementById("admDivCheck2").style.display = "block";
                document.getElementById("admDivCheck3").style.display = "block";
                document.getElementById("admDivCheck4").style.display = "block";
            } else {
                document.getElementById("admDivCheck").style.display = "none";
                document.getElementById("admDivCheck2").style.display = "none";
                document.getElementById("admDivCheck3").style.display = "none";
                document.getElementById("admDivCheck4").style.display = "none";
            }
        } else {
            document.getElementById("admDivCheck").style.display = "none";
        }
    }
</script>
<script>
    function totalItemWiseStock(id) {
        $('#totalItemWiseStock').html('<img src="LoaderIcon.gif" />');
        jQuery.ajax({
            url: "contentload/totalItemWiseStock.php",
            data: 'id=' + id,
            type: "POST",
            success: function (data) {
                if (data.trim() == '') {
                    $('#totalItemWiseStock').html(0);
                    $('#totalItemWiseStock2').html(0);
                } else {
                    $('#totalItemWiseStock').html(data);
                    $('#totalItemWiseStock2').html(data);
                }

            }
        });
    }
    function getTotalMedicineExprieStock(id) {
        $('#getTotalMedicineExprieStock').html('<img src="LoaderIcon.gif" />');
        jQuery.ajax({
            url: "contentload/getTotalMedicineExprieStock.php",
            data: 'id=' + id,
            type: "POST",
            success: function (data) {
                if (data.trim() == '') {
                    $('#getTotalMedicineExprieStockh1').html(0);
                    $('#getTotalMedicineExprieStockh2').html(0);
                    $('#getTotalMedicineExprieStock').html(0);
                } else {
                    $('#getTotalMedicineExprieStockh1').html(data);
                    $('#getTotalMedicineExprieStockh2').html(data);
                    $('#getTotalMedicineExprieStock').html(data);
                }

            }
        });
    }
    function getTotalMedicineExprieSoonStock(id) {
        $('#getTotalMedicineExprieSoonStock').html('<img src="LoaderIcon.gif" />');
        jQuery.ajax({
            url: "contentload/getTotalMedicineExprieSoonStock.php",
            data: 'id=' + id,
            type: "POST",
            success: function (data) {
                if (data.trim() == '') {
                    $('#getTotalMedicineExprieSoonStockh1').html(0);
                    $('#getTotalMedicineExprieSoonStockh2').html(0);
                    $('#getTotalMedicineExprieSoonStock').html(0);
                } else {
                    $('#getTotalMedicineExprieSoonStockh1').html(data);
                    $('#getTotalMedicineExprieSoonStockh2').html(data);
                    $('#getTotalMedicineExprieSoonStock').html(data);
                }

            }
        });
    }
    function totalOutStock(id) {
        $('#totalOutStock').html('<img src="LoaderIcon.gif" />');
        jQuery.ajax({
            url: "contentload/totalOutStock.php",
            data: 'id=' + id,
            type: "POST",
            success: function (data) {
                if (data.trim() == '') {
                    $('#totalOutStock').html(0);
                    $('#totalOutStock2').html(0);
                } else {
                    $('#totalOutStock').html(data);
                    $('#totalOutStock2').html(data);
                }
            }
        });
    }
    
    function totalCustomerFollowup(id) {
        $('#totalOutStock').html('<img src="LoaderIcon.gif" />');
        jQuery.ajax({
            url: "contentload/customer_followup_count.php",
            data: 'id=' + id,
            type: "POST",
            success: function (data) {
                if (data.trim() == '') {
                    $('#customerFollowup').html(0);
                    $('#customerFollowup2').html(0);
                } else {
                    $('#customerFollowup').html(data);
                    $('#customerFollowup2').html(data);
                }

            }
        });
    }

    totalItemWiseStock(1);
    getTotalMedicineExprieStock(1);
    getTotalMedicineExprieSoonStock(1);
    totalOutStock(1);
    totalCustomerFollowup(1);
</script>
</body>

</html>
<?php ob_end_flush(); ?>