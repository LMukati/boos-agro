<?php 

include 'layout/connect.php';

if(isset($_GET['id']) && $_GET['id'] != '') {
	$id = base64_decode($_GET['id']);
	$sql = mysqli_query($conn,"SELECT * FROM users WHERE id = '$id'");
	if(mysqli_num_rows($sql) > 0) {
		$sql1 = mysqli_query($conn,"UPDATE users SET active = '1' WHERE id = '$id'");
		if($sql1) {
		    echo '<script>alert("Successfully Verified.Please Login to your account"); window.location.href="index.php";</script>';	
		}
	} else {
		echo '<script>alert("Invalid Url Please register"); window.location.href="allregister.php";</script>';
	}
}
?>