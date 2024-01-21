<?php

include('layout/connect.php');
session_start();

  function getUserStatus($id) {
      include('layout/connect.php');
      $sql3 = mysqli_query($conn, "SELECT statusname FROM status where id ='".$id."'");
      $row3 = mysqli_fetch_assoc($sql3);
      return $row3['statusname'];
    }

if(isset($_GET['userID']))
{
    $userID = $_GET['userID'] ;
  ?>
  
<style>
    .product-result {
    border: 1px solid #eee;
    padding: 7px 10px;
    font-size: 15px;
}   
</style>  

   <table class="table table-bordered" id="rawData">
                <thead>
                <tr>
                    <th style="width:3%">S.no</th>
                    <th style="width:7%">OrderID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                      $totalinvest = 0 ;
                      $city = "SELECT * FROM users where id = '$userID'";
                      $sql4=mysqli_query($conn,$city);
                      $citiess = mysqli_fetch_assoc($sql4);
                      
                      $data_details=mysqli_query($conn,"SELECT * FROM users INNER JOIN order_details 
                                                        ON  users.id = order_details.customer_id WHERE order_details.customer_id ='$userID'");
                      $i=1;
                      while ($row=mysqli_fetch_assoc($data_details)) 
                      {  ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>#<?php echo $row["id"] ; ?></td>
                            <td><?php $pro_id="select * from product where id IN (select product_id from order_product WHERE order_id = '".$row['id']."')";
                                      $sql2 = mysqli_query($conn,$pro_id );
                                      echo mysqli_num_rows($sql2).' Products (';
                                      while($prod = mysqli_fetch_array($sql2))
                                      {
                                          echo $prod["product_name"] ;
                                      }
                                      echo ")" ;
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
                           <td><?php echo $row['total_price'];   $totalinvest += $row['total_price'] ;  ?></td>
                           <td><?php echo $row['created_on']; ?></td>
                           <td>
                               <span style="color:green;">
                                   <?php print_r(getUserStatus($row['status'])); ?>
                                   <?php 
                                   if($row["status"] > 1 && $row["status"] < 8){
                                   $unm = "select * from users where id = (select user_role_id from order_approved where order_id = '".$row["id"]."' order by id desc limit 1)";
                                   $unme = mysqli_query($conn,$unm);
                                   $unam = mysqli_fetch_array($unme);
                                   echo " By ".$unam["username"];
                                   }
                                   ?>
                               </span>
                           </td>
                    <td>
                      
                       <span style="color:orange;cursor:pointer;margin-left:10px" data-toggle="modal" data-target="#myVModal_<?php echo $row['id']; ?>">View Order</span>
                       
                    <div class="modal fade" role="dialog" id="myVModal_<?php echo $row['id']; ?>">
                        <div class="modal-dialog">  
                         
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Order Detail</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body" style="padding-bottom:20px;">
                                    <div class="row product-margin" style="margin-top:20px;">
                                        <div class="col-sm-4 col-xs-4 text-right product-result">Product</div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result">Unit</div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result">Price</div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result">Quantity</div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result">Total</div>
                                    </div>
                                    <?php  $gt = 0 ; $gqt = 0 ;
                                    $ord_d = "select * from order_product WHERE order_id = '".$row['id']."'";
                                    $ord_de = mysqli_query($conn,$ord_d);
                                    while($order_det = mysqli_fetch_array($ord_de))
                                    {
                                    ?>
                                    <div class="row product-margin">
                                        <div class="col-sm-4 col-xs-4 text-right product-result">
                                            <?php
                                             $prod_n = mysqli_query($conn,"select * from product where id = '".$order_det["product_id"]."'");
                                             $prod_nam = mysqli_fetch_array($prod_n);
                                             echo $prod_nam["product_name"] ;
                                            ?>
                                        </div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["unit"] ; ?></div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["price"] ; ?></div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["quantity"] ; $gqt += $order_det["quantity"] ; ?></div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $order_det["total_price"] ; $gt = $order_det["total_price"] ; ?></div>
                                    </div>
                                    <?php } ?>
                                    
                                    
                                    <div class="row product-margin">
                                        <div class="col-sm-8 col-xs-8 text-right product-result"> Total </div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $gqt ; ?></div>
                                        <div class="col-sm-2 col-xs-2 text-left  product-result"><?php echo $gt ; ?></div>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                    </td>
                </tr>
               <?php $i++;}  ?>
                     <tr>
                         <td colspan="4" class="text-right">Total</td>
                         <td colspan="4"><?php echo $totalinvest ; ?></td>
                     </tr>
               </tbody>
            </table>
  <?php  
}