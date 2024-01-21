<?php 
include('layout/connect.php');

//echo "<pre>";print_r($_POST);
if (isset($_POST['submit'])) 
{
   if(isset($_POST['product_id']) && $_POST['product_id'] != "")
   {
        
         
        $uploaddir = 'productImage/';
        $uploadfile = $uploaddir.basename($_FILES['pro_image']['name']);
       
        if($_FILES['pro_image']['name'] != "")
        {
          move_uploaded_file($_FILES['pro_image']['tmp_name'], $uploadfile);
          $uploadfile ;
        }
        else
        {
          $uploadfile=$_POST['pro_image1'];
        }
        
        $unit= $_POST['unit'][0].' '.$_POST['unit'][1];
        $sql1="UPDATE `product` SET `product_code` = '".$_POST['product_code']."',`product_name` = '".$_POST['product_name']."', `p_technical_name` = '".$_POST['p_technical_name']."', `batch_code` = '".$_POST['batch_code']."',`manufacturing_dt` = '".$_POST['manufacturing_date']."',`expiry_dt` = '".$_POST['expiry_date']."',`gst` = '".$_POST['gst']."',`product_price` = '".$_POST['product_price']."',`product_img` = '".$uploadfile."',`hsn_code` = '".$_POST['hsn']."',`unit` = '".$unit."',`packaging` = '".$_POST['packaging']."',`packaging` = '".$_POST['packaging']."' ,`active` = '1' WHERE `id` = '".$_POST['product_id']."'";
      
        $last_id = $_POST['product_id'] ;
        mysqli_query($conn,"DELETE FROM `product_price` WHERE product_id = '$last_id'");
        
        foreach($_POST['unit'] as $ukey => $uval)
        {
              $uniytype = $_POST['unit_type'][$ukey] ;
              $regular_price = $_POST['product_price'][$ukey] ;
              $dealer_price = $_POST['product_price1'][$ukey];
              $mfgdate = $_POST['mfg_date'][$ukey];
              $expdate = $_POST['exp_date'][$ukey];
              $batch = $_POST['batchcode'][$ukey];
              
              
              if($_FILES["variactionimage"]["name"][$ukey])
              {
                   $uploaddir = 'productImage/';
                   $uploadfile = $uploaddir . basename($_FILES['variactionimage']['name'][$ukey]);
                   move_uploaded_file($_FILES['variactionimage']['tmp_name'][$ukey], $uploadfile) ;
              }
              else
              {
                 $uploadfile = $_POST["oldvarimage"][$ukey];
              }
              
              $psql = "INSERT INTO `product_price`(`product_id`, `unit`, `unit_type`, `regular_price`, `dealer_price`,`mfgdate`,`expdate`,`batchcode`,`image`, `created_on`) 
                                           VALUES ('$last_id','$uval','$uniytype','$regular_price','$dealer_price', '$mfgdate', '$expdate', '$batch', '$uploadfile', '".date('Y-m-d H:i:s')."')" ;
              $presult = mysqli_query($conn,$psql);    
                                     
        }
        
        
        if($conn->query($sql1) === TRUE)
        {
         
           foreach ($_POST["node_id"] as $key => $value) 
           {
                 if($value != ''){
                   $sql1="UPDATE `optional_product_fields` SET `keys` = '".$_POST["node"][$key]."',`value` = '".$_POST["node1"][$key]."' WHERE id = '".$_POST['node_id'][$key]."'";
                    $conn->query($sql1);
                  }
                  else
                  {
                   $sql1="INSERT INTO `optional_product_fields`(`product_id`,`keys` `value`) VALUES ('".$_POST['product_id']."','".$_POST["node"][$key]."','".$_POST["node1"][$key]."')";
                   $conn->query($sql1);
                  }
            }
        }
        
     echo "<script>alert('Product update susessfully'); window.location.href ='create_product_final.php?product_id=".$last_id."' </script> ";
    
    
    }
    else
    {
           $uploaddir = 'productImage/';
           $uploadfile = $uploaddir . basename($_FILES['product_image']['name']);

            //echo "<p>";
            $p=$_POST['product_name'];
            $sql="SELECT product_name FROM product WHERE product_name='$p'";
            $result = $conn->query($sql);
            
if ($result->num_rows > 0) {
  ?>
 <script type="text/javascript"> alert("Already Exist"); window.location="http://bossagro.com/boss/create_product_final.php"; </script>
<?php
}
else
{
   
    if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadfile)) 
    {
        //print_r($_POST);die;
     
        $unit=$_POST['unit'][0].' '.$_POST['unit_type'][0];
        $product_price = $_POST['product_price'][0] ;
        
      
        $sql= "INSERT INTO `product`(`id`, `product_code`, `product_name`, `p_technical_name`, `batch_code`, `manufacturing_dt`, `expiry_dt`, `gst`, `product_price`, `product_img`, `hsn_code`, `unit`, `packaging`, `pro_discription`) VALUES (NULL,'".$_POST['product_code']."','".$_POST['product_name']."','".$_POST['p_technical_name']."','".$_POST['batch_code']."','".$_POST['manufacturing_date']."','".$_POST['expiry_date']."','".$_POST['gst']."','".$product_price."','".$uploadfile."','".$_POST['hsn']."','".$unit."','".$_POST['packaging']."','".$_POST['discription']."')";
        $result = mysqli_query($conn,$sql);
        $last_id = $conn->insert_id;  
     
        // price add
        foreach($_POST['unit'] as $ukey => $uval)
        {
              $uniytype = $_POST['unit_type'][$ukey] ;
              $regular_price = $_POST['product_price'][$ukey] ;
              $dealer_price = $_POST['product_price1'][$ukey];
              $mfgdate = $_POST['mfg_date'][$ukey];
              $expdate = $_POST['exp_date'][$ukey];
              $batch = $_POST['batchcode'][$ukey];
              
              if($_FILES["variactionimage"]["name"][$ukey])
              {
                   $uploaddir = 'productImage/';
                   $uploadfile = $uploaddir . basename($_FILES['variactionimage']['name'][$ukey]);
                   move_uploaded_file($_FILES['variactionimage']['tmp_name'][$ukey], $uploadfile) ;
              }
              
              $psql = "INSERT INTO `product_price`(`product_id`, `unit`, `unit_type`, `regular_price`, `dealer_price`,`mfgdate`,`expdate`,`batchcode`,`image`, `created_on`) 
                                           VALUES ('$last_id','$uval','$uniytype','$regular_price','$dealer_price', '$mfgdate', '$expdate', '$batch', '$uploadfile', '".date('Y-m-d H:i:s')."')" ;
              $presult = mysqli_query($conn,$psql);                               
        }
     
       
        // product attribute
        for($i = 0; $i < count($_POST['node']); $i++)
          {
              $key = mysqli_real_escape_string($conn, $_POST['node'][$i]);
              $value = mysqli_real_escape_string($conn, $_POST['node1'][$i]);
          
    
             // if (empty(trim($company))) continue;
    
              $sql = "INSERT INTO optional_product_fields(`product_id`, `keys`, `value`)VALUES('$last_id', '$key', '$value')";
                      print_r($sql);
              $result=  mysqli_query($conn, $sql);
          }
                  
                  
              if(sizeof($result)){
                 echo "<script>alert('Product inserted susessfully'); window.history.back(); </script>";
                }else{
                  
                echo mysqli_error($result);
                } 
    } 
    else 
    {
       echo "<script>alert('Image Not Save');  window.history.back();</script>";
    }


}
}
}

if(isset($_GET['danger']) && $_GET['danger'] !='' ){


  $sql ="UPDATE `product` SET `active` = '0' WHERE `id` = '".$_GET['danger']."'";

  if ($conn->query($sql) === TRUE)
                 {
                  echo "<script>alert('Product deleted susessfully'); window.location.href ='product_list.php'; </script>";
                
                 }  
                 else
                 {
                  echo "<script>alert('Error Raw deleted'); window.location.href ='product_list.php'; </script>";
                  
                 }

  }
  
if(isset($_GET['pricedanger']) && $_GET['pricedanger'] !='' ){


  $sql ="DELETE FROM `product_price` WHERE id='".$_GET['pricedanger']."'";

  if ($conn->query($sql) === TRUE)
                 {
                  echo "<script>alert('Product Price deleted susessfully'); window.location.href ='edit_product_page.php?product_id=".$_GET["ppid"]."'; </script>";
                
                 }  
                 else
                 {
                  echo "<script>alert('Error Raw deleted'); window.location.href ='product_list.php'; </script>";
                  
                 }

  }  
  
  
  
  
  
  
  if(isset($_POST['qty_pro']) && $_POST['qty_pro'] != ""){
    
    $sql= mysqli_query($conn, "SELECT * FROM product WHERE id = '".$_POST['pro_id']."'");
    $row = mysqli_fetch_assoc($sql);
    $jason=array();
    //print_r($row);die;
    if($row['product_quantity']>=$_POST['qty_pro'])
    {
      //echo "hh";die;
      $price=($_POST['qty_pro']* $row['product_price'])/$row['product_quantity'];
      //$jason['price']='';//$price;
      //$jason['Status']=
      echo json_encode($jason);
    }else{
       $jason['Status']="avalaible quantity only ".$row['product_quantity']."!";
      echo json_encode($jason);
    }
  }


 ?>