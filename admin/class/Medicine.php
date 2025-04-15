<?php

/* Developer: Mhammad Ali Khan
  Email: xvirus.bd@gmail.com
 * web: makgr.com
 */

class Medicine {

    private $db;
    private $fm;

    public function __construct() {

        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getOneCol($col, $tbl, $comCol, $comVal) {
        // $db_connect = $this->__construct();

        $sql = "SELECT $col FROM $tbl WHERE $comCol='$comVal' ";
        $res = $this->db->select($sql);


        if ($res) {
            $result = $this->db->select($sql);
            $row = $result->fetch_assoc();
            return $row[$col];
        }
    }

    public function addGeneric($data) {

        $generic_name = mysqli_real_escape_string($this->db->link, $data['generic_name']);


        if ($generic_name == "") {

            $msg = "
		  <div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
		  </div>";

            return $msg;
        } else {

            $genericquery = "SELECT * FROM generic WHERE generic_name = '$generic_name' LIMIT 1";

            $genericchk = $this->db->select($genericquery);
            if ($genericchk != false) {

                $msg = "<div class='alert alert-danger'>Generic already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO generic

				(generic_name) 

				  VALUES

				('$generic_name')";

                $genericinsert = $this->db->insert($query);

                if ($genericinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Generic added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add Generic </h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getAllGeneric() {

        $query = "SELECT * FROM generic WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteGeneric($id) {
        $query = "UPDATE generic SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url=manage-generic.php");
            $msg = "<div class='alert alert-success'>
							  <h4>Generic deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
					<div class='alert alert-danger'>
						  <h3> Failed to delete Generic </h3>
					</div>";
            return $msg;
        }
    }

    public function getGenericById($sid) {

        $query = "SELECT * FROM generic WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateGeneric($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $generic_name = mysqli_real_escape_string($this->db->link, $data['generic_name']);

        if ($generic_name == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $query = "UPDATE generic 
			       SET generic_name = '$generic_name'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-generic.php");
                $msg = "
					<div class='alert alert-success'>
                        <h4>Generic Information Updated successfully</h4>
					</div>";

                return $msg;
            } else {
                $msg = "
					<div class='alert alert-danger'>
                          <h4>Generic Information not Updated</h4>
					</div>";

                return $msg;
            }
        }
    }

    public function getAllCompany() {

        $query = "SELECT * FROM company WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function addCompany($data) {

        $company_name = mysqli_real_escape_string($this->db->link, $data['company_name']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $opening = mysqli_real_escape_string($this->db->link, $data['opening']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);


        if ($company_name == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $cmpquery = "SELECT * FROM company WHERE company_name = '$company_name' LIMIT 1";

            $cmpchk = $this->db->select($cmpquery);
            if ($cmpchk != false) {

                $msg = "<div class='alert alert-danger'>Company already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO `company`(`company_name`, `mobile`, `opening`, `balance`, `address`, `email`) VALUES

						('$company_name','$mobile','$opening','$opening','$address','$email')";

                $cmpinsert = $this->db->insert($query);

                if ($cmpinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Company added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add Company </h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getCompanyById($sid) {

        $query = "SELECT * FROM company WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateCompany($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $company_name = mysqli_real_escape_string($this->db->link, $data['company_name']);
        $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($company_name == "") {
            $msg = "<div class='alert alert-danger'>
					  <h4> Field can not be empty </h4>
		   </div>";
            return $msg;
        } else {
            $query = "UPDATE company 
			   SET company_name = '$company_name',
			       mobile = '$mobile',
			       address = '$address',
			       email = '$email'
			   WHERE id = '$sid'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                header("Refresh:1; url=manage-company.php");
                $msg = "
				<div class='alert alert-success'>
					<h4>Company Information Updated successfully</h4>
				</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'>
			   <h4>Company Information not Updated</h4>
			</div>";

                return $msg;
            }
        }
    }

    public function deleteCompany($id) {
        $query = "UPDATE company SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url=manage-company.php");
            $msg = "<div class='alert alert-success'>
							  <h4>Company deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
					<div class='alert alert-danger'>
						  <h3> Failed to delete Company </h3>
					</div>";
            return $msg;
        }
    }

    public function getMedicineInfo($medicine_id) {

        //$query = "SELECT * FROM medicine WHERE deletion_status = 0 AND id = '$medicine_id'";

        $query = "SELECT medicine.*,rack.*,generic.*,company.* 
					FROM medicine INNER JOIN rack ON
					medicine.rack_id = rack.id
					
					INNER JOIN generic ON
					medicine.generic_id = generic.id
					
					INNER JOIN company ON
					medicine.company_id = company.id
					WHERE medicine.deletion_status = 0 AND medicine.id = '$medicine_id'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllGenericList() {

        $query = "SELECT * FROM generic WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function getAllCompanyist() {

        $query = "SELECT * FROM company WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function getAllRackist() {

        $query = "SELECT * FROM rack WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function addMedicine($data) {

        $medicine_name = mysqli_real_escape_string($this->db->link, $data['medicine_name']);
        $medicine_form = mysqli_real_escape_string($this->db->link, $data['medicine_form']);
        $medicine_strength = mysqli_real_escape_string($this->db->link, $data['medicine_strength']);
        $company_id = mysqli_real_escape_string($this->db->link, $data['company_id']);
        $generic_id = mysqli_real_escape_string($this->db->link, $data['generic_id']);

        $contentindication = $data['indication'];
        $infoIndication = htmlentities($contentindication);
        $indication = mysqli_real_escape_string($this->db->link, $infoIndication);

        $contentsideeffect = $data['side_effect'];
        $infoSideeffect = htmlentities($contentsideeffect);
        $side_effect = mysqli_real_escape_string($this->db->link, $infoSideeffect);

        $contentadministration = $data['administration'];
        $infoAdministration = htmlentities($contentadministration);
        $administration = mysqli_real_escape_string($this->db->link, $infoAdministration);
        $rack_id = mysqli_real_escape_string($this->db->link, $data['rack_id']);
        $min_stock = mysqli_real_escape_string($this->db->link, $data['min_stock']);
        $purchases_price = mysqli_real_escape_string($this->db->link, $data['purchases_price']);
        $sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);
        $generic_name = $this->getOneCol('generic_name', 'generic', 'id', $generic_id);
        $company_name = $this->getOneCol('company_name', 'company', 'id', $company_id);

        if ($medicine_name == "" || $medicine_form == "" || $medicine_strength == "" || $generic_id == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $medicinequery = "SELECT * FROM medicine WHERE medicine_name = '$medicine_name' AND medicine_form = '$medicine_form' AND medicine_strength = '$medicine_strength' AND company_id = '$company_id' LIMIT 1";

            $medicinechk = $this->db->select($medicinequery);
            if ($medicinechk != false) {

                $msg = "<div class='alert alert-danger'>Medicine already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO medicine

			(medicine_name, medicine_form, medicine_strength, company_id, generic_id,company_name,generic_name, indication, side_effect, administration, rack_id, min_stock,purchases_price,sale_price) 

			VALUES

			('$medicine_name','$medicine_form','$medicine_strength','$company_id','$generic_id','$company_name','$generic_name','$indication','$side_effect','$administration','$rack_id','$min_stock','$purchases_price','$sale_price')";

                $salesmaninsert = $this->db->insert($query);

                if ($salesmaninsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Medicine added successfully.</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add medicine. </h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getMedicineById($medicine_id) {

        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND id = '$medicine_id'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateMedicine($data, $medicine_id) {

        $medicine_id = mysqli_real_escape_string($this->db->link, $medicine_id);
        $medicine_name = mysqli_real_escape_string($this->db->link, $data['medicine_name']);
        $medicine_form = mysqli_real_escape_string($this->db->link, $data['medicine_form']);
        $medicine_strength = mysqli_real_escape_string($this->db->link, $data['medicine_strength']);
        $purchases_price = mysqli_real_escape_string($this->db->link, $data['purchases_price']);
        $sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);
        $company_id = mysqli_real_escape_string($this->db->link, $data['company_id']);
        $generic_id = mysqli_real_escape_string($this->db->link, $data['generic_id']);
        $stock = mysqli_real_escape_string($this->db->link, $data['stock']);

        $contentindication = $data['indication'];
        $infoIndication = htmlentities($contentindication);
        $indication = mysqli_real_escape_string($this->db->link, $infoIndication);

        $contentsideeffect = $data['side_effect'];
        $infoSideeffect = htmlentities($contentsideeffect);
        $side_effect = mysqli_real_escape_string($this->db->link, $infoSideeffect);

        $contentadministration = $data['administration'];
        $infoAdministration = htmlentities($contentadministration);
        $administration = mysqli_real_escape_string($this->db->link, $infoAdministration);
        $rack_id = mysqli_real_escape_string($this->db->link, $data['rack_id']);
        $min_stock = mysqli_real_escape_string($this->db->link, $data['min_stock']);
        $generic_name = $this->getOneCol('generic_name', 'generic', 'id', $generic_id);
        $company_name = $this->getOneCol('company_name', 'company', 'id', $company_id);

        if ($medicine_name == "" || $medicine_form == "" || $medicine_strength == "" || $generic_id == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {
            if (Session::get('admin_type') == 1) {
                $query = "UPDATE medicine 
			   SET 
			   medicine_name = '$medicine_name',
			   medicine_form = '$medicine_form',
			   medicine_strength = '$medicine_strength',
			   company_id = '$company_id',
			   generic_id = '$generic_id',
			   company_name = '$company_name',
			   generic_name = '$generic_name',
			   indication = '$indication',
			   side_effect = '$side_effect',
			   administration = '$administration',
			   rack_id = '$rack_id',
			   min_stock = '$min_stock',
			   stock = '$stock',
			   purchases_price = '$purchases_price',
			   sale_price = '$sale_price'
			   WHERE id = '$medicine_id'";

                $updated_row = $this->db->update($query);

                if ($updated_row) {
                    //header("Refresh:1; url=manage-company.php");
                    $msg = "
                    <div class='alert alert-success'>
                            <h4>Medicine Information Updated successfully</h4>
                    </div>";

                    return $msg;
                } else {
                    $msg = "
                    <div class='alert alert-danger'>
                              <h4>Medicine Information not Updated</h4>
                    </div>";

                    return $msg;
                }
            } else {
                $query = "UPDATE medicine 
			   SET 
			   medicine_name = '$medicine_name',
			   medicine_form = '$medicine_form',
			   medicine_strength = '$medicine_strength',
			   company_id = '$company_id',
			   generic_id = '$generic_id',
			   company_name = '$company_name',
			   generic_name = '$generic_name',
			   indication = '$indication',
			   side_effect = '$side_effect',
			   administration = '$administration',
			   rack_id = '$rack_id',
			   min_stock = '$min_stock',
			   purchases_price = '$purchases_price',
			   sale_price = '$sale_price'
			   WHERE id = '$medicine_id'";

                $updated_row = $this->db->update($query);

                if ($updated_row) {
                    //header("Refresh:1; url=manage-company.php");
                    $msg = "
                    <div class='alert alert-success'>
                            <h4>Medicine Information Updated successfully</h4>
                    </div>";

                    return $msg;
                } else {
                    $msg = "
                    <div class='alert alert-danger'>
                              <h4>Medicine Information not Updated</h4>
                    </div>";

                    return $msg;
                }
            }
        }
    }

    public function deleteMedicine($id) {
        $query = "UPDATE medicine SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:13; url=medicine.php");
            $msg = "<div class='alert alert-success'>
                            <h4>Medicine deleted successfully</h4>
                  </div>";
            return $msg;
        } else {
            $msg = "
                <div class='alert alert-danger'>
                          <h3> Failed to delete Medicine </h3>
                </div>";
            return $msg;
        }
    }

    public function getAllUnit() {

        $query = "SELECT * FROM unit WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteUnit($delid) {
        $query = "UPDATE unit SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url=manage-unit.php");
            $msg = "<div class='alert alert-success'>
							  <h4>Unit deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
					<div class='alert alert-danger'>
						  <h3> Failed to delete Unit </h3>
					</div>";
            return $msg;
        }
    }

    public function addUnit($data) {

        $unit_name = mysqli_real_escape_string($this->db->link, $data['unit_name']);


        if ($unit_name == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $unitquery = "SELECT * FROM unit WHERE unit_name = '$unit_name' LIMIT 1";

            $unitchk = $this->db->select($unitquery);
            if ($unitchk != false) {

                $msg = "<div class='alert alert-danger'>Unit already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO unit

							(unit_name) 

							VALUES

						('$unit_name')";

                $unitinsert = $this->db->insert($query);

                if ($unitinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Unit added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add unit</h3>
					</div>";

                    return $msg;
                }
            }
        }
    }

    public function getUnitById($sid) {

        $query = "SELECT * FROM unit WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateUnit($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $unit_name = mysqli_real_escape_string($this->db->link, $data['unit_name']);

        if ($unit_name == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $query = "UPDATE unit 
			       SET unit_name = '$unit_name'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-unit.php");
                $msg = "
		      <div class='alert alert-success'>
                        <h4>Unit Information Updated successfully</h4>
		      </div>";

                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h4>Unit Information not Updated</h4>
			</div>";

                return $msg;
            }
        }
    }

    public function getAllMedicine() {

        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSupplier() {
//        $query = "SELECT * FROM supplier WHERE deletion_status = 0 AND status = 1";
        $query = "SELECT * FROM company WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);
		
        return $result;
    }

    public function getAllBankName() {

        $query = "SELECT * FROM bank WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function getInvoiceIdInfo() {

        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status= 0 || deletion_status = 1 ORDER BY id DESC LIMIT 1";

        $result = $this->db->select($query);

        return $result;
    }

    public function addItem($product_id, $mdate, $edate, $cprice, $sprice, $quantity, $subTotal, $invoice_number, $inStock, $sup_name, $pur_date) {

        $mdate1 = date('Y-m-d', strtotime($mdate));
        $edate1 = date('Y-m-d', strtotime($edate));
        $query = "INSERT INTO purchase_product_info
			(medicine, manufacturing, expire_date, purchase_price, sale_price, qty, sub_total, unit_type,common_id,supplier,pur_date) 
			VALUES
			('$product_id','$mdate1','$edate1','$cprice','$sprice','$quantity','$subTotal','Pcs','$invoice_number','$sup_name','$pur_date')";

        $iteminsert = $this->db->insert($query);
        if ($iteminsert) {
            $updquery = "UPDATE `medicine` SET stock = '$inStock',purchases_price = '$cprice',sale_price ='$sprice' WHERE id = '$product_id'";
            $result = $this->db->update($updquery);
        }
        return $iteminsert;
    }

    public function addExpiredItem($product_id, $quantity, $mdate, $edate, $pur_date) {

        $mdate1 = date('Y-m-d', strtotime($mdate));
        $edate1 = date('Y-m-d', strtotime($edate));
        $query = "INSERT INTO `expired_stock`(`product`, `qty`, `mdate`, `edate`, `pur_date`) 
                        VALUES('$product_id', '$quantity', '$mdate', '$edate', '$pur_date')";

        $itemInsert = $this->db->insert($query);
        return $itemINsert;


//         $mdate1 = date('Y-m-d', strtotime($mdate));
//        $edate1 = date('Y-m-d', strtotime($edate));
//
//        $check = "SELECT * FROM `expired_stock` WHERE `product` = '$product_id'";
//        $temp = 0;
//        $test_case = $this->db->select($check);
//        if ($test_case) {
//            $row = $test_case->fetch_assoc();
//            if ($row['product'] == $product_id) {
//                $query = "UPDATE `expired_stock` SET `edate` = '$edate' , `pur_date` = '$pur_date' WHERE `product` = '$product_id' ";
//
//                $itemUpdate = $this->db->update($query);
//                return $itemUpdate;
//            } else {
//                $query = "INSERT INTO `expired_stock`(`product`, `qty`, `mdate`, `edate`, `pur_date`) 
//                            VALUES('$product_id', '$quantity', '$mdate', '$edate', '$pur_date')";
//
//                $itemInsert = $this->db->insert($query);
//                return $itemINsert;
//            }
//        } else {
//            $query = "INSERT INTO `expired_stock`(`product`, `qty`, `mdate`, `edate`, `pur_date`) 
//                        VALUES('$product_id', '$quantity', '$mdate', '$edate', '$pur_date')";
//
//            $itemInsert = $this->db->insert($query);
//            return $itemINsert;
//        }
    }

    public function select_all_purches_product_info() {

        $query = "SELECT * FROM purchase_product_info WHERE deletion_status= 0 AND status_flag = 0 ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_purComnID_info() {

        $query = "SELECT * FROM purchase_product_info WHERE deletion_status= 0 AND status_flag = 0 ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function save_purchase_main_invoice_info($product_sup_name, $currentDue, $invoice_number, $purchase_date, $totalAmount, $payment_method, $disCnt, $less, $cashPaid, $dues, $predues, $chequeAmount, $bankName, $cheque_num, $cheque_app_date) {

//        $query = "INSERT INTO `supplier_invoice_info`"
//                . "(`supplier`, `previous_due`, `invoice_number`, `purchase_date`, `total_amount`, `payment_method`,`discount`,`less`,`amount`, `dues`, `checkAmount`, `bankName`, `checkNumber`, `checkAppDate`)"
//                . " VALUES  ('$product_sup_name','$predues','$invoice_number','$purchase_date','$totalAmount','$payment_method','$disCnt','$less','$cashPaid','$currentDue','$chequeAmount','$bankName','$cheque_num','$cheque_app_date')";

        $query = "INSERT INTO `supplier_invoice_info`"
                . "(`supplier`, `previous_due`, `invoice_number`, `purchase_date`, `total_amount`, `payment_method`,`discount`,`less`,`amount`, `dues`, `checkAmount`, `bankName`, `checkNumber`, `checkAppDate`)"
                . " VALUES  ('$product_sup_name','$predues','$invoice_number','$purchase_date','$totalAmount','$payment_method','$disCnt','$less','$cashPaid','$dues','$chequeAmount','$bankName','$cheque_num','$cheque_app_date')";

        $result = $this->db->insert($query);
        if ($result) {
            $con = $this->db->link;
            $id = mysqli_insert_id($con);
            return $id;
        } else {
            $message = "Purchase Invoice Info Save Failed.";
            return $message;
        }
    }

    public function updateProductStatusFlag($invoice_number) {

        $query = "UPDATE `purchase_product_info` SET status_flag = 1 WHERE common_id = '$invoice_number'";
        $result = $this->db->update($query);
        if ($result) {
            return $result;
        }
    }

    public function updateSupplierDues($currentDue, $product_sup_name) {

        $query = "UPDATE `company` SET balance = '$currentDue' WHERE id = '$product_sup_name'";
        $result = $this->db->update($query);
        if ($result) {
            $_SESSION['message'] = "<div class='alert alert-success'>
                            <h3>Purchase successfully</h3>
                       </div>";
            header('Location: add-purchase.php');
            exit();
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>
                            <h3>Purchase Failed.</h3>
                       </div>";
            header('Location: add-purchase.php');
            exit();
        }
    }

    public function updateReturnSupplierDues($currentDue, $product_sup_name) {

        $query = "UPDATE `company` SET balance = '$currentDue' WHERE id = '$product_sup_name'";
        $result = $this->db->update($query);
        if ($result) {
            $_SESSION['message'] = "<div class='alert alert-success'>
                            <h5>Purchase Return successfully</h5>
                       </div>";
            header('Location: add-purchase-return.php');
            exit();
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>
                            <h5>Purchase Return Failed.</h5>
                       </div>";
            header('Location: add-purchase-return.php');
            exit();
        }
    }

    public function updateStock() {

        $sql = "UPDATE `supplier` SET balance = '$currentDue' WHERE id = '$product_sup_name'";
        $result = $this->db->update($query);
        if ($result) {
            $message = "Save Successfully.";
            return $message;
        } else {
            $message = "Save Failed.";
            return $message;
        }
    }

    public function insertSupplierInvoice($product_sup_name, $predues, $invoice_number, $purchase_date, $totalAmount, $payment_method, $cashPaid, $currentDue, $chequeAmount, $bankName, $cheque_num, $cheque_app_date) {

        $query = "INSERT INTO `supplier_invoice_info`(`supplier`, `previous_due`, `invoice_number`, `purchase_date`, `total_amount`, `payment_method`, `amount`, `dues`, `checkAmount`, `bankName`, `checkNumber`, `checkAppDate`)"
                . " VALUES "
                . "('$product_sup_name','$predues','$invoice_number','$purchase_date','$totalAmount','$payment_method','$cashPaid','$currentDue','$chequeAmount','$bankName','$cheque_num','$cheque_app_date')";

        $result = $this->db->insert($query);

        if ($result) {

            $msg = "<div class='alert alert-success'>
                        <h4>Purchase Successfull.</h4>
                    </div>";
            return $msg;
        } else {
            $msg = "
                    <div class='alert alert-danger'>
                        <h3> Failed to Purchase.</h3>
                    </div>";

            return $msg;
        }
    }

    public function select_all_supplier_invoice_info() {

        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status= 0 AND purchase_date = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_all_supplier_return_invoice_info() {

        $query = "SELECT * FROM supplier_return_invoice_info WHERE deletion_status= 0 AND purchase_date = date(now()) ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_supplier_invoice_info($invid) {

        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status= 0 AND invoice_number = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_supplier_return_invoice_info($invid) {

        $query = "SELECT * FROM supplier_return_invoice_info WHERE deletion_status= 0 AND invoice_number = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getPurchaseInfo($invid) {
        $query = "SELECT * FROM purchase_product_info WHERE common_id = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getPurchaseReturnInfo($invid) {
        $query = "SELECT * FROM purchase_return_product_info WHERE common_id = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteSupInv($delid) {
        $query = "UPDATE supplier_invoice_info SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-purchase.php");
            $msg = "<div class='alert alert-success'>
			<h4>Invoice deleted successfully</h4>
		   </div>";
            return $msg;
        } else {
            $msg = "
		   <div class='alert alert-danger'>
			<h3> Failed to delete Invoice </h3>
		    </div>";
            return $msg;
        }
    }

    public function deleteSupReturnInv($delid) {
        $query = "UPDATE supplier_return_invoice_info SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-purchase-return.php");
            $msg = "<div class='alert alert-success'>
			<h4>Invoice deleted successfully</h4>
		   </div>";
            return $msg;
        } else {
            $msg = "
		   <div class='alert alert-danger'>
			<h3> Failed to delete Invoice </h3>
		    </div>";
            return $msg;
        }
    }

    public function deleteInv($delid) {

        $delMediDetails = "UPDATE sale_product_info SET 
			deletion_status = '1'
			WHERE commonId = '$delid'";
        $resultDel = $this->db->update($delMediDetails);

        $query = "UPDATE customer_invoice_info SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-invoice.php");
            $msg = "<div class='alert alert-success'>
			<h4>Invoice deleted successfully</h4>
		   </div>";
            return $msg;
        } else {
            $msg = "
		   <div class='alert alert-danger'>
			<h3> Failed to delete Invoice </h3>
		    </div>";
            return $msg;
        }
    }

    public function allSupplier() {
        $query = "SELECT * FROM company WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function dueSupplierPayment($data, $user_id, $user_name) {

        $paymentReceipt = mysqli_real_escape_string($this->db->link, $data['paymentReceipt']);
        $supplier = mysqli_real_escape_string($this->db->link, $data['supplier']);
        $paid = mysqli_real_escape_string($this->db->link, $data['paid']);
        $dues = mysqli_real_escape_string($this->db->link, $data['dues']);
        $currdue = mysqli_real_escape_string($this->db->link, $data['currdue']);
        $paymentDate = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['paymentDate'])));


        $query = "INSERT INTO supplier_payment
			    (payment_receipt,supplierId,previous_due,payment,current_due,paymentDate,user_id,username)
                            VALUES
			  ('$paymentReceipt','$supplier','$dues','$paid','$currdue','$paymentDate','$user_id','$user_name')";

        $paymentinsert = $this->db->insert($query);

        if ($paymentinsert) {

            $con = $this->db->link;
            $id = mysqli_insert_id($con);
            //generate invoice number


            $d = date('ymd');
            $year = date('Y');

            $last_date_query = "SELECT * FROM collection_invoice_count ORDER BY id DESC LIMIT 1";
            $result_last_date = $this->db->select($last_date_query);
            if($result_last_date != FALSE){
            $getLastDate = mysqli_fetch_assoc($result_last_date);
            $last_date = $getLastDate['inv_date'];
            }
            $saleDateY = date('Y', strtotime($last_date));

            if ($year != $saleDateY) {
                $truncate = "TRUNCATE TABLE payment_invoice_count";
                $exeTr = $this->db->delete($truncate);

                $querySIC = "INSERT INTO `payment_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$paymentDate','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'P' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE supplier_payment SET payment_receipt = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            } else {
                $querySIC = "INSERT INTO `payment_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$paymentDate','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'P' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE supplier_payment SET payment_receipt = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            }


            $query = "UPDATE `company` SET balance = '$currdue' WHERE id = '$supplier'";
            $result = $this->db->update($query);

            if ($result) {
                $_SESSION['message'] = "<div class='alert alert-success'>Payment successful.</div>";
                header('Location: create-payment.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed.</div>";
            header('Location: create-payment.php');
            exit();
        }
    }

    public function getAllPayment() {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_payment_lastId_info() {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSinglePayment($payid) {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND payment_receipt = '$payid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function deletePayment($payDelid) {

        $supID = $this->getOneCol('supplierId', 'supplier_payment', 'id', $payDelid);
        $supCurDue = $this->getOneCol('balance', 'company', 'id', $supID);
        $payment = $this->getOneCol('payment', 'supplier_payment', 'id', $payDelid);

        $newDue = $supCurDue + $payment;
        $querySupDue = "UPDATE company SET 
			balance = '$newDue'
			WHERE id = '$supID'";

        $res = $this->db->update($querySupDue);

        $query = "UPDATE supplier_payment SET 
			deletion_status='1'
			WHERE id = '$payDelid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-payment.php");
            $msg = "<div class='alert alert-success'>
			<h4>Payment Info deleted successfully</h4>
		</div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
			<h3> Failed to delete Payment Info. </h3>
		</div>";
            return $msg;
        }
    }

    public function getAllMedicineProduct() {

        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND status = 1 AND stock != ''";
        $result = $this->db->select($query);

        return $result;
    }

    public function getAllCustomer() {

        $query = "SELECT * FROM customer WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function getCustomerInvoiceIdInfo() {

        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status= 0 || deletion_status = 1 ORDER BY id DESC LIMIT 1";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_medicine_stock_info($medicine_id) {

        $query = "SELECT * FROM medicine WHERE deletion_status= 0 AND id = '$medicine_id'";

        $result = $this->db->select($query);

        return $result;
    }

    public function addProduct($medicine_id, $stock, $unitPrice, $dis, $subTot, $net_cost, $user_id, $mac, $user_name) {

        $query = "INSERT INTO `cart`(`medicine_id`, `qty`, `unit_price`, `discount`, `sub_total`, `net_cost`, `user_id`, `user_name`, `common_id`) 
                   VALUES
                 ('$medicine_id','$stock','$unitPrice','$dis','$subTot','$net_cost','$user_id','$user_name','$mac')";

        $iteminsert = $this->db->insert($query);
        return $iteminsert;
    }

    public function select_sale_product_info($invoice_number, $common_id) {

//        $query = "SELECT * FROM sale_product_info WHERE inv_number = '$invoice_number' AND commonId = '$common_id'";
        $query = "SELECT * FROM sale_product_info WHERE commonId = '$common_id'";

        $result = $this->db->select($query);

        return $result;
    }

    public function save_customer_invoice_info($cus_name, $predues, $invoice_number, $sale_date, $mainTotalAmount, $totalAmount, $totalNetAmount, $payment_method, $disCnt, $less, $cashPaid, $change, $currentDue, $dues, $chequeAmount, $bankName, $cheque_num, $cheque_app_date, $user_id, $user_name) {

        $query = "INSERT INTO `customer_invoice_info`(`customer`, `previous_due`, `invoice_number`, `sale_date`, `mainTotalAmount`, `total_amount`, `totalNetAmount`,`payment_method`,`discount`,`less`, `amount`,`changeAmount`, `dues`,`inv_due`, `checkAmount`, `bankName`, `checkNumber`, `checkAppDate`, `user_id`, `user_name`) "
                . "VALUES  ('$cus_name','$predues','$invoice_number','$sale_date','$mainTotalAmount','$totalAmount','$totalNetAmount','$payment_method','$disCnt','$less','$cashPaid','$change','$currentDue','$dues','$chequeAmount','$bankName','$cheque_num','$cheque_app_date','$user_id','$user_name')";

        $result = $this->db->insert($query);
        if ($result) {
            $con = $this->db->link;
            $id = mysqli_insert_id($con);
            //generate invoice number


            $d = date('ymd');
            $year = date('Y');

            $last_date_query = "SELECT * FROM sale_invoice_count ORDER BY id DESC LIMIT 1";
            $result_last_date = $this->db->select($last_date_query);
//            if (mysqli_num_rows($result_last_date) > 0) {
            if ($result_last_date != FALSE) {
                $getLastDate = mysqli_fetch_assoc($result_last_date);
                $last_date = $getLastDate['inv_date'];
            }


            $saleDateY = date('Y', strtotime($last_date));

            if ($year != $saleDateY) {
//                mysqli_query($this->db->link, "TRUNCATE TABLE sale_invoice_count");
                $truncate = "TRUNCATE TABLE sale_invoice_count";
                $exeTr = $this->db->delete($truncate);

                $querySIC = "INSERT INTO `sale_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$sale_date','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'SP' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE customer_invoice_info SET invoice_number = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            } else {
                $querySIC = "INSERT INTO `sale_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$sale_date','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'SP' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE customer_invoice_info SET invoice_number = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            }
            return $id;
        } else {
            $message = "Invoice Info Save Failed.";
            return $message;
        }
    }

    public function in_cash_income($sale_date, $cashPaid) {
        $query = "INSERT INTO `in_cash_income`(`date`, `amount`) VALUES ('$sale_date','$cashPaid')";
        $result = $this->db->insert($query);
        return $result;
    }

    public function updateTotalNetCost($totalAmount3, $common_id) {
        $invoice_number = $this->getOneCol('invoice_number', 'customer_invoice_info', 'id', $common_id);
        $query = "UPDATE `customer_invoice_info` SET totalNetAmount = '$totalAmount3' WHERE invoice_number = '$invoice_number' AND id = '$common_id'";

        $result = $this->db->update($query);
        if ($result) {
            $_SESSION['message'] = "Successfull" . "##" . $invoice_number;
            header('Location: create-invoice.php');
            exit();
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed.</div>";
            header('Location: create-invoice.php');
            exit();
        }
    }

    public function updateReturnTotalNetCost($invoice_number, $totalAmount3) {
        $query = "UPDATE `customer_return_invoice_info` SET totalNetAmount = '$totalAmount3' WHERE invoice_number = '$invoice_number'";
        $result = $this->db->update($query);
        if ($result) {
            $_SESSION['message'] = "<div class='alert alert-success'>
                            <h4>Sale Return successfully</h4>
                       </div>";
            header('Location: add-sales-return.php');
            exit();
        } else {
            $_SESSION['message'] = "<div class='alert alert-success'>
                            <h5>Sale Return failed.</h5>
                       </div>";
            header('Location: add-sales-return.php');
            exit();
        }
    }

    public function insertItem($product_id, $quantity, $sale_price, $discount, $netSalesamount, $netCosAmount, $invoice_number, $common_id, $user_id, $user_name, $inStock, $product_os) {

        $saleInsertQuery = "INSERT INTO `sale_product_info`(`medicine`, `qty`, `unit_price`, `discount`, `sub_total`, `net_cost`, `inv_number`, `commonId`, `user_id`, `user_name`,`product_os`) "
                . "VALUES ('$product_id','$quantity','$sale_price','$discount','$netSalesamount','$netCosAmount','$invoice_number','$common_id','$user_id','$user_name','$product_os')";
        $saleInsert = $this->db->insert($saleInsertQuery);
        if ($saleInsert) {
            $query = "UPDATE `medicine` SET stock = '$inStock' WHERE id = '$product_id' AND pro_type != '5'";
            $result = $this->db->update($query);
        }
        return $saleInsert;
    }

    public function updateCustomerDues($currentDue, $cus_name) {

        $query = "UPDATE `customer` SET balance = '$currentDue' WHERE id = '$cus_name'";
        $result = $this->db->update($query);
        if ($result) {
            return $result;
        }
    }

    public function updateReturnCustomerDues($currentDue, $cus_name) {

        $query = "UPDATE `customer` SET balance = '$currentDue' WHERE id = '$cus_name'";
        $result = $this->db->update($query);
        if ($result) {
            return $result;
        }
    }

    public function select_all_customer_invoice_info() {

        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date = date(now()) ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSingleInvoice(
    $invid) {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND id = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllProductInvoice(
    $invid) {
        $query = "SELECT * FROM sale_product_info WHERE deletion_status = 0 AND commonId = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function allCustomer() {



        $query = "SELECT * FROM customer WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function select_collection_lastId_info() {


        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function dueCustomerCollection($data, $user_name) {

        $collectionReceipt = mysqli_real_escape_string($this->db->link, $data['collectionReceipt']);
        $customer = mysqli_real_escape_string($this->db->link, $data['customer']);
        $dues = mysqli_real_escape_string($this->db->link, $data['dues']);
        $paid = mysqli_real_escape_string($this->db->link, $data['paid']);
//        $currdue = mysqli_real_escape_string($this->db->link, $data['currdue']);
        $currdue = $dues - $paid;
        $collectionDate = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['collectionDate'])));
        $user_id = mysqli_real_escape_string($this->db->link, $data['user_id']);


        $query = "INSERT INTO `customer_collection`(`collection_receipt`, `customerId`, `previous_due`, `collection`, `current_due`, `collectionDate`, `user_id`, `user_name`)
                    VALUES

                    ('$collectionReceipt', '$customer', '$dues', '$paid', '$currdue', '$collectionDate', '$user_id', '$user_name')";

        $collectioninsert = $this->db->insert($query);

        if ($collectioninsert) {

            $con = $this->db->link;
            $id = mysqli_insert_id($con);
            //generate invoice number


            $d = date('ymd');
            $year = date('Y');

            $last_date_query = "SELECT * FROM collection_invoice_count ORDER BY id DESC LIMIT 1";
            $result_last_date = $this->db->select($last_date_query);
            if($result_last_date != FALSE){
            $getLastDate = mysqli_fetch_assoc($result_last_date);
            $last_date = $getLastDate['inv_date'];
            }
            $saleDateY = date('Y', strtotime($last_date));

            if ($year != $saleDateY) {
                $truncate = "TRUNCATE TABLE collection_invoice_count";
                $exeTr = $this->db->delete($truncate);

                $querySIC = "INSERT INTO `collection_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$collectionDate','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'C' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE customer_collection SET collection_receipt = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            } else {
                $querySIC = "INSERT INTO `collection_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$collectionDate','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'C' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE customer_collection SET collection_receipt = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            }


            $query = "UPDATE `customer` SET balance = '$currdue' WHERE id = '$customer'";
            $result = $this->db->update($query);

            if ($result) {
                $_SESSION['messageC'] = "<div class='alert alert-success'>
                            <h5>Collection successful.</h5>
                       </div>";
                header('Location: add-collection.php');
                exit();
            }
        } else {
            $_SESSION['messageC'] = "<div class='alert alert-danger'>
                            <h5>Collection failed.</h5>
                       </div>";
            header('Location: add-collection.php');
            exit();
        }
    }

    public function getAllCollection() {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteCollection($colDelid) {
        $collection = $this->getOneCol('collection', 'customer_collection', 'id', $colDelid);
        $customerId = $this->getOneCol('customerId', 'customer_collection', 'id', $colDelid);
        $customerCurDue = $this->getOneCol('balance', 'customer', 'id', $customerId);
        $pre_due = $collection + $customerCurDue;
        $cusDueUpd = "UPDATE customer SET
                    balance = '$pre_due'
                    WHERE id = '$customerId'";
        $res = $this->db->update($cusDueUpd);

        $query = "UPDATE customer_collection SET
                    deletion_status = '1'
                    WHERE id = '$colDelid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url = manage-collection.php");
            $msg = "<div class = 'alert alert-success'>
                    <h4>Collection Info deleted successfully</h4>
                    </div>";
            return $msg;
        } else {
            $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to delete Collection Info.</h3>
                    </div>";
            return $msg;
        }
    }

    public function getAllSingleCollection($collid) {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 AND collection_receipt = '$collid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_cart_product_info($itemId, $commonID) {

        $query = " SELECT * FROM cart WHERE common_id = '$commonID' AND id = '$itemId'";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_medicine_stock_info2($medicine_id2) {

        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND id = '$medicine_id2'";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteCartItem($itemId) {

        $query = "DELETE FROM cart
                    WHERE id = '$itemId'";

        $result = $this->db->delete($query);
        if ($result) {
            header("Refresh:1;
                    url = create-invoice.php");
            $msg = "<div class = 'alert alert-success'>
                    <h4>Item deleted successfully</h4>
                    </div>";
            return $msg;
        } else {
            $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to delete Item </h3>
                    </div>";
            return $msg;
        }
    }

    public function medicineStockUpdate($currentStock2, $medicine_id2) {


        $updStk = " UPDATE `medicine` SET stock = '$currentStock2' WHERE id = '$medicine_id2'";
        $resultStk = $this->db->update($updStk);
        return $resultStk;
    }

    public function allMedicineProduct() {


        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function addReturnProduct(
    $medicine_id, $stock, $unitPrice, $subTot, $net_cost, $user_id, $mac, $user_name) {

        $query = "       INSERT INTO `return_cart`(`medicine_id`, `qty`, `unit_price`, `sub_total`, `net_cost`, `user_id`, `user_name`, `common_id`)
                    VALUES
                    ('$medicine_id', '$stock', '$unitPrice', '$subTot', '$net_cost', '$user_id', '$user_name', '$mac')";

        $iteminsert = $this->db->insert($query);
        return $iteminsert;
    }

    public function returnProStockUpdate(
    $currentStock, $medicine_id) {

        $query = " UPDATE `medicine` SET stock = '$currentStock' WHERE id = '$medicine_id'";
        $result = $this->db->update($query);

        if ($result) {

            $msg = "<div class = 'alert alert-success'>
                    <h4>Product added successfully</h4>
                    </div>";
            header('Location: ' . $_SERVER['PHP_SELF']);
            return $msg;
        } else {
            $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to add Product </h3>
                    </div>";

            return $msg;
        }
    }

    public function select_all_return_cart_product_info(
    $user_id, $commonID) {

        $query = " SELECT * FROM return_cart WHERE user_id = '$user_id' AND common_id = '$commonID'";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_return_cart_product_info(
    $itemId, $commonID) {

        $query = " SELECT * FROM return_cart WHERE common_id = '$commonID' AND id = '$itemId'";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteReturnCartItem(
    $itemId) {

        $query = "DELETE FROM return_cart
                    WHERE id = '$itemId'";

        $result = $this->db->delete($query);
        if ($result) {
            header("Refresh:1;
                    url = add-sales-return.php");
            $msg = "<div class = 'alert alert-success'>
                    <h4>Item deleted successfully</h4>
                    </div>";
            return $msg;
        } else {
            $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to delete Item </h3>
                    </div>";
            return $msg;
        }
    }

    public function return_cart_product_info(
    $user_id, $commonID) {

        $query = " SELECT * FROM return_cart WHERE user_id = '$user_id' AND common_id = '$commonID'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getCustomerReturnInvoiceIdInfo() {

        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 || deletion_status = 1 ORDER BY id DESC LIMIT 1";

        $result = $this->db->select($query);

        return $result;
    }

    public function save_customer_return_invoice_info($cus_name, $predues, $invoice_number, $sale_date, $totalAmount, $totalNetAmount, $payment_method, $disCnt, $less, $cashPaid, $currentDue, $dues, $chequeAmount, $bankName, $cheque_num, $cheque_app_date, $user_id, $user_name) {

        $query = "INSERT INTO `customer_return_invoice_info`(`customer`, `previous_due`, `invoice_number`, `sale_date`, `total_amount`, `totalNetAmount`, `payment_method`, `discount`, `less`, `amount`, `dues`, `checkAmount`, `bankName`, `checkNumber`, `checkAppDate`, `user_id`, `user_name`) "
                . "VALUES ('$cus_name', '$predues', '$invoice_number', '$sale_date', '$totalAmount', '$totalNetAmount', '$payment_method', '$disCnt', '$less', '$cashPaid', '$currentDue', '$chequeAmount', '$bankName', '$cheque_num', '$cheque_app_date', '$user_id', '$user_name')";

        $result = $this->db->insert($query);
        if ($result) {
            $con = $this->db->link;
            $id = mysqli_insert_id($con);

            $d = date('ymd');
            $year = date('Y');

            $last_date_query = "SELECT * FROM sale_return_invoice_count ORDER BY id DESC LIMIT 1";
            $result_last_date = $this->db->select($last_date_query);
            if ($result_last_date != FALSE) {
                $getLastDate = mysqli_fetch_assoc($result_last_date);
                $last_date = $getLastDate['inv_date'];
            }


            $saleDateY = date('Y', strtotime($last_date));

            if ($year != $saleDateY) {
//                mysqli_query($this->db->link, "TRUNCATE TABLE sale_invoice_count");
                $truncate = "TRUNCATE TABLE sale_return_invoice_count";
                $exeTr = $this->db->delete($truncate);

                $querySIC = "INSERT INTO `sale_return_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$sale_date','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'SR' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE customer_return_invoice_info SET invoice_number = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            } else {
                $querySIC = "INSERT INTO `sale_return_invoice_count`(`invoice_insert_id`, `inv_date`, `inv_year`) "
                        . "VALUES  ('$id','$sale_date','$year')";

                $resultSIC = $this->db->insert($querySIC);
                $sicId = mysqli_insert_id($con);

                $invNum = 'SR' . $d . $user_id . $sicId;
                $update_invoice = "UPDATE customer_return_invoice_info SET invoice_number = '$invNum' WHERE id = '$id'";
                $result_update_invoice = $this->db->update($update_invoice);
            }

            return $id;
        } else {
            $message = "Invoice Info Save Failed.";
            return $message;
        }
    }

    public function insertReturnItem(
    $product_id, $quantity, $sale_price, $discount, $netSalesamount, $netCosAmount, $invoice_number, $common_id, $user_id, $user_name, $inStock) {

        $saleInsertQuery = "          INSERT INTO `return_sale_product_info`(`medicine`, `qty`, `unit_price`, `discount`, `sub_total`, `net_cost`, `inv_number`, `commonId`, `user_id`, `user_name`) "
                . "VALUES ('$product_id', '$quantity', '$sale_price', '$discount', '$netSalesamount', '$netCosAmount', '$invoice_number', '$common_id', '$user_id', '$user_name')";
        $saleInsert = $this->db->insert($saleInsertQuery);
        if ($saleInsert) {
            $query = "UPDATE `medicine` SET stock = '$inStock' WHERE id = '$product_id'";
            $result = $this->db->update($query);
        }
        return $saleInsert;
    }

    public function select_return_sale_product_info($invoice_number, $common_id) {

        $query = " SELECT * FROM return_sale_product_info WHERE inv_number = '$invoice_number' AND commonId = '$common_id'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updCustomerDues(
    $currentDue, $cus_name) {

        $query = " UPDATE `customer` SET balance = '$currentDue' WHERE id = '$cus_name'";
        $result = $this->db->update($query);
        if ($result) {
            $message = "<div class = 'alert alert-success'>
                    <h4>Sale Return successfully</h4>
                    </div>";
            return $message;
        } else {
            $message = "<div class = 'alert alert-danger'>
                    <h4>Sale Return failed.</h4>
                    </div>";
            return $message;
        }
    }

    public function select_all_customer_return_invoice_info() {
        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 AND sale_date = date(now()) ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteSalesReturnInv($delid) {
        $delMediDetails = "UPDATE sale_return_invoice_count SET 
			deletion_status = '1'
			WHERE invoice_insert_id = '$delid'";
        $resultDel = $this->db->update($delMediDetails);

        $query = "UPDATE customer_return_invoice_info SET
                    deletion_status = '1'
                    WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1;url = manage-sales-return.php");
            $msg = "<div class = 'alert alert-success'>
                    <h4>Deleted successfully</h4>
                    </div>";
            return $msg;
        } else {
            $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to Delete </h3>
                    </div>";
            return $msg;
        }
    }

    public function select_all_purches_return_product_info() {

        $query = "SELECT * FROM purchase_return_product_info WHERE deletion_status = 0 AND status_flag = 0 ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function getReturnInvoiceIdInfo() {



        $query = "SELECT * FROM supplier_return_invoice_info WHERE deletion_status = 0 || deletion_status = 1 ORDER BY id DESC LIMIT 1";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_return_purComnID_info() {



        $query = "SELECT * FROM purchase_return_product_info WHERE deletion_status = 0 AND status_flag = 0 ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function addReturnItem(
    $product_id, $mdate, $edate, $cprice, $sprice, $quantity, $subTotal, $invoice_number, $inStock, $invNum, $product_sup_name, $purchase_date) {

        $mdate1 = date('Y-m-d', strtotime($mdate));
        $edate1 = date('Y-m-d', strtotime($edate));

        $query = "INSERT INTO purchase_return_product_info
                    (medicine, manufacturing, expire_date, purchase_price, sale_price, qty, sub_total, unit_type, carton_quantity, box_quantity, common_id,supplier,pur_date)

                    VALUES

                    ('$product_id', '$mdate1', '$edate1', '$cprice', '$sprice', '$quantity', '$subTotal', 'Pcs', '0', '0', '$invNum', '$product_sup_name', '$purchase_date')";

        $iteminsert = $this->db->insert($query);
        if ($iteminsert) {
            $updquery = "UPDATE `medicine` SET stock = '$inStock' WHERE id = '$product_id'";
            $result = $this->db->update($updquery);
        }
        return $iteminsert;
    }

    public function save_purchase_return_main_invoice_info(
    $product_sup_name, $currentDue, $invoice_number, $purchase_date, $totalAmount, $payment_method, $disCnt, $less, $cashPaid, $dues, $predues, $chequeAmount, $bankName, $cheque_num, $cheque_app_date) {

        $query = "              INSERT INTO `supplier_return_invoice_info`"
                . " ( `supplier`, `previous_due`, `invoice_number`, `purchase_date`, `total_amount`, `payment_method`, `amount`, `dues`, `checkAmount`, `bankName`, `checkNumber`, `checkAppDate`)"
                . " VALUES ('$product_sup_name', '$predues', '$invoice_number', '$purchase_date', '$totalAmount', '$payment_method', '$cashPaid', '$currentDue', '$chequeAmount', '$bankName', '$cheque_num', '$cheque_app_date')";

        $result = $this->db->insert($query);
        if ($result) {
            $con = $this->db->link;
            $id = mysqli_insert_id($con);
            return $id;
        } else {
            $message = "Purchase Invoice Info Save Failed.";
            return $message;
        }
    }

    public function updateProductReturnStatusFlag(
    $invoice_number) {

        $query = "UPDATE `purchase_return_product_info` SET status_flag = 1 WHERE common_id = '$invoice_number'";
        $result = $this->db->update($query);
        if ($result) {
            return $result;
        }
    }

    public function select_purches_return_product_info(
    $itemId) {

        $query = "SELECT * FROM purchase_return_product_info WHERE deletion_status = 0 AND id = '$itemId'";

        $result = $this->db->select($query);

        return $result;
    }

    public function deletePurchaseReturnItem($itemId) {

        $query = "DELETE FROM purchase_return_product_info
                    WHERE id = '$itemId'";

        $result = $this->db->delete($query);
        if ($result) {
            header("Refresh:1;
                    url = add-purchase-return.php");
            $msg = "<div class = 'alert alert-success'>
                    <h4>Item deleted successfully</h4>
                    </div>";
            return $msg;
        } else {
            $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to delete Item </h3>
                    </div>";
            return $msg;
        }
    }

    public function getAllBank() {
        $query = "SELECT * FROM bank WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteBank($delid) {
        $query = "UPDATE bank SET
                    deletion_status = '1'
                    WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1;
                    url = manage-bank.php");
            $msg = "<div class = 'alert alert-success'>
                    <h4>Bank deleted successfully</h4>
                    </div>";
            return $msg;
        } else {
            $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to delete Bank </h3>
                    </div>";
            return $msg;
        }
    }

    public function addBank($data) {

        $bank_name = mysqli_real_escape_string($this->db->link, $data['bank_name']);


        if ($bank_name == "") {

            $msg = "
                    <div class = 'alert alert-danger'>
                    <h4> Field can not be empty </h4>
                    </div>";

            return $msg;
        } else {

            $bankquery = "SELECT * FROM bank WHERE bank_name = '$bank_name' LIMIT 1";

            $bankchk = $this->db->select($bankquery);
            if ($bankchk != false) {

                $msg = "<div class = 'alert alert-danger'>Bank already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO bank
                    (bank_name)
                    VALUES
                    ('$bank_name')";

                $bankinsert = $this->db->insert($query);

                if ($bankinsert) {

                    $msg = "<div class = 'alert alert-success'>
                    <h4>Bank added successfully</h4>
                    </div>";
                    return $msg;
                } else {
                    $msg = "
                    <div class = 'alert alert-danger'>
                    <h3> Failed to add bank</h3>
                    </div>";

                    return $msg;
                }
            }
        }
    }

    public function getBankById($sid) {

        $query = "SELECT * FROM bank WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateBank($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $bank_name = mysqli_real_escape_string($this->db->link, $data['bank_name']);

        if ($bank_name == "") {

            $msg = "
                    <div class = 'alert alert-danger'>
                    <h4> Field can not be empty </h4>
                    </div>";

            return $msg;
        } else {

            $query = "UPDATE bank
                    SET bank_name = '$bank_name'
                    WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1;
                    url = manage-bank.php");
                $msg = "
                    <div class = 'alert alert-success'>
                    <h4>Bank Information Updated successfully</h4>
                    </div>";

                return $msg;
            } else {
                $msg = "
                    <div class = 'alert alert-danger'>
                    <h4>Bank Information not Updated</h4>
                    </div>";

                return $msg;
            }
        }
    }

    public function getAllReturnProductInvoice($invid) {
        $query = "SELECT * FROM return_sale_product_info WHERE deletion_status = 0 AND commonId = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllReturnSingleInvoice($invid) {
        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 AND id = '$invid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function searchProdctByTitle($data) {
        if (!$data['name']) {
            $data['name'] = '';
        }
        $query = "SELECT* FROM medicine WHERE deletion_status = 0 AND status = 1 AND stock != '' AND medicine_name LIKE '%" . $data['name'] . "%' ";
        // echo $query;
        $result = $this->db->select($query);

        return $result;
    }

    public function searchProdctByTitle2($data, $data1) {
        if (!$data['name']) {
            $data['name'] = '';
            $data1['sup_id'] = '';
        }
        $query = "SELECT* FROM medicine WHERE deletion_status = 0 AND status = 1 AND company_id = '" . $data1['sup_id'] . "' AND medicine_name LIKE '" . $data['name'] . "%' ";
        // echo $query;
        $result = $this->db->select($query);

        return $result;
    }

    public function getAllProductType() {

        $query = "SELECT * FROM product_type WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteProType($id) {
        $query = "UPDATE product_type SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= pro-type.php");
            $msg = "<div class='alert alert-success'>
                            <h4>Product Type deleted successfully.</h4>
                  </div>";
            return $msg;
        } else {
            $msg = "
                    <div class='alert alert-danger'>
                              <h3> Failed to delete Product Type. </h3>
                    </div>";

            return $msg;
        }
    }

    public function addProType($data) {

        $product_type = mysqli_real_escape_string($this->db->link, $data['product_type']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);


        if ($product_type == "" || $status == "") {

            $msg = "<div class='alert alert-danger'>
                       <h4> Field can not be empty. </h4>
		     </div>";

            return $msg;
        } else {

            $unitquery = "SELECT * FROM product_type WHERE product_type = '$product_type' LIMIT 1";

            $unitchk = $this->db->select($unitquery);
            if ($unitchk != false) {

                $msg = "<div class='alert alert-danger'>Product type already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO product_type
                                  (product_type,status) 
                                     VALUES('$product_type','$status')";

                $ptypeinsert = $this->db->insert($query);

                if ($ptypeinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Product Type added successfully.</h4>
			    </div>";
                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger'>
                               <h3> Failed to add product type.</h3>
			    </div>";

                    return $msg;
                }
            }
        }
    }

    public function getPtypeById($sid) {

        $query = "SELECT * FROM product_type WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateProType($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $product_type = mysqli_real_escape_string($this->db->link, $data['product_type']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);

        if ($product_type == "") {

            $msg = "<div class='alert alert-danger'>
                      <h4> Field can not be empty. </h4>
		    </div>";

            return $msg;
        } else {

            $query = "UPDATE product_type 
			       SET product_type = '$product_type', status = '$status'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                $msg = "
		      <div class='alert alert-success'>
                        <h4>Product type Updated successfully</h4>
		      </div>";

                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h4>Product type not updated.</h4>
			</div>";

                return $msg;
            }
        }
    }

    public function getAllProduct() {

        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND pro_type != '1'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllActiveProType() {

        $query = "SELECT * FROM product_type WHERE deletion_status = 0 AND status = '1'";

        $result = $this->db->select($query);

        return $result;
    }

    public function addPro($data) {

        $medicine_name = mysqli_real_escape_string($this->db->link, $data['medicine_name']);
        $product_sup_name = mysqli_real_escape_string($this->db->link, $data['product_sup_name']);
        $company_name = $this->getOneCol('company_name', 'company', 'id', $product_sup_name);
        $pro_type = mysqli_real_escape_string($this->db->link, $data['pro_type']);
        $purchases_price = mysqli_real_escape_string($this->db->link, $data['purchases_price']);
        $sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);


        if ($medicine_name == "" || $pro_type == "" || $product_sup_name == "") {

            $msg = "<div class='alert alert-danger'>
                       <h4> Field can not be empty. </h4>
		     </div>";

            return $msg;
        } else {

            $unitquery = "SELECT * FROM medicine WHERE medicine_name = '$medicine_name' AND pro_type = '$pro_type' LIMIT 1";

            $unitchk = $this->db->select($unitquery);
            if ($unitchk != false) {

                $msg = "<div class='alert alert-danger'>Product already exits.</div>";

                return $msg;
            } else {
                if ($pro_type == 5) {
                    $query = "INSERT INTO medicine
                                  (medicine_name,company_id,company_name,pro_type,stock,purchases_price,sale_price) 
                                     VALUES('$medicine_name','$product_sup_name','$company_name','$pro_type','1','$purchases_price','$sale_price')";

                    $proinsert = $this->db->insert($query);

                    if ($proinsert) {

                        $msg = "<div class='alert alert-success'>
                              <h4>Product added successfully.</h4>
			    </div>";
                        return $msg;
                    } else {
                        $msg = "<div class='alert alert-danger'>
                               <h3>Failed to add product.</h3>
			    </div>";

                        return $msg;
                    }
                } else {
                    $query = "INSERT INTO medicine
                                  (medicine_name,company_id,company_name,pro_type,purchases_price,sale_price) 
                                     VALUES('$medicine_name','$product_sup_name','$company_name','$pro_type','$purchases_price','$sale_price')";

                    $proinsert = $this->db->insert($query);

                    if ($proinsert) {

                        $msg = "<div class='alert alert-success'>
                              <h4>Product added successfully.</h4>
			    </div>";
                        return $msg;
                    } else {
                        $msg = "<div class='alert alert-danger'>
                               <h3>Failed to add product.</h3>
			    </div>";

                        return $msg;
                    }
                }
            }
        }
    }

    public function deletePro($id) {
        $query = "UPDATE medicine SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            $msg = "<div class='alert alert-success'>
                            <h4>Product deleted successfully.</h4>
                  </div>";
            return $msg;
        } else {
            $msg = "
                    <div class='alert alert-danger'>
                              <h3> Failed to delete Product. </h3>
                    </div>";

            return $msg;
        }
    }

    public function getProById($sid) {

        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updatePro($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $medicine_name = mysqli_real_escape_string($this->db->link, $data['medicine_name']);
        $product_sup_name = mysqli_real_escape_string($this->db->link, $data['product_sup_name']);
        $company_name = $this->getOneCol('company_name', 'company', 'id', $product_sup_name);
        $pro_type = mysqli_real_escape_string($this->db->link, $data['pro_type']);
        $purchases_price = mysqli_real_escape_string($this->db->link, $data['purchases_price']);
        $sale_price = mysqli_real_escape_string($this->db->link, $data['sale_price']);

        if ($medicine_name == "" || $pro_type == "" || $product_sup_name == "") {

            $msg = "<div class='alert alert-danger'>
                      <h4> Field can not be empty. </h4>
		    </div>";

            return $msg;
        } else {
            if ($pro_type == '5') {
                $query = "UPDATE medicine 
			       SET medicine_name = '$medicine_name',company_id = '$product_sup_name'company_name = '$company_name', pro_type = '$pro_type', stock = '1', purchases_price = '$purchases_price', sale_price = '$sale_price'
				   WHERE id = '$sid'";

                $updated_row = $this->db->update($query);

                if ($updated_row) {
                    $msg = "
		      <div class='alert alert-success'>
                        <h4>Product Updated successfully</h4>
		      </div>";

                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                          <h4>Product not updated.</h4>
			</div>";

                    return $msg;
                }
            } else {
                $query = "UPDATE medicine 
			       SET medicine_name = '$medicine_name',company_id = '$product_sup_name', pro_type = '$pro_type', purchases_price = '$purchases_price', sale_price = '$sale_price'
				   WHERE id = '$sid'";

                $updated_row = $this->db->update($query);

                if ($updated_row) {
                    $msg = "
		      <div class='alert alert-success'>
                        <h4>Product Updated successfully</h4>
		      </div>";

                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                          <h4>Product not updated.</h4>
			</div>";

                    return $msg;
                }
            }
        }
    }

    public function getExpStock() {

        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 AND edate < DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteExpireStk($id, $proID, $rmStk) {
        $Stkquery = "SELECT * FROM medicine WHERE deletion_status = 0 AND id = '$proID'";

        $resultStk = $this->db->select($Stkquery)->fetch_assoc();
        $curStk = $resultStk['stock'];
        $newStk = $curStk - $rmStk;

        $StkUpd = "UPDATE medicine 
			       SET stock = '$newStk'
				   WHERE id = '$proID'";

        $updated_row = $this->db->update($StkUpd);

        if ($updated_row) {
            $query = "DELETE FROM expired_stock 
			WHERE id = '$id'";

            $result = $this->db->delete($query);
            if ($result) {
                $msg = "<div class='alert alert-success'>
		    <h4>Deleted successfully</h4>
		</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'>
			<h3> Failed to delete.</h3>
		   </div>";

                return $msg;
            }
        }
    }

    public function getSingleInvInfo($inv) {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND invoice_number = '$inv' ORDER BY id DESC LIMIT 1";

        $result = $this->db->select($query);

        return $result;
    }

    public function singleInvInfo($inv, $cusId) {
//        $query = "SELECT * FROM sale_product_info WHERE deletion_status = 0 AND inv_number = '$inv' AND commonId = '$cusId'";
        $query = "SELECT * FROM sale_product_info WHERE deletion_status = 0 AND commonId = '$cusId'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllUserType() {

        $query = "SELECT * FROM tbl_user_type WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function addUserType($data) {

        $user_type = mysqli_real_escape_string($this->db->link, $data['user_type']);


        if ($user_type == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty. </h4>
			   </div>";

            return $msg;
        } else {

            $unitquery = "SELECT * FROM tbl_user_type WHERE user_type = '$user_type' LIMIT 1";

            $unitchk = $this->db->select($unitquery);
            if ($unitchk != false) {

                $msg = "<div class='alert alert-danger'>User Type already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO tbl_user_type (user_type) VALUES  ('$user_type')";

                $unitinsert = $this->db->insert($query);

                if ($unitinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>User Type added successfully</h4>
			   </div>";
                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger'>
                          <h3> Failed to add user type</h3>
			 </div>";

                    return $msg;
                }
            }
        }
    }

    public function deleteUserType($delid) {
        $query = "UPDATE tbl_user_type SET 
			deletion_status = '1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            //header("Refresh:1; url = user-type.php");
            $msg = "<div class='alert alert-success'>
			<h4>User type deleted successfully</h4>
		    </div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'>
			 <h3> Failed to delete User.</h3>
		    </div>";
            return $msg;
        }
    }

    public function getAllUser() {

        $query = "SELECT * FROM admin WHERE deletion_status = '0'";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteUser($delid) {
        $query = "UPDATE admin SET 
			deletion_status = '1'
			WHERE adminId = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            //header("Refresh:1; url = user-type.php");
            $msg = "<div class='alert alert-success'>
			<h4>User deleted successfully</h4>
		    </div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger'>
			 <h3> Failed to delete User. </h3>
		    </div>";
            return $msg;
        }
    }

    public function getUserType() {

        $query = "SELECT * FROM tbl_user_type WHERE deletion_status = 0 AND status = '1'";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_all_customer_invoice_info_datewise($from, $to) {

        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_all_supplier_invoice_info_datewise($from, $to) {

        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status= 0 AND purchase_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_all_customer_return_invoice_info_datewise($from, $to) {
        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to' ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function select_all_supplier_return_invoice_info_datewise($from, $to) {

        $query = "SELECT * FROM supplier_return_invoice_info WHERE deletion_status= 0 AND purchase_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateProductStock($delid) {
        $query = "SELECT * FROM sale_product_info WHERE commonId = '$delid'";
        $result = $this->db->select($query);
        while ($row = $result->fetch_assoc()) {
            $medicine = $row['medicine'];
            $qty = $row['qty'];
            $stk = $this->getOneCol('stock', 'medicine', 'id', $medicine);
            $currentStk = $stk + $qty;

            $stkQuery = "UPDATE `medicine` SET stock = '$currentStk' WHERE id = '$medicine'";
            $res = $this->db->update($stkQuery);
        }
        return $result;
    }

    public function cusDueUpdate($cusID, $currentDue) {
        $query = "UPDATE `customer` SET balance = '$currentDue' WHERE id = '$cusID'";
        $result = $this->db->update($query);
        return $result;
    }

    public function updateProductReturnStock($delid) {
        $query = "SELECT * FROM return_sale_product_info WHERE commonId = '$delid'";
        $result = $this->db->select($query);
        while ($row = $result->fetch_assoc()) {
            $medicine = $row['medicine'];
            $qty = $row['qty'];
            $stk = $this->getOneCol('stock', 'medicine', 'id', $medicine);
            $currentStk = $stk - $qty;

            $stkQuery = "UPDATE `medicine` SET stock = '$currentStk' WHERE id = '$medicine'";
            $res = $this->db->update($stkQuery);
        }
        return $result;
    }

    public function updateProductPurchaseStock($cmnId) {
        $query = "SELECT * FROM purchase_product_info WHERE common_id = '$cmnId'";
        $result = $this->db->select($query);
        while ($row = $result->fetch_assoc()) {
            $medicine = $row['medicine'];
            $qty = $row['qty'];
            $stk = $this->getOneCol('stock', 'medicine', 'id', $medicine);
            $currentStk = $stk - $qty;

            $stkQuery = "UPDATE `medicine` SET stock = '$currentStk' WHERE id = '$medicine'";
            $res = $this->db->update($stkQuery);
        }
        return $result;
    }

    public function supDueUpdate($supID, $currentDue) {
        $query = "UPDATE `company` SET balance = '$currentDue' WHERE id = '$supID'";
        $result = $this->db->update($query);
        return $result;
    }

    public function updateProductPurchaseReturnStock($cmnId) {
        $query = "SELECT * FROM purchase_return_product_info WHERE common_id = '$cmnId'";
        $result = $this->db->select($query);
        while ($row = $result->fetch_assoc()) {
            $medicine = $row['medicine'];
            $qty = $row['qty'];
            $stk = $this->getOneCol('stock', 'medicine', 'id', $medicine);
            $currentStk = $stk + $qty;

            $stkQuery = "UPDATE `medicine` SET stock = '$currentStk' WHERE id = '$medicine'";
            $res = $this->db->update($stkQuery);
        }
        return $result;
    }

    public function getExpDatetById($sid) {

        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateExpireDate($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $edate = mysqli_real_escape_string($this->db->link, $data['edate']);

        $edate1 = date('Y-m-d', strtotime($edate));
        if ($edate1 == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $query = "UPDATE expired_stock 
			       SET edate = '$edate1'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {

                $msg = "
		      <div class='alert alert-success'>
                        <h4>Expire Date Updated successfully.</h4>
		      </div>";

                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h4>Expire Date Information not Updated.</h4>
			</div>";

                return $msg;
            }
        }
    }

    public function updateMinStock($product_id, $minstk) {
        $query = "UPDATE `medicine` SET min_stock = '$minstk' WHERE id = '$product_id'";

        $result = $this->db->update($query);
        if ($result) {
            return $result;
        }
    }

    public function getAllActiveExpenseHead() {

        $query = "SELECT * FROM expense_head WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function getTodaysCollection() {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 AND collectionDate = date(now()) ORDER BY id DESC";

        $result = $this->db->select($query);

        return $result;
    }

    public function getCollectionByDate($from, $to) {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 AND collectionDate BETWEEN '$from' AND '$to' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getTodaysPayment() {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND paymentDate = date(now())";
        $result = $this->db->select($query);
        return $result;
    }

    public function getPaymentByDate($from, $to) {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND paymentDate BETWEEN '$from' AND '$to'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllActiveCompanyList() {

        $query = "SELECT * FROM company WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);

        return $result;
    }

}