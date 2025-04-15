<?php
	header("Content-Type: application/json");
	
       include 'connect.php';
	
	mysqli_set_charset( $conn, "utf8" );
	$sql = "SELECT medicine.*,medicine.id as mid,rack.*,generic.*,company.* 
			FROM medicine INNER JOIN rack ON
			medicine.rack_id = rack.id
			
			INNER JOIN generic ON
			medicine.generic_id = generic.id
			
			INNER JOIN company ON
			medicine.company_id = company.id
			WHERE medicine.deletion_status = 0 AND medicine.stock = 0
			";
			
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	
	$data = array();
	$i=0;
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$i++;
		
		$data[] = array(
			'sl' => $i,
			'medicine_id' => $rows['mid'],
			'medicine_name' => $rows['medicine_name'],
			'medicine_generic' => $rows['generic_name'],
			'medicine_from' => $rows['medicine_form'],
			'medicine_strength' => $rows['medicine_strength'],
			'company_name' => $rows['company_name'],
			'medicine_rack' => $rows['rack_name'],
			'stock' => $rows['stock'],
			'link' => 
			
			'
				<a target="_blank" href="medicine-view.php?medicine_id='.$rows['mid'].'"><span class="label label-primary"><i class="fas fa-eye"></i></span></a> 
				<a target="_blank" href="edit-medicine.php?medicine_id='.$rows['mid'].'"><span class="label label-info"><i class="far fa-edit"></i></span></a>
				<a onclick="return confirm("Are you sure to remove?");" href="?medicine_id='.$rows['mid'].'"><span class="label label-danger"><i class="fas fa-trash"></i></span></a>
			',
		);
	}
	$results = array(
	"sEcho" => 1,
	"iTotalRecords" => count($data),
	"iTotalDisplayRecords" => count($data),
	"aaData"=>$data);
	
	echo html_entity_decode(json_encode($results));
	
?>