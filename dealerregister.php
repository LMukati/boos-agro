<?php 
session_start();
include('layout/connect.php');




/* Dealer Data */
if(isset($_POST['Register']))
	{
   if($_POST['userid']!='')
      {
       $pass=md5($_POST['pass']);
        $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
        $imagebackup =$_POST['image1'];
        if(($images) !='')
        {
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
        $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$images."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:dealerlist.php");
                            }
                            else
                            {
                                header("Location:createuser.php");  
                            }
        }
        else
        {
          $sql = "UPDATE users SET username = '".$_POST['hname']."' ,firm_name='".$_POST['firm_name']."',email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$imagebackup."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:dealerlist.php");
                            }
                            else
                            {
                                header("Location:createuser.php");  
                            }
        }
  }
  else
  {
	   $un=$_POST['hname'];
	   $firm_name=$_POST['firm_name'];
	   $email=$_POST['hemail'];
	   $pass=md5($_POST['pass']);
	   $firstname=$_POST['firstname'];
	   $lastname=$_POST['lastname'];
	   $phone=$_POST['phone'];
	   $role=$_POST['role'];
	    $images = $_FILES["image"]["name"];
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
     $sqlns ="INSERT INTO users (username,firm_name, email, image, password, first_name, last_name, phone, user_role) VALUES ('".$un."','".$firm_name."',".$email."','".$images."','".$pass."','".$firstname."','".$lastname."','".$phone."','".$role."')";
     if (mysqli_query($conn, $sqlns)) 
                            {

                            	 header("Location:dealerlist.php");
                            }
                            else
                            {
                                header("Location:createuser.php");	
                            }

	}

}

/* Accounatnt Data */
if(isset($_POST['AcoountRegister']))
    {
      if($_POST['userid']!='')
      {
       $pass=md5($_POST['pass']);
        $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
               $imagebackup =$_POST['image1'];
        if(($images) !='')
        {
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
        $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$images."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:accountantlist.php");
                            }
                            else
                            {
                                header("Location:createaccount.php");  
                            }
        }
        else
        {
          $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$imagebackup."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:accountantlist.php");
                            }
                            else
                            {
                                header("Location:createaccount.php");  
                            }
        }
  }
  else
  {
       $un=$_POST['hname'];
       $email=$_POST['hemail'];
       $pass=md5($_POST['pass']);
       $firstname=$_POST['firstname'];
       $lastname=$_POST['lastname'];
       $phone=$_POST['phone'];
       $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
     $sqlns ="INSERT INTO users (username, email, image, password, first_name, last_name, phone, user_role) VALUES ('".$un."','".$email."','".$images."','".$pass."','".$firstname."','".$lastname."','".$phone."','".$role."')";
     if (mysqli_query($conn, $sqlns)) 
                            {
                                 header("Location:accountantlist.php");
                            }
                            else
                            {
                                header("Location:createaccount.php");  
                            }

    }
  }


/* ZSM Data */

if(isset($_POST['ZSMRegister']))
    {
      if($_POST['userid']!='')
      {
       $pass=md5($_POST['pass']);
        $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
             $imagebackup =$_POST['image1'];
        if(($images) !='')
        {
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
        $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$images."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:zsmlist.php");
                            }
                            else
                            {
                                header("Location:createzsm.php");  
                            }
        }
        else
        {
          $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$imagebackup."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                             {
                                 header("Location:zsmlist.php");
                            }
                            else
                            {
                                header("Location:createzsm.php");  
                            }
        }
  }
  else
  {
       $un=$_POST['hname'];
       $email=$_POST['hemail'];
       $pass=md5($_POST['pass']);
       $firstname=$_POST['firstname'];
       $lastname=$_POST['lastname'];
       $phone=$_POST['phone'];
       $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
     $sqlns ="INSERT INTO users (username, email, image, password, first_name, last_name, phone, user_role) VALUES ('".$un."','".$email."','".$images."','".$pass."','".$firstname."','".$lastname."','".$phone."','".$role."')";
     if (mysqli_query($conn, $sqlns)) 
                            {
                                 header("Location:zsmlist.php");
                            }
                            else
                            {
                                header("Location:createzsm.php");  
                            }

    }
    
   }

/* RSM Data */
if(isset($_POST['RSMRegister']))
    {

      if($_POST['userid']!='')
      {
       $pass=md5($_POST['pass']);
        $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
            $imagebackup =$_POST['image1'];
        if(($images) !='')
        {
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
        $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$images."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:rsmlist.php");
                            }
                            else
                            {
                                header("Location:creatersm.php");  
                            }
        }
        else
        {
          $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$imagebackup."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                                 header("Location:rsmlist.php");
                            }
                            else
                            {
                                header("Location:creatersm.php");  
                            }
        }
  }
  else
  {
       $un=$_POST['hname'];
       $email=$_POST['hemail'];
       $pass=md5($_POST['pass']);
       $firstname=$_POST['firstname'];
       $lastname=$_POST['lastname'];
       $phone=$_POST['phone'];
       $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
     $sqlns ="INSERT INTO users (username, email, image, password, first_name, last_name, phone, user_role) VALUES ('".$un."','".$email."','".$images."','".$pass."','".$firstname."','".$lastname."','".$phone."','".$role."')";
     if (mysqli_query($conn, $sqlns)) 
                             {
                                 header("Location:rsmlist.php");
                            }
                            else
                            {
                                header("Location:creatersm.php");  
                            }

    }
}

/* ASM Data */
    if(isset($_POST['ASMRegister']))
    {
      if($_POST['userid']!='')
      {
       $pass=md5($_POST['pass']);
        $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
               $imagebackup =$_POST['image1'];
        if(($images) !='')
        {
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
        $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$images."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                            {
                              
                                 header("Location:asmlist.php");
                               
                            }
                            else
                            {
                            
                               header("Location:createasm.php");  
                             
                            }
        }
        else
        {
          $sql = "UPDATE users SET username = '".$_POST['hname']."' ,email = '".$_POST['hemail']."', password = '".$pass."', first_name = '".$_POST['firstname']."', last_name = '".$_POST['lastname']."', image = '".$imagebackup."', phone = '".$_POST['phone']."', user_role = '".$_POST['role']."' WHERE id = '".$_POST['userid']."'";
         if (mysqli_query($conn, $sql)) 
                               {
                              
                                 header("Location:asmlist.php");
                               
                            }
                            else
                            {
                            
                               header("Location:createasm.php");  
                             
                            }
        }
  }
  else
  {
       $un=$_POST['hname'];
       $email=$_POST['hemail'];
       $pass=md5($_POST['pass']);
       $firstname=$_POST['firstname'];
       $lastname=$_POST['lastname'];
       $phone=$_POST['phone'];
       $role=$_POST['role'];
        $images = $_FILES["image"]["name"];
                $uploadfile=$_FILES["image"]["tmp_name"];
                $folder="uploads/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);
     $sqlns ="INSERT INTO users (username, email, image, password, first_name, last_name, phone, user_role) VALUES ('".$un."','".$email."','".$images."','".$pass."','".$firstname."','".$lastname."','".$phone."','".$role."')";
     if (mysqli_query($conn, $sqlns)) 
                            {
                              
                                 header("Location:asmlist.php");
                               
                            }
                            else
                            {
                            
                               header("Location:createasm.php");  
                             
                            }

    }
    }

    

?>
