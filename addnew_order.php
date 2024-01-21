<?php include('layout/connect.php');
session_start();

if(!isset($_SESSION['userId'])) {
    header("Location:index.php");
    exit();
}

if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') {
    $json = array();
    $sql = mysqli_query($conn, "SELECT * FROM order_details WHERE id = '".$_GET['raw_id']."'");
    $orderData = mysqli_fetch_assoc($sql);
    
if($_SESSION['userRole']=='1' ||$_SESSION['userRole']=='2') { 
    $orderst = 7 ;
} elseif ($_SESSION['userRole']=='3') { 
    $orderst = 6 ;
} elseif ($_SESSION['userRole']=='4') { 
    $orderst = 5 ;
} elseif ($_SESSION['userRole']=='5') {
     $orderst = 4 ;
} elseif ($_SESSION['userRole']=='6') {
    $orderst = 3 ;
} elseif ($_SESSION['userRole']=='7') {
     $orderst = 2 ;
} else{  $orderst = 1 ;  }    
    
    
}


if(isset($_POST["addUpdt"]))
{  
    if(isset($_GET["raw_id"])){
    $order_id = $_GET["raw_id"];
    }else{
       $addord = "INSERT INTO order_details (`customer_id`,`status`, `active`,`created_by`,`payment_method`, `created_on`) VALUES ('".$_GET["id"]."','1','1','".$_SESSION['userId']."','CASH','".date("Y-m-d H:i:s")."')" ;  
       $addorde = mysqli_query($conn,$addord);
       $order_id = $conn->insert_id; 
    }
    
    $product_id = $_POST["product_id"] ;
    $quantity = $_POST["quantity"] ;
    $variation = $_POST["price"] ;
    
    $var = mysqli_query($conn,"select * from product_price where id = $variation");
    $vari = mysqli_fetch_array($var) ;
    
    $unit = $vari["unit"].' '.$vari["unit_type"] ;
    $price = $vari["dealer_price"];
    $total_price = $quantity * $vari["dealer_price"] ;
    
    
    $PROD = mysqli_query($conn,"select * from product where id = $product_id");
    $PRODU = mysqli_fetch_array($PROD) ;
    
    $gst = $PRODU["gst"];
    $tax = $total_price * $gst/100 ;
    
    $grandtotal = $total_price + $tax ;
    
    $cust = mysqli_query($conn,"SELECT * FROM order_details where id = '".$order_id."'");
    $custom = mysqli_fetch_array($cust);
    $user_id = $custom['customer_id'] ;
    
    
    $ins_p = "INSERT INTO `order_product`( `order_id`, `product_id`, `unit`, `price`, `quantity`, `total_price`,`tax`,`grand_total`,`created_on`) 
    VALUES ('".$order_id."','$product_id','$unit','$price','$quantity','$total_price','$tax','$grandtotal','".date("Y-m-d H:i:s")."')";
    
     mysqli_query($conn,$ins_p);
    
    
    $orderprice = $custom["total_price"] + $grandtotal ;

	$sql = "UPDATE `order_details` SET total_price = '$orderprice' WHERE id = '".$order_id."'";
    $result = mysqli_query($conn,$sql);
    
    echo "<script>window.location.href='addnew_order.php?id=".$_GET["id"]."&raw_id=".$order_id."';</script>"; 
    
}

$succ = '';
if(isset($_POST["update"]))
{
     $gtot = array();
    $cart_total = 0 ;
    foreach($_POST["order_product_id"] as $key => $ordproid)
    {
        $price = $_POST["price"][$key] ;
        $quantity = $_POST["quantity"][$key];  
        
        $total_price = $price * $quantity ;
        $cart_total += $total_price ;
        
        $product_id = $_POST["product_id"][$key];
        
        $PROD = mysqli_query($conn,"select * from product where id = $product_id");
        $PRODU = mysqli_fetch_array($PROD) ;
        
        $gst = $PRODU["gst"];
        $tax = $total_price * $gst/100 ;
        
        $grandtotal = $total_price + $tax ;
        $gtot[] = $grandtotal ;
        mysqli_query($conn,"update order_product set price = '$price', quantity = '$quantity', total_price = '$total_price', tax = '$tax', grand_total = '$grandtotal'  where id = '$ordproid'") ;
        
    }
    
    $pro_ids = implode(',',$_POST["product_id"]) ;
    $pro_qtys = implode(',',$_POST["quantity"]) ;
    $pro_pric = implode(',',$gtot);
    $pro_unit = implode(',',$_POST["pro_unit"]);
   
    mysqli_query($conn,"update order_details set total_price = '$cart_total',product_id= '$pro_ids',order_quantity='$pro_qtys',
    product_price='$pro_pric',product_unit= '$pro_unit',payment_method ='".$_POST["payment_method"]."' where id = '".$_POST["OrderId"]."'");
    
    $succ = "Product Updated";
    
    
if($_SESSION['userRole']=='1' ||$_SESSION['userRole']=='2') { 
    $st = 7 ;
} elseif ($_SESSION['userRole']=='3') { 
    $st = 6 ;
} elseif ($_SESSION['userRole']=='4') { 
    $st = 5 ;
} elseif ($_SESSION['userRole']=='5') {
     $st = 4 ;
} elseif ($_SESSION['userRole']=='6') {
    $st = 3 ;
} elseif ($_SESSION['userRole']=='7') {
     $st = 2 ;
} else{  $st = 1 ;  }
    
    $sql = mysqli_query($conn,"UPDATE order_details SET status = '$st' WHERE id = '".$_POST["OrderId"]."'");
    $sql1= mysqli_query($conn,"INSERT INTO order_approved(`status`,`approved_date`,`user_role_id`,`order_id`) 
    VALUES ('".$_SESSION['status']."','".date("Y-m-d h:i:sa")."','".$_SESSION['userId']."','".$_POST["OrderId"]."')");

    if($sql1){ echo "<script>alert('Order submited!!!');window.location.href='dashboard.php';</script>"; }
}


//echo "<pre>"; print_r($json[0]); die;
include('layout/header1.php');
?>
<style type="text/css">
.main_div h2 {
    text-align: center;
    font-size: 60px;
}
.main_div table {
    margin-top: 60px
}
.submit {
    text-align: center;
}
.next {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
}
.next:hover {
    opacity: 0.8;
}
.prevBtn {
    background-color: #bbbbbb;
}
 .row.product-margin div {
         border: 1px solid #eee;
         padding: 10px 10px;
        text-align: left;
    }

.product-grid{font-family:Raleway,sans-serif;border:1px solid rgba(0,0,0,.1);overflow:hidden;position:relative;z-index:1;border-radius: 5px;}
.product-grid:hover { box-shadow: 3px 4px 3px #ccc; }
.product-grid .product-image{position:relative;transition:all .3s ease 0s}
.product-grid .product-image a{display:block}
.product-grid .product-image img{width:100%;height:auto}
.product-grid .product-content{background-color:#fff;padding:10px 0 0;margin:0 auto;}
.product-grid:hover .product-content{bottom:0}
.product-grid .title{ font-weight:400;letter-spacing:.5px;text-transform:capitalize;margin:0 0 5px 5px;transition:all .3s ease 0s}
.product-grid .title a{color:#000;}
.product-grid .title a:hover,.product-grid:hover .title a{color:#ef5777}
.product-grid .price{color:#333;font-size:17px;font-family:Montserrat,sans-serif;font-weight:700;letter-spacing:.6px;margin-bottom:8px;text-align:center;transition:all .3s}
.product-grid .price span{color:#999;font-size:13px;font-weight:400;margin-left:3px;display:inline-block}
.product-grid .add-to-cart{ 
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 10px 20px;
    background: #04d073;
    border-radius: 0px;
    width: 100%;
    display: block;
    margin-top: 5px;
}
.product-grid .add-to-cart i {
    float: right;
}

.product-content h3.title a {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

    
</style>   
<div class="content-wrapper">
    <div class="alert alert-success" id="success-alert" style="display: none;">
        <strong>Success!</strong> Product removed successfully.
    </div>

<?php if($succ){ ?> 
     <div class="alert alert-success" id="success-alert">
        <?php echo $succ ; ?>
     </div>
<?php } ?>    
<link rel="stylesheet" href="css/bootstrap-select.css"> 



    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
    
    
    <?php if(isset($_GET["raw_id"])){ ?>
     <div class="box" style="    margin-top: 0px;">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Detail</h3>
            </div>
            <div class="box-body main_div">
                  <?php 
                        $sqluser = mysqli_query($conn,"SELECT * FROM users WHERE id = (select customer_id from order_details where id = '".$_GET['raw_id']."')");
                        $resultUser = mysqli_fetch_array($sqluser);
                    ?>
                    
                    <div class="row product-margin">
                        <div class= "col-sm-12 col-xs-12 product-result">Firm : <?php echo $resultUser["shop"] ; ?></div>
                        <div class= "col-sm-4 col-xs-12 product-result">Username : <?php echo $resultUser["first_name"].' '.$resultUser['last_name'] ; ?></div>
                        <div class= "col-sm-4 col-xs-12 product-result">Email : <?php echo $resultUser["email"] ; ?></div>
                        <div class= "col-sm-4 col-xs-12 product-result">Phone : <?php echo $resultUser["phone"].' , '.$resultUser["telephone"] ; ?></div>
                        <div class= "col-sm-4 col-xs-12 product-result">Sales Person : 
                              <?php 
                                  $salp = mysqli_query($conn, "SELECT * FROM users WHERE id = '".$resultUser["allot_to"]."'"); 
    			    			  $salpp = mysqli_fetch_array($salp);
    			    			  echo $salpp["first_name"].' '.$salpp["last_name"] ;
                              ?>
                        </div>
                        <div class= "col-sm-8 col-xs-12 product-result">
                            Address : 
                            <?php 
                                $aquery = mysqli_query($conn,"SELECT cities.name as city, states.name as state, countries.name as country, users.village FROM users 
                                                              INNER JOIN cities ON users.city = cities.id INNER JOIN states ON users.state = states.id 
                                                              INNER JOIN countries ON users.country = countries.id WHERE users.id = '".$resultUser["id"]."'") ;  
                                $rquery = mysqli_fetch_array($aquery);
                                echo $rquery["village"].', '.$rquery["city"].', '.$rquery["state"].', '.$rquery["country"] ;
                            ?>
                        </div>
                        <!--<div class= "col-sm-3 col-xs-12 product-result">Shop Type : <?php echo $resultUser["shoptype"] ; ?></div>-->
                        <!--<div class= "col-sm-3 col-xs-12 product-result">Establised Year  : <?php echo $resultUser["year"] ; ?></div>-->
                        <!--<div class= "col-sm-3 col-xs-12 product-result">Sale Type : <?php echo $resultUser["saletype"] ; ?></div>-->
                        <div class="col-sm-12 col-xs-12 product-result" style="text-align: center;"><a href="user_detail.php?id=<?php echo $resultUser["id"] ; ?>" target="_blank">View More Detail</a></div>
                    </div>
            </div>
        </div>
        
        
        <div class="box" style="margin-top: 20px;">
            <div class="box-header with-border">
                <h3 class="box-title"><center>Order Product</center></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                     title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body main_div">
                <div class="panel-body pull-center">
                    <div class="row">
                    <form method="POST" action="" name="single_invoice" id="updatequan">    
                        <div class="col-lg-12 col-md-12 col-sm-12" >
                            <table  class="table table-striped table-bordered" style="width:100%;margin-top:0px;">
                                <thead>
                                  <tr>
                            
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>GST(%)</th>
                                    <th>Tax</th>
                                    <th>Grand Total</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>

                                 <?php 
                                    if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') {
                                        $get_tprice = 0 ; $get_gstprice  = 0 ; $get_grandprice = 0 ;
                                        $i = 1;
                                        ?>
                                        <input type="hidden" name="OrderId" value="<?php echo $_GET['raw_id'];?>"><?php
                                        //foreach($orderProducts as $key => $product_id) {
                                        
                                        $sqla1 = mysqli_query($conn, "SELECT * FROM order_product WHERE order_id = '".$_GET['raw_id']."'");
                                        while($orderDet = mysqli_fetch_array($sqla1))
                                        {
                                            $product_id = $orderDet["product_id"];
                                            $sql1 = mysqli_query($conn, "SELECT * FROM product WHERE id = '".$product_id."'");
                                            $proData = mysqli_fetch_assoc($sql1); ?>
                                            <tr id="rowpro<?php echo $orderDet['id']; ?>">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $proData['product_name']; ?></td>
                                                <td><?php echo $orderDet['unit']; ?></td>
                                                <td>
                                                    <input type="hidden" name="product_id[]" value="<?php echo $product_id ; ?>" >
                                                    <input type="hidden" name="order_product_id[]" value="<?php echo $orderDet['id'] ?>" >
                                                    <input type="hidden" name="price[]" value="<?php echo $orderDet['price'];?>"> 
                                                    <input type="hidden" name="pro_unit[]" value="<?php echo $orderDet['unit'];?>"> 
                                                    <?php if($orderData["status"] < $orderst){  ?>
												    <input type="number" name="quantity[]" value="<?php echo $orderDet["quantity"]; ?>"  style="width:55px;" id="qnt" onchange="antpr(this.value,'<?php echo $orderDet['price']; ?>','<?php echo $orderDet['id']; ?>','<?php echo $proData['gst']; ?>');" onkeyup="antpr(this.value,'<?php echo $orderDet['price']; ?>','<?php echo $orderDet['id']; ?>','<?php echo $proData['gst']; ?>');" required />
												    <?php }else{ ?>
												    <?php echo $orderDet["quantity"]; ?>
												    <?php } ?>
												</td>
												<td><span id="total_price<?php echo $orderDet["id"] ?>"><?php echo $orderDet['price']; ?></span></td>
												<td><span id="total_price<?php echo $orderDet["id"] ?>"><?php echo $orderDet['total_price']; ?></span></td>
												<td><?php echo $proData["gst"].'%'; ?></td>
												<td><span id="gst_price<?php echo $orderDet["id"] ?>"><?php echo $orderDet['tax']; ?></span></td>
												<td>
												    <span id="grand_price<?php echo $orderDet["id"] ?>"><?php echo $orderDet['grand_total']; ?></span>
												
							<input type="hidden" value="<?php $get_tprice += $orderDet['total_price']; ?>">
							<input type="hidden" value="<?php $get_gstprice += $orderDet['tax']; ?>">
							<input type="hidden" value="<?php $get_grandprice += $orderDet['grand_total']; ?>">
							
												</td>
												<td class="img-profile">
                                                    <img src="<?php echo $proData['product_img']; ?>" style="height:50px;width:50px;border-radius:10px;" />
                                                </td>
                                                
                                                <td class="img-profile" >
                                                <?php if($orderData["status"] < $orderst){ ?>
                                                    <img src="images/remove-icon-png-15.png" style="width: 35px;height: 35px;" onclick="deleteItem(<?php echo $_GET['raw_id']; ?>,<?php echo $orderDet['id']; ?>)" />
                                                    <input type="hidden" name="allPrdID1[]" value="<?php echo $proData['id']; ?>" />
                                                <?php } ?>    
                                                </td>
                                            </tr>
                                    <?php $i++; } ?>
                                    <tr>
									    <td colspan="8" style="background:#f2f2f2"><span class="pull-right"><b>Payment Type : </b></span></td>
									    <td ><input type="radio" name="payment_method" value="DPL" checked> DPL</td>
									    <td ><input type="radio" name="payment_method" value="CASH" checked> CASH</td>
									</tr>
                                    <tr>
                                        <td colspan="5"><span class="pull-right"><b>Total : </b></span></td>
                                        <td colspan="2"><?php echo $get_tprice ?></td>
                                        <td><?php echo $get_gstprice ?></td>
                                        <td colspan="3"><?php echo $get_grandprice ?></td>
                                    </tr>
                                    
                                    <?php } else {

                                    }
                                    ?>
                                <tbody id="prdctData">
                                   
                                </tbody>

                            </table>
                            <?php if (empty($i)) {
                                $i=0;
                            }?>
                            <input type="hidden" id="cot" name="cot" value="<?php echo $i; ?>" />
                            <?php
                            if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') { 
                              if($orderData["status"] < $orderst){ 
                            ?>
                              <input type="submit" name="update" id="updatesec" value="Processed To Order" class="btn btn-success btn-lg" />
                              <?php } ?>
                            <?php } ?>
                        </div>
                    </form>    
                        
                    </div>
                </div>
            </div>
        </div>
    
    <?php } ?>   
    
    
<?php if(isset($_GET["raw_id"])){ ?>
  <?php if($orderData["status"] < $orderst){  ?>
    <div class="box" style="margin-top: 20px;">
            <div class="box-header">
                <h3 class="box-title">Add New Product</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php
            if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') {        
                    $sql = mysqli_query($conn,"SELECT *  FROM product where active='1' AND id NOT IN (select product_id from order_product where order_id = '".$_GET["raw_id"]."')");
            }else{
                  $sql = mysqli_query($conn,"SELECT *  FROM product where active='1'");   
            }
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                            <div class="col-md-3 col-sm-6" style="margin-top:1em;">
                            <form method="POST" action="" name="single_invoice" >        
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a href="product_details.php?pid=<?php echo $row['id']; ?>">
                                        <?php $l = 1 ;
                                            $sp = mysqli_query($conn,"select * from product_price where product_id='".$row["id"]."' order by id asc");
                                            while($psp = mysqli_fetch_array($sp))
                                            {
                                        ?>        
                                            <img class="pic-1<?php echo $row['id'] ; ?>" src="<?php echo $psp['image'] ; ?>" style="height:18em; <?php if($l != 1){ echo "display:none;"; } ?>" id="im<?php echo $psp['id'] ; ?>" >
                                        <?php $l++ ; } ?>    
                                        </a>
                                    </div>
                    				<div class="product-content">
                                        <h3 class="title"><?php echo $row['product_name']; ?></h3>
                                        <p class="title"><?php echo $row['p_technical_name']; ?></p>
                                        <div class="form-group">
                                            <?php $p = 1 ;
                                                  $sp = mysqli_query($conn,"select * from product_price where product_id='".$row["id"]."' order by id asc");
                                                  while($psp = mysqli_fetch_array($sp))
                                                  { ?>
                    <div class="variation" style="background: #f2f2f250;padding: 5px 10px;margin-bottom: 5px;">
                        <input type="radio" name="price" value="<?php echo $psp["id"] ; ?>" onclick="$('.pic-1<?php echo $row['id'] ; ?>').hide()&&$('#im<?php echo $psp['id'] ; ?>').show()"  <?php if($p == 1){ echo "checked"; } ?> > <?php echo $psp["unit"].' '.$psp["unit_type"].' ( '.$psp['dealer_price'].' )'; ?>
                    </div>        
                                                  
                                            <?php  $p++;    }
                                            ?>      
                                        </div>
                                        
                                        <div class="form-group pt-2">
                                            <label class="control-lable">Quantity</label>
                                            <input type="number" min="1" value="1" name="quantity" class="form-control" required>
                                            <input type="hidden" name = "product_id" value="<?php echo $row['id'] ; ?>">
                                        </div>
                                        <button class="add-to-cart" type="submit" name="addUpdt" id="nw" value="Add">Add to order <i class="fa fa-shoppping-cart"></i></button>
                                    </div>
                                </div>
                            </form>    
                            </div>
                    <?php } ?>
                </div>
            </div>
    </div>        
  <?php } ?>    
<?php }else{ ?>
    <div class="box" style="margin-top: 20px;">
            <div class="box-header">
                <h3 class="box-title">Add New Product</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php
            if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') {        
                    $sql = mysqli_query($conn,"SELECT *  FROM product where active='1' AND id NOT IN (select product_id from order_product where order_id = '".$_GET["raw_id"]."')");
            }else{
                  $sql = mysqli_query($conn,"SELECT *  FROM product where active='1'");   
            }
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                            <div class="col-md-3 col-sm-6" style="margin-top:1em;">
                            <form method="POST" action="" name="single_invoice" >        
                                <div class="product-grid">
                                    <div class="product-image">
                                        <!--<a href="product_details.php?pid=<?php echo $row['id']; ?>">-->
                                        <?php $l = 1 ;
                                            $sp = mysqli_query($conn,"select * from product_price where product_id='".$row["id"]."' order by id asc");
                                            while($psp = mysqli_fetch_array($sp))
                                            {
                                        ?>        
                                            <img class="pic-1<?php echo $row['id'] ; ?>" src="<?php echo $psp['image'] ; ?>" style="height:18em; <?php if($l != 1){ echo "display:none;"; } ?>" id="im<?php echo $psp['id'] ; ?>" >
                                        <?php $l++ ; } ?>    
                                        <!--</a>-->
                                    </div>
                    				<div class="product-content">
                                        <h3 class="title"><?php echo $row['product_name']; ?></h3>
                                        <p class="title"><?php echo $row['p_technical_name']; ?></p>
                                        <div class="form-group">
                                            <?php $p = 1 ;
                                                  $sp = mysqli_query($conn,"select * from product_price where product_id='".$row["id"]."' order by id asc");
                                                  while($psp = mysqli_fetch_array($sp))
                                                  { ?>
                    <div class="variation" style="background: #f2f2f250;padding: 5px 10px;margin-bottom: 5px;">
                        <input type="radio" name="price" value="<?php echo $psp["id"] ; ?>" onclick="$('.pic-1<?php echo $row['id'] ; ?>').hide()&&$('#im<?php echo $psp['id'] ; ?>').show()"  <?php if($p == 1){ echo "checked"; } ?> > <?php echo $psp["unit"].' '.$psp["unit_type"].' ( '.$psp['dealer_price'].' )'; ?>
                    </div>        
                                                  
                                            <?php  $p++;    }
                                            ?>      
                                        </div>
                                        
                                        <div class="form-group pt-2">
                                            <label class="control-lable">Quantity</label>
                                            <input type="number" min="1" value="1" name="quantity" class="form-control" required>
                                            <input type="hidden" name = "product_id" value="<?php echo $row['id'] ; ?>">
                                        </div>
                                        <button class="add-to-cart" type="submit" name="addUpdt" id="nw" value="Add">Add to order <i class="fa fa-shoppping-cart"></i></button>
                                    </div>
                                </div>
                            </form>    
                            </div>
                    <?php } ?>
                </div>
            </div>
    </div> 
<?php } ?>
    </section>

</div>
  <!-- /.content-wrapper -->
<?php include('layout/footer1.php'); ?>
<script src="js/bootstrap-select.js"></script>
<script type="text/javascript">
function deleteItem(order_id,product_id) {
    if (confirm("Are you sure?")) {
        $.ajax({
            url: 'ajax_UpdateproductData.php',
            type: 'GET',
            data: {'order_id':order_id,'product_id':product_id},
            dataType: 'json',
            success: function(response) {
                if(response.result == 'success') {
                    location. reload(true);
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                    $('#rowpro'+product_id).remove();
                    });
                } else {
                    alert("Network Error");
                }
            }
        });
    }
    return false;
}


$(document).ready(function(){
    $('#add').on('click', function(){
        var selectedCountry = $("#pd").val();
        var row = $("#cot").val();
    if(selectedCountry=='') {
            alert('Select a product');
            return false;
        } else {
            $.ajax({
                type:'POST',
                url: 'ajax_productData.php',
                data: {'pdId': selectedCountry,'rowct': row},
                success: function(data) {
                    $('#prdctData').html(data);
                },
            });
            return false;
        }
    });
});
</script>
<script>

/*Select From*/
$(document).ready(function () {
    var mySelect = $('#first-disabled2');
    $('#special').on('click', function () {
        mySelect.find('option:selected').prop('disabled', true);
        mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
        mySelect.find('option:disabled').prop('disabled', false);
        mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
});


$(document).on('click', '.btn_remove3', function(){  
         var button_id = $(this).attr("id");  
      }); 
      
      
/*Update price for quantity*/      
function antpr(qun,price,id,gst)
{
   // alert(qun+price);
    $('#total_price'+id).html(qun*price);
    
    $('#gst_price'+id).html((qun*price)*gst/100);
    
    $('#grand_price'+id).html(((qun*price)*gst/100) + (qun*price));
    
    $('#updatesec').trigger('click');
    
}

/*Get Variation From Ajax*/
function showvariation(id)
{
     $.ajax({
        type:'POST',
        url: 'ajax_addproducttoorder.php',
        data: {'product': id},
        success: function(data) {
            $('#variations').html(data);
        },
    });
    return false;
}
      
</script>