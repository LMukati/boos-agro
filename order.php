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
}


if(isset($_POST["add_discount"]))
{
      $ords = mysqli_query($conn,"SELECT * FROM order_details where id = '".$_GET['raw_id']."'");
      $orders = mysqli_fetch_array($ords);
      $total_price = $orders['total_price'] ;
      
      $discount = $_POST["discount"];
      $discount_type = $_POST["discount_type"] ;
      
      if($discount_type == 1)
      {
      $total_discount = $discount ;
      $final_price = $total_price - $total_discount ;
      $db_dis = $_POST["discount"].' flat' ;
      }
      else
      {
        $total_discount = $discount*$total_price/100 ;
        $final_price = $total_price - $total_discount ;
        $db_dis = $_POST["discount"].' %' ;
      }
      
     mysqli_query($conn,"UPDATE `order_details` SET `discount`= '$total_discount',`discount_type`= '$db_dis' ,`final_total`= '$final_price' WHERE id =  '".$_GET['raw_id']."'"); 
     $succ = "Discount Added";  
    echo "<script>window.location.href='order.php?raw_id=".$_GET['raw_id']."';</script>";
}




if(isset($_POST["addUpdt"]))
{
    $product_id = $_POST["product_id"] ;
    $quantity = $_POST["quantity"];
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
    
    
    
    $cust = mysqli_query($conn,"SELECT * FROM order_details where id = '".$_GET['raw_id']."'");
    $custom = mysqli_fetch_array($cust);
    $user_id = $custom['customer_id'] ;
    
    
    $ins_p = "INSERT INTO `order_product`( `order_id`, `product_id`, `unit`, `price`, `quantity`, `total_price`,`tax`,`grand_total`,`created_on`) 
    VALUES ('".$_GET['raw_id']."','$product_id','$unit','$price','$quantity','$total_price','$tax','$grandtotal','".date("Y-m-d H:i:s")."')"; 
     mysqli_query($conn,$ins_p);
    
    
    $orderprice = $custom["total_price"] + $grandtotal ;

	$sql = "UPDATE `order_details` SET total_price = '$orderprice' WHERE id = '".$_GET['raw_id']."'";
    $result = mysqli_query($conn,$sql);
     echo "<script>window.location.href='order.php?raw_id=".$_GET['raw_id']."';</script>";
    
}

$succ = '';
if(isset($_POST["update"]))
{
    $cart_total = 0 ;
    foreach($_POST["order_product_id"] as $key => $ordproid)
    {
        $price = $_POST["price"][$key] ;
        $quantity = $_POST["quantity"][$key];  
        
        $total_price = $price * $quantity ;
        
        
             $product_id = $_POST["product_id"][$key];
        
        
        $PROD = mysqli_query($conn,"select * from product where id = $product_id");
        $PRODU = mysqli_fetch_array($PROD) ;
        
        $gst = $PRODU["gst"];
        $tax = $total_price * $gst/100 ;
        
        $grandtotal = $total_price + $tax ;
        $cart_total += $grandtotal ;
        
        mysqli_query($conn,"update order_product set price = '$price', quantity = '$quantity', total_price = '$total_price', tax = '$tax', grand_total = '$grandtotal'  where id = '$ordproid'") ;

        
    }
   
    mysqli_query($conn,"update order_details set total_price = '$cart_total' where id = '".$_POST["OrderId"]."'");
    $succ = "Product Updated";
     echo "<script>window.location.href='order.php?raw_id=".$_GET['raw_id']."';</script>";
    
    /* if($_SESSION['userRole']=='8')
      {
        echo "<script>window.location.href='purchase_list.php?type=dl';</script>";
      }
      else{
        echo "<script>window.location.href='sales_list.php';</script>";
      }
    */
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

<?php 
 if($_SESSION["userRole"] == "1"){ $userstate = 7 ; }
 elseif($_SESSION["userRole"] == "2"){ $userstate = 7 ; }
 elseif($_SESSION["userRole"] == "3"){ $userstate = 6 ; }
 elseif($_SESSION["userRole"] == "4"){ $userstate = 5 ; }
 elseif($_SESSION["userRole"] == "5"){ $userstate = 4 ; }
 elseif($_SESSION["userRole"] == "6"){ $userstate = 3 ; }
 elseif($_SESSION["userRole"] == "7"){ $userstate = 2 ; }
 elseif($_SESSION["userRole"] == "8"){ $userstate = 1 ; }
 else{ $userstate = 0 ; }
?>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        
        <?php if($_SESSION['userRole']=='8'){}else{ ?>
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
        <?php } ?>
        
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
                    <form method="POST" action="" name="single_invoice" >    
                        <div class="col-lg-12 col-md-12 col-sm-12" >
                            <table  class="table table-striped table-bordered" style="width:100%;margin-top:0px;">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Tax</th>
                                    <th>Grand Total</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>

                                 <?php 
                                    if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') {
                                        $orderProducts = explode(",", $json[0]['product_id']);
                                        $orderQuantity = explode(",", $json[0]['order_quantity']);
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
                                                <td>
                                                    <input type="hidden" name="product_id[]" value="<?php echo $product_id ; ?>" >
                                                    <input type="hidden" name="order_product_id[]" value="<?php echo $orderDet['id'] ?>" >
                                                    <input type="hidden" name="price[]" value="<?php echo $orderDet['price'];?>"> 
                                                    <?php if($orderData["status"] < $userstate){ ?> 
												    <input type="number" name="quantity[]"readonly="" value="<?php echo $orderDet["quantity"]; ?>"  style="width:55px;" id="qnt" onchange="antpr(this.value,'<?php echo $orderDet['price']; ?>','<?php echo $orderDet['id']; ?>','<?php echo $orderDet['tax']; ?>');" onkeyup="antpr(this.value,'<?php echo $orderDet['price']; ?>','<?php echo $orderDet['id']; ?>','<?php echo $orderDet['tax']; ?>');" required />
												    <?php } else{ 
												      echo $orderDet["quantity"]; 
												    } ?>    
												</td>
                                                <td><?php echo $orderDet['price']; ?></td>
												<td><span id="total_price<?php echo $orderDet["id"] ?>"><?php echo $orderDet['total_price']; $tot_price += $orderDet['total_price']; ?></span></td>
												<td><span id="gst_price<?php echo $orderDet['id'];  ?>"><?php echo $orderDet["tax"] ; $totaltax += $orderDet["tax"] ; ?></span></td>
												<td><span id="grand_price<?php echo $orderDet['id'];  ?>"><?php echo $orderDet["grand_total"] ; $grandtotal += $orderDet["grand_total"] ; ?></span></td>
                                                
                                                <td class="img-profile">
                                                    <img src="<?php echo $proData['product_img']; ?>" style="height:50px;width:50px;border-radius:10px;" />
                                                </td>
                                                <td class="img-profile">
                                                    <?php if($orderData["status"] < $userstate){ ?> 
                                                    <img src="images/remove-icon-png-15.png" style="width: 35px;height: 35px;" onclick="deleteItem(<?php echo $_GET['raw_id']; ?>,<?php echo $orderDet['id']; ?>)" />
                                                    <input type="hidden" name="allPrdID1[]" value="<?php echo $proData['id']; ?>" />
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                    <?php $i++; }
                                    } else {

                                    }
                                    ?>
                                    
                                    <tr>
                                        <td colspan="4" class="text-right">SubTotal</td>
                                        <td ><?php echo $tot_price ; ?></td>
                                        <td ><?php echo $totaltax ; ?></td>
                                        <td colspan="3"><?php echo $grandtotal ; ?></td>
                                    </tr>
                                    <?php if($orderData["discount_type"]){ ?>
                                    <tr>
                                        <td colspan="6" class="text-right">Discount</td>
                                        <td colspan="3"><?php echo $orderData["discount"]; ?></td>
                                    </tr>
                                    <?php } ?>
                                    
                                <tbody id="prdctData">
                                   
                                </tbody>

                            </table>
                            <?php if (empty($i)) {
                                $i=0;
                            }?>
                            <input type="hidden" id="cot" name="cot" value="<?php echo $i; ?>" />
                        
                        <?php if($orderData["discount_type"]){ ?>    
                             <a href="new_invoice.php?id=<?php echo $_GET['raw_id'];?>" class="btn btn-success btn-lg pull-right"><i class="fa fa-print"></i> Submit For Invoice</a>
                        <?php }else{ ?>    
                            <?php if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') { ?>
                             
                              <?php if($orderData["status"] < $userstate){ ?> 
                              <input type="submit"  name="Recieved" value="Update" id="updatesec" class="btn btn-success btn-lg pull-right" />
                              <?php } ?>
                            
                            
                            <?php } ?>
                        <?php } ?>
                        
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($orderData["discount_type"]){  }else{  if($_SESSION["userRole"] == 1 || $_SESSION["userRole"] == 2){ ?>
        <div class="box" style="margin-top: 20px;">
            <div class="box-header with-border">
                <h3 class="box-title"><center>Discount</center></h3>
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
                        <form action="" method="post">
                            <div class="col-lg-12 col-md-12 col-sm-12" >
                               <h4></h4>
                               <div class="col-md-4">
                                   <input type="number" class="form-control" min="1" name="discount" required>
                               </div>
                               <div class="col-md-4">
                                   <select class="form-control" name="discount_type" required>
                                       <option value="1">Flat</option>
                                       <option value="2">Percentage</option>
                                   </select>               
                               </div>
                               <div class="col-md-4">
                                   <button type="submit" name="add_discount" value="Add Discount" class="btn btn-success">Apply Discount</button> 
                                   <a href="new_invoice.php?id=<?php echo $_GET['raw_id'];?>" class="btn btn-warning pull-right"><i class="fa fa-print"></i> Submit Without Discount</a>
                               </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>    
        <?php } } ?>
        
        <?php if($orderData["status"] < $userstate){ ?> 
         <div class="box" style="margin-top: 20px;display:none;">
            <div class="box-header with-border">
                <h3 class="box-title">Add New Product</h3>
            </div>
            <div class="box-body main_div">
                 <form method="POST" action="" name="single_invoice" >    
                        <div class="col-lg-12 col-md-12 col-sm-12" >
                            <div class="form-group">
                                <?php 
                                if(isset($err)) { echo'<div style="color:red">'.$err.'</div>';  }
                                if(isset($_GET['err'])) { echo'<div style="color:red">Error to'.$_GET['err'].'</div>'; }
                                ?>
                                <label class="control-label">Product Name:</label>
                                <select id="pd" name="product_id" class="form-control selectpicker" required data-max-options="20" onchange="showvariation(this.value)">
                                    <option value="">Select Product</option>
                                    <?php
                                        if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') {
                                        $sql = mysqli_query($conn,"SELECT *  FROM product where active='1' AND id NOT IN (select product_id from order_product where order_id = '".$_GET["raw_id"]."')");
                                        } else {
                                            $sql = mysqli_query($conn,"SELECT *  FROM product where active='1'");
                                        }
                                        while($row=mysqli_fetch_array($sql)){
                                    ?>
                                    <option value="<?php echo $row['id']; ?>" data-tokens="<?php echo $row['p_technical_name']; ?>"><?php echo $row['p_technical_name']; ?></option>
                                        <?php } ?>
                                </select>  
                            </div>
                            
                            <div id="variations"></div>
                            
                            <div class="form-group pt-2">
                                <label class="control-lable">Quantity</label>
                                <input type="number" min="1" value="1" name="quantity" class="form-control" required>
                            </div>
                            
                            
                            <div class="form-group">
                                <?php
                                    if(isset($_GET['raw_id']) && $_GET['raw_id'] != '')
                                    {
                                        ?><button type="submit" name="addUpdt" id="nw" value="Add" class="btn btn-success">Add Product To Order</button><?php
                                    }
                                    else
                                    {
                                        ?><button type="button" id="add" value="Add">Add</button><?php
                                    }

                                ?>
                            </div>
                        </div>
                    </form>    
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
                    alert(responce);
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

           alert(button_id);

      }); 
      
      
      
function antpr(qun,price,id,gst)
{
   // alert(qun+price);
    $('#total_price'+id).html(qun*price);
    
    $('#gst_price'+id).html((qun*price)*gst/100);
    
    $('#grand_price'+id).html(((qun*price)*gst/100) + (qun*price));
    
       $('#updatesec').trigger('click');
    
}

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