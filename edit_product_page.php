<?php
include('layout/connect.php');
session_start();
if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }


if (isset($_POST['submit'])) 
{
        
        $unit= $_POST['unit'][0].' '.$_POST['unit'][1];
        $sql1= "UPDATE `product` SET  `product_type` = '".$_POST['product_type']."',`product_name` = '".$_POST['product_name']."', `p_technical_name` = '".$_POST['p_technical_name']."',
                                     `gst` = '".$_POST['gst']."', `hsn_code` = '".$_POST['hsn']."', `unit` = '".$unit."', `active` = '1' 
                                     WHERE `id` = '".$_POST['product_id']."'";
        
        mysqli_query($conn,$sql1);
        
        $last_id = $_POST['product_id'] ;
       
        mysqli_query($conn,"DELETE FROM `product_price` WHERE product_id = '$last_id'");
        
        foreach($_POST['unit'] as $ukey => $uval)
        {
              $uniytype = $_POST['unit_type'][$ukey] ;
              $regular_price = $_POST['product_price'][$ukey] ;
              $dealer_price = $_POST['product_price1'][$ukey];
              $mfgdate = $_POST['mfg_date'][$ukey];
              $expdate = $_POST['exp_date'][$ukey];
              $stock = $_POST['stock'][$ukey];
              $states = $_POST['states'][$ukey];
              
              
              if($_FILES["variactionimage"]["name"][$ukey])
              {
                   $uploaddir = 'productImage/';
                   $uploadfile = $uploaddir . basename($_FILES['variactionimage']['name'][$ukey]);
                   move_uploaded_file($_FILES['variactionimage']['tmp_name'][$ukey], $uploadfile) ;
              }
              else
              {
                 $uploadfile = $_POST["oldvarimage"][$ukey];
              }
              
              $psql = "INSERT INTO `product_price`(`state_id`,`product_id`, `unit`, `unit_type`, `regular_price`, `dealer_price`,`mfgdate`,`expdate`,`image`,stock,created_on) 
                                           VALUES ('$states','$last_id','$uval','$uniytype','$regular_price','$dealer_price', '$mfgdate', '$expdate','$uploadfile','$stock','".date("Y-m-d H:i:s")."')" ;
              $presult = mysqli_query($conn,$psql); 
        }
    
     echo "<script>alert('Product update susessfully'); window.location.href ='edit_product_page.php?product_id=".$last_id."' </script> ";
    
    
}    
    
    
?>


<?php    
    include('layout/header1.php');
?>



  <div class="content-wrapper" >
    <!-- Main content -->
    <section class="content">
     
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
            
       <form action="" method="POST" id="register" class="form-horizontal" enctype="multipart/form-data">
       <?php
        
        $id=$_GET['product_id'];
        $sql1 = mysqli_query($conn, "SELECT * FROM product WHERE id = ".$id."");
        if(mysqli_num_rows($sql1) > 0) {
            while($row = mysqli_fetch_assoc($sql1)) { 
         ?>
      
           <div class="box-body main_div">
                <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                                <label class="control-label col-sm-1">Product type:</label>
                                <div class="col-sm-11">
                                <select class="form-control" name="product_type" required>
                                         <option value="">Select Product Type</option>
                                         <option value="1" <?php if($row['product_type'] == "1"){ echo 'selected'; } ?>>key product</option>
                                         <option value="2" <?php if($row['product_type'] == "2"){ echo 'selected'; } ?>>Journal product</option>
                                         <option value="3" <?php if($row['product_type'] == "3"){ echo 'selected'; } ?>>3</option>
                                </select>
                                </div>
                        </div>
                    </div>
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
                    
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">GST Percentage:</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="gst" value="<?php echo $row['gst'];?>" required>
                            </div>
                        </div>
                    </div>
                    
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
                    $li = 1;
                    $pprice = mysqli_query($conn, "SELECT * FROM `product_price` WHERE product_id = '".$row["id"]."'");
                    while($prorice = mysqli_fetch_array($pprice))
                    {
                ?>    
                 <div class="row"><!--row-->
                    <div class="col-lg-12 col-md-12 col-sm-12" style="background: #eee;padding-top: 10px;margin-bottom:20px">
                        <div class="form-group">
                            
                            <div class="col-sm-4">
                                <lable>State</lable>
                                <select class="form-control" name="states[]" required id="st<?php echo $li ?>">
                                         <option value="">Select State</option>
                                         <?php 
                                         $sq = mysqli_query($conn,"SELECT * FROM `states` WHERE country_id = 101") ; while($stt = mysqli_fetch_array($sq)){ 
                                             if($stt["id"] == $prorice["state_id"]){
                                          echo '<option value="'.$stt["id"].'" selected>'.$stt["name"].'</option>';   
                                             }
                                             else
                                             {
                                          echo '<option value="'.$stt["id"].'">'.$stt["name"].'</option>';          
                                             }
                                         }     
                                         ?>
                                </select>
                            </div>
                            
                            <div class="col-sm-4"><lable>Unit</lable> <input type="text" id="un<?php echo $li ?>"  class="form-control" name="unit[]"  value="<?php echo $prorice['unit'] ?>" placeholder="Enter Unit no. "> </div>
                            <div class="col-sm-4">
                                <lable>Unit type</lable>
                                <select class="form-control" name="unit_type[]" required id="untyp<?php echo $li ?>">
                                         <option value="">Select Unit Type</option>
                                         <option value="Kg" <?php if($prorice['unit_type'] == "Kg"){ echo 'selected'; } ?>>Kg</option>
                                         <option value="Litter" <?php if($prorice['unit_type'] == "Litter"){ echo 'selected'; } ?>>Litter</option>
                                         <option value="Gram" <?php if($prorice['unit_type'] == "Gram"){ echo 'selected'; } ?>>Gram</option>
                                         <option value="Mili Liter" <?php if($prorice['unit_type'] == "Mili Liter"){ echo 'selected'; } ?>>Mili Liter</option>
                                         <option value="Packate" <?php if($prorice['unit_type'] == "Packate"){ echo 'selected'; } ?> >Packate</option>
                                         <option value="Pisces" <?php if($prorice['unit_type'] == "Pisces"){ echo 'selected'; } ?>>Pisces</option>
                                </select>
                            </div>
                        
                        </div>
                        <div class="form-group">
                            
                            <div class="col-sm-2"> 
                            <lable>MRP</lable>
                            <input class="form-control" name="product_price[]" placeholder="MRP" value="<?php echo $prorice['regular_price'] ?>" required>
                            </div>
                            
                            <div class="col-sm-2"> 
                            <lable>Dealer Price</lable>
                            <input class="form-control" name="product_price1[]" placeholder="Dealer Price" value="<?php echo $prorice['dealer_price'] ?>"  required>
                            </div>
                            
                            <div class="col-sm-2" style="display:none"> 
                            <lable>MFG Date</lable>
                            <input class="form-control" name="mfg_date[]" placeholder="Manufacturing Date" type="date" value="<?php echo $prorice['mfgdate'] ?>"  required>
                            </div>
                            
                            <div class="col-sm-2" style="display:none"> 
                            <lable>Expiry Date</lable>
                            <input class="form-control" name="exp_date[]" placeholder="Expiry Date" type="date" value="<?php echo $prorice['expdate'] ?>"  required>
                            </div>
                            
                            <!--<div class="col-sm-6"> -->
                            <!--<input class="form-control" name="batchcode[]" placeholder="Batch Code" value="<?php echo $prorice['batchcode'] ?>"  required>-->
                            <!--</div>-->
                            
                            <div class="col-sm-2">
                               <lable>Image</lable>     
                               <input type="file" class="form-control" name="variactionimage[]" placeholder="Image">
                               <input type="hidden" name="oldvarimage[]" value="<?php echo $prorice['image'] ?>">
                            </div>
                            
                             <div class="col-sm-2">
                                 <lable>Stock</lable>
                                <input type="text" class="form-control" name="stock[]" placeholder="Opening Qty" readonly value="<?php echo $prorice['stock'] ?>" onclick="alert('stock can not manage from here')">
                             </div>
                             
                             <div class="col-sm-2">
                                 <img src="<?php echo $prorice['image'] ?>" style="width:70px;height:70px;object-fit: cover;">
                             </div>
                             
                            <div class="col-sm-1">
                                <button type="button" class="col-md-12 btn btn-info" onclick="copyadd(<?php echo $li ?>)">Copy</button>
                            </div> 
                            
                            <div class="col-sm-1" style="padding: 0px;">
                                <a href="make_product.php?pricedanger=<?php echo $prorice['id'] ?>&ppid=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete ?')">Remove</a>
                            </div>
                            
                        </div>
                    </div>
                    
                </div><!--row-->
               
                <?php $li++; } ?>
                
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
               
            <div class="row"><!--row-->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group"> 
                        <div class="col-sm-7" >
                            <input type="submit" class="btn btn-info btn-lg pull-right" name="submit" value="Update Product">
                        </div>
                    </div>
                </div>
            </div><!--row-->


            </form>
        </div>
        
        <?php } } ?>
        </form>
      </div>
      
      <!-- /.box -->

<style>
    .form-group .col-sm-6 {
    margin-bottom: 10px;
}
</style>
   
<input type="hidden" id="rowval" value="<?php echo $li ; ?>" >
<script>
    function addmoreprice(){
        
        var rowval = $('#rowval').val();
        
        var row = '';
        row += '<div class="row"  style="background: #eeeeee;padding-top: 15px;margin-top:10px">';
        row += '            <div class="col-lg-12 col-md-12 col-sm-12">';
        row += '                <div class="form-group">';
        
        row += '<div class="col-sm-4">';
        row += '<lable>State</lable> ';
        row += '                        <select class="form-control" name="states[]" required id="st'+rowval+'">';
        row += '                                 <option value="">Select State</option>';
        row += '                                 <?php 
                                         $sq = mysqli_query($conn,"SELECT * FROM `states` WHERE country_id = 101") ; while($stt = mysqli_fetch_array($sq)){ 
                                          echo '<option value="'.$stt["id"].'">'.$stt["name"].'</option>';   
                                         }     
                                         ?>';
        row += '                        </select>';
        row += '                    </div>';
        
        row += '                    <div class="col-sm-4"><lable>Unit</lable><input type="text" id="un'+rowval+'"  class="form-control" name="unit[]" placeholder="Enter Unit no. "> </div>';
        row += '                    <div class="col-sm-4">';
        row += '<lable>Unit type</lable> ';
        row += '                        <select class="form-control" name="unit_type[]" required id="untyp'+rowval+'">';
        row += '                                 <option value="">Select Unit Type</option>';
        row += '                                 <option value="Kg">Kg</option>';
        row += '                                 <option value="Litter">Litter</option>';
        row += '                                 <option value="Gram">Gram</option>';
        row += '                                 <option value="Mili Liter">Mili Liter</option>';
        row += ' <option value="Packate">Packate</option>';
        row += '                                 <option value="Pisces">Pisces</option>';
        row += '                        </select>';
        row += '                    </div>';
        row += '                </div>';
        row += '                <div class="form-group">';
        
        
        row += '            <div class="col-sm-2"> ';
        row += '<lable>MRP</lable> ';
        row += '            <input class="form-control" name="product_price[]" placeholder="MRP"  required>';
        row += '            </div>';
        row += '            <div class="col-sm-2"> ';
        row += '<lable>Dealer Price</lable> ';
        row += '            <input class="form-control" name="product_price1[]" placeholder="Dealer Price"  required>';
        row += '            </div>';
        
        
        row += ' <div class="col-sm-2" style="display:none"> ';
        row += '<lable>MFG Date</lable> ';
        row += '                    <input class="form-control" name="mfg_date[]" placeholder="Manufacturing Date" type="date" >';
        row += '                    </div>';
                            
        row += '<div class="col-sm-2" style="display:none"> ';
        row += '<lable>EXP Date</lable> ';
        row += '                    <input class="form-control" name="exp_date[]" placeholder="Expiry Date" type="date" >';
        row += '                    </div>';
                            
        row += '                    <div class="col-sm-2"> ';
        row += '<lable>Opening Qty</lable> ';
        row += '                    <input class="form-control" name="stock[]" placeholder="Opening Qty"  required>';
        row += '                    </div>';
                            
        row += '                    <div class="col-sm-2"> ';
        row += '                     <lable>Image</lable> ';
        row += '                      <input type="file" class="form-control" name="variactionimage[]" placeholder="Image"  required>';
        row += '                    </div>';
        
        row += '                    <div class="col-sm-2"> ';
        row += '  <button type="button" class="col-md-12 btn btn-info" onclick="copyadd('+rowval+')">Copy</button>';
        row += '                    </div>';
        
        row += '                    <div class="col-sm-2"> ';
         row += '<button type="button" class="col-md-12 btn btn-danger" onclick="$(this).parent().parent().parent().parent().remove()">Remove</button>';
        row += '                    </div>';
        
        row += '                </div>';
        row += '            </div>';
        row += '</div>';
                
        $('#moreprice').append(row);    
        
         $('#rowval').val(parseInt(rowval)+parseInt(1));
        
    }
</script>


    </section>
    <!-- /.content -->
  </div>
<?php include('layout/footer1.php'); ?>





<script>
function copyadd(id)
    {
        var state = $('#st'+id).val();
        var unit = $('#un'+id).val();
        var unit_type = $('#untyp'+id).val();
        
        // add field
        addmoreprice() ;
        
        //append price
        var newid =  $('#rowval').val() - parseInt(1) ;
        
        $('#st'+newid).val(state);
        $('#un'+newid).val(unit);
        $('#untyp'+newid).val(unit_type);
        
    }
</script> 


