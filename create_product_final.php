<?php
include('layout/connect.php');
session_start();
if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
    include('layout/header1.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <style type="text/css">
    body{
       /* background:url('../images/Boss Agro.jpg'); */
        background-repeat:no-repeat;
       /* background-size:100% 100%;*/
       background-size:cover;
        background-attachment:fixed;
        background-color: cadetblue;
    }
    .error{
        display: none;
        margin-left: 10px;
    }       
    .error_show{
        color: red;
        margin-left: 10px;
    }
    input.invalid {
        border: 2px solid red;
    }
    input.valid {
        border: 2px solid green;
    }
    .Boss-registration-form label{
        /*color:#edfcfd;*/
        color:#ffffff;
        font-family:'Montserrat', sans-serif;
    }
    .Boss-registration-form button{
        /*background-color:#edfcfd;*/
        width:150px;
        font-family:'Montserrat', sans-serif;
        font-weight:bold;
        /*color:#17525a;*/
        background-color:#f9d8b2;
        color:#292929;
    }
    .Boss-registration-form h2{
        text-align:center; 
        /*color:#edfcfd;*/
        color:#ffffff;
        font-family:'Montserrat', sans-serif;
        margin-bottom:80px;
        margin-top:30px;
        font-weight:bold;
    }
   
    .Boss-registration-form span.group-span-filestyle.input-group-btn{
        width: 26%;
    }
    .Boss-registration-form input.file-input{
        margin-left: 16px;
    }
    .Boss-registration-form .img-file-label{
        background-color:#17525a ;
        color:#edfcfd;
    }
    .Boss-registration-form .group-span-filestyle span{
        color:#ffffff;
    }
    .Boss-registration-form .img-file-input{
        background-color:#fff;
    }
    @media only screen and (max-width: 500px){
        .Boss-registration-form .street-2{
            margin-top:35px;
        }
    }
    @media only screen and (max-width: 1024px) and (min-width: 1024px){
        .Boss-registration-form span.group-span-filestyle.input-group-btn{
            width:32%;
        }
    }
    @media only screen and (max-width: 1023px) and (min-width: 768px){
        .Boss-registration-form span.group-span-filestyle.input-group-btn {
            width: 44%;
        }
    }
    .multiselect-container label {
        color: black;
    }
    </style>
    <script>
    $(document).ready(function() {
        $('#Check_type').on('change', function(){
            //alert($('#Check_type').val());
            if($('#Check_type').val() == '2'){
                $('#rawmaterial').show();
                $('#product').hide();
            }else if($('#Check_type').val() == '1'){
                $('#rawmaterial').hide();
                $('#product').show();
            }else{
                $('#rawmaterial').hide();
                $('#product').hide();
            }
        });
    });
    
    </script>
  <div class="content-wrapper" >
    <!-- Main content -->
    <section class="content">
        
    <?php if(isset($_GET['product_id']) && $_GET['product_id'] !=''){ }else{ ?>     
    <div class="box" style="margin:0px;">
        <div class="box-header with-border">
          <h3 class="box-title"><center>Select Product Type</center></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body main_div">
            <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Product Type:</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="type" id="Check_type" required>
                                    <option value="">Select Type</option>
                                    <option value="1">Finished goods</option>
                                    <!-- <option value="2">Raw Material</option> -->
                                                                          
                            </select>
                              
                            </div>
                        </div>
                    </div>
            </div>   
        </div> 
      </div>
    <?php } ?>  
      
      <?php if(isset($_GET['product_id']) && $_GET['product_id'] !=''){ ?> 
        <div class="box" id="product" style="margin:20px 0px">
        <div class="box-header with-border">
          <h3 class="box-title"><center>Edit Product</center></h3>
            
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          
              <i class="fa fa-times"></i></button>
          </div>
        </div>
            
       <form action="make_product.php" method="POST" id="register" class="form-horizontal" enctype="multipart/form-data">
       <?php
        $id=$_GET['product_id'];
        //print_r("SELECT * FROM raw_material WHERE id = ".$id."");die;
        $sql1 = mysqli_query($conn, "SELECT * FROM product WHERE id = ".$id."");
       //print_r($sql1);die;
       //$i=1;
        
        if(mysqli_num_rows($sql1) > 0) {
            while($row = mysqli_fetch_assoc($sql1)) { 
                //print_r($row);

                ?>
      
      <div class="box-body main_div">
                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Product Name:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name'];?>" required>
                             <input type="hidden" class="form-control" name="product_id" value="<?php echo $row['id'];?>" required>
                              
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2">Product Image:</label>-->
                    <!--        <div class="col-sm-8">-->
                    <!--          <input type="file" class="form-control"  name="pro_image" >-->
                    <!--          <input type="hidden" class="form-control" value="<?php echo $row['product_img']; ?>" name="pro_image1" required>-->
                    <!--        </div>-->
                    <!--        <div class="col-sm-2">-->
                    <!--            <img src="<?php echo $row['product_img']; ?>" style="width: 50px;height: 50px;border-radius: 10px;border: 1px solid #eee;">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" for="email">Product Code:</label>-->
                    <!--        <div class="col-sm-10">-->
                    <!--        <input type="number" class="form-control" name="product_code"  value="<?php echo $row['product_code'];?>" required>-->
                              
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div><!--row-->

                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Technical Name:</label>
                            <div class="col-sm-10"> 
                            <input type="text" class="form-control" name="p_technical_name" value="<?php echo $row['p_technical_name'];?>" required>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">HSN Code:</label>
                            <div class="col-sm-10" id="locationField">
                            <input type="text" class="form-control" name="hsn" value="<?php echo $row['hsn_code'];?>"  required>
                            </div>
                        </div>
                    </div>
                    
                    
                </div><!--row-->

                <div class="row"><!--row-->
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" for="pwd">Batch Code:</label>-->
                    <!--        <div class="col-sm-10">-->
                    <!--        <input type="text" class="form-control" name="batch_code" value="<?php echo $row['batch_code'];?>"  required>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                   
                </div><!--row-->

                <div class="row"><!--row-->
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" for="pwd">Manufacturing Date</label>-->
                    <!--        <div class="col-sm-10">-->
                    <!--        <input type="date" class="form-control" name="manufacturing_date" value="<?php echo $row['manufacturing_dt'];?>"  required>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" for="pwd">Expiry Date :</label>-->
                    <!--        <div class="col-sm-10"> -->
                    <!--        <input type="date" class="form-control" name="expiry_date" value="<?php echo $row['expiry_dt'];?>"  required>-->
                             
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div><!--row-->

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">GST Percentage:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="gst" value="<?php echo $row['gst'];?>" required>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" >Packaging:</label>-->
                    <!--        <div class="col-sm-10"> -->
                    <!--        <select class="form-control" name="packaging" required>-->
                    <!--             <option  <?php if($row["packaging"] == "Box") echo "selected"; ?> value="Box">Box</option>-->
                    <!--             <option <?php if($row["packaging"] == "Carton") echo "selected"; ?> value="Carton">Carton</option>-->
                    <!--             <option <?php if($row["packaging"] == "Bag") echo "selected"; ?> value="Bag">Bag</option>    -->
                    <!--         </select>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div><!--row-->

                <div class="row">    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="control-label col-sm-1">Discription:</label>
                            <div class="col-sm-11"> 
                              <textarea type="text" class="form-control" name="discription" required><?php echo $row['pro_discription'];?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label>Per Item Price :</label>
                    </div>
                </div>

                <?php   
                    $pprice = mysqli_query($conn, "SELECT * FROM `product_price` WHERE product_id = '".$row["id"]."'");
                    while($prorice = mysqli_fetch_array($pprice))
                    {
                ?>    
                 <div class="row"><!--row-->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group" style="background: #eee;padding-top: 10px;">
                            <div class="col-sm-6"> <input type="text"  class="form-control" name="unit[]"  value="<?php echo $prorice['unit'] ?>" placeholder="Enter Unit no. "> </div>
                            <div class="col-sm-6">
                                <select class="form-control" name="unit_type[]" required>
                                         <option value="">Select Unit Type</option>
                                         <option value="Kg" <?php if($prorice['unit_type'] == "Kg"){ echo 'selected'; } ?>>Kg</option>
                                         <option value="Litter" <?php if($prorice['unit_type'] == "Litter"){ echo 'selected'; } ?>>Litter</option>
                                         <option value="Gram" <?php if($prorice['unit_type'] == "Gram"){ echo 'selected'; } ?>>Gram</option>
                                         <option value="Mili Liter" <?php if($prorice['unit_type'] == "Mili Liter"){ echo 'selected'; } ?>>Mili Liter</option>
                                         <option value="Packate"  >Packate</option>
                                         <option value="Pisces" <?php if($prorice['unit_type'] == "Pisces"){ echo 'selected'; } ?>>Pisces</option>
                                         
                                </select>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="product_price[]" placeholder="MRP" value="<?php echo $prorice['regular_price'] ?>" required>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="product_price1[]" placeholder="Dealer Price" value="<?php echo $prorice['dealer_price'] ?>"  required>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="mfg_date[]" placeholder="Manufacturing Date" type="date" value="<?php echo $prorice['mfgdate'] ?>"  required>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="exp_date[]" placeholder="Expiry Date" type="date" value="<?php echo $prorice['expdate'] ?>"  required>
                            </div>
                            
                            <!--<div class="col-sm-6"> -->
                            <!--<input class="form-control" name="batchcode[]" placeholder="Batch Code" value="<?php echo $prorice['batchcode'] ?>"  required>-->
                            <!--</div>-->
                            
                            <div class="col-sm-6"> 
                            <input type="file" class="form-control" name="variactionimage[]" placeholder="Image">
                            <input type="hidden" name="oldvarimage[]" value="<?php echo $prorice['image'] ?>">
                            </div>
                             <div class="col-sm-6">
                            <input type="text" class="form-control" name="opningqty[]" placeholder="Opening Qty"  required>
                            <input type="hidden" name="opningqty[]" value="<?php echo $prorice['opningqty'] ?>">
                         </div>
                            
                            <div class="col-sm-6">
                                <a href="make_product.php?pricedanger=<?php echo $prorice['id'] ?>&ppid=<?php echo $row['id'] ?>" class="col-sm-2 btn btn-danger" onclick="return confirm('Are you sure to delete ?')">X</a>
                            </div>
                            
                        </div>
                    </div>
                    
                </div><!--row-->
               
                <?php } ?>
                
              <div class="clearfix"></div>
              
              <div id="moreprice">
                  
              </div>    
              
              <div class="clearfix"></div>    
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                          <div class="col-sm-12">
                          <buttton type="button" name="Add More Price" class="btn btn-success pull-right" onclick="addmoreprice()">Add More Price</buttton>
                          </div>
                      </div>
                  </div>
              </div> 
                

               <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10 " id="dynamic_field1">
                             
                                <!-- <button type="button" name="addopt" id="addopt" class="btn btn-success">Add More Field</button> -->
                                  <?php
                                  $i=1;
                                  $sql12=mysqli_query($conn, "SELECT * FROM optional_product_fields WHERE product_id = '".$row['id']."'");
                                   while($row1 = mysqli_fetch_assoc($sql12)) { 
                                  ?>
                               <table> 
                            
                               <tr id="row<?php echo $i; ?>" class="dynamic-added">
                                    <td> Name:</td>
                                    <td><input type="text" name="node[]" value="<?php echo $row1['keys']; ?>" class="form-control name_list" required />
                                    </td>
                               </tr>
                               <tr id="row<?php echo $i; ?>" class="dynamic-added">
                                    <td> value:</td>
                                    <td><input type="text" name="node1[]" value="<?php echo $row1['value']; ?>" class="form-control name_list" required />
                                    </td>
                                    <input type="hidden" name="node_id[]" value="<?php echo $row1['id']; ?>" class="form-control name_list" required />
                                  <!-- <td>
                                   <button type="button" name="remove" id="<?php //echo $i; ?>" class="btn btn-danger btn_remove">X</button>
                                </td> -->
                            </tr>
                              
                                 </table>
                                  <?php $i++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
               
               
                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10" >
                                <input type="submit" class="btn btn-default pull-right" name="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </div><!--row-->


            </form>
        </div>
      </div>
      <?php } } }else{ ?>
	  
	  
      <div class="box" id="product" style="display:none;">
        <div class="box-header with-border">
          <h3 class="box-title"><center>Create Product</center></h3>
            
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
            
        <form action="make_product.php" method="POST" id="register" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body main_div">
                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Product Name:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" required>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Technical Name:</label>
                            <div class="col-sm-10"> 
                            <input type="text" class="form-control" name="p_technical_name" required>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" for="email">Product Image:</label>-->
                    <!--        <div class="col-sm-10">-->
                    <!--        <input type="file" class="form-control" name="product_image" value="" required>-->
                            
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                </div><!--row-->

               
                <div class="row"><!--row-->
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" for="pwd">Batch Code:</label>-->
                    <!--        <div class="col-sm-10">-->
                    <!--        <input type="text" class="form-control" name="batch_code" required>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label class="control-label col-sm-2" for="email">Product Code:</label>-->
                    <!--        <div class="col-sm-10">
                            
                            <input type="number" class="form-control" name="product_code" value="<?php  //echo $serial; ?>" required>
                              
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">HSN Code:</label>
                            <div class="col-sm-10" id="locationField">
                            <input type="text" class="form-control" name="hsn" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">GST Percentage:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="gst" required>
                            </div>
                        </div>
                    </div>
                </div><!--row-->

                <!--<div class="row"><!--row-->
                <!--    <div class="col-lg-6 col-md-6 col-sm-6">-->
                <!--        <div class="form-group">-->
                <!--            <label class="control-label col-sm-2" for="pwd">Manufacturing Date</label>-->
                <!--            <div class="col-sm-10">-->
                <!--            <input type="date" class="form-control" name="manufacturing_date" required>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-lg-6 col-md-6 col-sm-6">-->
                <!--        <div class="form-group">-->
                <!--            <label class="control-label col-sm-2" for="pwd">Expiry Date :</label>-->
                <!--            <div class="col-sm-10"> -->
                <!--            <input type="date" class="form-control" name="expiry_date" required>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div><!--row-->

                <div class="row">
                    
                    
                    <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                    <!--    <div class="form-group">-->
                    
                    <!--        <label class="control-label col-sm-2" >Packaging:</label>-->
                    <!--        <div class="col-sm-10"> -->
                    <!--        <select class="form-control" name="packaging" required>-->
                    <!--                <option value="Box">Box</option>-->
                    <!--                <option value="Carton">Carton</option>-->
                    <!--                <option value="Bag">Bag</option>-->
                    <!--        </select>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div><!--row-->

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="control-label col-sm-1">Discription:</label>
                            <div class="col-sm-11"> 
                              <textarea type="text" class="form-control" name="discription" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label>Per Item Price :</label>
                    </div>
                </div>
                
                <div class="row" style="background: #eeeeee;padding-top: 15px;"><!--row-->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-6"> <input type="text"  class="form-control" name="unit[]" placeholder="Enter Unit no. "> </div>
                            
                            <div class="col-sm-6">
                                <select class="form-control" name="unit_type[]" required>
                                         <option value="">Select Unit Type</option>
                                         <option value="Kg">Kg</option>
                                         <option value="Litter">Litter</option>
                                         <option value="Gram">Gram</option>
                                         <option value="Mili Liter">ML</option>
                                         <option value="Packate">Packate</option>
                                         <option value="Pisces">Pisces</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="product_price[]" placeholder="MRP"  required>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="product_price1[]" placeholder="Dealer Price"  required>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="mfg_date[]" placeholder="Manufacturing Date" type="date"  required>
                            </div>
                            
                            <div class="col-sm-6"> 
                            <input class="form-control" name="exp_date[]" placeholder="Expiry Date" type="date" required>
                            </div>
                            
                            <!--<div class="col-sm-6"> -->
                            <!--<input class="form-control" name="batchcode[]" placeholder="Batch Code"  required>-->
                            <!--</div>-->
                            
                            <div class="col-sm-6"> 
                            <input type="file" class="form-control" name="variactionimage[]" placeholder="Image"  required>
                            </div>
                             <div class="col-sm-6"> 
                            <input type="text" class="form-control" name="opningqty[]" placeholder="Opening Qty"  required>
                          </div>
                        </div>
                    </div>
                    
                </div><!--row-->
                
              <div class="clearfix"></div>
              
              <div id="moreprice">
                  
              </div>    
              
              <div class="clearfix"></div>    
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                          <div class="col-sm-12" style="margin-top:10px;">
                          <buttton type="button" name="Add More Price" class="btn btn-success pull-right" onclick="addmoreprice()">Add More Price</buttton>
                          </div>
                      </div>
                  </div>
              </div>    

               <!--<div class="row">-->
               <!--     <div class="col-lg-6 col-md-6 col-sm-6">-->
               <!--         <div class="form-group"> -->
               <!--             <div class="col-sm-offset-2 col-sm-10 " id="dynamic_field1">-->
               <!--                 <button type="button" name="addopt" id="addopt" class="btn btn-success">Add Extra Field</button>  -->
               <!--             </div>-->
               <!--         </div>-->
               <!--     </div>-->
               <!-- </div>-->
               
               
                <div class="row"><!--row-->
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10" >
                                <input type="submit" class="btn btn-default pull-right" name="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </div><!--row-->


            </form>
        </div>
      </div>
      <?php } ?>
      <!-- /.box -->

<style>
    .form-group .col-sm-6 {
    margin-bottom: 10px;
}
</style>
   
  <!-- /.content-wrapper -->
 <script type="text/javascript">

$(document).ready(function() {
    var i=1;  
    $('#addopt').click(function(){  
           i++;  
           $('#dynamic_field1').append('<tr id="row'+i+'" class="dynamic-added"><td>Name:</td><td><input type="text" name="node[]" class="form-control name_list" required /></td></tr><tr id="row'+i+'" class="dynamic-added"><td>Value:</td><td><input type="text" name="node1[]" class="form-control name_list" required /></td><td><input type="hidden" name="node_id[]" value="" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
});
</script>

<script>
    function addmoreprice(){
        
        var row = '';
        row += '<div class="row"  style="background: #eeeeee;padding-top: 15px;margin-top:10px">';
        row += '            <div class="col-lg-12 col-md-12 col-sm-12">';
        row += '                <div class="form-group" style="margin-bottom: 0px;">';
        row += '                    <div class="col-sm-6"> <input type="text"  class="form-control" name="unit[]" placeholder="Enter Unit no. "> </div>';
        row += '                    <div class="col-sm-6">';
        row += '                        <select class="form-control" name="unit_type[]" required>';
        row += '                                 <option value="">Select Unit Type</option>';
        row += '                                 <option value="Kg">Kg</option>';
        row += '                                 <option value="Litter">Litter</option>';
        row += '                                 <option value="Gram">Gram</option>';
        row += '                                 <option value="Mili Liter">Mili Liter</option>';
        row += '                        </select>';
        row += '                    </div>';
        
        
        row += '            <div class="col-sm-6"> ';
        row += '            <input class="form-control" name="product_price[]" placeholder="MRP"  required>';
        row += '            </div>';
        row += '            <div class="col-sm-6"> ';
        row += '            <input class="form-control" name="product_price1[]" placeholder="Dealer Price"  required>';
        row += '            </div>';
        
        
        row += ' <div class="col-sm-6"> ';
        row += '                    <input class="form-control" name="mfg_date[]" placeholder="Manufacturing Date" type="date"  required>';
        row += '                    </div>';
                            
        row += '                    <div class="col-sm-6"> ';
        row += '                    <input class="form-control" name="exp_date[]" placeholder="Expiry Date" type="date" required>';
        row += '                    </div>';
                            
        row += '                    <div class="col-sm-6"> ';
        row += '                    <input class="form-control" name="batchcode[]" placeholder="Batch Code"  required>';
        row += '                    </div>';
                            
        row += '                    <div class="col-sm-6"> ';
        row += '                    <input type="file" class="form-control" name="variactionimage[]" placeholder="Image"  required>';
        row += '                    </div>';
        row += '                    <div class="col-sm-6"> ';
        row += '                    <input type="text" class="form-control" name="opningqty[]" placeholder="Opening Qty"  required>';
        row += '                    </div>';
        
        
        
        
        
        row += '                </div>';
        row += '            </div>';
       
        row += '<button type="button" class="col-lg-12 col-md-12 col-sm-12 btn btn-danger" onclick="$(this).parent().remove()">Remove</button>';
        row += '</div>';
                
        $('#moreprice').append(row);        
        
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAz9BzJwfRWIDQTG8JdcJwn1JYJx1V25jg&libraries=places&callback=initAutocomplete" async defer></script>
<script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="product_name[]" placeholder="Product Name" class="form-control name_list" /></td><td><input type="text" name="product_qty[]" placeholder="Quantity" class="form-control name_list" style="width: 50%;float: left;"/><select class="form-control qty_uni" name="unit[]" style="width: 50%;float: left;"><option name="KG" value="KG">KG</option><option name="Liter" value="Liter">Liter</option><option name="Gram" value="Gram">Gram</option><option name="Mili Liter" value="Mili Liter">Mili Liter</option></select></td><td><input type="text" name="product_price[]" placeholder="Price" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>


      <!-- Default box -->
      <!-- <?php if(isset($_GET['raw_id'])){ ?>
      <div class="box" id="rawmaterial" style="margin:20px 0px">
        <div class="box-header with-border">
          <h3 class="box-title">
            Edit Raw Materials
            </h3>
        <?php }else{ ?>
            <div class="box" style="" id="rawmaterial" style="margin:20px 0px">
        <div class="box-header with-border">
        <h3 class="box-title">
        Add Raw Materials 
        </h3>
       <?php  } ?>
              

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body main_div">
        <form action="submit_raw_material.php" name="add_name" id="add_name" method="POST">
        
        <table class="table table-bordered" id="dynamic_field">
          <thead>
            <tr>
              <th>Name</th>
              <th>Quantity</th>
              <th>Price</th>
             
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php if(isset($_GET['raw_id'])){
                $id=$_GET['raw_id'];
                //print_r("SELECT * FROM raw_material WHERE id = ".$id."");die;
      $sql1 = mysqli_query($conn, "SELECT * FROM raw_material WHERE id = ".$id."");
           //print_r($sql1);die;
            //$i=1;
                    if(mysqli_num_rows($sql1) > 0) {
                      
                    while($row = mysqli_fetch_assoc($sql1)) { ?>
                      
                      <td><input type="text" name="product_name[]" value="<?php echo $row['raw_name'] ?>" placeholder="Product Name" class="form-control name_list" required /></td>
              <td><input type="text" name="product_qty[]" value="<?php echo $row['raw_quantity'] ?>" placeholder="Quantity" class="form-control name_list qty_pro" style="width: 50%;float: left;" />
                <select class="form-control qty_uni" name="unit[]" style="width: 50%;float: left;">
              <option name="KG" <?php if($row["raw_unit"] == "KG") echo "selected"; ?> value="KG">KG</option>
              <option name="Liter" <?php if($row["raw_unit"] == "Liter") echo "selected"; ?> value="Liter">Liter</option>
              <option name="Gram" <?php if($row["raw_unit"] == "Gram") echo "selected"; ?> value="Gram">Gram</option>
              <option name="Mili Liter" <?php if($row["raw_unit"] == "Mili Liter") echo "selected"; ?> value="Mili Liter">Mili Liter</option>
            </select>
              </td>
              <td><input type="text" name="product_price[]" value="<?php echo $row['raw_price']; ?>" placeholder="Price" class="form-control name_list" />
                <input type="hidden" name="id[]" value="<?php echo $row['id']; ?>" class="form-control" />
              </td>             
             
          </tr>
                    </tbody>
        </table>
        <div class="submit">
          <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
        </div>
              <?php }
                    } }else{ ?>

              <td><input type="text" name="product_name[]" placeholder="Product Name" class="form-control name_list" required /></td>
              <td><input type="text" name="product_qty[]" placeholder="Quantity" class="form-control name_list qty_pro" style="width: 50%;float: left;" />
                <select class="form-control qty_uni" name="unit[]" style="width: 50%;float: left;">
              <option name="KG" value="KG">KG</option>
              <option name="Liter" value="Liter">Liter</option>
              <option name="Gram" value="Gram">Gram</option>
              <option name="Mili Liter" value="Mili Liter">Mili Liter</option>
            </select>
              </td>
              <td><input type="text" name="product_price[]" placeholder="Price" class="form-control name_list" /></td>              
              <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
            </tr>
          </tbody>
        </table>
        <div class="submit">
          <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
        </div>
        <?php } ?>
      </form>
        </div>
      </div> -->
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php include('layout/footer1.php'); ?>