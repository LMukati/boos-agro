<?php
 session_start();
  include('layout/connect.php');
  //$val=$_GET['value'];
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


if(isset($_POST['NewRegister']))
  {
    $uploadfile4=$_FILES["addimage"]["tmp_name"];
    $folder="images/";

    if (empty($_FILES["addimage"]["name"])) {
        
     }else{
      $addimage=$_FILES["addimage"]["name"];
      $imgPath='images/'.$_FILES["addimage"]["name"];
      unlink($imgPath);
       move_uploaded_file($uploadfile4, "$folder".$_FILES["addimage"]["name"]);
        $sqlns = "UPDATE image SET log='".$addimage."' WHERE id='1'" ;
     
      if (mysqli_query($conn, $sqlns)) {
                $succ='Update Successfully..!';
            
        } else {
             $err='Not Update..!';
        } 
     }

       
  }
?>
  <style type="text/css">
    
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      LOGO IMAGE
      <!--   <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Logo Image</li>
      </ol>
    </section>
    <?php 
if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2')
    { ?>
    <!-- Main content -->
    <section class="content">
    <?php
    
      if(isset($succ))
      {
         ?>
        <div class="alert alert-success">
          <strong>Success!</strong><?php echo $succ;?>
        </div>
        <?php
      }

      if(isset($err))
      {
         ?>
        <div class="alert alert-danger">
          <strong>Error!</strong><?php echo $err;?>
        </div>
        <?php
      }
         
    
    ?>
    
      <!-- Small boxes (Stat box) -->
      <!-- Main row -->
    <div class="row">
       <div class="panel panel-default">
            <div class="panel-body">
            <?php
            $dd_res="SELECT * FROM `image` Limit 1";
            $image = mysqli_query($conn, $dd_res);
                  if (mysqli_num_rows($image) > 0)
                 {
                    $r=mysqli_fetch_assoc($image);
                     $imgName=$r['log'];
                  }
              
            ?>                    
                <form action="" method="POST" enctype="multipart/form-data" id="importFrm">
                
                      <label class="control-label" for="textarea">Upload Logo Image</label>
                              <input type="file" name="addimage"  class="btn btn-primary btn-sm file-image"/>
                                 <input type="hidden" name="add" value="<?php  echo $imgName;?>"><br>
                                  <button type="submit" name="NewRegister" class="btn btn-success">Submit</button><br>
                            <span class="material-input"></span>
                           
                             <?php
                            if(isset($imgName))
                            {
                              ?><br><?php if($imgName){ ?><img height="400px" width="400px" src="images/<?php  echo $imgName;?>"><?php }
                            }
                            ?>
                            
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