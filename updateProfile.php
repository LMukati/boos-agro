<?php
session_start();
include('layout/connect.php');
//print_r($_POST);die;
if(isset($_POST['email_varify']) && $_POST['email_varify'] != ''){
    $email = $_POST['email_varify'];
    $id = $_POST['user_id'];
    $number= $_POST['verify_number'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE id ='".$id."'");

    $result= mysqli_fetch_assoc($sql);
    //print_r($result);die;
    if($result['digit_4'] == $number){
             $sqlns = "UPDATE users SET verify='1', email='".$email."' WHERE id='".$id."'" ;
                if (mysqli_query($conn, $sqlns)) {
                    echo "1";
                   // header("Location:editProfile.php?succ=succ");
                
            } else {
               echo "10"; 
            }   
    }else{
        echo "0";
    }

}
if(isset($_POST['email_data']) && $_POST['email_data'] !=''){
    $email=$_POST['email_data'];
    $id = $_POST['user_id'];
    //$partOne =  substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3); 
    $digitss = 4; 
    $digit = rand(pow(10, $digitss-1), pow(10, $digitss)-1);  
   // echo $digit; 
    //$password= $partTwo;
    //$password=uniqid(rand(),1);
    //$pass=md5($password);
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email LIKE '%$email%'");
    if(mysqli_num_rows($sql) > 0) {
        echo '0';
    } else {
    
        $sqlns = mysqli_query($conn,"UPDATE users SET digit_4='".$digit."' WHERE id='".$id."'") ;
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
            $message ='<!DOCTYPE html><html><head><title>Boss Agro Email Template</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><style>@media only screen and (min-width:480px){.boss-mail-container .intro-row .col-xs-6{width:50%;}}
  @media only screen and (max-width:479px){
    .boss-mail-container .intro-row .col-xs-6{
      width:100%;
    }
  }
</style>
</head>
<body style="background-color:#6a7a01 !important; font-family:arial; font-size:15px;">
    <div class="container boss-mail-container" style=" max-width:580px;width:100%;background-color:#ffffff;padding:15px 5px;margin:20px auto;"><!--container-->


        <div class="row header-row text-center" style="margin-left:0; margin-right:0;">
        <img src="http://bossagro.com/boss/images/logo.png" style="width:24%; margin-left:auto;margin-right:auto;display:block;" />
        <h3 style="width:100%;font-weight:bold;color:#176268;text-align:center;">BOSS AGRO CHEMICALS PVT. LTD.</h3>
        <p style="width:98%;text-align:center;">We Offer An Extensive Range Of Agro Chemicals For Small seller And Wholesale dealers</p>
    </div>
<hr/>
    <div class="row banner-row text-center" >
        <img src="http://bossagro.com/boss/images/Boss%20Agro.jpg" style="max-width:100%;style="margin-left:0; margin-right:0;display:block;"/>
    </div>

    <div class="col-xs-12">
          <p style="font-family: Allura,cursive,Arial, Helvetica, sans-serif; font-size:12px">Hello,<br>User:'.$email.' <br>OTP :'.$digit.'</p>
        </div>
        <hr/>
    <div class="row footer-row text-center" style="margin-left:0; margin-right:0;">
      <h4 style="font-weight:bold;">Email Marketing For Boss Agro Chemicals</h4>
      <p>73, Sarvodaya Nagar, Near Hablani Parisar, Sapna Sangeeta Road,</br> Indore - 452001 (M.P.)</p>
      <p>Phone: 0731-2468111, 4274888, Email: bossagrochem@gmail.com, </br>Web: www.bossagro.com</p>
    </div>
    <div class="row footer-row-2 text-center" style="background-color:#f5f5f5; margin-left:0; margin-right:0;">
      <p style="padding:10px;">If you can no longer interested, you can <a href="#">unsubscribe instantly</a></p>
    </div>
    </div><!--container-->

</body>
</html>
';
               // echo $message; die;
                
            if(mail($to, $subject, $message, $headers)){

           
            echo "1";
            }else{

                echo "0";
               
            }
    }else{
        echo 'Not Update Data';
    }


}
}
if(isset($_POST['NewRegister'])){
 echo "<pre>";print_r($_POST);print_r($_FILES);
    $id=$_POST['id'];
	$un=$_POST['hname'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $country=$_POST['country'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $work_name=$_POST['work_name'];
    $work_year=$_POST['work_year'];
    $work_position=$_POST['work_position'];
    $degree_name=$_POST['degree_name'];
    $degree_year=$_POST['degree_year'];
    $degree_reg_number=$_POST['degree_reg_number'];
    $sql_wn = implode(',', $work_name);
    $sql2_ye = implode(',', $work_year);
    $sql_po = implode(',', $work_position);
    $sql_dn = implode(',', $degree_name);
    $sql_dy = implode(',', $degree_year);
    $sql_de = implode(',', $degree_reg_number);
    $adhar=$_POST['adhar'];
    $village=$_POST['village'];
    $pan=$_POST['pan']; 
    $dob=$_POST['dob'];
    $regdate=$_POST['regdate'];
    
    $dir="uploads/";    
if(!is_dir($dir. $_POST['id'] ."/")) {
    mkdir($dir. $_POST['id'] ."/");
}
if(isset($_FILES["panimage"]["name"]) && $_FILES["panimage"]["name"] != ""){
  $temp = explode(".", $_FILES["panimage"]["name"]);
  //print_r( $temp);
  $panimage="";
  $newfilename = round(1000000,10000000) . '.' . end($temp);
  $panimage= $dir. $_POST['id'] ."/". $newfilename;
  //print_r( $gstnimage);
  //die;
  move_uploaded_file($_FILES["panimage"]["tmp_name"], $panimage);
//    print_r( $error);
//     die;
}else{
  $panimage=$_POST['panimage'];
} if(isset($_FILES["adharimage"]["name"]) && $_FILES["adharimage"]["name"] != ""){
  $temp = explode(".", $_FILES["adharimage"]["name"]);
  $adharimage="";
  $newfilename = round(100000,1000000) . '.' . end($temp);
  $adharimage= $dir. $_POST['id'] ."/". $newfilename;
  //$adharimage = round(100000,1000000) . '.' . end($temp);
  
  move_uploaded_file($_FILES["adharimage"]["tmp_name"],$adharimage);
}else{
  $adharimage=$_POST['adharimage'];
}if(isset($_FILES["addimage"]["name"]) && $_FILES["addimage"]["name"] != ""){
  $temp = explode(".", $_FILES["addimage"]["name"]);
  $addimage="";
  $newfilename = round(10000,100000) . '.' . end($temp);
  $addimage= $dir. $_POST['id'] ."/". $newfilename;
  move_uploaded_file($_FILES["addimage"]["tmp_name"],$addimage);
}else{
  $addimage=$_POST['addimage'];
}if(isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != ""){
  $temp = explode(".", $_FILES["image"]["name"]);
  //print_r( $temp);die;
  $image="";
  $newfilename = round(1000,10000) . '.' . end($temp);
  $image= $dir.$_POST['id'] ."/". $newfilename;
  move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}else{
  $image=$_POST['image'];
}if(isset($_FILES["resume"]["name"]) && $_FILES["resume"]["name"] != ""){
  $temp = explode(".", $_FILES["resume"]["name"]);
  //print_r( $temp);die;
  $resume="";
  $newfilename = round(100,1000) . '.' . end($temp);
  $resume= $dir. $_POST['id'] ."/". $newfilename;
  move_uploaded_file($_FILES["resume"]["tmp_name"],$resume);
}else{
  $resume=$_POST['resume'];
}
         

        $sqlns = "UPDATE users SET username='".$un."', image='".$image."'
                , first_name='".$firstname."', last_name='".$lastname."', 
                country='".$country."', state='".$state."', city='".$city."', 
                pancard='".$pan."', adharcard='".$adhar."', village='".$village."',
                 dob='".$dob."', 
                  regdate='".$regdate."', pancardimg='".$panimage."',
                   adharimg='".$adharimage."',resume='".$resume."',
                   addimage='".$addimage."',
                   workName='".$sql_wn."',exp='".$sql2_ye."',degree='".$sql_dn."',
                   degYear='".$sql_dy."',division='".$sql_de."',position='".$sql_po."' 
                   WHERE id='".$id."'" ;
  
        
        //print_r( $sqlns);die;

            if (mysqli_query($conn, $sqlns)) {
                header("Location:editProfile.php?succ=succ");
            
        } else {
            header("Location:editProfile.php?err=err"); 
        }   
   
}
