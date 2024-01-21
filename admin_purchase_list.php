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
            <table class="table table-bordered" id="rawData">
                <thead>
                <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $sql1 = mysqli_query($conn, "SELECT * FROM raw_material WHERE active = 1");
                  if(mysqli_num_rows($sql1) > 0) { $i = 1;
                  while($row1 = mysqli_fetch_assoc($sql1)) { ?>
                  <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row1['raw_name']; ?></td>
                  <td><?php echo $row1['raw_quantity']; ?></td>
                  <td><?php echo $row1['raw_unit']; ?></td>
                  <td>₹<?php echo $row1['raw_price']; ?></td>
                  <td>
                  <?php if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' ){ ?>
                  <a href="create_product_final.php?raw_id=<?php echo $row1['id']; ?>" class="btn btn-success ">Edit</a>
                  <a href="submit_raw_material.php?danger=<?php echo $row1['id']; ?>" class="btn btn-danger ">Delete</a><?php } ?>
                  </td>
                </tr>
                <?php $i++;} } else { ?>
                <tr>
                  <td colspan="4" align="center">No products found</td>
                </tr>
                <?php } ?>
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