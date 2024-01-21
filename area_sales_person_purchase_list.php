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
  //print_r($id);die;
      include('layout/connect.php');
      $sql3 = mysqli_query($conn, "SELECT statusname FROM status where id ='".$id."'");
      $row3 = mysqli_fetch_assoc($sql3);
      return $row3['statusname'];
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
      <div class="box">
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
        <!--<form method="POST"  name="single_invoice"  >-->
        <div class="tab">
          <?php if($_SESSION['userRole']=='7' || $_SESSION['userRole']=='6'){ ?>
              <table class="table table-bordered" id="rawData">
                <thead>
                <tr>
                    <th style="width:3%">S.no</th>
                    <th style="width:7%">OrderID</th>
                    <th>Order Date</th>
                    <th>Firm Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $city = "SELECT * FROM users where id = '".$_SESSION['userId']."'";
                      $sql4=mysqli_query($conn,$city);
                      $citiess = mysqli_fetch_assoc($sql4);
                      $dataQuery = "SELECT * FROM users INNER JOIN order_details  ON  users.id = order_details.customer_id WHERE order_details.active = 1 
                                    AND order_details.status < 3 AND users.allot_to IN (select id from users where allot_to = '".$_SESSION["userId"]."')" ;
            
                      $data_details=mysqli_query($conn,$dataQuery);
                      $i=1;
                      while ($row=mysqli_fetch_assoc($data_details)) 
                      {  ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row["id"] ; ?></td>
                            <td><?php $date = $row['created_on'];
                                    $dt = new DateTime($date);
                                    
                                    echo $dt->format('d-m-Y');
                                    ?></td>
                            <td><?php echo $row["firm_name"] ; ?></td>
                            <td>
                               <?php 
                                      $quon ="select SUM(quantity) as quan from order_product WHERE order_id = '".$row['id']."'";
                                      $quan = mysqli_query($conn,$quon );
                                      $quant = mysqli_fetch_array($quan) ;
                                      echo $quant["quan"] ;
                               ?>
                            </td>
                            <td><?php echo $row['total_price']; ?></td>
                            <td>
                               <span style="color:green;">
                                   <?php print_r(getUserStatus($row['status'])); ?>
                                   <?php 
                                   if($row["status"] > 1 && $row["status"] < 8){
                                   $unm = "select * from users where id = (select user_role_id from order_approved where order_id = '".$row["id"]."' order by id desc limit 1)";
                                   $unme = mysqli_query($conn,$unm);
                                   $unam = mysqli_fetch_array($unme);
                                   echo "(".$unam["first_name"]." ".$unam["last_name"].")";
                                   }
                                   ?>
                               </span>
                            </td>
                    <td>
                      <?php if($_SESSION['userRole'] == 6 && $row['status'] < 3) { ?>
                         <a onclick="return confirm('Are you sure to approve ?')" href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&idasm=<?php echo $_SESSION['userId'];?>" class="btn btn-warning">Send For Approve</a>
                      <?php } ?>
                      
                      <a href="view_invoice.php?id=<?php echo $row['id']; ?>&date=<?php echo $dt->format('d-m-Y');?>" class="btn btn-success ">View</a>
                      <?php if($row['status'] > 3){}else{ ?>
                      <a href="delete_order.php?d_Order=1&amp;red=area_sales_person_purchase_list.php" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Reject</a>
                      <?php } ?>
                    </td>
                     </tr>
                
               <?php $i++;}  ?>
               </tbody>
            </table>
          <?php  } ?>
        </div>
        <!--</form>-->

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