<?php session_start();
  include('layout/connect.php');
 if(!isset($_SESSION['userId']))
    {
      header("Location:index.php");
        exit();
    }



if(isset($_POST["submit"]))
{
    $price_id = $_POST["price_id"] ; 
    $current_stock = $_POST["current_stock"] ;
    
    $regular_price = $_POST["price"];
    $dealer_price = $_POST["dealer_price"];
    $mfgdate = $_POST["mfgdate"];
    $expdate = $_POST["expdate"];
    $stock = $_POST["stock"] ;
    $batchcode = $_POST["batchcode"] ;
    
    $tota_stock = $_POST["current_stock"] + $_POST["stock"] ;
    
    $updateprice = "UPDATE `product_price` SET `regular_price`='$regular_price',`dealer_price`='$dealer_price',`mfgdate`= '$mfgdate',`expdate`= '$expdate', `stock`= '$tota_stock',`batchcode`='$batchcode' WHERE id = '$price_id'";
    $update_price = mysqli_query($conn,$updateprice);
    
    
    $product_id = $_POST["product_id"] ;
    
    $stockinsert = "INSERT INTO `product_stock`(`update_by`, `product_id`, `price_id`, `regular_price`, `dealer_price`, `mfgdate`, `expdate`, `quantity`,`batchcode` ,`created_on`) 
    VALUES ('".$_SESSION['userId']."','$product_id','$price_id','$regular_price','$dealer_price','$mfgdate','$expdate','$stock','$batchcode','".date('Y-m-d H:i:s')."')";
    $insert_stock = mysqli_query($conn,$stockinsert);
    
    echo '<script> alert("Stock Updated"); window.location.assign("manage_stock.php?proid='.$product_id.'"); </script>' ;
}


include('layout/header1.php');
?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->



<link rel="stylesheet" href="css/bootstrap-select.css"> 
<style>
    @import url(https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css);

.select2-container .select2-selection--single {
     height: 35px;
}
</style>

<div class="content-wrapper">

<section class="content" style="min-height: auto;">
    <div class="box" style="margin-top: 0px;">
        <div class="box-header with-border">
            <h3 class="box-title">Select Product</h3>
        </div>
        <div class="box-body main_div">
            <div class="col-lg-12 col-md-12 col-sm-12" >
                <div class="form-group">
                    <label class="control-label">Product Name:</label>
                    <select id="pd" name="product_id" class="form-control" required data-max-options="20" onchange="getproductstate(this.value)">
                        <option value="">Select Product</option>
                        <?php
                            $prosql = mysqli_query($conn,"SELECT *  FROM product where active='1'");
                            while($prodat=mysqli_fetch_array($prosql)){
                        ?>
                        <option value="<?php echo $prodat['id']; ?>"><?php echo $prodat['product_name']; ?> - (<?php echo $prodat['p_technical_name']; ?>)</option>
                        <?php } ?>
                    </select>  
                </div>
                
                
                <div class="form-group" id="statedata">
                    
                </div>
                
                
                <div class="form-group" id="unitdata">
                    
                </div>
                
                
            </div>
        </div>
    </div>
</section>



<section class="content" id="prodata"  style="min-height: auto;">
	<?php if(isset($_GET["proid"])){ ?>
	 
	 <style>
    .stocksec {
    background: #f0f0f0;
    margin: 10px 0;
    padding: 10px 10px;
}
</style>

<div class="box" style="margin-top: 0px;">
    <div class="box-header with-border">
        <h3 class="box-title">Product Detail</h3>
    </div>
    <div class="box-body main_div">
        
        <?php 
         $pid = $_GET["proid"] ;
         $query = mysqli_query($conn,"select * from product_price where product_id= '$pid'") ;
         while($pricep = mysqli_fetch_array($query)){
        ?> 
        <div class="stocksec">
        <div class="row">
            <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">State</div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Unit</div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Unit type</div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Batchcode</div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">MRP</div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Dealer Price</div>
            <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">Mfg date</div>
            <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">Exp date</div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Stock</div>
        </div>
        <div class="row">
            <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">
                <?php $stat = mysqli_query($conn,"select * from states where id ='".$pricep['state_id']."'"); $state = mysqli_fetch_array($stat) ; echo $state["name"] ;  ?>
            </div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['unit'] ; ?></div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['unit_type'] ; ?></div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['batchcode'] ; ?></div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['regular_price'] ; ?></div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['dealer_price'] ; ?></div>
            <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['mfgdate'] ; ?></div>
            <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['expdate'] ; ?></div>
            <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo  $pricep['stock'] ; ?></div>
        </div>
        
        <div class="row">
            <br>
            <form action="" method="post">
                <div class="col-md-4" style="padding: 0px;">   
                    <input type="hidden" name="price_id" value="<?php echo  $pricep['id'] ; ?>">
                    <input type="hidden" name="current_stock" value="<?php echo  $pricep['stock'] ; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $_GET["proid"] ; ?>" >
                    <button type="submit" name="submit" value="Update Stock" class="btn btn-success">Update Stock</button>
                </div>
                <div class="col-md-1 col-xs-1" style="padding: 0px;">
                    <input type="text" placeholder="Batch" name="batchcode" class="form-control" required>
                </div>
                <div class="col-md-1 col-xs-1" style="padding: 0px;">
                    <input type="text" placeholder="MRP" name="price" class="form-control" required>
                </div>
                <div class="col-md-1 col-xs-1" style="padding: 0px;">
                    <input type="text" placeholder="Dealer Price" name="dealer_price" class="form-control" required>
                </div>
                <div class="col-md-2 col-xs-2" style="padding: 0px;">
                   <input type="date" placeholder="MFG date" name="mfgdate" class="form-control" required>
                </div>
                <div class="col-md-2 col-xs-2" style="padding: 0px;">
                    <input type="date" placeholder="MFG date" name="expdate" class="form-control" required>
                </div>
                <div class="col-md-1 col-xs-1" style="padding: 0px;">
                    <input type="number" placeholder="stock" name="stock" min="1" class="form-control" required>
                </div>
            </form>
            <br>
        </div>
        
        <div class="stockhistry">
           <div class="row">
               <h3>Stock History</h3>
           </div>
           <div class="row">
                <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Batchcode</div>
                <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">MRP</div>
                <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Dealer Price</div>
                <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">MFG date</div>
                <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">Exp date</div>
                <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;">Quantity</div>
                <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">By user</div>
                <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;">On date</div>
           </div>
           
           <div class="row">
           <?php 
                $query1 = mysqli_query($conn,"select product_stock.*,CONCAT(users.first_name,' ',users.last_name) as username from product_stock inner join users on users.id = product_stock.update_by where product_stock.price_id= '".$pricep["id"]."'") ;
                while($resultp = mysqli_fetch_array($query1)){
            ?>
                    <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["batchcode"]; ?></div>
                    <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["regular_price"]; ?></div>
                    <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["dealer_price"]; ?></div>
                    <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["mfgdate"]; ?></div>
                    <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["expdate"]; ?></div>
                    <div class="col-md-1 col-xs-1" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["quantity"]; ?></div>
                    <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["username"]; ?></div>
                    <div class="col-md-2 col-xs-2" style="border:1px solid #ccc;padding:5px;"><?php echo $resultp["created_on"]; ?></div>
              <?php } ?>
           </div>
        </div>      
        
        
        </div>
        <?php } ?>
        
    </div>
</div>	 
	 
 	<?php } ?> 
</section>	
  
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php include('layout/footer1.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>

<script>
    $(function () {
  $("select").select2();
});


function getproductstate(id){
    if(id > "")
    {
     $.get("get_state_product.php?pid="+id, function(data, status){
          $('#statedata').html(data);
         // alert("Data: " + data + "\nStatus: " + status);
      });
    }
    else
    {
        $('#statedata').html("");
        $('#unitdata').html("");
    }
}

function getunits(id,pid)
{
    if(pid > "")
    {
     $.get("get_sunit_product.php?pid="+pid, function(data, status){
          $('#unitdata').html(data);
         // alert("Data: " + data + "\nStatus: " + status);
      });
    }
    else
    {
        $('#unitdata').html("");
    }
}

function getstock(id){
     $.get("get_stock_product.php?pid="+id, function(data, status){
          $('#prodata').html(data);
         // alert("Data: " + data + "\nStatus: " + status);
      });
}



</script>
