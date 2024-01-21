<?php
include('layout/connect.php');
session_start();
if(!isset($_SESSION['userId'])){
    header("Location:index.php");
    exit();
}
include('layout/header1.php');
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><center>Select Product Type</center></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body main_div">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Product Type:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="type" id="Check_type" required>
                                    <option value="">Select Type</option>
                                    <option value="1">Finished goods</option>
                                    <option value="2">Raw Material</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box" style="display:none;" id="product">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                  <th>S.no</th>
                                  <th>Name</th>
                                  <th>Product Image</th>
                                  <th>Price</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sql1 = mysqli_query($conn, "SELECT * FROM product WHERE active = '1'");
                                    if(mysqli_num_rows($sql1) > 0) { $i = 1;
                                        while($row = mysqli_fetch_assoc($sql1)) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td><?php if (isset($row['product_img']) && $row['product_img'] != "") { ?>
                                                    <img src="raw/images/<?php echo $row['product_img']; ?>" height="150" width="120">
                                                    <?php } else { ?>

                                                    <?php } ?>
                                                </td>
                                                <td>₹<?php echo $row['product_price']; ?></td>
                                                <td><button class="btn btn-success add-to-cart-button" data-toggle="modal" data-target="#myVModal_<?php echo $row['id']; ?> "><span class="glyphicon glyphicon-ok"></span>View</button>
                                                    <?php if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' ){ ?>
                                                    <a href="create_product_final.php?product_id=<?php echo $row['id']; ?>" class="btn btn-primary"  >Edit</a>
                                                    <a href="make_product.php?danger=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                                    <?php } ?>
                                                </td>
                                                <div id="myVModal_<?php echo $row['id']; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"><?php echo $row['product_name']; ?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="buttondanger" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                    <?php $i++;}
                                    } else { ?>
                                        <tr>
                                            <td colspan="5" align="center">No records found</td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box" style="display:none;" id="rawmaterial">
                        <table class="table table-bordered" id="rawData">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
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
                                                <td>₹<?php echo $row1['raw_price']; ?></td>
                                                <td><button class="btn btn-success add-to-cart-button" data-toggle="modal" data-target="#myModal_<?php echo $row1['id']; ?> "><span class="glyphicon glyphicon-ok"></span>View</button>
                                                    <?php if($_SESSION['userRole']=='1' || $_SESSION['userRole']=='2' ){ ?>
                                                        <a href="create_product_final.php?raw_id=<?php echo $row['id']; ?>" class="btn btn-success ">Edit</a>
                                                        <a href="submit_raw_material.php?danger=<?php echo $row['id']; ?>" class="btn btn-danger ">Delete</a><?php } ?>
                                                </td>
                                                <div id="myModal_<?php echo $row1['id']; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"><?php echo $row1['raw_name']; ?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="buttondanger" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        <?php $i++;}
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" align="center">No records found</td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('layout/footer1.php') ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#Check_type').on('change', function(){
        if($('#Check_type').val() == '2'){
            $('#rawmaterial').show();
            $('#product').hide();
        }else if($('#Check_type').val() == '1'){
            $('#rawmaterial').hide();
            $('#product').show();
        }else{
            $('#rawmaterial').hide();
            $('#product').hide();
        }
    });
});
$('#dataTable').DataTable();
$('#rawData').DataTable();
</script>