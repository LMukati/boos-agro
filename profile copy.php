<?php
session_start();
include('layout/connect.php');
 if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
include('layout/header1.php');
 ?>
<style type="text/css">
  /* Tabs*/
section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: ##222d32;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#tabs{
  background: #007b5e;
    color: #eee;
}
.nav-item 
{
  padding-left:20px;
}
#tabs h6.section-title{
    color: #eee;
}

#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #f3f3f3;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
    font-size: 20px;
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #eee;
    font-size: 20px;
}
#tabs span
{
  color:#000;
}
#tabs .active a
{
  background-color:#000;
}
#tabs input
{
  color:#808080;
}
#tabs td
{
  border:0px solid !important;
}
#tabs th
{
  border:0px solid !important;
}
#nav-contact
{
  position:relative;
}
.updata
{
  width:90%;
 margin-top:30px;
 padding:30px;
}
</style>
<?php 
if(isset($_POST['Submit']))
{
 $oldpass=md5($_POST['opwd']);
  $newpassword=md5($_POST['npwd']); 
$sql=mysqli_query($conn,"SELECT password FROM users where password='$oldpass' AND id='".$_SESSION['userId']."'");

if(mysqli_num_rows($sql) > 0)
{
 $sql1=mysqli_query($conn,"update users set password='$newpassword' where id='".$_SESSION['userId']."'");
$_SESSION['msg1']="Password Changed Successfully !!";
}
else
{
$_SESSION['msg1']="Old Password not match !!";
}
}
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">User Profile</h3>
     
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <!-- Tabs -->
<section id="tabs">
  <div class="">
    <h6 class="section-title h1">Profile</h6>
       <!-- <p style="color:red; text-align: center"><?php echo $_SESSION['image'];?><?php echo $_SESSION['image']="";?></p> -->
    <div class="row">
      <div class="col-xs-2">
      </div>
      <div class="col-xs-8">
        <nav>
          <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <li class="active"><a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a></li>
            <li><a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Change Password</a></li>
              <?php  if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2') {    ?>
            <li><a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Edit profile</a></li><?php } ?>
            <?php  if($_SESSION['userRole']!='8'){ ?>
              <li><a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Personal</a></li>
           <?php  }  ?>          
          </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade in  active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="col-xs-2">
</div>
               <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  ">
            <div class="well-lg">
                <div class="row">
                  <?php   $sql = "SELECT *  FROM users where id ='".$_SESSION['userId']."'"; 
                  {
                     $result = mysqli_query($conn, $sql);
                                 if (mysqli_num_rows($result) > 0)
                                     {

                                    while($row = mysqli_fetch_assoc($result)) 
                                      {
                                        
                                        $json[]=$row;
                                        //print_r($row);die;
                                        $id = $row['id'];
                                        $username = $row['username'];
                                        $password = $row['password'];
                                        $email = $row['email'];
                                        if($_SESSION['userRole'] == '8' ){
                                          $image = $row['dlrimage'];
                                        }else{
                                          $image = $row['image'];
                                        }
                                        $first_name = $row['first_name'];
                                        $last_name = $row['last_name'];
                                        $phone = $row['phone'];
                                        $dob=$row['dob'];
                                        $country =$row['country'];
                                        $mrg=$row['marri'];
                                        $city =$row['city'];
                                        $state =$row['state'];
                                        $status =$row['status'];
                                        $rgs=$row['regdate'];
                                        $shop=$row['shop'];
                                        $shopType =$row['shoptype'];
                                        $year =$row['year'];
                                        $saleType =$row['saletype'];
                                        $lic=$row['liencense'];
                                        $adhr=$row['adharcard'];
                                        $pan=$row['pancard'];
                                        $gstn=$row['gstno'];
                                        $deg=$row["degree"];
                                        $degYr= $row["degYear"];
                                        $div=$row["division"];
                                        $signeee=$row['signeee'];
                                        $wkNm=$row["workName"];
                                        $exp=$row["exp"];
                                        $pos=$row["position"];
                                        
                                         $sql1 = "SELECT statusname  FROM status where id ='".$status."'"; 
                  {
                   
                     $result1 = mysqli_query($conn, $sql1);
                                 if (mysqli_num_rows($result1) > 0)
                                     {
                                        $row1 = mysqli_fetch_assoc($result1);
                                        $statusname= $row1['statusname'];   
                                      } 
                                      } 
                                       
                                      } 
                                      } 
                 $sql1 = "SELECT * FROM states where id ='".$state."'";
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $sql2 = "SELECT * FROM cities where id ='".$city."'";
                 $result2 = mysqli_query($conn, $sql2);
                 $row2 = mysqli_fetch_assoc($result2);
                 $sql_sz = "SELECT * FROM countries where id ='".$country."'";
                 $resultsz = mysqli_query($conn, $sql_sz);
                 $row_sz = mysqli_fetch_assoc($resultsz);
       
                    }?>

                    
                    <div class="col-sm-4 col-md-2">
                      
                    </div> 
                    <div class="col-sm-8 col-md-8">

                      
                   <table class="table">
                   <?php if($_SESSION['userRole'] == '8' ){ ?>
                   <tr><td></td><td ><img width="80" src="<?php echo BASE_URL?>uploads/<?php  echo $_SESSION["userId"];?>/<?php echo $image;?>" alt="" class=" img-circle img-rounded img-responsive" /></td><td></td></tr>
                  <?php  }else{ ?>
                    <tr><td></td><td ><img width="80" src="<?php echo BASE_URL?>uploads/<?php echo $image;?>" alt="" class=" img-circle img-rounded img-responsive" /></td><td></td></tr>
                   <?php } ?>
                   <th ><tr style="background-color:darkslategray;"><td b colspan="3">Information:</td></tr></th>

                    <tr>
                    <td>Name:</td><td>  <?php echo $first_name.$last_name; ?></td>
                    </tr>
                     <tr>
                    <td>Email:</td><td>  <?php echo $email; ?></td>
                    </tr>
                    <tr>
                    <td>Phone:</td><td>  <?php echo $phone; ?></td>
                    </tr>
                    <?php if($_SESSION['userRole'] == '3' || $_SESSION['userRole'] == '4' || $_SESSION['userRole'] == '5' || $_SESSION['userRole'] == '6' || $_SESSION['userRole']=='7' || $_SESSION['userRole']=='8' ){ ?>
                    <tr>
                    <td>DOB:</td><td>  <?php echo $dob; ?></td>
                    </tr>
                   <!-- <?php  if($_SESSION['userRole'] != '8'){?>
                    <tr>
                    <td>MARRIAGE ANNIVERSARY:</td><td><?php echo $mrg;?></td>
                    </tr>
                    <?php }?> -->
                    <th ><tr style="background-color:darkslategray;"><td b colspan="3">Uploading Information:</td></tr></th>
                    <tr>
                    <td>LIENCENSE:</td><td>  <?php echo $lic; ?></td>
                    </tr>
                     <tr>
                    <td>ADHARCARD </td><td>  <?php echo $adhr; ?></td>
                    </tr>
                    <tr>
                    <td>PANCARD</td><td>  <?php echo $pan; ?></td>
                    </tr>
                    <tr>
                    <td>GSTN</td><td>  <?php echo $gstn; ?></td>
                    </tr>
                    <!-- <tr>
                    <td>SIGNATURE:</td><td><td ><img width="80" src="<?php echo BASE_URL?>uploads/<?php  echo $_SESSION["userId"];?>/<?php echo $signeee;?>" alt="" class=" img-circle img-rounded img-responsive" /></td></td>
                    </tr> -->
                    <?php  if($_SESSION['userRole'] != '8' && $_SESSION['userRole'] != '1'){
                      if($user_data["resume"] !=""){
                      ?>
                     <td>RESUME:</td><td><a class="img-thumbnail" href="<?php  echo  $user_data["resume"];?>"><?php  echo  "Uploded";?></a></td>
                    </tr>
                    <?php }}?>
                     <?php if($_SESSION['userRole'] =='8' ){ ?>
                   <th ><tr style="background-color:darkslategray;"><td b colspan="3">Shop Information:</td></tr></th>
                   <td>SHOP NAME:</td><td>  <?php echo $shop; ?></td>
                    </tr>
                     <!-- <tr>
                    <td>SHOP TYPE:</td><td>  <?php echo $shopType; ?></td>
                    </tr> -->
                    <tr>
                    <td>YEAR:</td><td>  <?php echo $year; ?></td>
                    </tr>
                    <tr>
                    <td>SALE TYPE:</td><td>  <?php echo $saleType; ?></td>
                    </tr><?php } ?>
                    <?php  if($_SESSION['userRole'] != '8'){?>
                    <th ><tr style="background-color:darkslategray;"><td b colspan="3">Education::</td></tr></th>
                    <tr><th>Degree</th><th>Year</th><th>Division</th></tr>
                    <?php
                    }
                      $temp=explode(',', $deg);
                      $temp1=explode(',', $degYr);
                      $temp2=explode(',', $div);
                      $n=count($temp);
                      if($n>1)
                       {
                        for ($i=0; $i < $n ; $i++) { 
                          ?>

                            <tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr>
                            <?php 
                          }
                       }
                    ?>
                    <?php  if($_SESSION['userRole'] != '8'){?>
                    <th ><tr style="background-color:darkslategray;"><td b colspan="3">Experience:</td></tr></th>
                    <tr><th>Work</th><th>Year</th><th>Position</th></tr>
                    <?php
                    }
                      $temp3=explode(',', $wkNm);
                          $temp4=explode(',', $exp);
                          $temp5=explode(',', $pos);
                          $n1=count($temp3);
                           if($n1>1)
                             {
                              for ($i=0; $i < $n1 ; $i++) { 
                                ?>

                                  <tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr>
                                  <?php 
                                }
                             }
                    ?>
                     <?php } ?>
                    </table>
                     <?php if($_SESSION['userRole'] == '3' || $_SESSION['userRole'] == '4' || $_SESSION['userRole'] == '5' || $_SESSION['userRole'] == '6' || $_SESSION['userRole']=='7' || $_SESSION['userRole']=='8' ){ ?>
                      <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $rgs; ?></p>
                      <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
                     <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
          </div>
         
          <div class="tab-pane fade in" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
                   <h4 style="text-align: center;">Change Password</h4>
                     </div>
                   </div>
          <div class="row">
<div class="col-sm-6 col-sm-offset-3">
      
<form name="chngpwd" action="" method="post" onSubmit="return valid();">
<table align="center">
<tr height="50">
<td>Old Password :</td>
<td><input type="password" name="opwd" id="opwd"></td>
</tr>
<tr height="50">
<td>New Passowrd :</td>
<td><input type="password" name="npwd" id="npwd"></td>
</tr>
<tr height="50">
<td>Confirm Password :</td>
<td><input type="password" name="cpwd" id="cpwd"></td>
</tr>
<tr>
<td></td><td><input type="submit" class="btn btn-succuss" name="Submit" value="Change Passowrd" /></td>
</tr>
 </table>
</form>
</div>
</div>
          </div>
          
            <?php  if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2') {    ?>
          <div class="tab-pane fade in" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="updata">
              <h4 style="text-align: center;">Edit Profile</h4>
             <?php if(isset($_REQUEST['id'])) {
              $ids = $_REQUEST['id'];
              $sql = "SELECT *  FROM users where id ='".$ids."'";
                  $result = mysqli_query($conn, $sql);
                                 if (mysqli_num_rows($result) > 0)
                                     {

                                    while($row = mysqli_fetch_assoc($result)) 
                                      {
                                        $json[]=$row;
                                        $id = $row['id'];
                                        $username = $row['username'];
                                        $password = $row['password'];
                                        $email = $row['email'];
                                        $image = $row['image'];
                                        $first_name = $row['first_name'];
                                        $last_name = $row['last_name'];
                                        $phone = $row['phone'];
                                        $user_role = $row['user_role'];
                                      } 
                                      }   
                                       } 
                                 
              ?>
           <form action="dealerregister1.php" method="POST" id="register" class="form-horizontal" enctype="multipart/form-data">

                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">User Name:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="register_hname" name="hname" value="<?php if(isset($username) != ''){ echo $username; } ?>">
                              <input type="hidden" class="form-control" id="register_id" name="userid" value="<?php if(isset($id) != ''){ echo $id; } ?>">
                             
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="register_hemail"  name="hemail" value="<?php if(isset($email) != ''){ echo $email; } ?>">
                             
                            </div>
                        </div>
                    </div>
                </div><!--row-->

                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Featured Image:</label>
                            <div class="col-sm-10"> 
                                <input type="file" class="form-control" name="himage">
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Profile Image:</label>
                            <div class="bootstrap-filestyle input-group"><!--bootstrap-filestyle-->
                               <input type="file" name="image"  class="btn btn-primary btn-md file-image"/>
                                 <span class="register-image"><?php if(isset($image) != ''){ ?> <img src='<?php echo $image;?> '> <?php } ?></span>
                                 <input type="hidden" name="image1" value="<?php echo $image;?>">
                            </div><!--bootstrap-filestyle-->
                        </div>
                    </div>
                    
                   
                </div><!--row-->

                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">First Name:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="firstname" name="firstname" value="<?php if(isset($first_name) != ''){ echo $first_name; } ?>">
                             
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Last Name:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="lastname" name="lastname" value="<?php if(isset($last_name) != ''){ echo $last_name; } ?>">
                             
                            </div>
                        </div>
                    </div>
                </div><!--row-->
                 <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Phone:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="phone" name="phone" value="<?php if(isset($phone) != ''){ echo $phone; } ?>">
                             
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                      <?php   $sql = "SELECT *  FROM groups where group_id ='".$_SESSION['userRole']."'";
                               $result = mysqli_query($conn, $sql);
                                 if (mysqli_num_rows($result) > 0)
                                     {

                                    while($row = mysqli_fetch_assoc($result)) 
                                      {
                                        $role_name =$row["group_name"];
                                        $role_id =$row["group_id"];
                                      }
                                     }
                           ?>
                            <input type="hidden" class="form-control" id="role" placeholder="Enter email" name="role" value="<?php echo $role_id; ?>">
                            <!-- <label class="control-label col-sm-2" for="email">Role:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="role" name="role" value="<?php //echo $role_name; ?>" disabled>
                               
                             
                            </div> -->
                        </div>
                    </div>
                </div><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10" id="registerForm">
                                <button type="submit" name="Register" class="btn btn-success pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
               
                  
            

            </form>
         
</div>
          </div>
          <?php } ?>
          <div class="tab-pane fade in" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
          </div>
        </div>
      
      </div>
    </div>
  </div>
</section>
<!-- ./Tabs -->
        </div>
       
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('layout/footer1.php');?>
 