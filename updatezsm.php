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
  select
  {
    width:100%;
    height:35px;
    background-color: transparent;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       RSM 
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
       
        <li class="active">Update State</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">RSM</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <div class=" ">
            <h2>ASM Update</h2>
             <?php if(isset($_REQUEST['id'])) {
              $ids = $_REQUEST['id'];
            
             }                    
              ?>
           <form action="locationupdate.php" method="POST" id="register" class="form-horizontal" enctype="multipart/form-data">

              
                <input type="hidden" name="userid" value="<?php echo $ids; ?>">
                 <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Country:</label>
                            <div class="col-sm-10">
                            <select name="country" id="country"> 
                                  <option value="">SELECT COUNTRY</option> 
                                   <?php
                                    $dd_res="SELECT * FROM countries";
                                     $country = mysqli_query($conn, $dd_res);
                                      if (mysqli_num_rows($country) > 0)
                                     {
                                       while($r=mysqli_fetch_assoc($country))
                                           { ?>
                                       <option value="<?php echo $r['id'];?>"> <?php echo $r['name'];?> </option>
                                       <?php } }
                                    ?>
                            </select>
                            </div>
                        </div>
                    </div>
                       <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">State:</label>
                            <div class="col-sm-10">
                              <select id="state" name="state[]" multiple>
                             <option value="">SELECT COUNTRY LIST</option>
                              </select>
                             
                            </div>
                        </div>
                    </div>
                    </div>
                
              <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10" id="registerForm">
                                <button type="submit" name="ZSMUpdate" class="btn btn-success pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
               
                  
            

            </form>
        </div>
 
        </div>
        <!-- /.box-body -->
       
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
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
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
 
 <?php include('layout/footer1.php');?>