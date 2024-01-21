<?php include('layout/connect.php');
session_start();

if(!isset($_SESSION['userId'])) {
    header("Location:index.php");
    exit();
}
if(isset($_GET['raw_id']) && $_GET['raw_id'] != '') {
    $json = array();
    $sql = mysqli_query($conn, "SELECT * FROM order_details WHERE id = '".$_GET['raw_id']."'");
    while($orderData = mysqli_fetch_assoc($sql)) {
        $json[] = $orderData;
    }
}
//echo "<pre>"; print_r($json[0]); die;
include('layout/header1.php');
?>
<style type="text/css">
.main_div h2 {
    text-align: center;
    font-size: 60px;
}
.main_div table {
    margin-top: 60px
}
.submit {
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
.prevBtn {
    background-color: #bbbbbb;
}
</style>   
<div class="content-wrapper">
     <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><center>Sales Details</center></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                     title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body main_div">
                <div class="panel-body pull-center">
                    <div class="row">
                    <form action="" method="POST">
                     <select id="delr" name="delr" class="form-control" onchange="getorder(this.value)">
                        <option value="">Select Dealer</option>
                        <?php 
                            $sql = mysqli_query($conn,"SELECT * FROM users WHERE users.user_role = 8 AND users.id in (SELECT customer_id FROM order_details group by customer_id)"); 
                            while($row=mysqli_fetch_array($sql))
                            {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo ucwords($row['first_name']).' '.ucwords($row['last_name']); ?></option>
                                <?php
                            } 
                        ?>

                                    
                     </select> 

                     <br>
                     <div id="prdctData">
                         
                     </div>
                     
                     
                     <br><br>
                     <div id="prdctData1">
                         
                     </div>  
                    </div>
                </div>
            </div>
            
        </div>
    </section>

</div>


 <!-- /.content-wrapper -->
<?php include('layout/footer1.php'); ?>

<script type="text/javascript">
  
function getorder(id){
     $.get("ajax_user_order.php?userID="+id, function(data, status){
          $('#prdctData').html(data);
         // alert("Data: " + data + "\nStatus: " + status);
      });
}

  
  
 /* 
   $(document).ready(function(){

        $("select#delr").change(function(){

            var selectedCountry = $("#delr option:selected").val();
            if(selectedCountry=='') {
                       alert('Select a Dealer');
                       return false;
                } else {
                    $.ajax({
                        type:'POST',
                        url: 'ajax_productData.php',
                        data: {'userId': selectedCountry},
                        success: function(data) {
                            $('#prdctData').html(data);
                        },
                    });
                    return false;
                }

        });
        return false;
    });
*/


   $(document).on('click', '.btn_remove3', function(){  

    
           var selectedCountry = $(this).attr("id");   

           // alert(selectedCountry);

          $.ajax({
                type:'POST',
                url: 'ajax_productData.php',
                data: {'usID': selectedCountry},
                success: function(data) {
                    $('#prdctData1').html(data);
                },
            });
        return false;

      }); 
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    } );


     $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


 



