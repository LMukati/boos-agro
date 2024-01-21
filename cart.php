<?php include('layout/connect.php');
session_start();

if(!isset($_SESSION['userId'])) {
    header("Location:index.php");
    exit();
}

//echo "<pre>"; print_r($json[0]); die;
include('layout/header1.php');
?>

<?php 
if(isset($_GET['del_pro']))
{
	$pid=$_GET['del_pro'];
	$sql=mysqli_query($conn,"delete from temp_order where customer_id='".$_SESSION['userId']."' and product_id='".$pid."'");
	    echo "<script>window.location.href='cart.php';</script>";
}

if(isset($_POST["cart_id"]))
{
    mysqli_query($conn,"update temp_order set order_quantity = '".$_POST["quantity"]."',price='".$_POST["price"]."',total_price ='".$_POST["total_price"]."' where id = '".$_POST["cart_id"]."'") ;
}

?>

 <?php 
                                 
    if(isset($_POST['addtocart']) && $_POST['addtocart'] != '') {
       
        $j = 1;
		$pro_id = $_POST['chk_product'];	
		$price_id = $_POST['price'];
		$quantity = $_POST['quantity'];
		
		$gp = mysqli_query($conn,"SELECT * FROM `product_price` WHERE id='$price_id'");
		$GPP = mysqli_fetch_assoc($gp);
		
		$unit = $GPP["unit"].' '.$GPP['unit_type'] ;
		$price = $GPP["dealer_price"] ;
		
		$total_price = $price*$_POST['quantity'] ;
		$user_id = $_SESSION['userId'] ;

		$qq=mysqli_query($conn, "SELECT * FROM temp_order WHERE customer_id = '".$_SESSION['userId']."' and product_id ='".$pro_id."' and price_id = '".$price_id."'");
		$count=mysqli_num_rows($qq);
		$carq = mysqli_fetch_assoc($qq);
		if($count<1)
		{
		 	$sql = "INSERT INTO `temp_order`(`customer_id`, `product_id`, `price_id`, `order_quantity`, `unit`, `price`, `total_price`, `created_on`) 
		 	VALUES ('$user_id','$pro_id','$price_id','$quantity','$unit','$price','$total_price','".date("Y-m-d H:i:s")."')";
            $result = mysqli_query($conn,$sql);
		}
		else
		{
		    $orquan = $carq["order_quantity"] + 1 ;
		    $usql = "UPDATE `temp_order` SET `order_quantity`= $orquan WHERE id='".$carq["id"]."'";  
		    mysqli_query($conn,$usql);
		}
		
		
		//update quantity
		$newqun = $GPP["stock"] - $quantity ;
		$ustock = "UPDATE `product_price` SET `stock`= $newqun WHERE id='".$price_id."'";  
		mysqli_query($conn,$usql);
	}	
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
</style>   
<div class="content-wrapper">
    
    <div class="alert alert-success" id="success-alert" style="display: none;">
        <strong>Success!</strong> Product removed successfully.
    </div>
    
<link rel="stylesheet" href="css/bootstrap-select.css"> 


<form method="POST" action="createorder.php" name="single_invoice" >
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box" style="margin: 20px auto 0 auto;">
            <div class="box-header with-border">
                <h3 class="box-title"><center>Cart Order Product</center></h3>
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
                   
                        <div class="col-lg-12 col-md-12 col-sm-12" >
							<table  class="table" style="width:100%;margin-top:-30px;" id="example">
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
                                <tbody>
							    <?php	$j = 1 ; $totalp = 0 ;		   
								   $sql2=mysqli_query($conn, "SELECT * FROM temp_order WHERE customer_id = '".$_SESSION['userId']."'");
								   while($data =mysqli_fetch_array($sql2))
								   {   
									  $ppid =  $data['product_id'] ;
									  $sql1 = mysqli_query($conn, "SELECT * FROM product WHERE id = '".$ppid."'");
                                      $proData = mysqli_fetch_assoc($sql1); 
                                ?>
                                    <tr>
                                        <td><?php echo $j; ?></td>
                                        <td><?php echo $proData['product_name']; ?></td>
                                        <td><?php echo $data['unit']; ?></td>
                                        <td><input type="number" name="quantity[]" min="1" value="<?php echo $data['order_quantity']; ?>" style="width:55px;" id="qnt" onchange="antpr(this.value,'<?php echo $data['price']; ?>','<?php echo $data['id'];  ?>','<?php echo $proData['gst'];  ?>');" onkeyup="antpr(this.value,'<?php echo $data['price']; ?>','<?php echo $data['id'];  ?>','<?php echo $proData['gst'];  ?>');" /></td>
										<td><?php echo $data['price']; ?></td>
                                        <td><span id="total_price<?php echo $data['id'];  ?>"><?php $totalp += $data['total_price']; echo $data['total_price']; ?></span></td>
										<td><?php echo $proData["gst"].'%' ?></td>
										<td><span id="gst_price<?php echo $data['id'];  ?>"><?php $gstp += $data['total_price']*$proData['gst']/100 ; echo $data['total_price']*$proData['gst']/100 ; ?></td>
										<td><span id="grand_price<?php echo $data['id'];  ?>"><?php $grandp += $data['total_price']*$proData['gst']/100 + $data['total_price'] ; echo $data['total_price']*$proData['gst']/100 + $data['total_price'] ; ?></td>
										<td class="img-profile"><img src="<?php echo $proData['product_img']; ?>" /></td>
										<td>
                                        <input type="hidden" name="product_id[]" value="<?php echo $proData['id']; ?>" />
                                        <input type="hidden" name="unit[]" value="<?php echo $data['unit']; ?>" >
                                        <input type="hidden" name="price[]" value="<?php echo $data['price']; ?>" >
                                        <input type="hidden" name="tax[]" value="<?php echo $proData['gst']; ?>" >
                                        <a class="btn btn-success" href="?del_pro=<?php echo $proData['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                 
									<?php 
									$j++; }
									if($j > 1) { ?>
									<tr>
									    <td colspan="5" class="text-right">Total</td>
									    <td colspan="2"><?php echo $totalp ; ?></td>
									    <td><?php echo $gstp ; ?></td>
									    <td colspan="3"><?php echo $grandp ; ?></td>
									</tr>
									<tr>
									    <td colspan="9" style="background:#f2f2f2"><span class="pull-right"><b>Payment Type : </b></span></td>
									    <td ><input type="radio" name="payment_method" value="DPL" checked> DPL</td>
									    <td ><input type="radio" name="payment_method" value="CASH" checked> CASH</td>
									</tr>
									<tr>
									    <td colspan="11">
									        <input type="submit" name="sub" value="Proceed To Order" class="pull-right btn btn-success btn-lg">
									        <a href="product_list.php" class="btn btn-warning btn-lg">Add More Product</a>
									   </td>
									</tr>
									<?php  }  ?>
								</tbody>	
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
</div>


<form id="cart_update" action="" method="post">
    <input type="hidden" name="cart_id" id="cart_id">
    <input type="hidden" name="quantity" id="cart_quantity">
    <input type="hidden" name="price" id="cart_price">
    <input type="hidden" name="total_price" id="cart_total_price">
</form>


  <!-- /.content-wrapper -->
<?php include('layout/footer1.php'); ?>
<script src="js/bootstrap-select.js"></script>

<script>

function myDeleteFunction(btn) {
	   var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
  //document.getElementById("myTable").deleteRow(1);
  return true;
}    
</script>

<script type="text/javascript">




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
    $('#total_price'+id).html(qun*price);
    
    $('#gst_price'+id).html((qun*price)*gst/100);
    
    $('#grand_price'+id).html(((qun*price)*gst/100) + (qun*price));
    
    $('#cart_id').val(id);
    $('#cart_quantity').val(qun);
    $('#cart_price').val(price);
    $('#cart_total_price').val(qun*price);
    $('#cart_update').submit() ;
}
      
      
</script>
