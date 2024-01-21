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
              </tr>
            </thead>
            <tbody>
           <?php
           if($_SESSION['userRole'] == '1' || $_SESSION['userRole'] == '2'){

              $data_details="SELECT * FROM order_details WHERE active = '1'";

              $sql=mysqli_query($conn,$data_details);
              $i=1;
              while ($row=mysqli_fetch_assoc($sql)) {  ?>

                 <tr>
                         <td><?php echo $i; ?></td>
                         <td><?php 
                                    $sqluser=mysqli_query($conn,"SELECT * FROM users WHERE id='".$row['customer_id']."'");
                                    $resultUser= mysqli_fetch_array($sqluser);
                                    echo $resultUser['first_name'].' '.$resultUser['last_name'];; 
                             ?>
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
                        <button type="button" class="btn btn-success add-to-cart-button" data-toggle="modal" data-target="#myModal_<?php echo $i; ?> ">View Order</button>
                    <?php 
                        if($row['status'] == 7) 
                             { ?> 
                           <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?> 
        						<?php  
        						  $or=mysqli_query($conn,"select b.first_name,b.last_name from order_approved a ,users b where a.order_id='".$row['id']."' and b.id=a.user_role_id");
        						  $dd=mysqli_fetch_array($or);
        						  if($row["status"] > 1 && $row["status"] < 8)
        						  {
                                    $unm = "select * from users where id = (select user_role_id from order_approved where order_id = '".$row["id"]."' order by id desc limit 1)";
                                    $unme = mysqli_query($conn,$unm);
                                    $unam = mysqli_fetch_array($unme);
                                    echo " By ".$unam["first_name"].' '.$unam["lastname"] ;
                                  }
        						?>
						   </p>
                                <div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content product-details-modal">
                                      <div class="modal-header">
                                           <h4 class="modal-title">Order Details</h4>
                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <form action="make_invoice.php" method="POST">
                                            <input type="hidden" name="customer_id" value="<?php echo $row['customer_id'];?>">
                                       	    <input type="hidden" name="prdID" value="<?php echo $row['product_id'];?>">
                                            <input type="hidden" name="prdqty" value="<?php echo $row['order_quantity'];?>">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id'];?>">
                                            
                                        <div class="modal-body">
                                            <?php 
                                                $sqluser = mysqli_query($conn,"SELECT * FROM users WHERE id='".$row['customer_id']."'");
                                                $resultUser = mysqli_fetch_array($sqluser);
                                            ?>
                                            
                                            <div class="row product-margin">
                                                <h4>User Detail (<a href="user_list.php?type=dl" target="_blank">View User Detail</a>)</h4>
                                                <div class= "col-sm-4 col-xs-12 product-result">Username : <?php echo $resultUser["first_name"].' '.$resultUser['last_name'] ; ?></div>
                                                <div class= "col-sm-4 col-xs-12 product-result">Email : <?php echo $resultUser["email"] ; ?></div>
                                                <div class= "col-sm-4 col-xs-12 product-result">Phone : <?php echo $resultUser["phone"].' , '.$resultUser["telephone"] ; ?></div>
                                                <div class= "col-sm-4 col-xs-12 product-result">Usertype : <?php if($resultUser["user_role"] == 8){ echo "Dealer" ; } ; ?></div>
                                                <div class= "col-sm-4 col-xs-12 product-result">Address : <?php echo $resultUser["residential"] ; ?></div>
                                                <div class= "col-sm-4 col-xs-12 product-result">
                                                    Address : 
                                                    <?php 
                                                        $aquery = mysqli_query($conn,"SELECT cities.name as city, states.name as state, countries.name as country, users.village FROM users 
                                                                                      INNER JOIN cities ON users.city = cities.id INNER JOIN states ON users.state = states.id 
                                                                                      INNER JOIN countries ON users.country = countries.id WHERE users.id = '".$resultUser["customer_id"]."'") ;  
                                                        $rquery = mysqli_fetch_array($aquery);
                                                        echo $rquery["village"].', '.$rquery["city"].', '.$rquery["state"].', '.$rquery["country"] ;
                                                    ?>
                                                </div>
                                                <div class= "col-sm-3 col-xs-12 product-result">Shop : <?php echo $resultUser["shop"] ; ?></div>
                                                <div class= "col-sm-3 col-xs-12 product-result">Shop Type : <?php echo $resultUser["shoptype"] ; ?></div>
                                                <div class= "col-sm-3 col-xs-12 product-result">Shop : <?php echo $resultUser["year"] ; ?></div>
                                                <div class= "col-sm-3 col-xs-12 product-result">Sale Type : <?php echo $resultUser["saletype"] ; ?></div>
                                            </div>
                                            
                                            
                                            <div class="row product-margin" style="margin-top:20px;">
                                                    <h4>Order Detail</h4>
                                                    <div class="col-sm-4 col-xs-4 text-right product-result">Product</div>
                                                    <div class="col-sm-2 col-xs-2 text-left  product-result">Unit</div>
                                                    <div class="col-sm-2 col-xs-2 text-left  product-result">Price</div>
                                                    <div class="col-sm-2 col-xs-2 text-left  product-result">Quantity</div>
                                                    <div class="col-sm-2 col-xs-2 text-left  product-result">Total</div>
                                            </div>
                                            <?php  
                                            $ord_d = "select * from order_product WHERE order_id = '".$row['id']."'";
                                            $ord_de = mysqli_query($conn,$ord_d);
                                            while($order_det = mysqli_fetch_array($ord_de))
                                            {
                                            ?>
                                            <div class="row product-margin">
                                                <div class="col-sm-4 col-xs-4 text-right product-label">
                                                    <?php
                                                     $prod_n = mysqli_query($conn,"select * from product where id = '".$order_det["product_id"]."'");
                                                     $prod_nam = mysqli_fetch_array($prod_n);
                                                     echo $prod_nam["product_name"] ;
                                                    ?>
                                                </div>
                                                <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["unit"] ; ?></div>
                                                <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["price"] ; ?></div>
                                                <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["quantity"] ; ?></div>
                                                <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["total_price"] ; ?></div>
                                            </div>
                                            <?php } ?>
                                          
                                            <div class="row product-margin">                                         
                                                 <div class="form-group">
                                                    <label style="margin-right:5px;">Discount</label>
                                                    <input type="text" class="form-control" name="dis">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                          <?php if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' ){ ?>
                                               <a href="order.php?raw_id=<?php echo $row['id']; ?>" class="btn btn-success ">Edit</a>
                                               <a href="delete_order.php?d_Order=<?php echo $row['id']; ?>&red=sales_list.php" class="btn btn-danger ">Delete</a>
                                          <?php } ?>
                                         <button type="submit" class="btn btn-primary" value="submit" name="subM">Submit</button> 
                                         <button type="buttondanger" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                                                        
                            <?php 
                        } else {  
                    ?>
                        <a href="invoicestatusupdate.php?idpro=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&iddr=<?php echo $_SESSION['userId'];?>"><?php print_r(getUserStatus($row['status'])); ?> (Approved : <?php echo $dd['first_name'] ?> <?php echo $dd['last_name'] ?> )</a>
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
					  <?php  
							  $or=mysqli_query($conn,"select b.first_name,b.last_name from order_approved a ,users b where a.order_id='".$row['id']."' and b.id=a.user_role_id");
							  $dd=mysqli_fetch_array($or);
							  ?>
							  
                    <td>
                      <?php if($row['status'] == 7) {
                              ?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?> (Approved By : <?php echo $dd['first_name'] ?> <?php echo $dd['last_name'] ?>)</p>
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
						  
                              ?>   <?php  
							  $or=mysqli_query($conn,"select b.first_name,b.last_name from order_approved a ,users b where a.order_id='".$row['id']."' and b.id=a.user_role_id");
							  $dd=mysqli_fetch_array($or);
							  ?>
							  
							  <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?> (Approved By : <?php echo $dd['first_name'] ?> <?php echo $dd['last_name'] ?>)</p>
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

                    <td><p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                    </td>
                     </tr>

              <?php $i++;} 
    }
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