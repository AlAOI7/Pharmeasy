<?php

/* Developer: Mhammad Ali Khan
  Email: xvirus.bd@gmail.com
 * web: makgr.com
 */

class Adminlogin {

    private $db;
    private $fm;

    public function __construct() {

        $this->db = new Database();
        $this->fm = new Format();
    }

    public function adminLogin($adminUser, $adminPass) {

        $adminUser = $this->fm->validation($adminUser);

        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);

        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {

            $loginmsg = "Username or password can not be empty";

            return $loginmsg;
        } else {

            $query = "SELECT * FROM admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' AND status = 1";

            $result = $this->db->select($query);

            if ($result != false) {

                $value = $result->fetch_assoc();

                Session::set("adminlogin", true);

                Session::set("adminId", $value['adminId']);

                Session::set("adminUser", $value['adminUser']);

                Session::set("admin_type", $value['user_type']);

                Session::set("adminEmail", $value['adminEmail']);

                Session::set("adminName", $value['adminName']);
                Session::set("access_permission", $value['access_permission']);

                date_default_timezone_set("Asia/Dhaka");
                $adminName = $value['adminName'];
                $browser = $this->fm->get_browser_name($_SERVER['HTTP_USER_AGENT']);
                $today = date("m/d/Y");
                $tdy = date('Y-m-d', strtotime($today));
                $historyQuery = "INSERT INTO admin_login_history
                              (username,name,browser,date,date_time) 
                                VALUES
                             ('$adminUser','$adminName','$browser','$tdy',CURRENT_TIMESTAMP)";

                $hisinsert = $this->db->insert($historyQuery);

                header('Location: dashboard.php');
            } else {

                $loginmsg = "Username or password not matched";

                return $loginmsg;
            }
        }
    }

    public function updatePas($OldPassword, $NewPassword, $adminId) {



        $OldPassword = mysqli_real_escape_string($this->db->link, $OldPassword);

        $NewPassword = mysqli_real_escape_string($this->db->link, md5($NewPassword));

        if (empty($OldPassword) || empty($NewPassword)) {

            $msg = '<div class="alert alert-danger">

						<h4 align="center">Field can not be empty.</h4>
						</div>';

            return $msg;
        } else {

            $passquery = "SELECT * FROM admin WHERE adminId = '$adminId' AND adminPass = '$OldPassword'";

            $passchk = $this->db->select($passquery);

            if ($passchk == false) {
                $msg = '
						<div class="alert alert-danger" style="text-align:center;">
							<h4>Old passwords do not match.</h4>
						</div>
						';
                return $msg;
            } else {
                $query = "UPDATE admin 

			         SET adminPass = '$NewPassword'

					 WHERE adminId = '$adminId'

					 ";

                $passupdate = $this->db->update($query);

                if ($passupdate) {

                    $msg = '

					<div class="alert alert-success">

						<h4 align="center">Password updated successfully.</h4>
					</div>

				  ';

                    return $msg;
                } else {

                    $msg = '

					<div class="alert alert-danger">

						<h4>Failed to Update Password</h4>

					</div>

					';

                    return $msg;
                }
            }
        }
    }

    public function UpdateLogo($file) {

        if ($file['logo']) {

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['logo']['name'];
            $file_size = $file['logo']['size'];
            $file_temp = $file['logo']['tmp_name'];

            $div = explode('.', $file_name);

            $file_ext = strtolower(end($div));

            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;

            $uploaded_image = "images/" . $unique_image;

            $uploaded_image1 = $unique_image;

            if ($file_name) {

                if ($file_size > 1048567) {
                    $msg = '
						<div class="alert alert-danger" style="text-align:center;">
							<h4>Image Size should be less then 1MB!</h4>
						</div>
						';
                    return $msg;
                } elseif (in_array($file_ext, $permited) === false) {

                    $msg = '
						<div class="alert alert-danger" style="text-align:center;">
							<h4>You can upload only:- ' . implode(', ', $permited) . '</h4>
						</div>
						';
                    return $msg;
                } else {

                    $imgquery = "SELECT * FROM logo WHERE logoId ='1'";

                    $getData = $this->db->select($imgquery);
                    if ($getData) {
                        while ($delImg = $getData->fetch_assoc()) {

                            $dellink = "images/" . $delImg['logo'];
                            unlink($dellink);
                        }
                    }

                    move_uploaded_file($file_temp, $uploaded_image);

                    $query = "UPDATE logo 

			         SET logo = '$uploaded_image1'

					 WHERE logoId = '1'

					 ";

                    $infoupdate = $this->db->update($query);

                    if ($infoupdate) {

                        $msg = "
						<div class='alert alert-success' style='text-align:center;'>

                          <h4>Updated successfully</h4>

						</div>
				  ";

                        echo $msg;
                    } else {

                        $msg = "<span class='error'>Failed to Update</span>";

                        echo $msg;
                    }
                }
            }
        }
    }

    public function getLogo() {

        $query = "SELECT * FROM logo";

        $result = $this->db->select($query);

        return $result;
    }

    public function getInfo() {

        $query = "SELECT * FROM info";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateInfo($data) {

        $store_name = mysqli_real_escape_string($this->db->link, $data['store_name']);
        $address_line1 = mysqli_real_escape_string($this->db->link, $data['address_line1']);
        $address_line2 = mysqli_real_escape_string($this->db->link, $data['address_line2']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);


        if (empty($store_name) || empty($address_line1)) {

            $msg = "<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>
			";

            return $msg;
        } else {

            $query = "UPDATE info 

			       SET store_name='$store_name',
				   address_line1 = '$address_line1',
				   address_line2 = '$address_line2',
				   mobile = '$mobile'
				   WHERE id = '1'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {

                $msg = "
					<div class='alert alert-success'>

                        <h4>Store Information Updated successfully</h4>

					</div>";

                return $msg;
            } else {

                $msg = "
					<div class='alert alert-danger'>

                          <h4>Store Information not Updated </h4>

					</div>";

                return $msg;
            }
        }
    }

    public function getNameInfo() {

        $query = "SELECT * FROM info";

        $result = $this->db->select($query);

        return $result;
    }

    public function addSalesman($data) {

        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $nid = mysqli_real_escape_string($this->db->link, $data['nid']);
        $birth = mysqli_real_escape_string($this->db->link, $data['birth']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $status = mysqli_real_escape_string($this->db->link, $data['status']);

        if ($username == "" || $name == "" || $mobile == "" || $email == "" || $nid == "" || $birth == "" || $address == "" || $password == "" || $status == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $usernamequery = "SELECT * FROM salesman WHERE username = '$username' LIMIT 1";

            $userchk = $this->db->select($usernamequery);
            if ($userchk != false) {

                $msg = "<div class='alert alert-danger'>User already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO salesman

			(username,name,mobile,email,nid,birth,address,password,status) 

			VALUES

			('$username','$name','$mobile','$email','$nid','$birth','$address','$password','$status')";

                $salesmaninsert = $this->db->insert($query);

                if ($salesmaninsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Salesman added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add salesman </h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getAllSalesman() {
        $query = "SELECT * FROM salesman WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteSalesman($id) {
        $query = "UPDATE salesman SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:0; url=manage-salesman.php");
            $msg = "<div class='alert alert-success'>
                              <h4>Salesman deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to delete salesman </h3>
					</div>";

            return $msg;
        }
    }

    public function getSalesmanInfoById($sid) {
        $query = "SELECT * FROM salesman WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateSalesmanInfo($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $nid = mysqli_real_escape_string($this->db->link, $data['nid']);
        $birth = mysqli_real_escape_string($this->db->link, $data['birth']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        //$password         = mysqli_real_escape_string($this->db->link,md5($data['password']));
        $status = mysqli_real_escape_string($this->db->link, $data['status']);


        if ($username == "" || $name == "" || $mobile == "" || $email == "" || $nid == "" || $birth == "" || $address == "" || $status == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $query = "UPDATE salesman 
					   SET username = '$username',
					   name = '$name',
					   mobile = '$mobile',
					   email = '$email',
					   nid = '$nid',
					   birth = '$birth',
					   address = '$address',
					   status = '$status'
					   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-salesman.php");
                $msg = "
						<div class='alert alert-success'>
							<h4>Salesman Information Updated successfully</h4>
						</div>";

                return $msg;
            } else {
                $msg = "
						<div class='alert alert-danger'>
							  <h4>Salesman Information not Updated</h4>
						</div>";

                return $msg;
            }
        }
    }

    public function addSupplier($data) {

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $company = mysqli_real_escape_string($this->db->link, $data['company']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);
        $opening = mysqli_real_escape_string($this->db->link, $data['opening']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);


        if ($name == "" || $company == "" || $mobile == "" || $status == "") {

            $msg = "<div class='alert alert-danger'>
                       <h4> Field can not be empty. </h4>
		    </div>";

            return $msg;
        } else {

            $usernamequery = "SELECT * FROM supplier WHERE name = '$name' AND company = '$company' LIMIT 1";

            $userchk = $this->db->select($usernamequery);
            if ($userchk != false) {

                $msg = "<div class='alert alert-danger'>Supplier already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO supplier

			(name,company,mobile,status,opening,balance,address,email) 

			VALUES

			('$name','$company','$mobile','$status','$opening','$opening','$address','$email')";

                $salesmaninsert = $this->db->insert($query);

                if ($salesmaninsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Supplier added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add Supplier </h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getAllSupplier() {
        $query = "SELECT * FROM supplier WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteSupplier($id) {
        $query = "UPDATE supplier SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url=manage-supplier.php");
            $msg = "<div class='alert alert-success'>
                              <h4>Supplier deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to delete Supplier </h3>
					</div>";

            return $msg;
        }
    }

    public function getSupplierById($sid) {
        $query = "SELECT * FROM supplier WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateSupplier($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $company = mysqli_real_escape_string($this->db->link, $data['company']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);
        $opening = mysqli_real_escape_string($this->db->link, $data['opening']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);


        if ($name == "" || $company == "" || $mobile == "" || $status == "" || $opening == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $query = "UPDATE supplier 
			       SET name = '$name',
				   company = '$company',
				   mobile = '$mobile',
				   status = '$status',
				   opening = '$opening',
				   address = '$address',
				   email = '$email'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-supplier.php");
                $msg = "
					<div class='alert alert-success'>
                        <h4>Supplier Information Updated successfully</h4>
					</div>";

                return $msg;
            } else {
                $msg = "
					<div class='alert alert-danger'>
                          <h4>Supplier Information not Updated</h4>
					</div>";

                return $msg;
            }
        }
    }

    public function addCustomer($data) {

        $cusname = mysqli_real_escape_string($this->db->link, $data['cusname']);
        $location = mysqli_real_escape_string($this->db->link, $data['location']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $opening = mysqli_real_escape_string($this->db->link, $data['opening']);
        $cus_type = mysqli_real_escape_string($this->db->link, $data['cus_type']);


        if ($cusname == "" || $cus_type == "" || $mobile == "" || $status == "") {

            $msg = "<div class='alert alert-danger'>
                       <h4> Field can not be empty </h4>
		    </div>";

            return $msg;
        } else {

            $usernamequery = "SELECT * FROM customer WHERE name = '$cusname' AND mobile = '$mobile' AND cus_type = '$cus_type' LIMIT 1";

            $userchk = $this->db->select($usernamequery);
            if ($userchk != false) {

                $msg = "<div class='alert alert-danger'>Customer already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO customer

			(name,location,email,status,mobile,address,opening,cus_type,balance) 

			VALUES

			('$cusname','$location','$email','$status','$mobile','$address','$opening','$cus_type','$opening')";

                $cusinsert = $this->db->insert($query);

                if ($cusinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Customer added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add Customer </h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getAllCustomer() {
        //$query = "SELECT * FROM customer WHERE deletion_status = 0 ORDER BY name ASC";
        $query = "SELECT * FROM customer WHERE deletion_status = 0";
        $result = $this->db->select($query);

        return $result;
    }

    public function deleteCustomer($id) {
        $query = "UPDATE customer SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url=manage-customer.php");
            $msg = "<div class='alert alert-success'>
                              <h4>Customer deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to delete Customer </h3>
					</div>";

            return $msg;
        }
    }

    public function getCustomerInfoById($sid) {

        $query = "SELECT * FROM customer WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateCustomer($data, $sid) {

        //$sid = mysqli_real_escape_string($this->db->link, $sid);

        $cusname = mysqli_real_escape_string($this->db->link, $data['cusname']);
        $location = mysqli_real_escape_string($this->db->link, $data['location']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $medicine = mysqli_real_escape_string($this->db->link, $data['medicine']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $opening = mysqli_real_escape_string($this->db->link, $data['opening']);
        $cus_type = mysqli_real_escape_string($this->db->link, $data['cus_type']);

        if ($cusname == "" || $cus_type == "" || $mobile == "" || $status == "" || $location == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $query = "UPDATE customer 
			       SET name = '$cusname',
				   location = '$location',
				   email = '$email',
				   medicine = '$medicine',
				   status = '$status',
				   mobile = '$mobile',
				   address = '$address',
				   opening = '$opening',
				   cus_type = '$cus_type'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-customer.php");
                $msg = "
					<div class='alert alert-success'>
                        <h4>Customer Information Updated successfully</h4>
					</div>";

                return $msg;
            } else {
                $msg = "
					<div class='alert alert-danger'>
                          <h4>Customer Information not Updated</h4>
					</div>";

                return $msg;
            }
        }
    }

    public function getAllRack() {

        $query = "SELECT * FROM rack WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteRack($id) {
        $query = "UPDATE rack SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url=manage-rack.php");
            $msg = "<div class='alert alert-success'>
							  <h4>Rack deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
					<div class='alert alert-danger'>
						  <h3> Failed to delete Rack </h3>
					</div>";

            return $msg;
        }
    }

    public function addRack($data) {

        $rack_name = mysqli_real_escape_string($this->db->link, $data['rack_name']);


        if ($rack_name == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $rackquery = "SELECT * FROM rack WHERE rack_name = '$rack_name' LIMIT 1";

            $rackchk = $this->db->select($rackquery);
            if ($rackchk != false) {

                $msg = "<div class='alert alert-danger'>Rack already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO rack

							(rack_name) 

							VALUES

						('$rack_name')";

                $rackinsert = $this->db->insert($query);

                if ($rackinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Rack added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add Rack </h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getRackById($sid) {

        $query = "SELECT * FROM rack WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateRack($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $rack_name = mysqli_real_escape_string($this->db->link, $data['rack_name']);

        if ($rack_name == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $query = "UPDATE rack 
			       SET rack_name = '$rack_name'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-rack.php");
                $msg = "
					<div class='alert alert-success'>
                        <h4>Rack Information Updated successfully</h4>
					</div>";

                return $msg;
            } else {
                $msg = "
					<div class='alert alert-danger'>
                          <h4>Rack Information not Updated</h4>
					</div>";

                return $msg;
            }
        }
    }

    public function getAllCustomerType() {

        $query = "SELECT * FROM customer_type WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function getCusTypeById($sid) {

        $query = "SELECT * FROM customer_type WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateCusType($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $customer_type = mysqli_real_escape_string($this->db->link, $data['customer_type']);

        if ($customer_type == "") {

            $msg = "
                    <div class='alert alert-danger'>
              <h4> Field can not be empty </h4>
               </div>";

            return $msg;
        } else {

            $query = "UPDATE customer_type 
                        SET customer_type = '$customer_type'
                            WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url= customer-type.php");
                $msg = "
			<div class='alert alert-success'>
                         <h4>Customer Type Updated successfully</h4>
			</div>";

                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h4>Customer Type Information not Updated</h4>
			</div>";

                return $msg;
            }
        }
    }

    public function deleteCusType($id) {
        $query = "UPDATE customer_type SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= customer-type.php");
            $msg = "<div class='alert alert-success'>
                            <h4>Customer Type deleted successfully</h4>
                  </div>";
            return $msg;
        } else {
            $msg = "
                    <div class='alert alert-danger'>
                              <h3> Failed to delete Customer Type </h3>
                    </div>";

            return $msg;
        }
    }

    public function addCusType($data) {

        $customer_type = mysqli_real_escape_string($this->db->link, $data['customer_type']);

        if ($customer_type == "") {

            $msg = "
                        <div class='alert alert-danger'>
                  <h4> Field can not be empty </h4>
                   </div>";

            return $msg;
        } else {

            $typequery = "SELECT * FROM customer_type WHERE customer_type = '$customer_type' LIMIT 1";

            $typechk = $this->db->select($typequery);
            if ($typechk != false) {

                $msg = "<div class='alert alert-danger'>Customer type already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO customer_type

                                (customer_type) 

                                VALUES

                        ('$customer_type')";

                $typeinsert = $this->db->insert($query);

                if ($typeinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Customer Type added successfully</h4>
			</div>";
                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                           <h3> Failed to add Customer Type </h3>
			</div>";

                    return $msg;
                }
            }
        }
    }

    public function getAllType() {
        $query = "SELECT * FROM customer_type WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function save_user_info($data) {

        $access_permission = $data['access_permission'];
        $chk1 = "";
        foreach ($access_permission as $chk2) {
            $chk1 .= $chk2 . ",";
        }
        $rest1 = substr($chk1, 0, strlen($chk1) - 1);

        $adminName = $data['adminName'];
        $username = $data['username'];
        $status = $data['status'];
        $user_type = $data['user_type'];
        $password = md5($data['password']);

        if ($password) {
            $query = "SELECT * FROM admin WHERE adminUser ='" . $username . "' AND deletion_status = 0";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $message = "<span style='color: white;background:#f44336;padding:8px;'>Sorry User Name is unique . This User Name is alrady exits !!</span>";
                return $message;
            } else {
                $sql = "INSERT INTO `admin`(`adminName`, `adminUser`, `adminPass`, `status`, `user_type`, `access_permission`) "
                        . "VALUES ('$adminName', '$username', '$password','$status','$user_type','$rest1')";
                $uinsert = $this->db->insert($sql);
                if ($uinsert) {
                    $msg = "<div class='alert alert-success'>
                              <h4>User added successfully</h4>
			</div>";
                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                           <h3> Failed to add user. </h3>
			</div>";

                    return $msg;
                }
            }
        }
    }

    public function getUserById($sid) {
        $query = "SELECT * FROM admin WHERE deletion_status = 0 AND adminId = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateUser($data, $sid) {
        $adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
        $user_type = mysqli_real_escape_string($this->db->link, $data['user_type']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $adminPass = mysqli_real_escape_string($this->db->link, $data['password']);

        $access_permission = $data['access_permission'];
        $chk1 = "";
        foreach ($access_permission as $chk2) {
            $chk1 .= $chk2 . ",";
        }
        $rest1 = substr($chk1, 0, strlen($chk1) - 1);

        if ($adminPass == "") {
            $query = "UPDATE admin SET 
			adminName = '$adminName',
			mobile = '$mobile',
			status = '$status',
			user_type = '$user_type',
			access_permission = '$rest1'
			WHERE adminId = '$sid'";

            $result = $this->db->update($query);
            if ($result) {
                $msg = "<div class='alert alert-success'>
                              <h4>User updated successfully</h4>
			</div>";
                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                           <h3> Failed to update user. </h3>
			</div>";

                return $msg;
            }
        } else {
            $newPass = md5($adminPass);
            $query = "UPDATE admin SET 
			adminName = '$adminName',
			adminPass = '$newPass',
			mobile = '$mobile',
			status = '$status',
			user_type = '$user_type',
			access_permission = '$rest1'
			WHERE adminId = '$sid'";

            $result = $this->db->update($query);
            if ($result) {
                $msg = "<div class='alert alert-success'>
                              <h4>User updated successfully</h4>
			</div>";
                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                           <h3> Failed to update user. </h3>
			</div>";

                return $msg;
            }
        }
    }

    public function updateUserStatus() {

        $query = "UPDATE admin 
                        SET status = 0,access_permission = 'ALL'
                            WHERE deletion_status = 0";

        $updated_row = $this->db->update($query);
        return $updated_row;
    }

    public function getInformation() {
        $query = "SELECT * FROM info WHERE id = 1";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getAllCustomerFollowup() {
        $current_date = date('Y-m-d');
        $query = "SELECT * FROM customer WHERE deletion_status = 0 AND '$current_date'<= followup_date";
        $result = $this->db->select($query);

        return $result;
    }

    public function customerFolloup($id, $followup_date) {
        $followup_date = date('Y-m-d', strtotime($followup_date));
        $query = "UPDATE customer SET 
			followup_date = '$followup_date'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            $msg = "<div class='alert alert-success'>
                              <h4>Follow up set up successfully.</h4>
						</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'>
                          <h3> Failed. </h3>
		    </div>";

            return $msg;
        }
    }

    public function customerFolloupDone($id) {
        $query = "UPDATE customer SET 
			followup_date = ''
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            $msg = "<div class='alert alert-success'>
                              <h4>Collection done successfully.</h4>
						</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'>
                          <h3> Failed. </h3>
		    </div>";

            return $msg;
        }
    }

}
?>



