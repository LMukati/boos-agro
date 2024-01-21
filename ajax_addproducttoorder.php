<?php include('layout/connect.php');
if(isset($_POST['product']) && $_POST['product'] != '') {
	
	$json = array();
?>

    <?php
        $o = 1 ;
        $gprice = mysqli_query($conn,"select * from product_price where product_id='".$_POST["product"]."'");
        while($pprice = mysqli_fetch_array($gprice))
        {
           $o++ ;
           echo '<div class="variation" style="background: #f2f2f250;padding: 0 10px;margin-bottom: 5px;">';
           echo '<div class="row">';
            echo '<div class="col-md-10">';
              echo '<input type="radio" name="price" value="'.$pprice["id"].'" checked> '.$pprice["unit"].' '.$pprice["unit_type"].' ( '.$pprice['dealer_price'].' )';
            echo '</div><div class="col-md-2">';
              echo '<img src="'.$pprice["image"].'" style="height:35px;width:35px;">';
            echo '</div>';
           echo  '</div>' ;    
           echo '</div>';    
        }
    ?>
<?php
}