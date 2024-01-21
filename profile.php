<?php

    session_start();
    // echo $_SESSION['userId'];die;
    include('layout/connect.php');
    if(!isset($_SESSION['userId'])) {
        header("Location:index.php");
        exit();
    }

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
    ?>

<style type="text/css">
   .form-horizontal .form-group
  {
    margin-left:0px;
    margin-right:0px;
  }
  #regiration_form fieldset:not(:first-of-type) {
    display: none;
  }
</style>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Profile
       <!--  <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Edit Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border" style="background: #3c8dbc;">
          <h3 class="box-title">Profile</h3>
            
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <?php
if (@$_GET['succ'] == 'succ') { ?>
   <div class="alert alert-success">
  <strong>Successfully Update Profile!</strong>
</div>
<?php } if (@$_GET['err'] == 'err') { ?>
   <div class="alert alert-danger">
  <strong>Not Update Profile</strong>
</div>
<?php }
?>
					
           <form action="updateProfile.php" method="POST" id="regiration_form" class="form-horizontal" enctype="multipart/form-data">
                <fieldset>
				<?php
				if(isset($_GET['id']) && $_GET['id'] !="" ){
				     $sql = "SELECT * FROM users where id='".$_GET['id']."'";
				}else{
                  $sql = "SELECT * FROM users where id='".$_SESSION['userId']."'";
				}
                      $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                          
                          while($row = $result->fetch_assoc()) {
                            // echo $row['country'];
                        $sql1 = "SELECT * FROM groups where group_id='".$row["user_role"]."'";
                        
                      $result1 = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result1) > 0) {
                          
                         $role = $result1->fetch_assoc();
                       }
                      
                
                ?>

                    <input type="hidden" name="id" id='user_id' value="<?php  echo $_SESSION['userId'];?>">

                    <div class="row">
                    <div class="divider"><center><h4 style="margin-bottom:15px; border-bottom:3px solid #3c8dbc; padding:10px;">Basic Information:</h4></center></div>
                        <div class="form-group is-empty col-md-6" style="display:none;">
                            <label class="control-label" for="textarea">User Name:</label>
                                <input type="text" class="form-control" name="hname" id="hname" value="<?php  echo $row["username"];?>" placeholder="Name" readonly="">
                            <span class="material-input"></span>
                        </div>
                         <div class="form-group is-empty col-md-12">
                            <label class="control-label" for="textarea">Email:</label>
                              <input type="email" readonly=""  class="form-control" name="hemail" id="hemail" placeholder="Your@domain.com" value="<?php  echo $row["email"];?>">
                            <span class="material-input"></span>
                        </div>
                       </div>
                        <div class="row">
                         <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Phone/Mobile No.:</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Mobile No." value="<?php  echo $row["phone"];?>" maxlength="10" readonly>
                            <span class="material-input" readonly=""></span>
                        </div>
                         <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Role:</label>
                            <?php 
                              ?>
                              <select class="form-control pull-right" name="role" id="role" readonly>
             
             <?php  
               
                                 if($row["user_role"] == '2'){
                                       ?>
                                 
                                  <option value="2">Account Manager  </option> 
                                <?php  } 
                               else if($row["user_role"] == '3' ){
                                  ?>
                                   <option value="3">General Manager  </option> 
                                <?php } else if($row["user_role"] == '4' ){
                                  ?>
                                   <option value="4">Zonal Sales Manager  </option> 
                                <?php }else if($row["user_role"] == '5' ){
                                  ?>
                                   <option value="5">Regional Sales Manager</option> 
                                <?php }else if($row["user_role"] == '6' ){
                                  ?>
                                   <option value="6">Area Sales Manager</option> 
                                <?php } else if($row["user_role"] == '7' ){
                                  ?>
                                   <option value="7">Sales Person</option> 
                                <?php }else{ ?>
                                 <option value="">Select Role  </option> 
                                 <?php  $sql = "SELECT *  FROM groups";
   
                                   $result = mysqli_query($conn, $sql);
                                     if (mysqli_num_rows($result) > 0)
                                         {
    
                                        while($row = mysqli_fetch_assoc($result)) 
                                          {
                                             if($row["group_id"]!=8 && $row["group_id"]!=1)
                                             {
                                            $role_name =$row["group_name"];
                                            $role_id =$row["group_id"];
                                            ?>
                                            <option value="<?php echo $role_id;?>"><?php echo $role_name;?></option> 
   
                             <?php    }} }}?>
               </select>
                                <!-- <input type="pass" class="form-control" name="hemail" id="role" placeholder="Role" value="<?php  echo $row["user_role"];?>" readonly=""> -->
                            
                            <span class="material-input"></span>
                        </div>
						 
                        </div>
						<!--<input type="button" name="password" class="next btn btn-info" value="Next" />-->
						
					
                         <div class="row">
                         <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Name:</label>
                                <input type="text" readonly=""  class="form-control" name="firstname" id="firstname" placeholder="Name" value="<?php  echo $row["first_name"]." ".$row["last_name"];?>">
                            <span class="material-input"></span>
                        </div>
                        
                         <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Address:</label>
                                <input type="text" readonly="" value="<?php  echo $row["village"];?>" name="village" id="village" class="form-control" placeholder="Address">
                            <span class="material-input"></span>
                        </div>
						
                        </div>
                         <div class="row">
                        <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Country:</label>
                              
                                   <?php
                                    $dd_res="SELECT * FROM countries WHERE id ='101'";
                                     $country = mysqli_query($conn, $dd_res);
                                      if (mysqli_num_rows($country) > 0)
                                     {
                                       while($r=mysqli_fetch_assoc($country))
                                           {
                                           
                                            ?>
                                             <input type="text" readonly="" class="form-control" name="stat" id="stat" placeholder="stat" value="India"> </option>
                                            <?php
                                          
                                          } 
                                        }
                                    ?>
                            </select>
                            <span class="material-input"></span>
                        </div>
                         <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">State:</label>
                                 
                            <?php

                                   if($row['state'] !='')
                                    {
                                      $statName=getName('states','id',$row['state'],'name');
                                      ?>
                                       <input type="text" readonly="" class="form-control" name="stat" id="stat" placeholder="stat" value="<?php  echo $statName;?>"><?php
                                    }
                                                                    
                                ?>
                              
                        </div>
                        </div>
                         <div class="row">
                         <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">City:</label>
                                
                                 <?php
                                if($row['city'] !='')
                                  {
                                    $statCity=getName('cities','id',$row['city'],'name');
                                    ?>
                                    <input type="text" readonly="" class="form-control" name="city" id="city" placeholder="city" value="<?php  echo $statCity;?>">
                                    <?php
                                  }
                            
                              ?>
                            
                        </div>
                        <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">DOB:</label>
                                <input type="date" readonly="" class="form-control" name="dob" id="dob" placeholder="(DD/MM/YY)" value="<?php  echo $row["dob"];?>">
                            <span class="material-input"></span>
                        </div>
                  
                       </div>
                        <div class="row">
                      
                        <!-- <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Marriage Anniversary:</label>
                                <input type="date" class="form-control" name="marri" id="marri" placeholder="(DD/MM/YY)" value="<?php  echo $row["marri"];?>">
                            <span class="material-input"></span>
                        </div> -->
                        <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Joining Date:</label>
                                <input type="text"  readonly="" class="form-control" name="regdate" id="regidate" placeholder="(DD/MM/YY)" value="<?php echo $row['regdate']; ?>" >
                            <span class="material-input"></span>
                        </div>
                         </div> 
                       <div class="row">
                      <div class="form-group is-empty col-md-12">
                        <div class="divider"><center><h4 style="margin-bottom:15px; border-bottom:3px solid #3c8dbc; padding:10px;">Upload Information:</h4></center></div>
                         <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">Employee Image:</label>
                                
                                 <span id="lblErrorprofile" style="color: red;"></span>
                            <span class="material-input"></span>
                             <?php
                            if(isset($row["image"]))
                            {
                              ?><br><?php if($row["image"]){ ?>
                              <img class="img-thumbnail" style="height: 350px;" src="<?php  echo  $row["image"];?>"><?php }
                            }
                            ?>
                        </div>
                        
                        <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">Adhar Card Uploaded:</label>
                                
                                 <span id="lblErrorprofile" style="color: red;"></span>
                            <span class="material-input"></span>
                             <?php
                            if(isset($row["adharimg"]))
                            {
                              ?><br><?php if($row["adharimg"]){ ?>
                              <img class="img-thumbnail" style="height: 350px;" src="<?php  echo  $row["adharimg"];?>"><?php }
                            }
                            ?>
                        </div>
                         <div class="form-group is-empty col-md-4">
                            <label class="control-label" for="textarea">Uploaded Address Proof:</label>
                              
                            <span id="lblErroradd" style="color: red;"></span>
                            <span class="material-input"></span>
                             <?php
                            if(isset($row["addimage"]))
                            {
                              ?><br><?php if($row["addimage"]){ ?>
                              <img class="img-thumbnail" style="height: 350px;" src="<?php  echo  $row["addimage"];?>"><?php }
                            }
                            ?>
                        </div>
                        
                        
                        
                        </div>
                        <div class="form-group is-empty col-md-6">
                            <label class="control-label" for="textarea">Upload Resume</label>
                            <?php if(isset($row["resume"]) && $row["resume"] !="")
                            {
                              ?><br>
                                
                                 <span id="lblErrorresume" style="color: red;"></span>
                            <span class="material-input"></span>
                             <br>
                           
                              <a class="img-thumbnail" href="<?php  echo  $row["resume"];?>">Dowanload Resume</a>
                              <?php
                            }
                            ?>
                              <!-- <a class="img-thumbnail" href="<?php  echo  $row["resume"];?>"></a> -->
                             
                        </div>
						
	
                        </div>
                       <!-- <div class="row">-->
                       <!-- <div class="form-group is-empty col-md-6"  >-->
                       <!--  <div class="form-group is-empty col-md-6"  >     -->
                            <!--<input type="button" name="previous" class="previous btn btn-default" value="Previous" />-->
                                
                       <!--     <a href="editProfile.php"><button type="button" name="UpdateDealer" class="btn btn-success ">Update</button></a>-->
                            
                       <!--  </div>-->
                       <!-- </div>-->
                       <!--</div>-->
		
</div>
                           
         <!--<input type="button" name="previous" class="previous btn btn-default" value="Previous" />-->
   
</fieldset>
  
 
<?php }  } ?>

  
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
$(document).ready(function(){
    var email_data= $('#hemail').val();
    $('#country').on('change',function(){
     
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="<?php  echo $row["first_name"];?>">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="<?php  echo $row["first_name"];?>">Select country first</option>');
            $('#city').html('<option value="<?php  echo $row["first_name"];?>">Select state first</option>'); 
        }
    });

    $('#hemail').on('blur', function(){

       var email= $('#hemail').val();
       var user_id = $('#user_id').val();
       if(email_data != email ){
       $.ajax({
                type:'POST',
                url:'updateProfile.php',
                data:{
                    'email_data':email,
                    'user_id':user_id
                 },
                success:function(data){
                    if(data == 0){
                        alert('Please Use Any Other Email!');
                        $('#hemail').val(email_data);
                    }else{
                        alert('Please Check Your Email For OTP!')
                        $("#myModal").modal();

                    }
                    //return false;
                   // $('#city').html(html);
                },
            }); 
       }

    });
    $('#verify_email').on('click', function(){
        console.log($('#verify_no').val());
        $('#errVerify').html('');
         var email= $('#hemail').val();
         var user_id = $('#user_id').val();
         var verify_number= $('#verify_no').val();
         $.ajax({
                type:'POST',
                url:'updateProfile.php',
                data:{
                    'email_varify':email,
                    'user_id':user_id,
                    'verify_number':verify_number
                 },
                success:function(data){
                    if(data == 0){
                        //alert('Please Use Any Other Email!');
                        $('#errVerify').html('Enter Correct Number');
                    }else{
                        $("#myModal").modal('hide');

                    }
                    //return false;
                   // $('#city').html(html);
                },
            }); 


    });
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="<?php  echo $row["first_name"];?>">Select state first</option>'); 
        }
    });
});
</script>
  <script type="text/javascript">
    function pan1(txt)
{

  txt = txt.toUpperCase();
  var regex = /[a-zA-Z]{3}[PCHFATBLJG]{1}[a-zA-Z]{1}[0-9]{4}[a-zA-Z]{1}$/;
    var pan = {C:"Company", P:"Personal", H:"Hindu Undivided Family (HUF)", F:"Firm", A:"Association of Persons (AOP)", T:"AOP (Trust)", B:"Body of Individuals (BOI)", L:"Local Authority", J:"Artificial Juridical Person", G:"Govt"};
    pan=pan[txt[3]];
  if(regex.test(txt))
  {
    if(pan!="undefined")
      alert(pan+" card detected");
    var x = document.getElementById("panblock");
     if (x.style.display === 'none')
     {
     x.style.display = 'block';
     }
    
    else
    alert("Unknown card");
    }
    else
    alert("Unknown card");
}
  </script>
  <?php include('layout/footer1.php');?>

  <script type="text/javascript">
  $("form").on("change", "#pan_img", function () {
            var allowedFiles = [".jpg", ".jpeg", ".png",".pdf"];
            var fileUpload = $("#pan_img");
            var lblError = $("#lblErrorpan");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.val().toLowerCase())) {
                lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
                return false;
            }else{
              lblError.hide();
            }
            lblError.html('');
            return true;
        });
  $("form").on("change", "#add_img", function () {
            var allowedFiles = [".jpg", ".jpeg", ".png"];
            var fileUpload = $("#add_img");
            var lblError = $("#lblErroradd");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.val().toLowerCase())) {
                lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
                return false;
            }else{
              lblError.hide();
            }
            lblError.html('');
            return true;
        });
  $("form").on("change", "#profile_img", function () {
            var allowedFiles = [".jpg", ".jpeg", ".png"];
            var fileUpload = $("#profile_img");
            var lblError = $("#lblErrorprofile");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.val().toLowerCase())) {
                lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
                return false;
            }else{
              lblError.hide();
            }
            lblError.html('');
            return true;
        });
  $("form").on("change", "#resume_img", function () {
            var allowedFiles = [".doc", ".docx", ".pdf"];
            var fileUpload = $("#resume_img");
            var lblError = $("#lblErrorresume");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.val().toLowerCase())) {
                lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
                return false;
            }else{
              lblError.hide();
            }
            lblError.html('');
            return true;
        });
$(document).ready(function(){

});
</script>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
function myFunctionlin() {
    var x = document.getElementById("linblock");
     if (x.style.display === 'none')
     {
     x.style.display = 'block';
     }
}
// function myFunctionpan() {
//     var x = document.getElementById("panblock");
//      if (x.style.display === 'none')
//      {
//      x.style.display = 'block';
//      }
    
// }
function myFunctionadhar(txt) {
  var txt1  = txt;
  var n = txt1.length;
    if(n == 14)
    {  
    var x = document.getElementById("adharblock");
     if (x.style.display === 'none')
     {
     x.style.display = 'block';
     }
     else
     {
       x.style.display = 'none';
     }
   }    
 else
      {
        alert("Adhar Number not correct");
      }

}
function myFunctiongstn() {
    var x = document.getElementById("gstnblock");
     if (x.style.display === 'none')
     {
     x.style.display = 'block';
     }
    
}
</script>
 <script type="text/javascript">
$(document).ready(function(){
    var max_fields_limit = 5;
    var x =1;
    $('.add_more_button').on('click', function(e){
        e.preventDefault();
        if(x < max_fields_limit) {
            x++;
            $('.input_fields_container1').append('<br /><br /><br /><div class="col-sm-12"><div class="col-sm-2"></div><div class="col-sm-2"><input type="text" class="form-control" name="work_name[]" placeholder="Name" /></div><div class="col-sm-2"><input type="number" class="form-control datepicker" name="work_year[]" placeholder="Experience Year" /></div><div class="col-sm-2"><input type="text" class="form-control" name="work_position[]" placeholder="Division" /></div><div class="col-sm-1"><a href="#" class="remove_field btn btn-primary" style="margin-left:10px;">Remove</a></div></div>');
        }
    });

    $('.input_fields_container1').on('click','.remove_field', function(e){
        e.preventDefault(); 
        $(this).parent().parent('div').remove();
        $(this).parent().parent().find('br').remove();
        x--;
    });
});

</script>
<script type="text/javascript">
$(document).ready(function(){
    var max_fields_limit = 5;
    var x =1;
    $('.add_more_button1').on('click', function(e){
        e.preventDefault();
        if(x < max_fields_limit) {
            x++;
            $('.input_fields_container').append('<br /><br /><br /><div class="col-sm-12"><div class="col-sm-2"></div><div class="col-sm-2"><input type="text" class="form-control" name="degree_name[]" placeholder="Degree" /></div><div class="col-sm-2"><input type="number" class="form-control datepicker" name="degree_year[]" placeholder="Year" /></div><div class="col-sm-2"><input type="text" class="form-control" name="degree_reg_number[]" placeholder="Division" /></div><div class="col-sm-1"><a href="#" class="remove_field btn btn-primary" style="margin-left:10px;">Remove</a></div></div>');
        }
    });

    $('.input_fields_container').on('click','.remove_field', function(e){
        e.preventDefault(); 
        $(this).parent().parent('div').remove();
        $(this).parent().parent().find('br').remove();
        x--;
    });
});

</script>
<script type="text/javascript">
  $('[data-type="adhaar-number"]').keyup(function() {
  var value = $(this).val();
  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
  $(this).val(value);
});

$('[data-type="adhaar-number"]').on("change, blur", function() {
  var value = $(this).val();
  var maxLength = $(this).attr("maxLength");
  if (value.length != maxLength) {
    $(this).addClass("highlight-error");
  } else {
    $(this).removeClass("highlight-error");
  }
});
</script>
