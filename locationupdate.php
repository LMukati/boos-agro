<?php 
session_start();
include('layout/connect.php');

// include('layout/header1.php');


/* ASM Data */
if(isset($_POST['ASMUpdate']))
	{
   
          $id = $_POST['userid'];

           if(!empty($_POST['city']))
           {
             $city= implode(', ', $_POST['city']);
           }
           else{
              $city ='';
           }
          
          $state = $_POST['state'];
          $pgtype = $_POST['pgtype'];
          $country = $_POST['country'];
            $role = $_POST['role'];

        $sql = "UPDATE users SET city = '".$city."' ,country = '".$country."', state = '".$state."' , user_role = '".$role."' WHERE id = '".$id."'";
      
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$pgtype);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
  }
}


/* RSM Data */
if(isset($_POST['RSMUpdate']))
  {
   
          $id = $_POST['userid'];
           if(!empty($_POST['state']))
           {
             $state = implode(', ', $_POST['state']);
           }
           else{
              $state ='';
           }
          
          $country = $_POST['country'];
           $role = $_POST['role'];
          $pgtype = $_POST['pgtype'];

        $sql = "UPDATE users SET country = '".$country."', state = '".$state."' , user_role = '".$role."' WHERE id = '".$id."'";
      
         if (mysqli_query($conn, $sql)) 
                            {
                                header("Location:user_list.php?type=".$pgtype);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
  }
}


/* SP Data */
if(isset($_POST['SPUpdate']))
  {
   
           $id = $_POST['userid'];
          $state = $_POST['state'];
            $city = $_POST['city'];
            $role = $_POST['role'];
            $pgtype = $_POST['pgtype'];
          $country = $_POST['country'];
      
        $sql = "UPDATE users SET country = '".$country."', state = '".$state."', city = '".$city."' , user_role = '".$role."' WHERE id = '".$id."'";
     
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:user_list.php?type=".$pgtype);
                            }
                            else
                            {
                                header("Location:dashboard.php");  
  }
}

?>