<?php
include('layout/connect.php');

session_start();
//print_r($_SESSION);die;
if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
//echo "<pre>"; print_r($_POST); die;

 ?>
 <!DOCTYPE html>
<html>
<head>
  <title>Boss Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style-2.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

</style>
</head>
<body>
<!--<button type="button" id="cmd">Generate PDF</button>-->
<p class="text-center">
<button type="button" class="btn btn-info" onclick="printDiv()"><span class="glyphicon glyphicon-print"></span> Print Invoice</button>
</p>
	<!--<a href="#" class="btn btn-info btn-lg" id="printInvoice" style="float:right;margin-right: 40px;margin-top: 20px">
          <span class="glyphicon glyphicon-print"></span> Print
    </a>-->
    
	<div class="container boss-invoice-container"  id="content"><!--Container-->
		<div class="row invoice-company-row" style="width:100%"><!--invoice-company-row-->
			<div class="col-lg-6 cpl-md-6 col-sm-6 boss-agro" style="    width: 50%;"><!--grid-->
				<h3><strong>Boss Agro Chemical Pvt. Ltd.</strong></h3>
				<p><span><strong>Address:</strong></span>
					<span>73, Sarvodaya Nagar, Near Hablani Parisar, </span>
					<span>Sapna Sangeeta Road, Indore - 452001 (M.P.),</span> 
					<span>Phone: 0731-2468111, 4274888, </span>
					<span>Email: bossagrochem@gmail.com,</span> 
					<span>Web: www.bossagro.com</span>
				</p>
			</div><!--grid-->

			<div class="col-lg-6 cpl-md-6 col-sm-6 boss-invoice" style="    width: 50%;"><!--grid-->
				<h3><strong>Invoice</strong></h3>
				<div class="table-responsive"><!--table-responsive-->
					<form >
				<table class="table text-center">
						<tbody>
							
							<tr style="width:100%">
								<td style="width:20%">Invoice Date</td>
								<?php 	$date = date("d-m-Y"); ?>	
								<td style="width:80%"><?php echo $date; ?></td>
								<input type="hidden" name="invoice_date" value="<?php $date1 = date("Y-m-d"); echo $date1 ; ?>">
							</tr>
							<tr>
								<td>Invoice#</td>	
								<?php $digits = 4;
								$rand = rand(pow(10, $digits-1), pow(10, $digits)-1);
								 ?>
								<td><?php echo $rand; ?></td>
								<input type="hidden" name="invoice_code" value="<?php echo $rand; ?>">
							</tr>
							<tr>
								<td>Customer ID</td>	
								<td><?php echo $_POST['customer_id']; ?></td>
								<input type="hidden" name="c_id" value="<?php echo$_POST['customer_id'];  ?>">
							</tr>
							
						</tbody>
					</table>
				</div><!--table-responsive-->
			</div><!--grid-->

		</div><!--invoice-company-row-->

		<div class="row bill-to-row"><!--bill-to-row-->
			<div class="col-lg-6 cpl-md-6 col-sm-6 bill-to-section"><!--grid-->
		
				<h4>BILL TO</h4>
				<?php

				$sql= mysqli_query($conn,"SELECT * FROM users WHERE id = '".$_POST['customer_id']."'");
				$row=mysqli_fetch_assoc($sql);
				//echo "<pre>";print_r($row);die;

				$sql1= mysqli_query($conn,"SELECT * FROM `countries` WHERE id = '".$row['country']."'");
				$countries=mysqli_fetch_assoc($sql1);
				$sql2= mysqli_query($conn,"SELECT * FROM `states` WHERE id = '".$row['state']."'");
				$states=mysqli_fetch_assoc($sql2);
				$sql3= mysqli_query($conn,"SELECT * FROM `cities` WHERE id = '".$row['city']."'");
				$cities=mysqli_fetch_assoc($sql3);


				 ?>
				<p><?php echo $row['first_name'].' '.$row['last_name'];?></p>
				<!-- <p>Ananya Pvt. Ltd.</p> -->
				<p><?php echo $cities['name'];?> </p>
				<p><?php echo $states['name'] ;?> ,<?php echo $countries['name']; ?></p>
				<p><?php echo $row['phone']; ?></p>

			</div><!--grid-->
		</div><!--bill-to-row-->

		<div class="row bill-description-row"><!--bill-description-row-->
			<div class="table-responsive"><!--table-responsive-->
					<table class="table table-striped">
						<thead>
							<tr>
								<td style="width:5%;">No.</td>
								<td style="width:20%;">Products Code</td>
								<td style="width:45%;">Products</td>
								<td style="width:15%;">HSN Code</td>
							
								<td style="width:15%;">Quantity</td>
								<td style="width:15%;">Rate/ Unit Price (in &#8377;)</td>
								<td style="width:15%;">Amount (in &#8377;)</td>
							</tr>
						</thead>

						<tbody>
							<?php 
							
								$i=1;
								$j=0;
								$quantity=explode(',' , $_POST['prdqty']); 
								// foreach($quantity as $rid => $pid) 
								// {

								 $p_id=$pid;
								 $pro_id=$pid;
							
								  // $sql= mysqli_query($conn,"SELECT * FROM product WHERE id IN(".$_POST['prdID'].")");
								  
								   $order_prod = mysqli_query($conn,"select * from order_product inner join product on product.id = order_product.product_id where order_product.order_id = '".$_POST["order_id"]."'");	
								  	
								  	while($row=mysqli_fetch_array($order_prod)){ ?>
							<tr>
								 <input type="hidden" name="pro_id[]" value="<?php echo $row['id']; ?>">
								 <input type="hidden" name="order_id" value="<?php echo $_POST['order_id']; ?>">
								<td><?php echo $i; ?></td>
								<td><?php echo $row['product_code']; ?></td>
								<td><?php echo $row['p_technical_name']; ?> </td>
								<td><?php echo $row['hsn_code']; ?> </td>

								  
								<td><?php echo $row["quantity"]; ?></td>
								<input type="hidden" name="order_qty[]" value="<?php echo $row["quantity"] ; ?>" >
								<td><?php echo $row["price"] ; ?></td>
								<td><?php echo $row["total_price"] ; ?></td>
								<?php// } ?>
							</tr>
							<?php $gst += $row['gst']; $i++;
									$j++;	
						}
							 ?>
							
						</tbody>
						<?php
						   $orderd = mysqli_query($conn,"select * from order_details where id = '".$_POST["order_id"]."'");
						   $order_detail = mysqli_fetch_array($orderd);
						   $totalprice  = $order_detail["total_price"];
                		 ?>
						<tfoot>
						    <tr>
						    	<td></td>
						    	<td></td>
						    	<td></td>
						    	<td></td>
								<td></td>
								
						      
								  <?php
								if($_POST['dis']){
								$totalprice=$totalprice-$totalprice*$_POST['dis']/100;
									//echo $p;die;
								?>
								<input type="hidden" name="discount" value="<?php echo $_POST['dis']; ?>">
								<td>Discount(%)</td>
								
								<td><?php echo $_POST['dis']; ?></td><br>
								<td class="odd">Subtotal</td>
						      	<td class="odd"><?php echo $totalprice; ?></td>
								<?php }else{
								?>
									<td class="odd">Subtotal</td>
								  <td class="odd"><?php echo $totalprice; ?></td>
								<?php } ?>
						    </tr>
						    <tr>
						    	<td></td>
						    	<td></td>
						    	<td></td>
						    	<td></td>
							    <td></td>    
						      	<td class="even">GST Tax(%)</td>
						      	<?php $tax= $totalprice*( $gst/100 ); ?>
						      	<td class="even"><?php echo $tax; ?></td>
						    </tr>
						    <?php $sql="SELECT state FROM users WHERE id = '".$_SESSION['userId']."'";
                                  $result=$conn->query($sql);
                                  while($row=$result->fetch_assoc()){
                          
                              if ($row['state']=='21') {
                              	?>
                              	<tr>
						    	<td></td>
						    	<td></td>
						    	<td></td>
						    	<td></td>
								<td></td>
						      	<td class="odd">CGST</td>
                                <?php $cg=$tax/2; ?>
						      	<td class="odd"><?php echo $cg; ?></td>
						    </tr>
						     <tr>
						    	<td></td>
						    	<td></td>
						    	<td></td>
						    	<td></td>
							    <td></td>
						      	<td class="odd">SGST</td>
                                <?php $cg=$tax/2; ?>
						      	<td class="odd"><?php echo $cg; ?></td>
						    </tr>
                              	<?php
                              } else{
						    ?>
						     <tr>
						    	<td></td>
						    	<td></td>
						    	<td></td>
						    	<td></td>
							    <td></td>
						      	<td class="odd">IGST</td>
       
						      	<td class="odd"><?php echo $tax; ?></td>
						    </tr>
						    <?php } }?>
						    <tr>
						    	<td></td>
						    	<td></td>
						    	<td></td>
						    	<td></td>
								<td></td>
						      	<td class="odd">Grand Total</td>
						      	<?php  	$gTotal= $totalprice+$tax; ?>
						      	<td class="odd"><?php echo $gTotal; ?></td>
						   
						   
							<input type="hidden" name="grand_total" value="<?php echo $gTotal; ?>"> 

						    </tr>
						    
						    
						</tfoot>

					</table>
				</form>
				</div><!--table-responsive-->
				
		</div><!--bill-description-row-->

		<div class="row bill-comment-row"><!--bill-comment-row-->
			<div class="col-lg-6 col-md-6 col-sm-6 comment-section">
				<div class="my-comments">
					<h4>Other Comments</h4>
					<ol type="1">
						<li>Total payment due in 30 days</li>
						<li>Please include the invoice number on your check</li>
					</ol>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<p style="text-align:center; width:100%; margin:0 auto; font-weight:bold;">Make all checks payable to</br>
				(Boss Agro Chemical Private Limited)</p>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 text-center">
				<p style="text-align:center; margin-top:20px; font-size:15px;">If you have questions about this invoice, please contact</br>
				<strong>(Ananya Shenoy, 09587412568, bossagrochem@gmail.com)</strong></p>
				<p style="font-size:15px;font-weight:bold; margin-top:20px;">THANK YOU FOR YOUR BUSINESS</p>
			</div>
		</div><!--bill-comment-row-->

	</div><!--Container-->

<script type="text/javascript">

$('#printInvoice').on('click', function(){
	//alert('hh');
var invoice=$('form').serialize();

jQuery.ajax({
                        type:'POST',
                        url:'submit_product.php',
                        data:{invoice},
                        dataType: "json",
                        success:function(data){
                        	//console.log(data);

	window.print();
	window.location.href="sales_list.php";
},
});
	//alert('hhhh');

});

</script>
</body>

</html>


<div id="editor"></div>
<div id="editor1">
    <img src="" id="out1" style="width:100%">
</div>

<!--<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>-->

<script>
    
/*

$('#cmd').click(function () { 
    var element = $("#content"); // global variable
    var getCanvas; // global variable
     
    html2canvas(element, {
         onrendered: function (canvas) {
                //$("#editor1").append(canvas);
                getCanvas = canvas;
                var imgageData = getCanvas.toDataURL("image/png");
                    // Now browser starts downloading it instead of just showing it
                    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                    $("#out1").attr("alt", "your_pic_name.png").attr("src", newData);
                    
                    var pdf = new jsPDF();
                    pdf.addImage(newData, 'png', 0, 0);
                    pdf.save('screenshot.pdf');
             }
    });


    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    doc.fromHTML($('#content').html(), 15, 15, {
        'elementHandlers': specialElementHandlers
    });
   doc.save('sample-file.pdf');
   
    
});*/

/*
function printDiv() 
{
    
    var element = $("#content"); // global variable
    var getCanvas; // global variable
     
    html2canvas(element, {
         onrendered: function (canvas) {
                //$("#editor1").append(canvas);
                getCanvas = canvas;
                var imgageData = getCanvas.toDataURL("image/png","1.0");
                    // Now browser starts downloading it instead of just showing it
                    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                    $("#out1").attr("alt", "your_pic_name.png").attr("src", newData);
                  
             }
    });
    

  var divToPrint=document.getElementById('editor1');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
*/
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

