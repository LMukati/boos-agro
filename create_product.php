<?php
session_start();
include('../layout/connect.php');
//echo "<pre>"; print_r($_SESSION['raw']);
if(isset($_GET['material']) && $_GET['material'] == 0){
  ?> <script> alert("Please select atleast one material"); </script>

  <?php } else if(isset($_GET['raw_data']) && $_GET['raw_data'] != ""){
    //echo "hiii";
    unset($_SESSION['raw']);
  }
   if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Raw Materials</title>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->

<script >
$(document).ready(function(){
  var table = $('#example').DataTable({
        responsive: true
    });
 
    new $.fn.dataTable.FixedHeader(table);
$('#submitdata').on('click',function(){
//alert($("input:checked").val());
//var 
        if( $("input:checked").length > 1 ){
            
          return true;
        }else{

         alert('select atleast 2 checkbox!');
         return false;

        }

});

/*validate({
        rules: {
            raw_id: {
               required: true,
               minlength: 2  // at least two checkboxes are required
               // maxlength: 4 // less than 5 checkboxes are required
               // rangelength: [2,4] // must select 2, 3, or 4 checkboxes
            }
        }*/
        });
</script>
<style type="text/css">
.main_div h2
{
  text-align: center;
    font-size: 60px;
}
.main_div table
{
  margin-top: 60px
}
.submit
{
  text-align: center;
}
.next {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

.next:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
</head>
<body>
    <div class="container main_div">

      <form action="create_product_final.php" method="POST">
        <div><a href="../dashboard.php" class="btn btn-success">back</a></div>
        <h2>Create Product</h2>
        <div class="tab">
        <div style="overflow:auto;">
            <div style="float:right;">
              <input type="Submit" name="submit" id='submitdata' class="btn btn-success" value="Next"></button>
            </div>
        </div>
          <table class="table table-bordered" id="example">
            <thead>
              <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Choose</th>
              </tr>
            </thead>
            <tbody>
              <?php $sql1 = mysqli_query($conn, "SELECT * FROM raw_material ");
                    if(mysqli_num_rows($sql1) > 0) {
                    while($row = mysqli_fetch_assoc($sql1)) {
                 ?>
                 <tr>
                    <td><?php echo $row['raw_name']; ?></td>
                    <td><?php echo $row['raw_quantity']; ?></td>
                    <td><?php echo $row['raw_unit']; ?></td>
                    <td><?php echo $row['raw_price']; ?></td>
                    <td>
                      <?php 
                      // if (in_array(32, $_SESSION['raw'])) {
                      //   echo "12";
                      // } else {
                      //   echo "14";
                      // }
                      //die;
                      if(isset($_SESSION['raw']) && $_SESSION['raw'] != '') {
                          if(in_array($row['id'],$_SESSION['raw'])) { ?>
                            <input type="checkbox" name="raw_id[]" checked="checked" value="<?php echo $row['id']; ?>" class="form-control name_list qty_pro"  style="height: 30px; width: 100%"  />
                            
                          <?php } else { ?>
                            <input type="checkbox" name="raw_id[]" value="<?php echo $row['id']; ?>" class="form-control name_list qty_pro"  style="height: 30px; width: 100%"  />
                          <?php } }else{ ?>

                            <input type="checkbox" name="raw_id[]" value="<?php echo $row['id']; ?>" class="form-control name_list qty_pro"  style="height: 30px; width: 100%"  />

                         <?php } ?>
                    </td>
                </tr>
              <?php } } ?>
            </tbody>
          </table>
        </div>
        
      </form>
    </div>
</body>
</html>