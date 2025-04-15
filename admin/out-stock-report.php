<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getStk = $report->getAllMedicineOutStock();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Out of Stock</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">stock</li>
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
                        <h5 class="card-title">All Out of Stock</h5>
                        <div class="box-tools pull-right" align="center">

                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config2" class="table table-striped table-bordered display tblReport">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">SL</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Generic</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Stock</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
<script>

    $(document).ready(function () {
        $('#zero_config2').dataTable(
                {
                    "pagingType": "simple_numbers",
                    "responsive": true,
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'csv', 'print'
                    ],
                    //scrollY:        "300px",
                    //scrollX:        true,
                    //scrollCollapse: true,
                    //fixedColumns:   true,
                    // "ordering": false,
                    "language": {
                        "emptyTable": "<h2 style='text-align:center;color:#ff5b5b;'>No medicine found!!!</h2>",
                        "zeroRecords": "<h2 style='text-align:center;color:#ff5b5b;'>No matching records found</h2>"

                    },
                    "xhrFields": {withCredentials: true},
                    "bProcessing": true,
                    "sAjaxSource": "loadpage/out-stock.php",
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "iDisplayLength": 10,
                    "aoColumns": [
                        {mData: 'sl'},
                        {mData: 'medicine_name'},
                        {mData: 'medicine_generic'},
                        {mData: 'medicine_from'},
                        {mData: 'medicine_strength'},
                        {mData: 'stock'}
                    ]
                }
        );
    });

</script>