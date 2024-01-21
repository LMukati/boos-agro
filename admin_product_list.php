<?php
    session_start();
    include('layout/connect.php');
    if(!isset($_SESSION['userId'])) {
        header("Location:index.php");
        exit();
    }
    //print_r($_SESSION);die;

    include('layout/header1.php');

    function getUserStatus($id) {
    	include('layout/connect.php');
    	$sql3 = mysqli_query($conn, "SELECT statusname FROM status where id ='".$id."'");
    	$row3 = mysqli_fetch_assoc($sql3);
    	return $row3['statusname'];
    }
?>

<style>
    .pimg{
        height: 50px;
    width: 50px;
    border-radius: 10px;
    }
    .br {
    border-bottom: 1px solid #eee;
    padding: 0 0 11px 0;
}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Product List</h1>
		

		<ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Product List</li>

        </ol>
	</section>
	<section class="content">
		<div class="box" style="margin:0px;">
			<div class="box-header with-border">
					<h3 class="box-title">Finished Product List</h3>
				<div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
						<thead>
					        <tr>
						        <th>No</th>
						        <th>Product Name</th>
						        <th>State</th>
						        <th>MRP</th>
						        <th>DPL</th>
						        <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					        <?php $i = 1 ;
					            $sql1 = mysqli_query($conn, "SELECT * FROM `product` WHERE active = 1 order by id desc");
                                while($proData = mysqli_fetch_array($sql1))
                            	{
					           ?>
					        <tr>
                               <td><?php echo $i ; ?></td>
                               <td><?php echo $proData["product_name"]; ?></td>
                               <td><?php echo ""; ?></td>
                               
                               
                               <th>
                                <?php   
                                    $sql = mysqli_query($conn, "SELECT * FROM `product_price` WHERE product_id = '".$proData["id"]."'");
                                    while($price = mysqli_fetch_array($sql))
                                    {
                                       echo $price['unit'].' '.$price['unit_type'].'  '.$price['regular_price'].'<br>' ;
                                    }   
                                ?>   
                               </th>
                               <th>
                                <?php   
                                    $sql = mysqli_query($conn, "SELECT * FROM `product_price` WHERE product_id = '".$proData["id"]."'");
                                    while($price = mysqli_fetch_array($sql))
                                    {
                                       echo $price['unit'].' '.$price['unit_type'].'  '.$price['dealer_price'].'<br>' ;
                                    }   
                                ?>   
                               </th>
                               <td>
                                    <button style="display:none;"class="btn btn-success add-to-cart-button" data-toggle="modal" data-target="#myModal<?php echo $proData["id"]; ?>">View</button>
                                    <a href="edit_product_page.php?product_id=<?php echo $proData["id"]; ?>" class="btn btn-primary">Edit</a>
                                    <a href="manage_stock.php?proid=<?php echo $proData["id"]; ?>" class="btn btn-info">Manage Stock</a>
                                    <a href="make_product.php?danger=<?php echo $proData["id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete ?')">Delete</a>
                               </td>
                           </tr>
                           
                           <div id="myModal<?php echo $proData["id"]; ?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content modal-lg">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">View Product</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h4 id="Productname"  class="br"><?php echo "Name: ". $proData["product_name"]; ?><p class="col-md-6"> Technical Name : <?php echo $proData["p_technical_name"]; ?></p></h4>
                                    <p class="col-md-6 br">HSN Code : <span class="Product"><?php echo $proData["hsn_code"]; ?></span></p>
                                    
                                    <p class="col-md-6 br">GST : <span class="Product"><?php echo $proData["gst"]; ?> %</span></p>
                                    <p class="col-md-12 br">Description : <span class="Product"><?php echo $proData["pro_discription"]; ?></span></p>
                                    <p id="priceview">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;">Image</div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;">Unit</div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;">Unit type</div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;">Batch</div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;">MRP</div>
                                                    <div class="col-md-2 col-xs-2" style="border:1px solid #eee;padding:5px;">Dealer Price</div>
                                                    
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;">Stock</div>
                                                </div>
                                                <?php 
                                                 $psql = mysqli_query($conn, "SELECT * FROM `product_price` WHERE product_id = '".$proData["id"]."'");
                                                 while($pricep = mysqli_fetch_array($psql)){
                                                ?>     
                                                <div class="row" style="display: flex;">
                                                    <div  style="border:1px solid #eee;padding:5px;">
                                                        <img src="<?php echo  $pricep['image'] ; ?>" style="width:100%">
                                                    </div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;"><?php echo  $pricep['unit'] ; ?></div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;"><?php echo  $pricep['unit_type'] ; ?></div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;"><?php echo  $pricep['batchcode'] ; ?></div>
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;"><?php echo  $pricep['regular_price'] ; ?></div>
                                                    <div class="col-md-2 col-xs-2" style="border:1px solid #eee;padding:5px;"><?php echo  $pricep['dealer_price'] ; ?></div>
                                                   
                                                    <div class="col-md-1 col-xs-1" style="border:1px solid #eee;padding:5px;"><?php echo  $pricep['stock'] ; ?></div>
                                                </div>
                                                <?php } ?>
                                    </p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                            
                              </div>
                            </div>
                           
                           <?php $i++ ; } ?>
					    </tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
   

<?php include('layout/footer1.php');?>
<script src="js/jquery.magnify.js"></script>


<script>
    $('#dataTable').DataTable();
</script>


