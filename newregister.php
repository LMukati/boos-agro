<?php 
define('BASE_URL', 'https://boss.atsindore.com/');
session_start();
include('layout/connect.php');

if(isset($_POST['NewRegister'])){

	$un=$_POST['hname'];
		$firm_name=$_POST['firm_name'];
	
    $email=$_POST['hemail'];
    $partOne =  substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);    
$partTwo =  substr(str_shuffle("0123456789"), 0, 4);  
$password= $partOne.$partTwo;
    //$password=uniqid(rand(),1);
    $pass=md5($password);
   //print_r( $pass);die;
    $phone=$_POST['phone'];
    $role=$_POST['role'];
    
    $status='1';
   
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email LIKE '%$email%'");
   
    if(mysqli_num_rows($sql) > 0) {
        echo '<script>alert("Email Already Exists"); window.location.href="index.php";</script>';
         //print_r( $pass);die;
    } else {
   if(isset($_POST['dlr'])){
    $tel=$_POST['tel'];
   // $resume = $_FILES["resume"]["name"];
    //$uploadfile4=$_FILES["resume"]["tmp_name"];
    // $dir="uploads/";    
    //     if(!is_dir($dir. $_POST['id'] ."/")) {
    //         mkdir($dir. $_POST['id'] ."/");
    //     }
    //     if(isset($_FILES["resume"]["name"]) && $_FILES["resume"]["name"] != ""){
    //       $temp = explode(".", $_FILES["resume"]["name"]);
    //       //print_r( $temp);die;
    //       $resume="";
    //       $newfilename = round(100,1000) . '.' . end($temp);
    //       $resume= $dir. $_POST['id'] ."/". $newfilename;
    //       move_uploaded_file($_FILES["resume"]["tmp_name"],$resume);
    //     }
         echo "<pre>";print_r($_POST);
        $sqlns = "INSERT INTO users (firm_name, email,  password,  phone, user_role, status) VALUES ('".$firm_name."','".$email."','".$pass."','".$phone."','".$role."','".$status."')";
   //echo "<pre>";print_r($sqlns);die;
   }else{
       //$resume_temp="img";
       //echo "<pre>";print_r($_POST);die;
       	$first_name=$_POST['first_name'];
       $sqlns = "INSERT INTO users (username,first_name, email,  password,  phone, user_role, status) VALUES ('".$un."','".$first_name."','".$email."','".$pass."','".$phone."','".$role."','".$status."')";
        //echo $sqlns;die;
   }
    $sql_run= mysqli_query($conn,$sqlns);
    // echo(mysqli_num_rows($sql_run));die;
      //print_r(  mysqli_query($conn,$sqlns));die;
       //$co
        if ($sqlns) {
            $id = mysqli_insert_id($conn);
            $url = base64_encode($id);
            $to      = $email;
            $subject = 'Boss Agro';
            // Set content-type header for sending html email
            $headers  = "MIME-Version: 1.0" ."\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: do-notreply@bossagro.com' . "\r\n" .
                       'Reply-To: do-notreply@bossagro.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
            $message ='<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Boss Agro Email</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  @font-face {
    font-family:comic;
    src: url("comic.ttf");
  }
  @font-face {
    font-family:comicbd;
    src: url("comicbd.ttf");
  }
  @media only screen and (min-width:480px){
    .boss-mail-container .intro-row .col-xs-6{width:50%;
      }
    }
  @media only screen and (max-width:479px){
    .boss-mail-container .intro-row .col-xs-6{
      width:100%;
    }
  }
</style>
</head>
<body style="background-color:#6a7a01 !important; font-family:arial; font-size:15px;">
    <div class="container boss-mail-container" style=" max-width:580px;width:100%;background-color:#ffffff; padding: 15px 5px 3px 5px;margin:20px auto;"><!--container-->


        <div class="row header-row text-center" style="margin-left:0; margin-right:0;">
        <img src="'. BASE_URL .'images/logo-2.png" style="width:22%; margin-left:auto;margin-right:auto;display:block;" />
        <h3 style="width:100%;font-weight:bold;color:#176268;text-align:center; font-family:comicbd;">BOSS AGRO CHEMICALS PVT. LTD.</h3>
        <p style="width:98%;text-align:center; font-family:comic;">We Offer An Extensive Range Of Agro Chemicals</br> For Small Seller, Wholesale Dealers & Distributor</p>
    </div>
<!-- <hr/> -->
    <div class="row banner-row text-center" style="margin-left:0; margin-right:0;border-top:solid 1px gray;border-bottom:solid 1px gray;margin-top: 20px;
    padding-top: 15px;padding-bottom: 15px;">
        <!-- <img src="<?php echo BASE_URL; ?>/images/Boss Agro.jpg" style="width:100%;margin-left:0; margin-right:0;display:block;"/ -->
        <div class="col-sm-12 col-xs-12">
          <p style="text-align:left;font-family:comic;">Hello, <span style="color:blue;font-family:comicbd;font-size: 20px;">'.$email.'</span> </p>
        </div>

        <div class="col-sm-12 col-xs-12">
          <p style="text-align:left;font-size: 20px;font-family:comic;">Your User Id : '.$un.'</p>
        </div>
        <div class="col-sm-12 col-xs-12">
          <p style="font-family:comic;text-align:left;color:blue;font-size:18px;line-height:30px;">Your Password is: <span style="color:#ff0000;background-color:#00ff00;">'.$password.'</span></p>
        </div>
<div class="col-sm-12">  <a target="_blank" href="'. BASE_URL .'verify.php?id='.$url.'" class="btn btn-success" style="width:100%;font-weight:bold;background-color:#62a30c;font-size:16px;">Click here</a>Please click below link to verify your account</a></div>
        <div class="col-sm-12 col-xs-12">
          <p style="color:red; font-family:comic;margin-top:15px;"><span style="color: rgb(153, 0, 0);font-size:20px;">Note:</span> This Password is System Generated Password " Kindly Request to You" Change your Password after First Login </p>

          <p style="color:red;font-family:comic;"> Any Query or Support Please Send Mail support@<a href="#" style="text-decoration:underline;">bossagro.com </a>.</p>
        </div>

    </div>

    <div class="row footer-row text-center" style="margin-left:0; margin-right:0;">
      <h4 style="font-weight:bold; text-align:center;">Boss Agro Chemicals</h4>
      <p>Address: 73, Sarvodaya Nagar, </br>Near Hablani Parisar, Sapna Sangeeta Road, Indore - 452001 (M.P.)</p>
      <p>Phone: 0731-2468111, 4274888</p>
       <p>Email: <a href="#" style="text-decoration:underline;">support@bossagro.com</a> Web: <a href="#" style="text-decoration:underline;">www.bossagro.com</a></p>
       <p>  Copyright © 2018 Boss Agro Chem Pvt. Ltd. All rights reserved.</p>
    </div>

    <div class="row" style="margin-left:-5px; margin-right:-5px; background-color:#e6ebee;height:30px; margin-top:15px;">
      <p style="text-align:center; line-height:30px; font-size:12px;color:#757575;">  Copyright © 2018 Boss Agro Chem Pvt. Ltd. All rights reserved.</p>
    </div>
    
    </div><!--container-->

</body>
</html>
';
               // echo $message; die;
               
            if(mail($to, $subject, $message, $headers)){
            // if($role == 8)
            // {
            header("Location:index.php?registered=true");
            }
           // }
           // else
           // {
           //  header("Location:index.php?registered=true&type=2");
           // }

        } else {
            header("Location:index.php"); 
        }   
    }
}
