<?php 
session_start();
include('layout/connect.php');



if(isset($_SESSION['userId']))
  {
    //echo $_SESSION['userId'];die;
     header("Location:dashboard.php");
     exit();
  }
  else{
    //echo "";die;
    // header("Location:index.php");
  }
  include('layout/header.php'); ?>
  <script type="text/javascript">
   function showforget()
{

  var x = document.getElementById("forgetpass");
     if (x.style.display === 'none')
     {
     x.style.display = 'block';
     }
     else {
        x.style.display = "none";
    }
}

</script>
<style>
.input['type=text'], input['type=password'], input['type=email'] {
    width: 100%;
    padding: 20px;
    margin: 5px 0 0 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}
.form-control-feedback
{
    top:8px;
}
.ligindata{
background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

</style>
  

<?php
            $dd_res="SELECT * FROM `image` Limit 1";
            $image = mysqli_query($conn, $dd_res);
                  if (mysqli_num_rows($image) > 0)
                 {
                    $r=mysqli_fetch_assoc($image);
                     $logo=$r['log'];
                  }
              
            ?>   
<div class="row"><div class="form-group is-empty col-md-6 btn btn-primary" style="float:left;width:200px;color:#fff !important"><img src="<?php echo BASE_URL; ?>uploads/register.gif" style="width:30px;"><a href="dlregister.php" class="text-center" style="color:#fff;">Register a new Dealer</a></div>
<div class="form-group is-empty col-md-6 btn btn-primary"style="float:right;width:200px;color:#fff !important"><img src="<?php echo BASE_URL; ?>uploads/register.gif" style="width:30px;"><a href="empregister.php" class="text-center" style="color:#fff !important;">Register Employee</a></div></div>
<div class="login-box">
    <div class="login-logo">
         <img src="<?php echo BASE_URL; ?>images/<?php echo $logo;?>" class="user-image" alt="User Image">
    </div><!-- /.login-logo -->
    <div class="login-box-body" style="background-color:transparent !important;margin-top:120px">
<?php
if (@$_GET['registered'] == 'true') { ?>
   <div class="alert alert-success">
  <strong>Successfully Register!</strong> verify to your email.
</div>
<?php } 

if (@$_GET['passchange'] == 'true') { ?>
   <div class="alert alert-success">
  <strong>Successfully Update Password Check Your Email</strong> Check your email.
</div>
<?php }
if (@$_GET['passchange'] == 'err') { ?>
   <div class="alert alert-danger">
  <strong>Select Your Valid Email Address </strong>
</div>
<?php }
if (@$_GET['err'] == 'err') { ?>
   <div class="alert alert-danger">
  <strong>Select Your Valid Email Address And Password </strong>
</div>
<?php } ?>

        <p class="login-box-msg" style="color:yellow;font-size:20px;">Login Boss Agro</p>
          <form action="login.php" method="POST">
               <input type="text" name="name" class="form-control" placeholder="Email" required="" />   
                           <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span><font color="red"></font></span>
       
        <div class="form-group has-feedback">
          <input type="password"  name="pass" class="form-control" placeholder="Password" required="" />
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span><font color="red"></font></span>
        </div>
                <div class="row">
                  <div class="col-xs-3">
                  </div>
            
            <div class="col-xs-6">
                  <input class="btn btn-primary submit ligindata" type="submit" name="submit" value="Login in">
                             </div><!-- /.col -->
        </div><div class="col-xs-3">
                  </div>
        </form>   
           <p style="padding-top:10px;text-align:center;"><a href="#" onclick="showforget();"class="btn btn-danger">Forget Password</a></p>
            <div class="form-group has-feedback" id="forgetpass" style="display:none;">
         
         <form method="post" action="send_link.php">
     <div class="form-group is-empty col-md-9">
      <input type="email" class="form-control" name="email"  placeholder="Enter Your Valid Email" required>
      </div>
      <div class="form-group is-empty col-md-1">
      <input type="submit" class="btn btn-primary cancelbtn submit" name="submit" value="Reset"></div>
    </form>
    </div>
       
          <!-- <div><h3 style="text-align: center;"><img src="<?php echo BASE_URL; ?>uploads/register.gif" style="width:80px;"></h3></div>   -->
          <!--<div class="row"><div class="form-group is-empty col-md-6"><a href="dlregister.php" class="text-center">Register a new Dealer</a></div><div class="form-group is-empty col-md-6"><a href="empregister.php" class="text-center" style="color:#000;">Register Employee</a></div></div> -->
         
                    
<?php //echo BASE_URL; ?>
            </div><!-- /.login-box-body -->


</div>

<script>
// setTimeout(function()
// {
//  window.location.href="index.php"},50000);
</script>
<?php 
include('layout/footer.php'); ?>
