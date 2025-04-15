<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
if (!isset($_GET['clid']) || $_GET['clid'] == NULL) {
    echo "<script>window.location = 'manage-customer.php';</script>";
} else {

    $clid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['clid']);
}
    $cusSalesLed = $report->getCustomerSalesLedger($clid);
    $cusCollLed = $report->getCustomerCollectionLedger($clid);

?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Customer Ledger</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">customer ledger</li>
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
                        <h5 class="card-title">Customer Ledger Details</h5>
						
                        <h4 class="card-title text-center">
						  <?php
						    echo $cus_name = $medicine->getOneCol('name','customer','id',$clid).'<br>';
						    echo $cus_mobile = $medicine->getOneCol('mobile','customer','id',$clid).'<br>';
						    echo $cus_loc = $medicine->getOneCol('location','customer','id',$clid).'<br>';
						    echo $cus_ad = $medicine->getOneCol('address','customer','id',$clid).'<br>';
						    echo '<label class="text-danger">Current Due: '.$cus_cur_due = $medicine->getOneCol('balance','customer','id',$clid).'</label>';
						  ?>
						</h4>
                      
                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table id="zero_config2" class="table table-striped table-bordered display tblReport">
                                        <thead>
										<th class="text-center" colspan="6"><span style="color:#ffffff;">Sales</span></th>
                                            <tr>
                                                <th style="width:10px;">SL</th>
                                                <th style="width:20px;">Date</th>
                                                <th style="width:20px;">Invoice</th>
                                                <th style="width:20px;">Total</th>
                                                <th style="width:20px;">Cash</th>
                                                <th style="width:20px;">Due</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($cusSalesLed)) {
                                                $i = 0;
												$total = 0;
                                                while ($result = mysqli_fetch_assoc($cusSalesLed)) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($result['sale_date'])); ?>
                                                        </td>
														<td><a target="_blank" href="cusinv.php?invid=<?php echo $result['id']; ?>"><?php echo $result['invoice_number']; ?></a></td>
                                                        <td>
                                                            <?php
                                                             echo  $result['total_amount'];
                                                            ?>
                                                        </td>
														<td>
                                                            <?php
                                                             $cashPaid = $result['amount'];
															 $change = $result['changeAmount'];
															 echo $totSales = $cashPaid + $change;
                                                            ?>
                                                        </td>
														<td>
                                                            <?php
                                                             echo $tamt = $result['inv_due'];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
													$total += $tamt;
                                                }
                                            }
                                            ?>
                                        </tbody>
										<tfoot>
										<th>Total</th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th>
										   <?php
										     if(isset($total)){
												 echo $total;
											 }
										   ?>
										</th>
										</tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered display tblReport">
                                        <thead>
										<th class="text-center" colspan="3"><span style="color:#ffffff;">Collection</span></th>
                                            <tr>
                                                <th style="width:10px;">SL</th>
                                                <th style="width:20px;">Date</th>
                                                <th style="width:20px;">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($cusCollLed)) {
                                                $i = 0;
												$totCol = 0;
                                                while ($res = mysqli_fetch_assoc($cusCollLed)) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($res['collectionDate'])); ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $col = $res['collection'];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
													$totCol += $col;
                                                }
                                            }
                                            ?>
                                        </tbody>
										<tfoot>
										<th>Total</th>
										<th></th>
										<th>
										   <?php
										     if(isset($totCol)){
												 echo $totCol;
											 }
										   ?>
										</th>
										</tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>






