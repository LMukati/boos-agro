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
    

/*Assign selse Person*/
if(isset($_POST["sales_person"]))
{
   $allot_to = $_POST["sales_person"] ;
   $user_id = $_POST["userID"] ;
   $query = mysqli_query($conn,"update users set allot_to = '$allot_to' where id='$user_id'");
}



$sql_login =mysqli_query($conn, "SELECT *  FROM users where id ='".$_SESSION['userId']."'");
$row_login = mysqli_fetch_assoc($sql_login);

if($row_login['user_role'] == 1 || $row_login['user_role'] == 2) {
	$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8'");
}
else if($row_login['user_role'] == 3 || $row_login['user_role'] == 4 || $row_login['user_role'] == 5) {
	$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8' and state IN ('".$row_login["state"]."')");
}
else if($row_login['user_role'] == 6) {
	$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8' and city IN ('".$row_login["city"]."')");
}
else if($row_login['user_role'] == 7) {
	$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8' and allot_to = '".$row_login["id"]."' ");
}
					    		

    
?>


<div class="content-wrapper">
	<section class="content-header">
	
	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Dealer List</h3>
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
						        <th>Profile</th>
						        <th>Firm Name</th>
						        <th>Email</th>
						        <th>Sales Person</th>
						        <th>Phone</th>
						        <th>State</th>
						        <th>City</th>
						        <th>Status</th>
						        <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    			
					    		$i =1;
					    		
					    		while($row = mysqli_fetch_assoc($sql))  { ?>
					    		 <tr>
					    			<td><?php echo $i; ?></td>
					    			<?php if(isset($row['image']) && $row['image'] !=""){ ?>
					    			        <td class="img-profile" ><img src="<?php echo $row['image']; ?>" style="width: 50px;height: 50px;border-radius: 10px;"></td>
					    			<?php }else{ ?>
					    					<td class="img-profile" ><p style="width: 50px;height: 50px;border-radius: 10px;text-align: center;background: #000;padding: 3px 0 0 0;color: #fff;">No Image</p></td>
					    			<?php } ?>
					    			<td><?php echo $row['firm_name'] ; ?></td>
					    			<td><?php echo $row['email']; ?></td>
					    			<td>
					    			    <?php if($row_login['user_role'] == 1 || $row_login['user_role'] == 2) { ?>
    			    			          <form action="" method="post" id ="changeslaes<?php echo $row['id'] ; ?>">
    			    			              <input type="hidden" name="userID" value="<?php echo $row['id'] ; ?>">
    			    			              <select name="sales_person" class="form-control" required onchange="updatesales(<?php echo $row['id'] ; ?>)">
    			    			                  <option value="">Sales Person</option>
    			    			                  <?php $salp = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7'"); 
    			    			                        while($salpp = mysqli_fetch_array($salp)){ ?>
    			    			                        
    			    			                        <?php if($row['allot_to'] == $salpp["id"]){ ?>
    			    			                        <option value="<?php echo $salpp["id"]; ?>" selected><?php echo $salpp["first_name"].' '.$salpp["last_name"] ; ?></option>
    			    			                        <?php } else { ?>
    			    			                        <option value="<?php echo $salpp["id"]; ?>"><?php echo $salpp["first_name"].' '.$salpp["last_name"] ; ?></option>
    			    			                        <?php } ?>
    			    			                        
    			    			                  <?php } ?>         
    			    			              </select>
    			    			          </form>
    			    			          <?php } else { 
    			    			          $myallot = mysqli_query($conn, "SELECT * FROM users WHERE id = '".$row['allot_to']."'"); 
    			    			          $myallot1 = mysqli_fetch_array($myallot) ; echo $myallot1["first_name"].' '.$myallot1["last_name"] ;
    			    			          } ?>
					    			</td>
					    			<td><?php echo $row['phone']; ?></td>
					    			<td>
					    			   <?php  // Get State Name
					    			          $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					  while($row1 = mysqli_fetch_assoc($sql1)) { echo $row1['name']." ,";  }
					    				?>
					    			</td>
					    			<td>
					    			   <?php 
					    			          // Get City Name
					    			          $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					  while($row2 = mysqli_fetch_assoc($sql2)) { 	echo $row2['name'].",";  }
					    				?>
					    			</td>
					    			<td>
					    			    <?php /*check user status*/ if($row['status'] == 7) { ?> 
					    			         <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                        <?php } else { ?>
					    					 <a href="statusupdate.php?idra=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&pg=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    				<?php }?>
					    			</td>
					    			<td>
					    			    <a href="user_detail.php?id=<?php  echo $row['id']; ?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-eye-open"></span></a> 
					    				
					    				<?php if($row_login['user_role'] == 1 || $row_login['user_role'] == 2) { ?>
					    					<a href="updatesalesperson.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>
					    				<?php }  ?>&nbsp;&nbsp; 
                                        
                                           <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                   </td>
					    		</tr>
					    	<?php $i++; } ?>		
					    </tbody>
					 </table><!--table-->   
				</div><!--table div-->
			</div><!--box body-->
		</div><!--box-->
	</section><!--section-->	
</div><!--container-->
					    		
					    		
					    		
<script>
    function updatesales(id)
    {
        var r = confirm('Are you sure to allocate this dealer');
        if (r == true) {
          document.getElementById("changeslaes"+id).submit();
        }
    }
</script>					    		
					    		
					    		
					    		
<?php include('layout/footer1.php');?>	    		
					    		
					    		
					    		