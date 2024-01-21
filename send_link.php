<?php
define('BASE_URL', 'https://boss.atsindore.com/');
include('layout/connect.php');
if (isset($_POST['submit']))
{
	?>
	<style>
		.clr {
		    background-color:#D3D3D3;
		}
	</style>
	<?php

$email = $_POST['email'];

  $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");
   $row = mysqli_fetch_assoc($query);
   $partOne =  substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);    
   $partTwo =  substr(str_shuffle("0123456789"), 0, 4);  
   $password= $partOne.$partTwo;
       //$password=uniqid(rand(),1);
       $pass=md5($password);
	   //echo $password;
if($row['email'] == '')
	{
  echo "<script>window.location.href='index.php?passchange=err';</script>";
   }
 else
{	
	$tempName=$row['first_name'].' '.$row['last_name'];
	$name=ucwords($tempName);

	$to = $email;
	$subject = "Password Recovery";
	$body = '<!DOCTYPE html>
  <html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Boss Agro Email Template</title>
    
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
          <img src="'.BASE_URL.'/images/logo-2.png" style="width:22%; margin-left:auto;margin-right:auto;display:block;" />
          <h3 style="width:100%;font-weight:bold;color:#176268;text-align:center; font-family:comicbd;">BOSS AGRO CHEMICALS PVT. LTD.</h3>
          <p style="width:98%;text-align:center; font-family:comic;">We Offer An Extensive Range Of Agro Chemicals</br> For Small seller And Wholesale dealers</p>
      </div>
  <!-- <hr/> -->
      <div class="row banner-row text-center" style="margin-left:0; margin-right:0;border-top:solid 1px gray;border-bottom:solid 1px gray;margin-top: 20px;
      padding-top: 15px;padding-bottom: 15px;">
          <!-- <img src="'.BASE_URL.'/images/Boss Agro.jpg" style="width:100%;margin-left:0; margin-right:0;display:block;"/ -->
          <div class="col-sm-12 col-xs-12">
            <p style="text-align:left;font-family:comic;">Hello, <span style="color:blue;font-family:comicbd;font-size: 20px;">'.$name.'</span> </p>
          </div>
  
          <div class="col-sm-12 col-xs-12">
            <p style="font-family:comic;text-align:left;color:blue;font-size:18px;line-height:30px;">Your New Password is: <span style="color:#ff0000;background-color:#00ff00;"> '.$password.'</span></p>
          </div>
  
          <div class="col-sm-12 col-xs-12">
            
  
            <p style="color:red;font-family:comic;"> Any Query or Support Please Send Mail On <a href="#" style="text-decoration:underline;">support@bossagro.com </a>.</p>
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
  </html>';

$headers  = "MIME-Version: 1.0" ."\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: do-notreply@bossagro.com' . "\r\n" .
                       'Reply-To: do-notreply@bossagro.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
           // $message ='<!DOCTYPE html>
mail($to, $subject, $body, $headers);

//echo"";print_r($password);die;
$sql = mysqli_query($conn, "UPDATE users SET password='$pass' WHERE email = '$email'");
//echo"";print_r($password);die;
echo "<script>window.location.href='index.php?passchange=true';</script>";

}// close if form sent

 
}
?>