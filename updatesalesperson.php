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
  <section class="content-header">
    <?php if($_GET['type'] == 'sp') { ?>
      <h1>Sales Person Update</h1>
    <?php } else if($_GET['type'] == 'dl') { ?>
      <h1>Dealer Update</h1>
    <?php } ?>
    
    <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
          <?php if($_GET['type'] == 'sp') { ?>
        <li class="active">Sales Person List</li>
      <?php } else if($_GET['type'] == 'dl') { ?>
        <li class="active">Dealer List</li>
      <?php } ?>

        </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <?php if($_GET['type'] == 'sp') { ?>
          <h3 class="box-title">Sales Person List</h3>
          <?php } else if($_GET['type'] == 'dl') { ?>
          <h3 class="box-title">Dealer List</h3>
        <?php } ?>
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
           
             <?php if(isset($_REQUEST['id'])) {
              $ids = $_REQUEST['id'];
              $sql = mysqli_query($conn, "SELECT * FROM users WHERE id='".$ids."'");
              $row = mysqli_fetch_assoc($sql);
              //print_r($row);die;
              $country = $row['country'];
              $state = $row['state'];
              
             }                    
              ?>
               
          <form action="locationupdate.php" method="POST" id="register" class="form-horizontal" enctype="multipart/form-data">

              
                <input type="hidden" name="userid" value="<?php echo $ids; ?>">
                <input type="hidden" name="pgtype" value="<?php echo $_GET['type'];?>">
                 <div class="row"><!--row-->


                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Country:</label>
                            <div class="col-sm-10">
                            <select name="country" id="country"> 
                                  <option value="">SELECT COUNTRY</option> 
                                   <?php $sql1 = mysqli_query($conn, "SELECT * FROM countries WHERE id ='".$country."'");
                                              $row1 = mysqli_fetch_assoc($sql1);
                                              
                                              $country_name = $row1['name'];
                                              $country_id = $row1['id']; ?>
                                       <option value="<?php echo $country_id;?>"> <?php echo $country_name;?> </option>
                                     
                            </select>
                            </div>
                        </div>
                    </div>
                       <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">State:</label>
                            <div class="col-sm-10">
                              <select id="state"  name="state">
                             <option value="">SELECT STATE</option>
                              <?php $sql2 = mysqli_query($conn, "SELECT * FROM states WHERE id ='".$state."'");
                                              $row2 = mysqli_fetch_assoc($sql2);
                                              $state_name = $row2['name'];
                                              $state_id = $row2['id']; ?>
                                <option value="<?php echo $state_id;?>"> <?php echo $state_name;?> </option>
                              </select>
                             
                            </div>
                        </div>
                    </div>
                    </div>
                 <div class="row"><!--row-->
                 
                   
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">City:</label>
                            <div class="col-sm-10">
                            <select id="city" name="city">
                              <option value="">SELECT CITY</option>
                            </select>
                            </div>
                        </div>
                    </div>

                
                  <?php 

                    if($_SESSION['userRole'] == 1)
                    {
                      $userID=$_GET['id'];
                      $userRole= getPrdNm('users',$userID,'id','user_role');
                      ?>
  
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="form-group">
                              <label class="control-label col-sm-2" for="email">USER ROLE:</label>
                              <div class="col-sm-10">
                                <select id="role" name="role">
                                  <?php
                                    $sql = "SELECT * FROM groups WHERE group_id !=1";
                                  $result = mysqli_query($conn, $sql);

                                  if (mysqli_num_rows($result) > 0) 
                                   {
                                      // output data of each row
                                      while($row = mysqli_fetch_assoc($result)) 
                                        {

                                          ?><option value="<?php echo $row['group_id'];?>" <?php if($userRole == $row['group_id']){echo 'selected';} ?>><?php echo $row['group_name'];?></option><?php
                                        }

                                    }    

                                 ?>
                                </select>
                              </div>
                          </div>
                        </div>
                        <?php
                      }
                  ?>

                </div><!--row-->
                
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10" id="registerForm">
                                <button type="submit" name="SPUpdate" class="btn btn-success pull-right">Submit</button>
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
                    // $('#state').html(html);
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