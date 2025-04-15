<?php include 'header.php'; ?>
<!-- ============================================================== -->
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['medicine_id'])) {
    $id = $_GET['medicine_id'];
    $medicineDel = $medicine->deleteMedicine($id);
}
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Medicine</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">medicine</li>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($medicineDel)) {
                        echo $medicineDel;
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Medicine</h5>
                        <div class="box-tools pull-right" align="right">
                            <a href="add-medicine.php"><button type="button" class="btn btn-success"><i
                                        class="fas fa-plus"></i>Add Medicine</button></a>
                        </div><br>
                        <div class="table-responsive">
                            <table id="zero_config1" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">SL</th>
                                        <th style="width:20px;">الاسم</th>
                                        <th style="width:20px;">الاسم العام</th>
                                        <th style="width:20px;">النوع</th>
                                        <th style="width:20px;">القوة</th>
                                        <th style="width:20px;">الرف</th>
                                        <th style="width:50px;">اجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getType = $medicine->getAllMedicine();
                                    if ($getType) {
                                        $i = 0;
                                        while ($result = $getType->fetch_assoc()) {
                                            $i++;
                                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $result['medicine_name']; ?></td>
                                        <td><?php echo $result['medicine_name']; ?></td>
                                        <td>
                                            <?php
                                                    $proType = $medicine->getOneCol('generic', 'generic', 'id', $result['generic_id']);
                                                    echo $proType;
                                                    ?>
                                        </td>
                                        <td><?php echo $result['medicine_form']; ?></td>
                                        <td><?php echo $result['medicine_strength']; ?></td>
                                        <td>
                                            <a href="edit-pro.php?sid=<?php echo $result['id']; ?>"><button
                                                    type="button" class="btn btn-cyan btn-sm">تعديل</button></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a onclick="return confirm('Are you sure to delete?');"
                                                href="?delid=<?php echo $result['id']; ?>"><button type="button"
                                                    class="btn btn-danger btn-sm">Delete</button></a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:20px;">SL</th>
                                        <th style="width:20px;">Name</th>
                                        <th style="width:20px;">Generic</th>
                                        <th style="width:20px;">Form</th>
                                        <th style="width:20px;">Strength</th>
                                        <th style="width:20px;">Rack</th>
                                        <th style="width:50px;">Action</th>
                                    </tr>
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
<script>
/*  $(document).ready(function () {
        $('#zero_config1').dataTable(
                {
                    "pagingType": "simple_numbers",
                    "responsive": true,
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
                    "sAjaxSource": "loadpage/medicine_record.php",
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "iDisplayLength": 10,
                    "aoColumns": [
                        {mData: 'sl'},
                        {mData: 'medicine_name'},
                        {mData: 'medicine_generic'},
                        {mData: 'medicine_from'},
                        {mData: 'medicine_strength'},
                        {mData: 'medicine_rack'},
                        {mData: 'link'}
					]
                }
        );
    }); */


$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#zero_config1 tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

    // DataTable
    var table = $('#zero_config1').DataTable({
        "pagingType": "simple_numbers",
        "responsive": true,
        //scrollY:        "300px",
        //scrollX:        true,
        //scrollCollapse: true,
        //fixedColumns:   true,
        // "ordering": false,
        "language": {
            "emptyTable": "<h2 style='text-align:center;color:#ff5b5b;'>No medicine found!!!</h2>",
            "zeroRecords": "<h2 style='text-align:center;color:#ff5b5b;'>No matching records found</h2>"
        },
        "xhrFields": {
            withCredentials: true
        },
        "bProcessing": true,
        "sAjaxSource": "loadpage/medicine_record.php",
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "aoColumns": [{
                mData: 'sl'
            },
            {
                mData: 'medicine_name'
            },
            {
                mData: 'medicine_generic'
            },
            {
                mData: 'medicine_from'
            },
            {
                mData: 'medicine_strength'
            },
            //{mData: 'medicine_rack'},
            {
                mData: 'link'
            }
        ],
        initComplete: function() {
            // Apply the search
            this.api().columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change clear', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });

});
</script>