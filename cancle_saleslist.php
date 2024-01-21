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
<script type="text/javascript">
   
    </script>
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
    .modal-content.product-details-modal {
      width: 85%;
      margin: 94px auto;
      border-radius:8px;
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
          <h3 class="box-title"><center>Reject List</center></h3>
            
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
          <table class="table table-bordered" id="example">
            
            <thead>
              <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
           <?php
           if($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2'){

              $data_details="SELECT * FROM order_details WHERE status = '8'";

              $sql=mysqli_query($conn,$data_details);
              $i=1;
              while ($row=mysqli_fetch_assoc($sql)) {  ?>

                 <tr>
                         <td><?php echo $i; ?></td>
                         <td><?php 
                                    $sqluser=mysqli_query($conn,"SELECT * FROM users WHERE id='".$row['customer_id']."'");
                                    $resultUser= mysqli_fetch_array($sqluser);
                                    ?><?php echo $resultUser['firm_name'] ; ?>
                         </td>
                         <td>
                            <?php
                                 $pro_id="SELECT * FROM product where id IN (SELECT product_id FROM order_product where order_id = '".$row["id"]."')";
                                 $sql2 = mysqli_query($conn,$pro_id );
                                 $j=1;
                                 while($res_pro=mysqli_fetch_array($sql2))
                                 {
                                    echo $j.'.'. $res_pro['p_technical_name'].'<br>'; 
                                    $j++;
                                 }
                           ?>
                         </td>
                         <td>
                           <?php 
                                  $quon ="select SUM(quantity) as quan from order_product WHERE order_id = '".$row['id']."'";
                                  $quan = mysqli_query($conn,$quon );
                                  $quant = mysqli_fetch_array($quan) ;
                                  echo $quant["quan"] ;
                           ?>
                         </td>
                         <td><?php echo $row['created_on']; ?></td>
                         <td><?php echo $row['total_price']; ?></td>
                    <td>
                           <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?> 
        						<?php  
        						  if($row["status"] > 1 && $row["status"] < 8)
        						  {
                                    $unm = "select * from users where id = (select user_role_id from order_approved where order_id = '".$row["id"]."' order by id desc limit 1)";
                                    $unme = mysqli_query($conn,$unm);
                                    $unam = mysqli_fetch_array($unme);
                                    echo " (".$unam["first_name"].' '.$unam["lastname"].")" ;
                                  }
        						?>
						   </p>
                    </td>
                    <td>
                       <?php /* if($row['status'] < 7){ ?> 
                        <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&iddr=<?php echo $_SESSION['userId'];?>" class="btn btn-warning">Click to approve</a>
                       <?php } */ ?>    
                       <a href="view_invoice.php?id=<?php echo $row['id']; ?>" class="btn btn-success ">View</a>
                        <!--<a href="delete_order.php?d_Order=<?php echo $row['id']; ?>&red=sales_list.php" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Reject</a>-->
                    </td>
                </tr>
                
              <?php $i++;} ?>


          <?php }
     ?>
            </tbody>
          </table>
                    
  </div>
<!--</form>-->

        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
$(document).ready(function() {
    //$('#example').DataTable();
    var table = $('#example').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
});
</script>
<?php include('layout/footer1.php'); ?>