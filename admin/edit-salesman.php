<?php include 'header.php';?>
        <!-- ============================================================== -->
        <?php include 'sidebar.php';?>
		<?php
			if(!isset($_GET['sid']) || $_GET['sid'] == NULL){
				echo "<script>window.location = 'manage-salesman.php';</script>";
			}else{
				
				$sid = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['sid']);
			}
			
		 if($_SERVER['REQUEST_METHOD']== 'POST'){

				$UpdateSalesman = $admin->updateSalesmanInfo($_POST,$sid);
			}
		?>
		<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Salesman</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">edit salesman</li>
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
						    if(isset($UpdateSalesman)){
								echo $UpdateSalesman;
							}
						?>
						<?php
							  $getInfo = $admin->getSalesmanInfoById($sid);
							  if($getInfo){
								  while($result = $getInfo->fetch_assoc()) {							  
						   ?>
							<form class="form-horizontal" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Update Salesman</h4>
									<div class="row">	
									<div class="col-md-6">
									<div class="form-group">
									   <label for="uname">User Name<span style="color: red"> *</span></label>
                                       <input type="text" class="form-control" id="uname" value ="<?php echo $result['username'];?>" name="username" placeholder="username" required>
									</div>
									<div class="form-group">
									 <label for="fname">Full Name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="fname" value ="<?php echo $result['name'];?>" name="name" placeholder="Full Name Here" required>
									</div>
									<div class="form-group">
                                        <label for="fname">Phone<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fname" value ="<?php echo $result['mobile'];?>" name="mobile" placeholder="Mobile number">
                                    </div>
									<div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" value ="<?php echo $result['email'];?>" name="email" placeholder="Email">
                                    </div>
										
					                </div>
									
									<div class="col-md-6">
											<div class="form-group">
											    <label for="datepicker-autoclose">Birth Date</label>
												<input type="text" class="form-control" id="datepicker-autoclose" value ="<?php echo $result['birth'];?>" name="birth" placeholder="mm/dd/yyyy">
										    </div>
										<div class="form-group">
											<label for="address">Address</label>
												<input type="text" class="form-control" id="address" value ="<?php echo $result['address'];?>" name="address" placeholder="Address">
										</div>
								<!--		<div class="form-group">
											<label for="lname">Password<span style="color: red"> *</span></label>
											<input type="password" name = "password" class="form-control" id="lname" placeholder="Password Here">
										</div>  -->
										<div class="form-group">
											<label for="fname">NID/Passport<span style="color: red"> *</span></label>
											<input type="text" class="form-control" id="nid" value ="<?php echo $result['nid'];?>" name="nid" placeholder="NID/Passport/Birth Registration" required>
										</div>
										<div class="form-group">
											<label for="lname">Status<span style="color: red"> *</span></label>
												<select class="form-control" name="status" required>
													<option value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
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
<?php include 'footer.php';?>