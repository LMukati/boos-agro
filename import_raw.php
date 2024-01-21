<?php
 session_start();
  include('layout/connect.php');
  $val=$_GET['value'];
 if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
include('layout/header1.php');
 $sql = ("SELECT COUNT(*) FROM users WHERE user_role ='3'");
$rs = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($rs);
 $zsm= $result[0];
$sql1 = ("SELECT COUNT(*) FROM users WHERE user_role ='4'");
$rs1 = mysqli_query($conn,$sql1);
$result1 = mysqli_fetch_array($rs1);
 $rsm= $result1[0];
 $sql2 = ("SELECT COUNT(*) FROM users WHERE user_role ='5'");
$rs2 = mysqli_query($conn,$sql2);
$result2 = mysqli_fetch_array($rs2);
 $asm= $result2[0];
$sql3 = ("SELECT COUNT(*) FROM users WHERE user_role ='6'");
$rs3 = mysqli_query($conn,$sql3);
$result3 = mysqli_fetch_array($rs3);
 $dealer= $result3[0];

?>
  <style type="text/css">
    
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Raw Material Import
      <!--   <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Raw Material Import</li>
      </ol>
    </section>
    <?php 
if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' || $_SESSION['userRole']=='3')
    { ?>
    <!-- Main content -->
    <section class="content">
    <?php
    if(isset($val))
    {
      if($val=='succ')
      {
          ?>
        <div class="alert alert-success">
          <strong>Success!</strong> Import
        </div>
        <?php
      }
        

        if($val=='err')
      {
        ?>
        <div class="alert alert-danger">
          <strong>Errror!</strong> Import
        </div>
        <?php
      }
        
    }
    ?>
    
      <!-- Small boxes (Stat box) -->
      <!-- Main row -->
    <div class="row">Raw Material Import
       <div class="panel panel-default">
            <div class="panel-body">
                <form action="importData.php" method="POST" enctype="multipart/form-data" id="importFrm">
                <input type="hidden" name="type" value='1'>
                    <input type="file" name="file" /><br/>

                    <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                     <!-- <p style="color:green"><img src="images/csv.png">Upload CSV File</p> -->
                </form>
            </div>
        </div>
    </div>
      
    </section>

    <!-- /.content -->
    <?php } ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- <input type="text" data-type="adhaar-number" maxLength="19"> -->
  </div>
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
 <?php include('layout/footer1.php'); ?>