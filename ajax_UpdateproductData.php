<?php include('layout/connect.php');
if(isset($_GET['order_id']) && $_GET['order_id'] != '') {
	

	$sql = mysqli_query($conn, "SELECT * FROM order_product WHERE id = '".$_GET['product_id']."'");
	$row = mysqli_fetch_object($sql);
	
	$gprice = $row["grand_total"] ;
	
	
	$ssql = mysqli_query($conn, "SELECT * FROM order_details WHERE id = '".$_GET['order_id']."'");
	$srow = mysqli_fetch_object($ssql);
	
	$tprice = $srow["total_price"] ;
	
	$newp = $tprice - $gprice ;
	
	mysqli_query($conn,"update order_details set total_price = '$newp'  WHERE id = '".$_GET['order_id']."'");

	
	$sql1 = mysqli_query($conn, "delete from order_product WHERE id = '".$_GET['product_id']."'");
	
	if($sql1) {
		$json = array(
			'result' => 'success'
		);
	} else {
		$json = array(
			'result' => 'error'
		);
	}

	echo json_encode($json);

}