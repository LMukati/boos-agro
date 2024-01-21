
<?php
//  session_start();?>
<?php
 
  include('layout/connect.php');
  include('layout/header.php');
?>
 <script src="email-validation.js"></script>
<style>

body{
  /*background: rgb(204,204,204)*/
}
.form-inline .form-control
{
    width:99%;
}
strong
{
	color:#fff;	
}
.boss-form-container .form-margin label
{
	color:#fff !important;
}
p
{
	color:#fff;
}
page {
    background: rgba(0, 0, 0, 0.5);
  display: block;
  margin: 160px auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
  padding:5px;
  border-radius:8px;
}
page[size="A4"]{
  max-width:210mm;
  height: 128mm; 
  width:100%;
}
.boss-form-container .form-type-heading{
  border-bottom:solid 2px #d3d3d3;
}
.boss-form-container .form-heading{
  border-bottom:solid 2px #d3d3d3;
}
.boss-form-container h3{
  color:#fff;
  font-weight:bold;
}
.boss-form-container h4{
  color:#fff;
  font-weight:bold;
}

.boss-form-container .form-margin{
  margin-top:20px;
}
.boss-form-container .form-margin select{
  width:99%;
}
.boss-form-container .form-margin button{
  width:15%;
  font-weight:bold;
}
.boss-form-container .form-margin label{
  color:#276268;
}
@media only screen and (max-width:767px){
  page[size="A4"]{
    height:178mm; 
  }
  .boss-form-container .form-margin select{
    width:100%;
  }
}

@media only screen and (max-width:500px){
  .boss-form-container .form-margin button{
    width:40%;
  }
}
@media only screen and (max-width:380px){
  page[size="A4"]{
    height:185mm; 
  }
}
</style>


  <!-- Content Wrapper. Contains page content -->
   <div class="container boss-form-container"><!--container-->
    <div  class="row">
      <page size="A4">
       
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center form-heading">
          <h3>DEALER CREATION FORM</h3>
          <h4>Basic Details:</h4>
        </div>

    <form action="newregister.php" method="POST" id="regiration_form" class="form-horizontal" enctype="multipart/form-data">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:20px;display:none;">
          <p style="color:#276268;"><strong>User Name: <span style="color:#34a856;">
		  <p id="username" style="margin-top:40px;"></p></span></strong></p>
          <input type="hidden" name="hname" id="username_value">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-margin text-center">
          <div class="form-group form-inline">
            <label for="usr" class="pull-left">Full Name of the Firm:</label>
              <input type="text" placeholder="Firm name" name="firm_name" style="text-transform: capitalize;" class="form-control pull-right"  value="" required>
            <input type="hidden" placeholder="Full name" style="text-transform: capitalize;" class="form-control pull-right" id="hname" value="" onblur="get_username();" required>
            <span class="material-input"></span>
     </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-margin text-center">
           <div class="form-group form-inline">
            <label  for="email" class="pull-left">Email:</label>
            <input type="email" placeholder="Your@domain.com"  name="hemail" id="hemail" class="form-control pull-right" onblur="ValidateEmail(document.form1.hemail);">
            <span class="material-input"></span>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-margin text-center">
           <div class="form-group form-inline">
            <label  for="mobileNumber" class="pull-left">Phone/Mobile No.:</label>
            <input type="text" placeholder="Mobile No." class="form-control pull-right" name="phone" id="phone" max="10" required>
            <input type="hidden" name="dlr" >
            <span class="material-input"></span>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-margin text-center">
          <div class="form-group form-inline">
            <label for="roll" class="pull-left">Role:</label>
            <select class="form-control pull-right" name="role" id="role" readonly>
             <?php   
              // $sql = "SELECT *  FROM groups WHERE group_id='8'";
              //                  $result = mysqli_query($conn, $sql);
              //                    if (mysqli_num_rows($result) > 0)
              //                        {
              //                         while($row = mysqli_fetch_assoc($result)) 
              //                        {
              //                           $role_name =$row["group_name"];
              //                           $role_id =$row["group_id"];
                                  if(isset($_GET['type']) && $_GET['type'] == 'dl'){
                                    ?>
                                    <option value="8"> <?php echo 'Dealer/Distributor' ;?> </option> 
                             <?php  }else { ?>

                                       <option value="8"> <?php echo 'Dealer/Distributor' ;?> </option> 
                            <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-margin text-center">
           <div class="form-group form-inline">
             <button type="submit" name="NewRegister" class="btn btn-success" style="margin-right:5px;">Submit</button>
              <a href="index.php" class="btn btn-default">Login</a>
          </div>
        </div>
       </form>
      </page>
    </div>
  </div><!--container-->
  <?php include('layout/footer.php');?>

<script type="text/javascript">
function ValidateEmail(inputText)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat))
{
document.form1.text1.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.form1.text1.focus();
return false;
}
}
function get_username()
{

 var name=$("#hname").val();

 if(name!="")
 {
  $.ajax
  ({
   type:'post',
   url:'do_signup.php',
   data:{
    get_username:name
   },
   success:function(response) 
   {
    $("#username").css({"display":"block"});
    $("#username").html("UserName : "+response);
    $("#username_value").val(response);
   }
  });
 }
}
</script>

 