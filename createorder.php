<?php include('layout/connect.php');
session_start();

function getPrdNm($tbl,$id,$match,$getValue)
    {
      include('layout/connect.php');
      $pro_id="SELECT * FROM ".$tbl." where ".$match." =".$id."";
      $resultEmp1 = mysqli_query($conn, $pro_id);
      
         if (mysqli_num_rows($resultEmp1) > 0)
            {
              
              while($rowEmp1 = mysqli_fetch_assoc($resultEmp1)) 
                {
                  // echo "string";
                  // echo $rowEmp1['id'];
                         
                  $name= $rowEmp1[$getValue]; 
                }
            }

        return $name;
    }


    if(isset($_POST['update'])) {

      $id=$_POST['OrderId'];
        $prcAry=$_POST['prc'];
        //print_r($prcAry);die;
        $pdt_id2=$_POST['allPrdID'];
        $n= count($prcAry);
        $nwPdID=$_POST['allPrdID1'];
       
        $n1=count($nwPdID);
        $total=0;
        for ($i=0; $i < $n ; $i++) 
        { 
            $total=$total+$prcAry[$i];
           
        }

        for ($j=0; $j < $n1; $j++) { 
          if($j== $n1-1)
          {

           $pdt_id1 .=$nwPdID[$j];
          }
          else{
            $pdt_id1 .=$nwPdID[$j].',';
          }
        }
       if(empty($pdt_id1))
        {
          $pdt_id=$pdt_id2;
        }
        elseif(empty($pdt_id2))
        {
          $pdt_id=$pdt_id1;
        }
        else
        {
          $pdt_id=$pdt_id1.','.$pdt_id2;

        }


           $sql = "UPDATE order_details SET customer_id='".$_SESSION['userId']."',product_id='".$pdt_id."',order_quantity='".implode(',',$_POST['qty'])."',total_price='".$total."' WHERE id='".$id."'";

        // $sql = "UPDATE order_deails SET customer_id='".$_SESSION['userId']."',product_id='".implode(',',$_POST['allPrdID1'])."',order_quantity='".implode(',',$_POST['qty'])."',total_price='".$total."' WHERE id=''";
           $result = mysqli_query($conn,$sql);
          
           if($result) {
               if($_SESSION['userRole']=='8')
              {

                echo "<script>window.location.href='purchase_list.php?type=dl';</script>";
              }
              else{
                echo "<script>window.location.href='sales_list.php';</script>";
              }
           } else {
              $err='Error to Edit Product';
              header('Location:order.php?err=Update');
              
           }
    }
    

    if(isset($_POST['addUpdt'])) {

       $total=0;

       $id=$_POST['OrderId'];
         $prcAry=$_POST['pdAry'];
         //print_r($prcAry);
         

        $nwPdID=$_POST['allPrdID1'];
        
        $n= count($prcAry);
        $qty1=implode(',',$_POST['qty']);
        for ($i=0; $i < $n; $i++) { 
          
          if($i== $n-1)
          {
            //echo "string";
           $pdt_id2 .=$prcAry[$i];
           $qty2 .= '1';
          }
          else{
            $pdt_id2 .=$prcAry[$i].',';
            $qty2 .='1'.',';
          }


          $prc=getPrdNm('product',$prcAry[$i],'id','product_price');

          $total=$total+$prc;
        }
        
      
       $n1=count($nwPdID);
        for ($j=0; $j < $n1; $j++) { 
          
          if($j== $n1-1)
          {

           $pdt_id1 .=$nwPdID[$j];
          }
          else{
            $pdt_id1 .=$nwPdID[$j].',';
          }
          $prc=getPrdNm('product',$nwPdID[$j],'id','product_price');

          $total=$total+$prc;
        }
        if(empty($pdt_id1))
        {
          $pdt_id=$pdt_id2;
        }
        elseif(empty($pdt_id2))
        {
          $pdt_id=$pdt_id1;
        }
        else
        {
          $pdt_id=$pdt_id1.','.$pdt_id2;

        }
        
        $qty=$qty1.','.$qty2;
        //echo $qty;die;
        // echo $pdt_id;
        // echo "<br>";
        // echo $total;die;
        $sql = "UPDATE order_details SET customer_id='".$_SESSION['userId']."',product_id='".$pdt_id."',order_quantity='".$qty."',total_price='".$total."' WHERE id='".$id."'";

        $result = mysqli_query($conn,$sql);
          
        if($result)
          {
            // header('Location:order.php?raw_id='.$id.'');
            echo "<script>window.location.href='order.php?raw_id=".$id."';</script>";
          }
       else 
          {
            $err='Error to Edit Product';
            header('Location:order.php?raw_id='.$id.'&&err=Update');
          }
    }

    if(isset($_POST['sub'])) {
       
    	mysqli_query($conn,"delete FROM temp_order where customer_id='".$_SESSION['userId']."'");
        
        $sql = "INSERT INTO order_details (`customer_id`,`payment_method`,created_on) VALUES ('".$_SESSION['userId']."','".$_POST["payment_method"]."','".date('Y-m-d H:i:s')."')";
        $result = mysqli_query($conn,$sql);
        $last_id = $conn->insert_id;  
        
        $cart_total = 0 ;
        $product_unit = '';
        $product_price = '';
        $product_quantity = '';
        $product_ids = '';
        
        
        foreach($_POST["product_id"] as $key => $pro_id)
        {
            $unit = $_POST["unit"][$key] ;
            $quantity =  $_POST["quantity"][$key] ;
            $price =  $_POST["price"][$key] ;
            $total_price = $_POST["quantity"][$key] * $_POST["price"][$key] ;
            
            $gst =  $_POST["tax"][$key] ;
            $tax =  $total_price*$gst/100 ;
            
            $grand_total = $total_price + $tax ;
            
            $cart_total += $grand_total ;
            
            $product_unit .= $unit.',';
            $product_price .= $grand_total.',';
            $product_quantity .= $quantity.',';
            $product_ids .= $pro_id.',' ;
            
            $query =   "INSERT INTO `order_product`(`order_id`, `product_id`, `unit`, `price`, `quantity`, `total_price`, `tax`,`grand_total`,`created_on`) 
                        VALUES ('$last_id','$pro_id','$unit','$price','$quantity','$total_price','$tax','$grand_total','".date('Y-m-d H:i:s')."')";
            mysqli_query($conn,$query);
        }
		 
		mysqli_query($conn,"UPDATE `order_details` SET `total_price`=$cart_total, order_quantity='$product_quantity',product_price = '$product_price',
		                    product_unit = '$product_unit',	product_id = '$product_ids', `status`=1 , `active`=1 WHERE id = '$last_id' ");
		   
           if($result) {
              if($_SESSION['userRole']=='8')
              {

                echo "<script>window.location.href='dealer_order_list.php';</script>";
              }
              else{
                echo "<script>window.location.href='sales_list.php';</script>";
              }
              
           } else {
              $err='Error to Order Product';
              header('Location:order.php?err=Add');
           }
    }


?>
