<?php
session_start();
include('layout/connect.php');

if(!isset($_SESSION['userId'])) {
    header("Location:index.php");
    exit();
}

include('layout/header1.php');


/*Get Status*/
function getUserStatus($id) {
	include('layout/connect.php');
	$sql3 = mysqli_query($conn, "SELECT statusname FROM status where id ='".$id."'");
	$row3 = mysqli_fetch_assoc($sql3);
	return $row3['statusname'];
}


if(isset($_POST["submit"]))
{
       $uploaddir = 'tour_plan/';
       $uploadfile = $uploaddir . basename($_FILES['file']['name']);
       move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile) ;
       
       $sql = "INSERT INTO `tourplan`(`user_id`, `file`, `created_on`) VALUES ('".$_SESSION["userId"]."','$uploadfile','".date("Y-m-d H:i:s")."')";
       mysqli_query($conn,$sql);
       echo "<script>alert('Plan uploaded susessfully'); window.location.assign('dailytourplan_exp.php'); </script>";
}
    
?>

<div class="content-wrapper">

	<section class="content" style="min-height:auto">
		<div class="box" style="margin-top:0px">
			<div class="box-header with-border">
				<h3 class="box-title" style="width:100%">
				    Download Sample For Expenses and Tour Plan 
				   <a href="tour_plan/travelling_sample.pdf" class="btn btn-success btn-sm pull-right" target="_blank" download="">Download</a>
				</h3>
			</div><!--box header-->
		</div>
	</section>
	
	<section class="content">
		<div class="box" style="margin-top:0px">
			<div class="box-header with-border">
				<h3 class="box-title">Upload Your Expenses and Tour Plan</h3>
				<div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
			</div><!--box header-->
			<div class="box-body">
			    <div class="row">
			        <form action="" method="post" enctype="multipart/form-data">
			            <div class="form-group">
			                <label>Upload Your Plan</label>
			                <input type="file" name="file" class="form-control" required accept="application/pdf">
			            </div>
			            <div class="form-group">
			                <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
			            </div>
			        </form>
			    </div>
			</div>
		</div>
	</section>


	<section class="content">
		<div class="box" style="margin-top:0px">
			<div class="box-header with-border">
				<h3 class="box-title">Your Expenses and Tour Plan</h3>
				<div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
			</div><!--box header-->
			<div class="box-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
					        <tr>
						        <th>No</th>
						        <th>file</th>
						        <th>date</th>
					        </tr>
					    </thead>
					    <tbody>
					    	 <?php $i = 1;
					    	     $query = mysqli_query($conn,"SELECT * FROM `tourplan` WHERE user_id='".$_SESSION["userId"]."'"); 
					    	     while($result = mysqli_fetch_array($query))
					    	     {
					    	 ?>	
					    	 <tr>
					    	     <td><?php echo $i ; ?></td>
					    	     <td><a href="<?php echo $result['file'] ; ?>" target="_blank" class="btn btn-warning btn-sm">View File</a></td>
					    	     <td><?php echo $result["created_on"] ; ?></td>
					    	 </tr>
					    	 
					    	 <?php $i++; } ?>
					    </tbody>
					 </table><!--table-->   
				</div><!--table div-->
			</div><!--box body-->
		</div><!--box-->
	</section><!--section-->	
</div><!--container-->
					    		
					    		
					    		
					    		
					    		
<?php include('layout/footer1.php');?>	    		
					    		
					    		
					    		