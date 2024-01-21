<?php
include('layout/connect.php');
session_start();
if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
    include('layout/header1.php');
?>
<script type="text/javascript">
    $(document).ready(function() {
       
    });
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
        <form method="POST" action="raw/make_invoice.php" name="single_invoice"  >
        <div class="tab">
          <table class="table table-bordered" id="example">
            
            <thead>
              <tr>
                <th>S.no</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <!-- <th>Price</th> -->
                <th>Order Date</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
           <?php
           if($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2'){

              $data_details="SELECT * FROM order_details";

              $sql=mysqli_query($conn,$data_details);
              $i=1;
              while ($row=mysqli_fetch_assoc($sql)) {  ?>

                 <tr>
                         <td><?php echo $i; ?></td>
                         <td><?php
                                 $pro_id="SELECT * FROM product where id IN (".$row['product_id'].")";
                                    //echo $pro_id;
                                $sql2 = mysqli_query($conn,$pro_id );
                                $j=1;
                          while($res_pro=mysqli_fetch_array($sql2)){
                          //  print_r($res_pro);
                           echo $j.'.'. $res_pro['product_name'].'<br>'; 
                       $j++;}
                           //$res_pro[$i-1]; ?>
                           
                   </td>
                         <td><?php 
                  //  $k=1;
                    
                      # code...
                   $order_quantity=explode(',', $row['order_quantity']);
        foreach ($order_quantity as $key => $value) {
                    echo $value.'<br>';//$order_quantity[$i-1]; 
                } ?></td>
                        <td><?php echo $row['invoice_date']; ?></td>
                    
                    
                    <td><?php echo $row['total_price']; ?></td>
                    <td>
                      <?php if($row['status'] == 7) {
                              ?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php 
                                  } else {  
                                      // echo "string".$row['status'];
                                    ?>
                                    <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&iddr=<?php echo $_SESSION['userId'];?>"><?php print_r(getUserStatus($row['status'])); ?></a>
                                  <?php }?>
                    </td>
                     </tr>
                
              <?php $i++;} ?>


          <?php }
       if($_SESSION['userRole']=='7' || $_SESSION['userRole']=='6')
      {
        $city="SELECT * FROM users where id = '".$_SESSION['userId']."'";
                                  $sql4=mysqli_query($conn,$city);
                                $citiess = mysqli_fetch_assoc($sql4);
        $data_details=mysqli_query($conn,"SELECT * FROM users INNER JOIN order_details 
                                                    ON  users.id = order_details.customer_id WHERE users.city IN ('".$citiess['city']."') " );
            

              $i=1;
              while ($row=mysqli_fetch_assoc($data_details)) {  ?>
 

                 <tr>
                         <td><?php echo $i; ?></td>
                         <td><?php
                                 $pro_id="SELECT * FROM product where id IN (".$row['product_id'].")";
                                    //echo $pro_id;
                                $sql2 = mysqli_query($conn,$pro_id );
                                $j=1;
                          while($res_pro=mysqli_fetch_array($sql2)){
                          //  print_r($res_pro);
                           echo $j.'.'. $res_pro['product_name'].'<br>'; 
                       $j++;}
                           //$res_pro[$i-1]; ?>
                           
                   </td>
                <td><?php 
                       $order_quantity=explode(',', $row['order_quantity']);
                      foreach ($order_quantity as $key => $value) {
                                  echo $value.'<br>';//$order_quantity[$i-1]; 
                              } ?></td>
                        <td><?php echo $row['invoice_date']; ?></td>
                    
                    
                    <td><?php echo $row['total_price']; ?></td>
                    <td>
                      <?php if($row['status'] == 7) {
                              ?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php 
                                  }elseif($_SESSION['userRole'] == 6) {  
                                      // echo "string".$row['status'];
                                    ?>
                                    <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&idasm=<?php echo $_SESSION['userId'];?>"><?php print_r(getUserStatus($row['status'])); ?></a>
                                  <?php } elseif($_SESSION['userRole'] == 7) {  
                                      // echo "string".$row['status'];
                                    ?>
                                    <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&idgsp=<?php echo $_SESSION['userId'];?>"><?php print_r(getUserStatus($row['status'])); ?></a>
                                  <?php }?>
                    </td>
                     </tr>
                
              







              <?php $i++;} 
    }if ($_SESSION['userRole']=='4' || $_SESSION['userRole']=='3' || $_SESSION['userRole']=='5') {
     $state="SELECT * FROM users where id = '".$_SESSION['userId']."'";
                                  $sql4=mysqli_query($conn,$state);
                                $state = mysqli_fetch_assoc($sql4);
        $data_details=mysqli_query($conn,"SELECT * FROM users INNER JOIN order_details 
                                                    ON  users.id = order_details.customer_id WHERE users.state IN ('".$state['state']."') " );
          

              $i=1;
              while ($row=mysqli_fetch_assoc($data_details)) {  ?>
 

                 <tr>
                         <td><?php echo $i; ?></td>
                         <td><?php
                                 $pro_id="SELECT * FROM product where id IN (".$row['product_id'].")";
                                    //echo $pro_id;
                                $sql2 = mysqli_query($conn,$pro_id );
                                $j=1;
                          while($res_pro=mysqli_fetch_array($sql2)){
                          //  print_r($res_pro);
                           echo $j.'.'. $res_pro['product_name'].'<br>'; 
                       $j++;}
                           //$res_pro[$i-1]; ?>
                           
                   </td>
                <td><?php 
                       $order_quantity=explode(',', $row['order_quantity']);
                      foreach ($order_quantity as $key => $value) {
                                  echo $value.'<br>';//$order_quantity[$i-1]; 
                              } ?></td>
                        <td><?php echo $row['invoice_date']; ?></td>
                    
                    
                    <td><?php echo $row['total_price']; ?></td>

                   <td>
                      <?php if($row['status'] == 7) {
                              ?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php 
                                  } elseif($_SESSION['userRole'] == 3) {  
                                      // echo "string".$row['status'];
                                    ?>
                                    <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&idgm=<?php echo $_SESSION['userId'];?>"><?php print_r(getUserStatus($row['status'])); ?></a>
                                  <?php } elseif($_SESSION['userRole'] == 4) {  
                                      // echo "string".$row['status'];
                                    ?>
                                    <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&idzm=<?php echo $_SESSION['userId'];?>"><?php print_r(getUserStatus($row['status'])); ?></a>
                                  <?php } elseif($_SESSION['userRole'] == 5) {  
                                      // echo "string".$row['status'];
                                    ?>
                                    <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&idgrsm=<?php echo $_SESSION['userId'];?>"><?php print_r(getUserStatus($row['status'])); ?></a>
                                  <?php }?>
                    </td>
                     </tr>
                
              







              <?php $i++;} 
    }if($_SESSION['userRole']=='8' ){
         
        $data_details=mysqli_query($conn,"SELECT * FROM order_details WHERE customer_id = '".$_SESSION['userId']."'" );
         // echo "SELECT * order_details WHERE customer_id = '".$_SESSION['userId']."'";

              $i=1;
              while ($row=mysqli_fetch_assoc($data_details)) {  ?>
 

                 <tr>
                         <td><?php echo $i; ?></td>
                         <td><?php
                                 $pro_id="SELECT * FROM product where id IN (".$row['product_id'].")";
                                    //echo $pro_id;
                                $sql2 = mysqli_query($conn,$pro_id );
                                $j=1;
                          while($res_pro=mysqli_fetch_array($sql2)){
                          //  print_r($res_pro);
                           echo $j.'.'. $res_pro['product_name'].'<br>'; 
                       $j++;}
                           //$res_pro[$i-1]; ?>
                           
                   </td>
                <td><?php 
                       $order_quantity=explode(',', $row['order_quantity']);
                      foreach ($order_quantity as $key => $value) {
                                  echo $value.'<br>';//$order_quantity[$i-1]; 
                              } ?></td>
                        <td><?php echo $row['invoice_date']; ?></td>
                    
                    
                    <td><?php echo $row['total_price']; ?></td>

                    <td>
                      <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                    </td>
                     </tr>
                
              







              <?php $i++;} 
    }
?>
            </tbody>
          </table>
                    
  </div>
</form>

        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('layout/footer1.php'); ?>