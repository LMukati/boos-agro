<?php session_start();
  include('layout/connect.php');
 if(!isset($_SESSION['userId']))
    {
      header("Location:index.php");
        exit();
    }
include('layout/header1.php'); ?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->



<link rel="stylesheet" href="css/bootstrap-select.css"> 
<style>
    @import url(https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css);
</style>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>		


<section class="content" style="min-height: auto;"> 
 <div class="row">
     <div class="col-md-4">
         <?php  $allnot = mysqli_query($conn,"select * from notification where user_role IN ('".$_SESSION['userRole']."','9') order by id desc"); ?>
            <div class="box" style="margin-top: 0px;background:#0027ff;">
                <div class="box-header with-border">
                    <h3 class="box-title" style="color:#fff">Boss Notification</h3>
                </div>
                <div class="box-body main_div">
                    <div class="col-lg-12 col-md-12 col-sm-12" >
                        <?php while($shownoti = mysqli_fetch_array($allnot)){ ?>
                            <div class="alert alert-success" role="alert" style="    background-color: #03a9f4 !important;">
                              <h4 class="alert-heading"><?php echo $shownoti["subject"] ?></h4>
                              <p><?php echo $shownoti["message"] ?></p>
                            </div>
                        <?php } ?>       
                    </div>
                </div>
            </div>
     </div>
     
     
     <div class="col-md-4">
        <?php $allnot = mysqli_query($conn,"select * from notification where user_role IN ('".$_SESSION['userRole']."','10') order by id desc"); ?>
            <div class="box" style="margin-top: 0px;background:#ffeb3b;">
                <div class="box-header with-border">
                    <h3 class="box-title">Office Notification</h3>
                </div>
                <div class="box-body main_div">
                    <div class="col-lg-12 col-md-12 col-sm-12" >
                        <?php while($shownoti = mysqli_fetch_array($allnot)){ ?>
                            <div class="alert alert-success" role="alert" style="    background-color: #ffc107 !important;">
                              <h4 class="alert-heading"><?php echo $shownoti["subject"] ?></h4>
                              <p><?php echo $shownoti["message"] ?></p>
                            </div>
                        <?php } ?>       
                    </div>
                </div>
            </div>
     </div>
     
     
     <div class="col-md-4">
        <?php  $allnot = mysqli_query($conn,"select * from notification where user_role IN ('".$_SESSION['userRole']."','0') order by id desc"); ?>
            <div class="box" style="margin-top: 0px;background: #ff9800;">
                <div class="box-header with-border">
                    <h3 class="box-title">User Notification</h3>
                </div>
                <div class="box-body main_div">
                    <div class="col-lg-12 col-md-12 col-sm-12" >
                        <?php while($shownoti = mysqli_fetch_array($allnot)){ ?>
                            <div class="alert alert-success" role="alert" style="background:#b36b00 !important">
                              <h4 class="alert-heading"><?php echo $shownoti["subject"] ?></h4>
                              <p><?php echo $shownoti["message"] ?></p>
                            </div>
                        <?php } ?>       
                    </div>
                </div>
            </div>
     </div>
     
     
 </div>

</section> 



    <!-- Main content -->
   
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php include('layout/footer1.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>

<script>
    $(function () {
  $("select").select2();
});
</script>
