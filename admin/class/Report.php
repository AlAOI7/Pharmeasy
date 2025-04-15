<?php
/*Developer: Mhammad Ali Khan
Email: xvirus.bd@gmail.com
 * web: makgr.com
 */
class Report {

    private $db;
    private $fm;

    public function __construct() {

        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getAllMedicineStock() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getCurrentStock() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND stock != ''";
        $result = $this->db->select($query);
        return $result;
    }

    public function getMedicineStockByName($medicine_name) {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND medicine_name LIKE '%$medicine_name%'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTotalMedicineExprieStock() {

        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 AND edate < DATE(NOW())";

        $result = $this->db->select($query);
        if ($result) {
            $totalMedi = mysqli_num_rows($result);
            return $totalMedi;
        }
    }

    public function getAllSlowMoving() {
        $query = "SELECT * FROM `slowmoving` ORDER BY qty ASC";

        $result = $this->db->select($query);

        return $result;
    }

    public function getColumnData($col, $table, $con, $val) {
        $query = "SELECT * FROM $table WHERE $con = '$val'";
        $result = $this->db->select($query);
        if ($result) {
            $value = mysqli_fetch_assoc($result);
            return $value[$col];
        }
    }

    public function getTotalMedicineExprieSoonStock() {
//        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 
//AND DATEDIFF(edate,curdate()) <= 180
//AND curdate() < edate";
        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 
AND (SELECT medicine.stock FROM medicine WHERE deletion_status = 0 AND medicine.id = expired_stock.product AND medicine.stock != 0) 
AND DATEDIFF(edate,curdate()) <= 180
AND curdate() < edate";

        $result = $this->db->select($query);
        if ($result) {
            $totalMedi = mysqli_num_rows($result);
            return $totalMedi;
        }
    }

    public function getAllMedicineExprieSoonStock() {

//        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 
//AND DATEDIFF(edate,curdate()) <= 180
//AND curdate() < edate";
        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 
AND (SELECT medicine.stock FROM medicine WHERE deletion_status = 0 AND medicine.id = expired_stock.product AND medicine.stock != 0) 
AND DATEDIFF(edate,curdate()) <= 180
AND curdate() < edate";

        $result = $this->db->select($query);
        if ($result) {
            return $result;
        }
    }

    public function getAllMedicineExprieStock() {

        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 AND edate < DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function totalMedicine() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0";

        $result = $this->db->select($query);
        if ($result) {
            $totalMedi = mysqli_num_rows($result);
            return $totalMedi;
        }
    }

    public function totalProduct() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND pro_type != '1'";

        $result = $this->db->select($query);
        if ($result) {
            $totalPro = mysqli_num_rows($result);
            return $totalPro;
        }
    }

    public function totalOutStock() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND stock = 0";

        $result = $this->db->select($query);
        if ($result) {
            $totalStock = mysqli_num_rows($result);
            return $totalStock;
        }
    }

    public function totalInStock() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND stock != 0";

        $result = $this->db->select($query);
        if ($result) {
            $totalStock = mysqli_num_rows($result);
            return $totalStock;
        }
    }

    public function getAllMedicineOutStock() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND stock = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllPaymentReport() {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllPaymentReportDate($from, $to) {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND paymentDate BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllCollectionReport() {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllCollectionReportDate($from, $to) {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 AND collectionDate BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllPurchaseReport() {
        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllPurchaseReportDate($from, $to) {
        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status = 0 AND purchase_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllPurchaseReportDateSupplier($from, $to, $sup) {
        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status = 0 AND supplier = '$sup' AND  purchase_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSalesReport() {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSalesReportDate($from, $to) {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSupplierReport() {
        $query = "SELECT * FROM company WHERE deletion_status = 0 AND balance != '0'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getSupplierByName($supplier_name) {
        $query = "SELECT * FROM company WHERE deletion_status = 0 AND name LIKE '%$supplier_name%'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllCustomerReport() {
//        $query = "SELECT * FROM customer WHERE deletion_status = 0 ORDER BY name ASC LIMIT 10";
        $query = "SELECT * FROM customer WHERE deletion_status = 0 AND balance != 0.00";

        $result = $this->db->select($query);

        return $result;
    }

    public function getCustomerByName($customer_name) {
        $query = "SELECT * FROM customer WHERE deletion_status = 0 AND name LIKE '%$customer_name%'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getRecentSale() {
        $query = "SELECT * FROM sale_product_info WHERE deletion_status = 0 ORDER BY id DESC LIMIT 3";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSalesman() {
        $query = "SELECT * FROM admin WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSalesReportBySalesmanDate($sm, $from, $to) {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to' AND user_id = '$sm'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllIncomeHead() {

        $query = "SELECT * FROM income_head WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteIncomeHead($delid) {
        $query = "UPDATE income_head SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-income-head.php");
            $msg = "<div class='alert alert-success'>
		      <h4>Income Head deleted successfully</h4>
		   </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
			<h3> Failed to delete Income Head </h3>
		</div>";
            return $msg;
        }
    }

    public function addIncomeHead($data) {

        $incomeHead = mysqli_real_escape_string($this->db->link, $data['incomeHead']);


        if ($incomeHead == "") {

            $msg = "<div class='alert alert-danger'>
                      <h4> Field can not be empty. </h4>
		      </div>";

            return $msg;
        } else {

            $unitquery = "SELECT * FROM income_head WHERE income_head_name = '$incomeHead' LIMIT 1";

            $unitchk = $this->db->select($unitquery);
            if ($unitchk != false) {

                $msg = "<div class='alert alert-danger'>Income head already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO income_head
                              (income_head_name) 
                              VALUES
                          ('$incomeHead')";

                $unitinsert = $this->db->insert($query);

                if ($unitinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Income Head added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                          <h3> Failed to add Income Head</h3>
			</div>";

                    return $msg;
                }
            }
        }
    }

    public function addIncome($data) {

        $incomeHead = mysqli_real_escape_string($this->db->link, $data['incomeHead']);
        $income_amount = mysqli_real_escape_string($this->db->link, $data['income_amount']);
        $incomeDate = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['incomeDate'])));
        $purpose = mysqli_real_escape_string($this->db->link, $data['purpose']);


        if ($incomeHead == "" || $income_amount == "" || $incomeDate == "") {

            $msg = "
		<div class='alert alert-danger'>
                    <h4> Field can not be empty </h4>
		</div>";

            return $msg;
        } else {

            $query = "INSERT INTO `income`(`income_head`, `income_amount`, `income_date`, `purpose`) 
                        VALUES
			('$incomeHead','$income_amount','$incomeDate','$purpose')";

            $cusinsert = $this->db->insert($query);

            if ($cusinsert) {

                $msg = "<div class='alert alert-success'>
                              <h4>Income added successfully</h4>
						</div>";
                return $msg;
            } else {
                $msg = "
					<div class='alert alert-danger'>
                          <h3> Failed to add Income </h3>
					</div>";

                return $msg;
            }
        }
    }

    public function getAllIncome() {

        $query = "SELECT * FROM income WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteIncome($delid) {
        $query = "UPDATE income SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url = manage-income.php");
            $msg = "<div class='alert alert-success'>
			<h4>Income deleted successfully</h4>
		    </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
		<h3> Failed to delete Income </h3>
		</div>";
            return $msg;
        }
    }

    public function getIncomeById($sid) {

        $query = "SELECT * FROM income WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateIncome($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $incomeHead = mysqli_real_escape_string($this->db->link, $data['incomeHead']);
        $income_amount = mysqli_real_escape_string($this->db->link, $data['income_amount']);
        $incomeDate = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['incomeDate'])));
        $purpose = mysqli_real_escape_string($this->db->link, $data['purpose']);

        if ($incomeHead == "" || $income_amount == "" || $incomeDate == "") {

            $msg = "
		<div class='alert alert-danger'>
                    <h4> Field can not be empty </h4>
		</div>";

            return $msg;
        } else {

            $query = "UPDATE income 
			       SET income_head = '$incomeHead',
			       income_amount = '$income_amount',
			       income_date = '$incomeDate',
			       purpose = '$purpose'
			       WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-income.php");
                $msg = "
		      <div class='alert alert-success'>
                        <h4>Income Information Updated successfully</h4>
		      </div>";

                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h4>Income Information not Updated</h4>
			</div>";
                return $msg;
            }
        }
    }

    public function getAllExpenseHead() {

        $query = "SELECT * FROM expense_head WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteExpenseHead($delid) {
        $query = "UPDATE expense_head SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-expense-head.php");
            $msg = "<div class='alert alert-success'>
		      <h4>Expense Head deleted successfully</h4>
		   </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
			<h3> Failed to delete Expense Head </h3>
		</div>";
            return $msg;
        }
    }

    public function addExpenseHead($data) {

        $expenseHead = mysqli_real_escape_string($this->db->link, $data['expenseHead']);


        if ($expenseHead == "") {

            $msg = "
				<div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
			   </div>";

            return $msg;
        } else {

            $unitquery = "SELECT * FROM expense_head WHERE expense_head_name = '$expenseHead' LIMIT 1";

            $unitchk = $this->db->select($unitquery);
            if ($unitchk != false) {

                $msg = "<div class='alert alert-danger'>Income head already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO expense_head
                              (expense_head_name) 
                              VALUES
                          ('$expenseHead')";

                $unitinsert = $this->db->insert($query);

                if ($unitinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Expense Head added successfully</h4>
						</div>";
                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                          <h3> Failed to add Expense Head</h3>
			</div>";

                    return $msg;
                }
            }
        }
    }

    public function getAllExpense() {

        $query = "SELECT * FROM expense WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteExpense($delid) {
        $query = "UPDATE expense SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url = manage-expense.php");
            $msg = "<div class='alert alert-success'>
			<h4>Expense deleted successfully</h4>
		    </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
		<h3> Failed to delete Expense </h3>
		</div>";
            return $msg;
        }
    }

    public function getExpenseHead() {

        $query = "SELECT * FROM expense_head WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function addExpense($data) {

        $expenseHead = mysqli_real_escape_string($this->db->link, $data['expenseHead']);
        $expense_amount = mysqli_real_escape_string($this->db->link, $data['expense_amount']);
        $expenseDate = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['expenseDate'])));
        $purpose = mysqli_real_escape_string($this->db->link, $data['purpose']);


        if ($expenseHead == "" || $expense_amount == "" || $expenseDate == "") {

            $msg = "
		<div class='alert alert-danger'>
                    <h4> Field can not be empty </h4>
		</div>";

            return $msg;
        } else {

            $query = "INSERT INTO `expense`(`expense_head`, `expense_amount`, `expense_date`, `purpose`) 
                        VALUES
			('$expenseHead','$expense_amount','$expenseDate','$purpose')";

            $cusinsert = $this->db->insert($query);

            if ($cusinsert) {

                $msg = "<div class='alert alert-success'>
                              <h4>Expense added successfully</h4>
						</div>";
                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h3> Failed to add Expense </h3>
			</div>";

                return $msg;
            }
        }
    }

    public function getExpenseById($sid) {

        $query = "SELECT * FROM expense WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateExpense($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);

        $expenseHead = mysqli_real_escape_string($this->db->link, $data['expenseHead']);
        $expense_amount = mysqli_real_escape_string($this->db->link, $data['expense_amount']);
        $expenseDate = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['expenseDate'])));
        $purpose = mysqli_real_escape_string($this->db->link, $data['purpose']);

        if ($expenseHead == "" || $expense_amount == "" || $expenseDate == "" || $purpose == "") {

            $msg = "
		<div class='alert alert-danger'>
                    <h4> Field can not be empty </h4>
		</div>";

            return $msg;
        } else {

            $query = "UPDATE expense 
			       SET expense_head = '$expenseHead',
			       expense_amount = '$expense_amount',
			       expense_date = '$expenseDate',
			       purpose = '$purpose'
			       WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                header("Refresh:1; url=manage-expense.php");
                $msg = "
		      <div class='alert alert-success'>
                        <h4>Expense Information Updated successfully</h4>
		      </div>";

                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h4>Expense Information not Updated</h4>
			</div>";

                return $msg;
            }
        }
    }

    public function getSalesReport($from, $to) {

        //$invquery = "SELECT DISTINCT `invoice_number`,`id`,`total_amount`,`totalNetAmount`,`sale_date` FROM customer_invoice_info 
        //WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to'";

        $invquery = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to'";
        $res = $this->db->select($invquery);
        return $res;
    }

    public function getSalesRep() {

//        $invquery = "SELECT DISTINCT `invoice_number`,`total_amount`,`totalNetAmount`,`sale_date` FROM customer_invoice_info WHERE deletion_status = 0 ORDER BY id ASC LIMIT 50";
        $invquery = "SELECT DISTINCT `invoice_number`,`total_amount`,`totalNetAmount`,`sale_date` FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date = DATE(NOW())";

        $res = $this->db->select($invquery);
        return $res;
    }

    public function getOhReport($from, $to) {

        $invquery = "SELECT * FROM overhead_info WHERE deletion_status = 0 AND overhead_info_date BETWEEN '$from' AND '$to'";

        $res = $this->db->select($invquery);
        return $res;
    }

    public function getLossRep() {

        $invquery = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 ORDER BY id DESC LIMIT 10";

        $res = $this->db->select($invquery);
        return $res;
    }

    public function getLossReport($from, $to) {

        $invquery = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to'";

        $res = $this->db->select($invquery);
        return $res;
    }

    public function getAllPurchaseReturnReport() {
        $query = "SELECT * FROM supplier_return_invoice_info WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllPurchaseReturnReportDate($from, $to) {
        $query = "SELECT * FROM supplier_return_invoice_info WHERE deletion_status = 0 AND purchase_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSalesReturnReport() {
        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllSalesReturnReportDate($from, $to) {
        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 AND sale_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function totalSalesIncome($from, $to) {
        $query = "SELECT * FROM customer_invoice_info WHERE sale_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);
        return $result;
    }

//    public function totalPurchaseReturn($from, $to) {
//        $query = "SELECT * FROM supplier_return_invoice_info WHERE purchase_date BETWEEN '$from' AND '$to'";
//
//        $result = $this->db->select($query);
//        return $result;
//    }


    public function totalOtherIncome($from, $to) {
        $query = "SELECT * FROM income WHERE income_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);
        return $result;
    }

    public function totalSalesReturn($from, $to) {
        $query = "SELECT * FROM customer_return_invoice_info WHERE sale_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);
        return $result;
    }

    public function totalPurchasePro($from, $to) {
        $query = "SELECT * FROM supplier_invoice_info WHERE purchase_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);
        return $result;
    }

    public function totalOtherExpense($from, $to) {
        $query = "SELECT * FROM expense WHERE expense_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTodaysSale() {

        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND DATE(sale_date) = DATE(NOW())";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTodaysCollection() {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 AND DATE(collectionDate) = DATE(NOW())";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTodaysPurchase() {
        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status = 0 AND DATE(purchase_date) = DATE(NOW())";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTodaysPayment() {

        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND DATE(paymentDate) = DATE(NOW())";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTotalAdmin() {

        $query = "SELECT * FROM admin";

        $result = $this->db->select($query);
        if ($result) {
            $total = mysqli_num_rows($result);
            return $total;
        }
    }

    public function getTotalSaleToday() {
        $query = "SELECT * FROM customer_invoice_info WHERE DATE(sale_date) = DATE(NOW()) AND deletion_status = '0'";

        $result = $this->db->select($query);
        if ($result) {
            $total = mysqli_num_rows($result);
            return $total;
        }
    }

    public function getTotalSaleReturnToday() {
        $query = "SELECT * FROM customer_return_invoice_info WHERE DATE(sale_date) = DATE(NOW())";

        $result = $this->db->select($query);
        if ($result) {
            $total = mysqli_num_rows($result);
            return $total;
        }
    }

    public function getTotalCollectionToday() {
        $query = "SELECT * FROM customer_collection WHERE DATE(collectionDate) = DATE(NOW())";

        $result = $this->db->select($query);
        if ($result) {
            $total = mysqli_num_rows($result);
            return $total;
        }
    }

    public function getTodaysIncome() {

        $query = "SELECT * FROM income WHERE deletion_status = 0 AND DATE(income_date) = DATE(NOW())";

        $result = $this->db->select($query);
        return $result;
    }

    public function getAdminLoginHistory() {
        $query = "SELECT * FROM admin_login_history WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAdminLoginHistoryDate($from, $to) {
        $query = "SELECT * FROM admin_login_history WHERE deletion_status = 0 AND date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getSalesmanLoginHistory() {
        $query = "SELECT * FROM salesman_login_history WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getSalesmanLoginHistoryDate($from, $to) {
        $query = "SELECT * FROM salesman_login_history WHERE deletion_status = 0 AND date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllStockBySupplier($sup) {
        $query = "SELECT * FROM supplier_invoice_info WHERE deletion_status = 0 AND supplier = '$sup'";

        $result = $this->db->select($query);

        return $result;
    }

    public function totalItemWiseStock() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND (min_stock = stock OR stock < min_stock) AND min_stock != '-1'";

        $result = $this->db->select($query);
        if ($result) {
            $totalStock = mysqli_num_rows($result);
            return $totalStock;
        }
    }

    public function getItemwiseStockAlertReport() {

        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND (min_stock = stock OR stock < min_stock) AND min_stock != '-1'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getExpiredStock() {

        $query = "SELECT * FROM expired_stock WHERE deletion_status = 0 AND edate <= DATE_ADD(DATE(NOW()), INTERVAL 180 Day)";

        $result = $this->db->select($query);

        return $result;
    }

    public function getIncToday() {
        $query = "SELECT SUM(amount) AS amt FROM in_cash_income WHERE deletion_status = 0 AND DATE(date) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getExpToday() {
        $query = "SELECT SUM(expense_amount) AS examt FROM expense WHERE deletion_status = 0 AND DATE(expense_date) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getOverheadToday() {
        $query = "SELECT SUM(overhead_info_amount) AS ohamt FROM overhead_info WHERE deletion_status = 0 AND DATE(overhead_info_date) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getSalesReturnToday() {
        $query = "SELECT SUM(amount) AS sramt FROM customer_return_invoice_info WHERE deletion_status = 0 AND DATE(sale_date) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getCashHistory($from, $to) {
        $query = "SELECT * FROM in_cash_history WHERE deletion_status = 0 AND date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function insertCashHistory($date, $opening, $inc, $exp, $less, $access, $incash, $remarks) {

        $queryChk = "SELECT * FROM in_cash_history WHERE deletion_status = 0 AND date = '$date'";
        $resultChk = $this->db->select($queryChk);
        if ($resultChk != FALSE) {
            $msg = "<div class='alert alert-danger'>
		      <h4>Already Submitted.</h4>
		  </div>";
            return $msg;
        } else {
            if ($less != "" && $access != "") {
                $msg = "<div class='alert alert-danger'>
					  <h4>Input only less or access..</h4>
				  </div>";
                return $msg;
            } else {
                if ($less != "") {
                    $new_incash = $incash - $less;
                    $query = "INSERT INTO `in_cash_history`(`date`,`opening`, `inc`,`exp`, `less`,`incash`,`remarks`) VALUES ('$date','$opening','$inc','$exp','$less','$new_incash','$remarks')";
                    $result = $this->db->insert($query);
                    if ($result) {
                        $msg = "<div class='alert alert-success'>
							  <h4>Save Successfully.</h4>
							</div>";
                        return $msg;
                    } else {
                        $msg = "<div class='alert alert-danger'>
						 <h3> Failed. </h3>
						</div>";
                        return $msg;
                    }
                } else if ($access != "") {
                    $new_incash = $incash + $access;
                    $query = "INSERT INTO `in_cash_history`(`date`,`opening`, `inc`,`exp`, `access`, `incash`,`remarks`) VALUES ('$date','$opening','$inc','$exp','$access','$new_incash','$remarks')";
                    $result = $this->db->insert($query);
                    if ($result) {
                        $msg = "<div class='alert alert-success'>
							  <h4>Save Successfully.</h4>
							</div>";
                        return $msg;
                    } else {
                        $msg = "<div class='alert alert-danger'>
						 <h3> Failed. </h3>
						</div>";
                        return $msg;
                    }
                } else {
                    $query = "INSERT INTO `in_cash_history`(`date`,`opening`, `inc`,`exp`, `incash`,`remarks`) VALUES ('$date','$opening','$inc','$exp','$incash','$remarks')";
                    $result = $this->db->insert($query);
                    if ($result) {
                        $msg = "<div class='alert alert-success'>
							  <h4>Save Successfully.</h4>
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
        }
    }

    public function getOpToday() {
        $query = "SELECT * FROM in_cash_history WHERE deletion_status = 0 ORDER BY id DESC LIMIT 1";

        $result = $this->db->select($query);

        return $result;
    }

    public function addInvestment($data) {

        $invest = mysqli_real_escape_string($this->db->link, $data['invest']);
        $remarks = mysqli_real_escape_string($this->db->link, $data['remarks']);
        $investmentDate = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['investmentDate'])));


        if ($invest == "" || $investmentDate == "") {

            $msg = "
		<div class='alert alert-danger'>
                    <h4> Field can not be empty. </h4>
		</div>";

            return $msg;
        } else {

            $query = "INSERT INTO `investment`(`invest`, `investmentDate`,`remarks`)
                VALUES
			('$invest','$investmentDate','$remarks')";

            $cusinsert = $this->db->insert($query);

            if ($cusinsert) {

                $msg = "<div class='alert alert-success'>
                              <h4>Investment added successfully.</h4>
			</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'>
                          <h3> Failed to add Investment. </h3>
			</div>";

                return $msg;
            }
        }
    }

    public function getAllInvestment() {

        $query = "SELECT * FROM investment WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteInvestment($delid) {
        $query = "UPDATE investment SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-investment.php");
            $msg = "<div class='alert alert-success'>
		      <h4>Investment deleted successfully</h4>
		   </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
			<h3>Failed to delete Investment.</h3>
		</div>";
            return $msg;
        }
    }

    public function getAllOverhead() {

        $query = "SELECT * FROM overhead WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteOverhead($delid) {
        $query = "UPDATE overhead SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= overhead.php");
            $msg = "<div class='alert alert-success'>
		      <h4>Overhead deleted successfully</h4>
		   </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
			<h3> Failed to delete Overhead. </h3>
		</div>";
            return $msg;
        }
    }

    public function addOverhead($data) {

        $overhead_name = mysqli_real_escape_string($this->db->link, $data['overhead_name']);


        if ($overhead_name == "") {

            $msg = "<div class='alert alert-danger'>
                          <h4> Field can not be empty. </h4>
		     </div>";

            return $msg;
        } else {

            $unitquery = "SELECT * FROM overhead WHERE overhead_name = '$overhead_name' LIMIT 1";

            $unitchk = $this->db->select($unitquery);
            if ($unitchk != false) {

                $msg = "<div class='alert alert-danger'>Already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO overhead
                              (overhead_name) 
                              VALUES
                          ('$overhead_name')";

                $unitinsert = $this->db->insert($query);

                if ($unitinsert) {

                    $msg = "<div class='alert alert-success'>
                              <h4>Added successfully</h4>
			    </div>";
                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                          <h3> Failed.</h3>
			</div>";

                    return $msg;
                }
            }
        }
    }

    public function getAllOverheadInfo() {

        $query = "SELECT * FROM overhead_info WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteOverheadInfo($delid) {
        $query = "UPDATE overhead_info SET 
			deletion_status='1'
			WHERE id = '$delid'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url = manage-overhead-info.php");
            $msg = "<div class='alert alert-success'>
			<h4>Deleted successfully</h4>
		    </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
		<h3> Failed to delete. </h3>
		</div>";
            return $msg;
        }
    }

    public function getOverhead() {

        $query = "SELECT * FROM overhead WHERE deletion_status = 0 AND status = '1'";

        $result = $this->db->select($query);

        return $result;
    }

    public function addOverheadInfo($data) {

        $overhead_info_head = mysqli_real_escape_string($this->db->link, $data['overhead_info_head']);
        $overhead_info_amount = mysqli_real_escape_string($this->db->link, $data['overhead_info_amount']);
        $overhead_info_date = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['overhead_info_date'])));
        $purpose = mysqli_real_escape_string($this->db->link, $data['purpose']);


        if ($overhead_info_head == "" || $overhead_info_amount == "" || $overhead_info_date == "") {

            $msg = "
		<div class='alert alert-danger'>
                    <h4> Field can not be empty. </h4>
		</div>";

            return $msg;
        } else {

            $query = "INSERT INTO `overhead_info`(`overhead_info_head`, `overhead_info_amount`, `overhead_info_date`, `purpose`) VALUES
			('$overhead_info_head','$overhead_info_amount','$overhead_info_date','$purpose')";

            $cusinsert = $this->db->insert($query);

            if ($cusinsert) {

                $msg = "<div class='alert alert-success'>
                              <h4>Added successfully.</h4>
			</div>";
                return $msg;
            } else {
                $msg = "
			<div class='alert alert-danger'>
                          <h3> Failed to add. </h3>
			</div>";

                return $msg;
            }
        }
    }

    public function getAllActiveOverhead() {

        $query = "SELECT * FROM overhead WHERE deletion_status = 0 AND status = '1'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllOverheadByDate($sm, $from, $to) {
        $query = "SELECT * FROM overhead_info WHERE deletion_status = 0 AND overhead_info_head = '$sm' AND overhead_info_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllOverheadReport() {
        $query = "SELECT * FROM overhead_info WHERE deletion_status = 0 LIMIT 10";

        $result = $this->db->select($query);

        return $result;
    }

    public function getSalesToday() {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND DATE(sale_date) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getIncomeToday() {
        $query = "SELECT * FROM income WHERE deletion_status = 0 AND DATE(income_date) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getPaymentToday() {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND DATE(paymentDate) = DATE(NOW())";

        $result = $this->db->select($query);
        //if(mysqli_num_rows($result) > 0){
        if($result != FALSE){
            return $result;
        }else{
            return 0;
        }
        
    }

    public function getCollectionToday() {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 AND DATE(collectionDate) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getIncomeReport($from, $to) {

        $invquery = "SELECT * FROM income WHERE deletion_status = 0 AND income_date BETWEEN '$from' AND '$to'";

        $res = $this->db->select($invquery);
        return $res;
    }

    public function getExpReport($from, $to) {
        $invquery = "SELECT * FROM expense WHERE deletion_status = 0 AND expense_date BETWEEN '$from' AND '$to'";
        $res = $this->db->select($invquery);
        return $res;
    }

    public function getTotalPurchase() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND stock != ''";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTotalDues() {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND sale_date = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTotalCollection() {
        $query = "SELECT * FROM customer_collection WHERE deletion_status = 0 AND collectionDate = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTotalCustomerDues() {
        $query = "SELECT * FROM customer WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTotalSupplierDues() {
        $query = "SELECT * FROM company WHERE deletion_status = 0";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTotalExpense() {
        $query = "SELECT * FROM expense WHERE deletion_status = 0 AND expense_date = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getOP() {
        $query = "SELECT * FROM in_cash_history WHERE deletion_status = 0 ORDER BY id DESC LIMIT 1";

        $result = $this->db->select($query);

        return $result;
    }

    public function totalStockBalance() {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND stock != '0'";

        $result = $this->db->select($query);
        return $result;
    }

    public function totalSupplierDue() {
        $query = "SELECT * FROM supplier WHERE deletion_status = 0 AND balance != '0'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getAllExpenseReport() {
        $query = "SELECT * FROM expense WHERE deletion_status = 0 AND expense_date = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllExpenseReportDateSupplier($from, $to, $expense_head) {
        if ($expense_head == '') {
            $query = "SELECT * FROM expense WHERE deletion_status = 0 AND  expense_date BETWEEN '$from' AND '$to'";
        } else {
            $query = "SELECT * FROM expense WHERE deletion_status = 0 AND expense_head = '$expense_head' AND  expense_date BETWEEN '$from' AND '$to'";
        }


        $result = $this->db->select($query);

        return $result;
    }

    public function totalCustomerDue() {
        $query = "SELECT * FROM customer WHERE deletion_status = 0 AND balance != '0'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getAllExpenseReportDate($from, $to) {

        $query = "SELECT * FROM expense WHERE deletion_status = 0 AND  expense_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getPaymentReportDate($from, $to) {

        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND  paymentDate BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTodPaymentReport() {
        $query = "SELECT * FROM supplier_payment WHERE deletion_status = 0 AND paymentDate = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTodSalesReturnReport() {
        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 AND sale_date = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getSalesReturnDate($from, $to) {

        $query = "SELECT * FROM customer_return_invoice_info WHERE deletion_status = 0 AND  sale_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getCustomerDuesToday() {
        $query = "SELECT SUM(inv_due) AS inv_due FROM customer_invoice_info WHERE deletion_status = 0 AND DATE(sale_date) = DATE(NOW())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getAllCustomerDueReportToday() {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND inv_due != '0.00' AND DATE(sale_date) = DATE(NOW())";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAllCustomerDueReportDatewise($from, $to) {
        $query = "SELECT * FROM customer_invoice_info WHERE deletion_status = 0 AND inv_due != '0.00' AND sale_date BETWEEN '$from' AND '$to'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCustomerSalesLedger($clid) {
        $query = "SELECT * FROM customer_invoice_info WHERE customer = '$clid' AND deletion_status = 0";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCustomerCollectionLedger($clid) {
        $query = "SELECT * FROM customer_collection WHERE customerId = '$clid' AND deletion_status = 0";
        $result = $this->db->select($query);
        return $result;
    }

    public function getTotalInactiveCustomer() {
        $query = "select name,mobile,location,address,balance,t.id 
                    from customer t where t.balance != 0.00 AND
                      not exists (
                          select 1 
                            from customer_invoice_info where 
                            customer = t.id
                            and
                            datediff(curdate(),customer_invoice_info.sale_date) <= 30)";
        $result = $this->db->select($query);
        if ($result) {
            $totalStock = mysqli_num_rows($result);
            return $totalStock;
        }
    }

    public function getNonmovementCustomer() {
        $query = "select name,mobile,location,address,balance,t.id 
                    from customer t where t.balance != 0.00 AND 
                      not exists (
                          select 1 
                            from customer_invoice_info where 
                            customer = t.id
                            and
                            datediff(curdate(),customer_invoice_info.sale_date) <= 30)";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        }
    }

    public function getCurrentStockByCompany($com) {
        $query = "SELECT * FROM medicine WHERE deletion_status = 0 AND stock != '' AND company_id = '$com'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getTotalNonmovementMedicine() {
        $query = "select medicine_name,t.id 
        from medicine t where stock != 0 AND 
        not exists 
        ( select 1 from sale_product_info where medicine = t.id and datediff(curdate(),sale_product_info.date) <= 120 ) 
        AND not exists
        ( select 1 from purchase_product_info where medicine = t.id and datediff(curdate(),purchase_product_info.pur_date) <= 120 )";
        $result = $this->db->select($query);
        if ($result) {
            $total = mysqli_num_rows($result);
            return $total;
        }
    }

    public function getNonmovementMedicineList() {
        $query = "select medicine_name,t.id,t.* 
        from medicine t where stock != 0 AND 
        not exists 
        ( select 1 from sale_product_info where medicine = t.id and datediff(curdate(),sale_product_info.date) <= 120 ) 
        AND not exists
        ( select 1 from purchase_product_info where medicine = t.id and datediff(curdate(),purchase_product_info.pur_date) <= 120 )";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSlowMovementMedicine() {
        $query = "select medicine,SUM(qty) as totQty from sale_product_info where datediff(curdate(),date) <= 120 GROUP BY medicine HAVING totQty < ROUND((select stock from medicine where medicine.stock != 0 AND medicine.id = sale_product_info.medicine) * 0.4)";
        $result = $this->db->select($query);
        if ($result) {
            $total = mysqli_num_rows($result);
            return $total;
        }
    }

    public function getSlowMovementMedicineList() {
        $query = "select medicine,SUM(qty) as totQty from sale_product_info where datediff(curdate(),date) <= 120 GROUP BY medicine HAVING totQty < ROUND((select stock from medicine where medicine.stock != 0 AND medicine.id = sale_product_info.medicine) * 0.4)";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSalesDetails() {
//        $query = "SELECT * FROM sale_product_info WHERE deletion_status = 0 AND date(date) = date(now())";
        $query = "SELECT medicine,SUM(qty) as totQty,unit_price,product_os,date FROM sale_product_info WHERE deletion_status = 0 AND date(date) = date(now()) GROUP BY medicine";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSalesDetailsByDate($from, $to, $item) {
        if ($item != "") {
            $query = "SELECT * FROM sale_product_info WHERE deletion_status = 0 AND medicine = '$item' AND date BETWEEN '$from' AND '$to'";
        } else {
            //$query = "SELECT * FROM sale_product_info WHERE deletion_status = 0 AND DATE(date) BETWEEN '$from' AND '$to'";
            $query = "SELECT medicine,SUM(qty) as totQty,unit_price,product_os,date FROM sale_product_info WHERE deletion_status = 0 AND date BETWEEN '$from' AND '$to'  GROUP BY medicine";
        }

        $result = $this->db->select($query);
        return $result;
    }

    public function getIncomeByDate($from, $to) {

        $query = "SELECT * FROM income WHERE deletion_status = 0 AND income_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getTodaysExpense() {

        $query = "SELECT * FROM expense WHERE deletion_status = 0 AND expense_date = date(now())";

        $result = $this->db->select($query);

        return $result;
    }

    public function getExpenseByDate($from, $to) {

        $query = "SELECT * FROM expense WHERE deletion_status = 0 AND expense_date BETWEEN '$from' AND '$to'";

        $result = $this->db->select($query);

        return $result;
    }

    public function saveNetCapital($data) {
        $date = date('Y-m-d');
        $total_purchase = mysqli_real_escape_string($this->db->link, $data['total_purchase']);
        $total_due = mysqli_real_escape_string($this->db->link, $data['total_due']);
        $opening_balance = mysqli_real_escape_string($this->db->link, $data['opening_balance']);
        $total = mysqli_real_escape_string($this->db->link, $data['total']);
        $total_supplier_due = mysqli_real_escape_string($this->db->link, $data['total_supplier_due']);
        $net_capital = mysqli_real_escape_string($this->db->link, $data['net_capital']);


        if ($date == "") {

            $msg = "
		  <div class='alert alert-danger'>
                          <h4> Field can not be empty </h4>
		  </div>";

            return $msg;
        } else {

            $genericquery = "SELECT * FROM net_capital WHERE date = '$date' LIMIT 1";

            $genericchk = $this->db->select($genericquery);
            if ($genericchk != false) {

                $msg = "<div class='alert alert-danger'>Already submitted.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO `net_capital`(`total_purchase`, `total_due`, `opening_balance`, `total`, `total_supplier_due`, `net_capital`, `date`) VALUES

				('$total_purchase','$total_due','$opening_balance','$total','$total_supplier_due','$net_capital','$date')";

                $genericinsert = $this->db->insert($query);

                if ($genericinsert) {
                    $_SESSION['message'] = "<div class='alert alert-success'>
                            <h4>Net capital info save successfully.</h4>
                       </div>";
                    header('Location: net-capital.php');
                    exit();
                } else {
                    $_SESSION['message'] = "<div class='alert alert-success'>
                            <h4>Failed.</h4>
                       </div>";
                    header('Location: net-capital.php');
                    exit();
                }
            }
        }
    }

    public function getNetcapital($from, $to) {
        $query = "SELECT * FROM net_capital WHERE deletion_status = 0 AND date BETWEEN '$from' AND '$to'";
        $result = $this->db->select($query);
        return $result;
    }

    public function purchasedStock($medicine,$from,$to) {
        if($from != '' && $to != ''){
            $query = "SELECT SUM(qty) as totPQty FROM purchase_product_info WHERE deletion_status = 0 AND medicine = '$medicine' AND pur_date BETWEEN '$from' AND '$to' GROUP BY medicine";
        }else{
            $query = "SELECT SUM(qty) as totPQty FROM purchase_product_info WHERE deletion_status = 0 AND medicine = '$medicine' AND date(pur_date) = date(now()) GROUP BY medicine";
        }
        
        $result = $this->db->select($query);
//        if ($result) {
//            $total = mysqli_num_rows($result);
//            return $total;
//        }
        return $result;
    }

}
?>




