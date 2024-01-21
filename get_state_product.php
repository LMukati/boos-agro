<?php 
session_start();
include('layout/connect.php');

if(isset($_GET["pid"]))
{
    $pid = $_GET["pid"] ;
    ?>
    <select class="form-control" name="states" onchange="getunits(this.value,<?php echo $pid ; ?>)" style="color: #000;border: 1px solid #aaa;border-radius: 4px;width: 98.5%;">
        <option value="">Select State</option>
    <?php
   
   $query = mysqli_query($conn,"SELECT states.* FROM `product_price` INNER JOIN states ON states.id = product_price.state_id WHERE product_price.product_id = '$pid' GROUP BY product_price.state_id") ;
   while($pricep = mysqli_fetch_array($query))
   { 
     echo '<option value="'.$pricep["id"].'">'.$pricep["name"].'</option>';
   }       
?> 
</select>
<?php } ?>