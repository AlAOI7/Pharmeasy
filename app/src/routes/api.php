<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;


$app->get('/api/v1/GetUserDetails', function(Request $request, Response $response){
     
     $token = implode("",$request->getHeader("Token"));
     $sql = "CALL `getUserDetails`('".$token."')";
	 
     try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $menu_items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($menu_items[0]);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode("Unauthorized user");
    } 
});


$app->get('/api/v1/GetStockList', function(Request $request, Response $response){
   
	$sql_productList = "call getProductInfo()";
	
    try{
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql_productList);
        $menu_items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($menu_items);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode("Unauthorized user");
    }
});

$app->get('/api/v1/GetMaxCustomerInvoiceNumber', function(Request $request, Response $response){
   
	$sql_productList = "call getMaxIdCustomerInvoice()";
	
    try{
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql_productList);
        $menu_items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($menu_items[0]);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode("Unauthorized user");
    }
});

$app->get('/api/v1/GetTotalStock', function(Request $request, Response $response){
   
	$sql_productList = "call getTotalStockList()";
	
    try{
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql_productList);
        $menu_items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($menu_items[0]);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode("Unauthorized user");
    }
});


$app->post('/api/v1/UserLogin', function(Request $request, Response $response){
   
    $user_name = $request->getParam('user_name');
    $password = $request->getParam('password');
	$token = bin2hex(openssl_random_pseudo_bytes(16)); //generate a random token

    // Get DB Object
    $db = new db();
    // Connect
    $con = $db->connect_to_db();

    //sql query
    $sql = "CALL `checkAuthentication`('".$user_name."', '".$password."')";
    $result = mysqli_query($con,$sql); 
	$row=mysqli_fetch_assoc($result);
	$userCode = $row['userCode'];
	
	if($userCode != null)
	{
    $db = new db();
    $con = $db->connect_to_db();
	$sql_two = "CALL `updateAuthenticationToken`('".$userCode."', '".$token."')";
    $result_two = mysqli_query($con,$sql_two); 
	
    echo json_encode($token);  
	} else 
	{
		 echo '{"error": {"text": '.$e->getMessage().'}';
	}
});


$app->post('/api/v1/AddInvoices', function(Request $request, Response $response){
   
        $all_variable = $request->getParsedBody();
		$customer_invoice = $all_variable['CustomerInvoice'];
		$sale_product = $all_variable['SelectedProduct'];
		
		$user_id = $customer_invoice["userId"];
		$productSaleAmount = $customer_invoice["productSaleAmount"];
		$productNetAmount = $customer_invoice["productNetAmount"];
		$discount = $customer_invoice["discount"];
		$less = $customer_invoice["less"];
		
		try{
		//start ------------- customer invoice -----------------------------
       
		$sql = 'CALL addInvoice(:userId,
		                        :productSaleAmount,
								:productNetAmount,
								:discount,
								:less,
								@invoiceNumberOut,
								@maxIdOut)';
 
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
 
        // pass value to the command
        $stmt->bindParam(':userId', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':productSaleAmount', $productSaleAmount, PDO::PARAM_STR);
        $stmt->bindParam(':productNetAmount', $productNetAmount, PDO::PARAM_STR);
        $stmt->bindParam(':discount', $discount, PDO::PARAM_INT);
        $stmt->bindParam(':less', $less, PDO::PARAM_INT);
 
        // execute the stored procedure
        $stmt->execute();
 
        $stmt->closeCursor();
 
        // execute the second query to get customer's level
        $row = $db->query("SELECT @invoiceNumberOut AS invoiceNumber, @maxIdOut as maxId")->fetch(PDO::FETCH_ASSOC);
        $invoiceNumber = $row['invoiceNumber'];
		$maxId = $row['maxId'];
		
		//--------------------- customer invoice ending process ---------------------------------------
		
		
		try{
	    for($i = 0; $i<count($sale_product);$i++)
        {
        $userId = $sale_product[$i]["userId"];
		$productId = $sale_product[$i]["productId"];
		$quantity = $sale_product[$i]["quantity"];
		 // Get DB Object
        $db = new db();
        // Connect
        $con = $db->connect_to_db();

        //sql query
         $sql = "CALL `addSaleProductInfo`('".$productId."', '".$userId."','".$quantity."','".$invoiceNumber."','".$maxId."')";
        $result = mysqli_query($con,$sql);    
		 }
		 		 echo json_encode($invoiceNumber);
		} catch(PDOException $e)
		{
			 echo json_encode($e->getMessage());
		}
		
		
		}  catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode($e->getMessage());
    }
});


$app->post('/api/v1/AddSaleInvoices', function(Request $request, Response $response){
   
        $all_variable = $request->getParsedBody();
		$sale_product = $all_variable['SelectedProduct'];

		try{
	    for($i = 0; $i<count($sale_product);$i++)
        {
        $userId = $sale_product[$i]["userId"];
		$productId = $sale_product[$i]["productId"];
		$quantity = $sale_product[$i]["quantity"];
		$invoiceNumber = $sale_product[$i]["invoiceNumber"];
		$maxId = $sale_product[$i]["maxId"];
		
		// Get DB Object
        $db = new db();
        // Connect
        $con = $db->connect_to_db();

        //sql query
        $sql = "CALL `addSaleProductInfo`('".$productId."', '".$userId."','".$quantity."','".$invoiceNumber."','".$maxId."')";
        $result = mysqli_query($con,$sql);   
		 }
		 
		/*$db = new db();
        $con = $db->connect_to_db();
	    $sql_two = "CALL `deleteUnwantedInvoice`()";
        $result_two = mysqli_query($con,$sql_two);*/
		
		echo json_encode($invoiceNumber);
		} catch(PDOException $e)
		{
			 echo json_encode($e->getMessage());
		}
});


$app->post('/api/v1/AddCustomerInvoice', function(Request $request, Response $response){
        $all_variable = $request->getParsedBody();
		$customer_invoice = $all_variable['CustomerInvoice'];
		$sale_product = $all_variable['SelectedProduct'];
		
		$user_id = $customer_invoice["userId"];
		$productSaleAmount = $customer_invoice["productSaleAmount"];
		$productNetAmount = $customer_invoice["productNetAmount"];
		$discount = $customer_invoice["discount"];
		$less = $customer_invoice["less"];
		
		$sql = 'CALL addInvoice(:userId,
		                        :productSaleAmount,
								:productNetAmount,
								:discount,
								:less,
								@invoiceNumberOut,
								@maxIdOut)';
 
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
 
        // pass value to the command
        $stmt->bindParam(':userId', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':productSaleAmount', $productSaleAmount, PDO::PARAM_STR);
        $stmt->bindParam(':productNetAmount', $productNetAmount, PDO::PARAM_STR);
        $stmt->bindParam(':discount', $discount, PDO::PARAM_INT);
        $stmt->bindParam(':less', $less, PDO::PARAM_INT);
 
        // execute the stored procedure
        $stmt->execute();
 
        $stmt->closeCursor();
 
        // execute the second query to get customer's level
        $row = $db->query("SELECT @invoiceNumberOut AS invoiceNumber, @maxIdOut as maxId")->fetch(PDO::FETCH_ASSOC);
        $invoiceNumber = $row['invoiceNumber'];
		$maxId = $row['maxId'];
		
        echo json_encode($invoiceNumber.','.$maxId);  
});



$app->get('/api/v1/invoiceDetail', function(Request $request, Response $response){
   
         $invoiceNo = $request->getParam('invioceNo');
         $sql  = "SELECT 
                  customer_invoice_info.id,
                  customer.name,
                  customer.mobile,  
                  customer_invoice_info.previous_due,
                  customer_invoice_info.invoice_number,
                  customer_invoice_info.sale_date,
                  customer_invoice_info.mainTotalAmount,
                  customer_invoice_info.total_amount,
                  customer_invoice_info.totalNetAmount,
                  customer_invoice_info.payment_method,
                  customer_invoice_info.discount,
                  customer_invoice_info.less,
                  customer_invoice_info.amount,
                  customer_invoice_info.changeAmount,
                  customer_invoice_info.dues,
                  customer_invoice_info.checkAmount,
                  customer_invoice_info.bankName,
                  customer_invoice_info.checkNumber,
                  customer_invoice_info.checkAppDate,
                  customer_invoice_info.user_id,
                  customer_invoice_info.user_name
                  FROM customer_invoice_info left join customer 
                  on customer.id = customer_invoice_info.customer 
                  WHERE customer_invoice_info.deletion_status = 0 AND customer_invoice_info.invoice_number = 
                  '$invoiceNo' ORDER BY customer_invoice_info.id DESC LIMIT 1";
	
    try{
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $menu_items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($menu_items[0]);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode("Unauthorized user");
    }
});


$app->get('/api/v1/invoiceProductsDetails', function(Request $request, Response $response){
   
         $inv = $request->getParam('inv');
         $cusId = $request->getParam('cusId');
         $sql = "SELECT 
         sale_product_info.qty,
         sale_product_info.unit_price,
         sale_product_info.discount,
         sale_product_info.sub_total,
         sale_product_info.net_cost,
         sale_product_info.inv_number,
         sale_product_info.commonId,
         sale_product_info.user_id,
         sale_product_info.user_name,
         medicine.medicine_form,
          medicine.medicine_name,
         medicine.medicine_strength,
         medicine.sale_price
         FROM sale_product_info left join medicine on 
         sale_product_info.medicine = medicine.id
         WHERE sale_product_info.deletion_status = 0 AND sale_product_info.inv_number = '$inv' 
         AND sale_product_info.commonId = '$cusId'";
	
    try{
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $menu_items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($menu_items);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode("Unauthorized user");
    }
});
