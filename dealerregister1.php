<?php 
session_start();
include('layout/connect.php');

// include('layout/header1.php');


/* Dealer Data */
if(isset($_POST['Register']))
	{
   if($_POST['userid']!='')
      {
       $password=$_POST['pass'];
       $pass=md5($password);
        $role=$_POST['role'];
        //print_r($_POST);die;
        $images = $_FILES["image"]["name"];
        
        if(($images) !='')
        {
          
                 //$userUploadfiles=$_FILES["image"]["tmp_name"];
                //$folder="uploads/";
               $dir = 'uploads/admin/'; 
	           $temp = explode(".", $_FILES["image"]["name"]);
               $newfilename = round(microtime(true)) . '.' . end($temp);
	            $path= $dir. $_POST['userid'] ."/". $newfilename;
	          if(!is_dir($dir. $_POST['userid'] ."/")) {
                    mkdir($dir. $_POST['userid'] ."/");
                }


        move_uploaded_file($_FILES["image"]["tmp_name"], $dir. $_POST['userid'] ."/". $newfilename);

        $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$path."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:profile.php");
                            }
                            else
                            {
                                header("Location:dashboard.php");  
                            }
        }
        else
        {
          $path =$_POST['image1'];
          $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$path."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:profile.php");
                            }
                            else
                            {
                                header("Location:dasshboard.php");  
                            }
        }
  }
 

}
