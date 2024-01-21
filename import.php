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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#Check_type').on('change', function(){
            //alert($('#Check_type').val());
            if($('#Check_type').val() == '2'){
                $('.rawmaterial').show();
                $('.product').hide();
            }else if($('#Check_type').val() == '1'){
                $('.rawmaterial').hide();
                $('.product').show();
            }else{
                $('.rawmaterial').hide();
                $('.product').hide();
            }
        });
    });
    
    </script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Product Export
      <!--   <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Import</li>
      </ol>
    </section>
    <?php 
              if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' )
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
      <div class="box" >
          <div class="box-header with-border">
		        <h3 class="box-title"><center>Select Product Type</center></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
             </div>
            <div class="box-body main_div">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Product Type:</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="type" id="Check_type" required <?php //if($_SESSION['userRole']=='1') { echo "disabled";} ?>>
                                    <option value="">Select Type</option>
                                    <option value="1">Finished goods</option>
                                    <option value="2" <?php //if($_SESSION['userRole']=='1') { echo "selected";} ?>>Raw Material</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        <?php //if(isset($_GET['p']) && $_GET['p'] == "product") { ?>
        <div class="box product" style="display:none;">
            <div class="box-header with-border">
                 <h3 class="box-title"><center>Excel Format Product</center></h3>
            </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Name</th>
                                <th>Technicale Name</th>
                                <th>Batch Code</th>
                                <th>Manufacturing Date</th>
                                <th>Expiry Date</th>
                                <th>Gst</th>
                                <th>Product Price</th>
                                <th>Product Image Name</th>
                                <th>HSN Code</th>
                                <th>Unit</th>
                                <th>Packaging</th>
                                <th>Product Discription</th>
                            </tr>
                        <thead>
                    </table>
                    </div>
                </div>
        </div>
    <div class="box product" style="display:none;">

     <div class="box-header with-border">
		        <h3 class="box-title"><center>Import Product</center></h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
             </div>
       <div class="panel panel-default">
            <div class="panel-body">
                <form action="importData.php" method="POST" enctype="multipart/form-data" id="importFrm">
                <input type="hidden" name="type" value='2'>
                    <input type="file" name="file" /><br/>

                    <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                     <!-- <p style="color:green"><img src="images/csv.png">Upload CSV File</p> -->
                </form>
            </div>
        </div>
    </div>
    
    <?php //}   else { ?>
     
   
    <div class="box rawmaterial" style="display:none;">
        <div class="box-header with-border">
            <h3 class="box-title"><center>Excel Format Raw Material</center></h3>
        </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th>Name</th>
                                            <th>Raw Quantity</th>
                                            <th>Raw Unit</th>
                                            <th>Price</th>
                                        </tr>
                                    <thead>
                    </table>
                </div>
            </div>
               
    
   
            </div>
            <div class="box rawmaterial" style="display:none;">
        <div class="box-header with-border">
            <h3 class="box-title"><center>Import Material</center></h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fa fa-minus"></i></button>
                </div>
        </div>
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
<?php } //} ?>
    </section>

    <!-- /.content -->
    
 
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- <input type="text" data-type="adhaar-number" maxLength="19"> -->
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