<?php
    session_start();
    include('layout/connect.php');
    if(!isset($_SESSION['userId'])) {
        header("Location:index.php");
        exit();
    }
    //print_r($_SESSION);die;

    include('layout/header1.php');
    function getName($tblName,$match,$val,$getVal)
    {
       include('layout/connect.php');
       $sql1 = "SELECT * FROM $tblName where $match='".$val."'";
    
          $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1) > 0) {
              
             $role = $result1->fetch_assoc();
             return $role[$getVal];
           }
    }
    function getUserStatus($id) {
    	include('layout/connect.php');
    	$sql3 = mysqli_query($conn, "SELECT statusname FROM status where id ='".$id."'");
    	$row3 = mysqli_fetch_assoc($sql3);
    	return $row3['statusname'];
    }
   // print_r($_SESSION);
if(isset($_GET["id"]) && $_GET["id"] !='')
{
   
$usd = mysqli_query($conn,"select * from users where id = '".$_GET["id"]."'")    ;
$row = mysqli_fetch_array($usd);

}
else
{
    $usd = mysqli_query($conn,"select * from users where id = '".$_SESSION["userId"]."'")    ;
$row = mysqli_fetch_array($usd);
}    
?>
<style>.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}</style>
<div class="content-wrapper">
	<section class="content-header">
		<ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        </ol>
        <?php //echo "<pre>";print_r($row); ?>
	</section>
	
	<section class="content">
		<div class="box">
			<div class="box-header with-border" style="background-color: #3c8dbc;">
				<h3 class="box-title">User Detail</h3>
				
				<div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
			</div>
			
			<div class="box-body">
            <fieldset>
   
                <?php
                if(isset($_GET['id']) && $_GET['id'] !=""){
                  $sql = "SELECT * FROM users where id='".$_GET['id']."'";
                }else{
                     $sql = "SELECT * FROM users where id='".$_SESSION['userId']."'";
                }
                      $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                          
                          while($row1 = $result->fetch_assoc()) {
                            //echo"<pre>"; print_r($row);
                        $sql1 = "SELECT * FROM groups where group_id='".$row1["user_role"]."'";
                        
                      $result1 = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result1) > 0) {
                          
                         $role = $result1->fetch_assoc();
                       }
                      // print_r($row);
                ?>
                  
                     <div class="divider"><center><h3 style="margin-bottom:15px; border-bottom:3px solid #3c8dbc; padding:10px;">Basic Information:</h3></center></div>
                    <div class="row">
                    
                     
                      <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Role:</label>
                                <input type="pass" class="form-control" name="hemail" id="role" placeholder="Role" value="<?php  echo $role['group_name'].'/ Distributor';?>" readonly="">
                            <span class="material-input"></span>
                        </div>
                        <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Firm Name:</label>
                                <input type="text" readonly="readonly" class="form-control" name="firm_name" style="text-transform:uppercase"  value="<?php  echo $row["firm_name"];?>" placeholder="Firm Name">
                            <span class="material-input"></span>
                        </div>
                        
                        
                       </div>
                        <div class="row">
                             <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Name:</label>
                                <input type="text" readonly="readonly"  class="form-control" name="firstname" id="firstname" placeholder="Name" value="<?php  echo $row["first_name"];?>">
                            <span class="material-input"></span>
                        </div>
                          <div class="form-group is-empty col-md-3">
                            <label class="control-label" for="textarea">Phone/Mobile No.:</label>
                                <input type="text" readonly="readonly"  class="form-control" name="phone" id="phone" placeholder="Mobile No." value="<?php  echo $row["phone"];?>" maxlength="10" >
                            <span class="material-input" readonly=""></span>
                        </div>
                        <div class="form-group is-empty col-md-3">
                            <label class="control-label" for="textarea">Email:</label>
                             <input type="email" readonly="readonly"  class="form-control" name="hemail" id="hemail" placeholder="Your@domain.com" value="<?php  echo $row["email"];?>">
                            <span class="material-input"></span>
                        </div>
                       
                        
                        </div>
  <!--                        <input type="button" name="password" class="next btn btn-info" value="Next" />-->
  <!--</fieldset>-->
  <!--<fieldset>-->
   <div class="divider"><center><h3 style="margin-bottom:15px; border-bottom:1px solid #3c8dbc; padding:10px;">Dealer Other Details:</h3></center></div>
                         
                        <div class="form-group is-empty col-md-12">
                            <label class="control-label" for="textarea">Address:</label>
                                <input type="text" readonly="readonly"  value="<?php  echo $row["village"];?>" style="text-transform:uppercase"  name="village" id="village" class="form-control" placeholder="Address">
                            <span class="material-input"></span>
                        </div>
                         </div>
                         <div class="row">
                         
                        <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">Country:</label>
                            <input type="text" readonly="readonly"  value="India"   name="country" id="country" class="form-control" placeholder="country">
                            <span class="material-input"></span>
                        </div>
                         <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">State:</label>
                                 
                            <?php

                                   if($row['state'] !='')
                                    {
                                      $statName=getName('states','id',$row['state'],'name');
                                       ?>
                                    <!-- <option value="<?php echo $row['state'];?>"><?php echo $statName;?></option> -->
                                      <input type="text" readonly="readonly"  value="<?php echo $statName;?>"   name="state" id="state" class="form-control" placeholder="state"><?php
                                    }
                                    

                                   
                                ?>
                              
                        </div>
                       
                         
                         <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">City:</label>
                               
                              <?php
                                if($row['city'] !='')
                                  {
                                    $statCity=getName('cities','id',$row['city'],'name');
                                    ?>
                                 <input type="text" readonly="readonly"  value="<?php echo $statCity;?>"   name="city" id="city" class="form-control" placeholder="city">
                                 <?php }
                                  
                              ?>
                            
                        </div></div>
                       
                             <div class="row">
                     <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">Telephone No. with STD Code Office:</label>
                            <input type="text" readonly="readonly" class="form-control" name="tel" id="tel" placeholder="Telephone No." maxlength="10" value="<?php echo $row['telephone'];?>">
                            <span class="material-input"></span>
                        </div>
                        
                        <div class="form-group is-empty col-md-4" style="display:none;">
                            <label class="control-label" for="textarea">Mobile:</label>
                                <input type="text" readonly="readonly" value="<?php echo $row['phone'];?>" name="phone1" id="phone1" class="form-control" placeholder="Mobile No." maxlength="12">
                            <span class="material-input"></span>
                        </div>
                        <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">DOB:</label>
                                <input type="date" readonly="readonly" class="form-control" name="dob" id="dob" placeholder="(DD/MM/YY)" value="<?php  echo $row["dob"];?>">
                            <span class="material-input"></span>
                        </div>
                         <!-- <div class="row">
                          
                        </div> -->
                        <!-- <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Marriage Anniversary:</label>
                                <input type="date" class="form-control" name="marri" id="marri" placeholder="(DD/MM/YY)" value="<?php  //echo $row["marri"];?>">
                            <span class="material-input"></span>
                        </div> -->
                       
                        
                        </div>
  <!--                       <input type="button" name="previous" class="previous btn btn-default" value="Previous" />-->
  <!--  <input type="button" name="next" class="next btn btn-info" value="Next" />-->
  <!--</fieldset>-->
  <!--<fieldset>-->
                      <div class="divider"><center><h3 style="margin-bottom:15px; border-bottom:1px solid #3c8dbc; padding:10px;">Uploading File:</h4></center></div>
                        <div class="row">
                         
                         
                      <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">Dealer Image</label>
                                
                            
                            <span class="material-input"></span>
                             <?php
                            if(isset($row["image"]))
                            {
                              ?><br><?php if($row["image"]){ ?>
                              <img class="img-thumbnail" style="height: 250px; width: 250px;"src="<?php  echo $row["image"];?>">
                              
                              <?php }
                            }
                            ?>
                        </div>
                          <div class="form-group is-empty col-md-4">
                         
                           
                            <div class="form-group is-empty col-md-6" id="adharblock">
                            <label class="control-label" for="textarea">Adhar Card Upload:</label>
                             
                                 
                           
                        </div>
                            <span class="material-input"></span>
                            <?php
                            if(isset($row["adharimg"]))
                            {
                              ?><br>
                              <?php if($row["adharimg"] !=""){ ?>
                              <img class="img-thumbnail" style="height: 250px; width: 250px;" src="<?php  echo $row["adharimg"];?>">
                              
                              <?php }
                            
                            }
                            ?>
                       
                         
                        </div>
                        <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">Upload Address Proof</label>
                             
                                  
                            <span class="material-input"></span>
                             <?php
                            if(isset($row["addimage"]))
                            {
                              ?><br>
                              <?php if($row["addimage"] !=""){ ?> 
                              <img class="img-thumbnail" style="height: 250px; width: 250px;" src="<?php  echo $row["addimage"];?>">
                              <input type="hidden" name="addimage" value="<?php  echo $row["addimage"];?>">
                              <?php }
                            }
                            ?>
                        </div>
                      </div>

                        <div class="row">
                        <div class="form-group is-empty col-md-6"  >
                         <div class="form-group is-empty col-md-6"  >
                            <label class="control-label" for="textarea">GSTN Number:</label>
                                <input type="text" readonly="readonly" class="form-control" name="gstn" id="gstn" style="text-transform:uppercase"  placeholder="GSTN Number" value="<?php  echo $row["gstno"];?>" maxlength="16" onblur="myFunctiongstn(document.getElementById('gstn').value)">  
                                     
                           
                        </div>
                         <div class="form-group is-empty col-md-6"  id="gstnblock" >
                            <label class="control-label" for="textarea">GSTN Card Upload in PDF:</label>
                             
                               <span class="material-input"></span>
                             <?php
                            if(isset($row["gstimg"]))
                            {
                              ?><br>
                              <?php if($row["gstimg"] !=""){ ?>
                              <a class="img-thumbnail" style="display:none;width: 250px; height: 50px;" href="<?php  echo $row["gstimg"];?>">Dowanload GST Card</a>
                              <input type="hidden" name="gstnimage" value="<?php  echo $row["gstimg"];?>">
                              <?php }
                            }
                            ?>   
                            <span class="material-input"></span>
                        </div>
                        </div>

                        
                        </div>

                       <div class="row">
                      
  <!--                            <input type="button" name="previous" class="previous btn btn-default" value="Previous" />-->
  <!--  <input type="button" name="next" class="next btn btn-info" value="Next" />-->
  <!--</fieldset>-->
  <!--<fieldset>-->
                       
                       <div class="divider" style="display:none;"><center><h3 style="margin-bottom:15px; border-bottom:3px solid #3c8dbc; padding:10px;">Other Information:</h3></center></div>
                       
                          
                                
                       <!--<div class="row">-->
                       <!-- <div class="form-group is-empty col-md-6"  >-->
                       <!--  <div class="form-group is-empty col-md-6"  >     -->
                            <!--<input type="button" name="previous" class="previous btn btn-default" value="Previous" />-->
                       <!--             <?php if($row['user_role'] == 8){?>-->
                       <!--     <a href="editdlprofile.php"><button type="button" name="UpdateDealer" class="btn btn-success ">Update</button></a>-->
                       <!--     <?php }else{ ?>-->
                       <!--     <a href="editprofile.php"><button type="button" name="UpdateDealer" class="btn btn-success ">Update</button></a>-->
                       <!--     <?php } ?>-->
                       <!--  </div>-->
                       <!-- </div>-->
                       <!--</div>-->

  </fieldset>
			</div> 

   
   

</div>
            </div>
        </div>
	</section>
</div>
<?php }  } ?> 
 
<?php include('layout/footer1.php');?>
<script src="js/jquery.magnify.js"></script>