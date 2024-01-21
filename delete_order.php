<?php include('layout/connect.php');
session_start();

if(!isset($_SESSION['userId'])) {
    header("Location:index.php");
    exit();
}

if(isset($_GET['d_Order']) && $_GET['d_Order'] != ""){

    $sql = "UPDATE `order_details` SET `active` = '0', status = 8 WHERE `id` = '".$_GET['d_Order']."'" ;
    
    $sql1= mysqli_query($conn,"INSERT INTO order_approved(`status`,`approved_date`,`user_role_id`,`order_id`) 
                      VALUES ('8','".date("Y-m-d h:i:sa")."','".$_SESSION['userId']."','".$_GET['d_Order']."')");
     
   if ($conn->query($sql) === TRUE)
     {
        echo "<script> window.location ='".$_GET["red"]."' ; </script>";
     }  
     else
     {
      echo "<script>alert('Error Raw deleted'); window.location ='submit_raw_material.php?d_Order=<?php echo '".$_GET['d_Order']."'; ?>'; </script>";
      // echo "<script>alert('Error Product Inserted');window.location='raw_material.php';</script>";
     }
}

 ?>