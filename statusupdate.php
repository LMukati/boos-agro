<?php 
session_start();
include('layout/connect.php');

/* Update by Director And Accountant */
  if(isset($_REQUEST['idra'])) {
         $page = $_REQUEST['pg'];  
         //echo "INSERT INTO approved_by (`status`,`approved_date`,`user_role_id`) VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userRole']."')";die;     
         $sql = "UPDATE users SET status = '7' WHERE id = '".$_REQUEST['idra']."'";
            $sql1= mysqli_query($conn,"INSERT INTO approved_by(`status`,`approved_date`,`user_role_id`,`user_id`,`approvel_user_id`) VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userRole']."','".$_REQUEST['idra']."','".$_SESSION['userId']."')");
    if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$page);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
                            }
        }


/* Update by Genral Manager */
if(isset($_REQUEST['idgm'])) {
         $page = $_REQUEST['pggm']; 
        
         $sql = "UPDATE users SET status = '6' WHERE id = '".$_REQUEST['idgm']."'";
    $sql1= mysqli_query($conn,"INSERT INTO approved_by(`status`,`approved_date`,`user_role_id`,`user_id`,`approvel_user_id`) VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userRole']."','".$_REQUEST['idgm']."','".$_SESSION['userId']."')");
    if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$page);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
                            }
        }
   
   /* Update by Zonal Manager */
if(isset($_REQUEST['idzm'])) {
         $page = $_REQUEST['pgzm'];
         
         $sql = "UPDATE users SET status = '5' WHERE id = '".$_REQUEST['idzm']."'";
   $sql1= mysqli_query($conn,"INSERT INTO approved_by(`status`,`approved_date`,`user_role_id`,`user_id`,`approvel_user_id`) VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userRole']."','".$_REQUEST['idzm']."','".$_SESSION['userId']."')");
    if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$page);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
                            }
        }

        /* Update by Regional Manager */
if(isset($_REQUEST['idrm'])) {
         $page = $_REQUEST['pgrm'];       
         
         $sql = "UPDATE users SET status = '4' WHERE id = '".$_REQUEST['idrm']."'";
   $sql1= mysqli_query($conn,"INSERT INTO approved_by(`status`,`approved_date`,`user_role_id`,`user_id`,`approvel_user_id`) VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userRole']."','".$_REQUEST['idrm']."','".$_SESSION['userId']."')");
    if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$page);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
                            }
        }

        /* Update by Area Manager */
if(isset($_REQUEST['idam'])) {
         $page = $_REQUEST['pgam']; 

            $sql = "UPDATE users SET status = '3' WHERE id = '".$_REQUEST['idam']."'";

   $sql1= mysqli_query($conn,"INSERT INTO approved_by(`status`,`approved_date`,`user_role_id`,`user_id`,`approvel_user_id`) VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userRole']."','".$_REQUEST['idam']."','".$_SESSION['userId']."')");
   //print_r($sql1);die;
    if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$page);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
                            }
        }
/* Update by Sales Person */
if(isset($_REQUEST['idsp'])) {
        
         $page = $_REQUEST['pgsp'];  
         
         $sql = "UPDATE users SET status = '2' WHERE id = '".$_REQUEST['idsp']."'";
   $sql1= mysqli_query($conn,"INSERT INTO approved_by(`status`,`approved_date`,`user_role_id`,`user_id`,`approvel_user_id`) VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userRole']."','".$_REQUEST['idsp']."','".$_SESSION['userId']."')");
    if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$page);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
                            }
        }

 