<?php
include('layout/connect.php');
session_start();
if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
    include('layout/header1.php');
    
    function getUserStatus($id) {
      include('layout/connect.php');
      $sql3 = mysqli_query($conn, "SELECT statusname FROM status where id ='".$id."'");
      $row3 = mysqli_fetch_assoc($sql3);
      return $row3['statusname'];
    }
    
if(isset($_POST["cancle"]))
{
    $order_id = $_POST["order_id"];
    mysqli_query($conn,"UPDATE `order_details` SET `status`='8',`active`='0' WHERE id = '$order_id'");
}
    
?>
<style>
    .row.product-margin div {
    border: 1px solid #eee;
    padding: 10px 10px;
        text-align: left;
}
</style>

<div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box" style="margin: 20px auto 0 auto;">
        <div class="box-header with-border">
          <h3 class="box-title"><center>Purchase List</center></h3>
            
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body main_div">
        <div class="tab">

   <?php if($_SESSION['userRole']=='8' ){ ?>

    <table class="table table-bordered" id="rawData">
                <thead>
                    <tr>
                        <th style="width:3%">S.no</th>
                        <th  style="width:7%">OrderID</th>
                        <th>Order Date</th>
                        <th>Order Amount</th>
                        <th>Tax</th>
                        <th>Total Order Amount</th>
                        
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                      $data_details=mysqli_query($conn,"SELECT * FROM order_details WHERE customer_id = '".$_SESSION['userId']."' AND active = 1" );
                      $i=1;
                      while ($row=mysqli_fetch_assoc($data_details)) {  
                          
                          $orderdata = mysqli_query($conn, "select SUM(total_price) as productprice, SUM(tax) as tax, SUM(grand_total) as grandtotal from order_product where order_id = '".$row["id"]."'") ;
                          $orderdetail = mysqli_fetch_array($orderdata);
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["id"] ; ?></td>
                    <td><?php echo $row['created_on']; ?></td>
                   <td><?php echo $orderdetail['productprice']; ?></td>
                   <td><?php echo $orderdetail['tax']; ?></td>
                   <td><?php echo $orderdetail['grandtotal']; ?></td>
                   
                   <td><span style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></span></td>
                   <td>
                       <a href="view_invoice.php?id=<?php echo $row['id']; ?>&date=<?php echo $row['created_on']; ?>" class="btn btn-success ">View</a>
                       <!--<a href="delete_order.php?d_Order=<?php echo $row['id']; ?>&red=dealer_order_list.php" onclick="return confirm('Are you sure ?')" class="btn btn-danger ">Delete</a>-->
                       
                   </td>
                </tr>
            <?php $i++;}   ?>
            </tbody>
          </table>
    <?php } ?>                
  </div>

        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('layout/footer1.php'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#rawData').DataTable();
    var table = $('#example').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
});
</script>