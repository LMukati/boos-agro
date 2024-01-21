<?php
    session_start();
    include('layout/connect.php');
    if(!isset($_SESSION['userId'])) {
        header("Location:index.php");
        exit();
    }
    //print_r($_SESSION);die;

    include('layout/header1.php');

    function getUserStatus($id) {
    	include('layout/connect.php');
    	$sql3 = mysqli_query($conn, "SELECT statusname FROM status where id ='".$id."'");
    	$row3 = mysqli_fetch_assoc($sql3);
    	return $row3['statusname'];
    }
    
    $currentRole = $_SESSION['userRole'] ;
    
    
    
?>

<div class="content-wrapper">
	<section class="content-header">
		<?php if($_GET['type'] == 'gm') { ?>
			<h1>GSM List</h1>
		<?php } else if($_GET['type'] == 'asm') { ?>
			<h1>ASM List</h1>
		<?php } else if($_GET['type'] == 'rsm') { ?>
			<h1>RSM List</h1>
		<?php } ?>
	

		<ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <?php if($_GET['type'] == 'gm') { ?>
				<li class="active">GSM List</li>
			<?php } else if($_GET['type'] == 'asm') { ?>
				<li class="active">ASM List</li>
				<?php } else if($_GET['type'] == 'zsm') { ?>
				<li class="active">ZSM List</li>
			<?php } else if($_GET['type'] == 'rsm') { ?>
				<li class="active">RSM List</li>
			<?php } else if($_GET['type'] == 'am') { ?>
				<li class="active">Account Manager List</li>
			<?php } else if($_GET['type'] == 'sp') { ?>
				<li class="active">Sales Person List</li>
			<?php } else if($_GET['type'] == 'dl') { ?>
				<li class="active">Dealer List</li>
			<?php } ?>

        </ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<?php if($_GET['type'] == 'gm') { ?>
					<h3 class="box-title">GSM List</h3>
				<?php } else if($_GET['type'] == 'asm') { ?>
					<h3 class="box-title">ASM List</h3>
				<?php } else if($_GET['type'] == 'rsm') { ?>
					<h3 class="box-title">RSM List</h3>
					<?php } else if($_GET['type'] == 'am') { ?>
					<h3 class="box-title">Account Manager List</h3>
					<?php } else if($_GET['type'] == 'zsm') { ?>
					<h3 class="box-title">ZSM List</h3>
					<?php } else if($_GET['type'] == 'sp') { ?>
					<h3 class="box-title">Sales Person List</h3>
					<?php } else if($_GET['type'] == 'dl') { ?>
					<h3 class="box-title">Dealer List</h3>
				<?php } ?>
				<div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
					        <tr>
						        <th>No</th>
						        <th>Profile</th>
						        <th>Name</th>
						        <th>Email</th>
						        <th>Phone</th>
						        <th>State</th>
						        <th>City</th>
						        <th>Status</th>
						        <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    		$sql_login =mysqli_query($conn, "SELECT *  FROM users where id ='".$_SESSION['userId']."'");
					    		$row_login = mysqli_fetch_assoc($sql_login);
					    		if($row_login['user_role'] == 1) {
					    			if($_GET['type'] == 'gm') { 
					    				if(isset($_GET['myId']))
					    		     	{
					    		     		$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='3' and id='".$_GET['myId']."'");
					    		     	}
					    		     	else
					    		     	{
					    					$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='3'");
					    				}
					    		    }
					    		     else if($_GET['type'] == 'am') { 
					    				$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='2'");
					    		     }
					    		     else if($_GET['type'] == 'zsm') { 
					    		     	if(isset($_GET['myId']))
					    		     	{
					    		     		$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='4' and id='".$_GET['myId']."'");
					    		     	}
					    		     	else
					    		     	{

					    					$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='4'");
					    				}
					    		     }
					    		     else if($_GET['type'] == 'rsm') { 
					    		     	if(isset($_GET['myId']))
					    		     	{
					    		     		$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='5' and id='".$_GET['myId']."'");
					    		     	}
					    		     	else
					    		     	{
					    					$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='5'");
					    				}
					    		     }
					    		     else if($_GET['type'] == 'asm') { 
					    		     	if(isset($_GET['myId']))
					    		     	{
					    		     		$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='6' and id='".$_GET['myId']."'");
					    		     	}
					    		     	else{

					    					$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='6'");
					    				}
					    		     }
					    		     else if($_GET['type'] == 'sp') { 

					    		        if(isset($_GET['myId']))
					    		     	{
					    		     		$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7' and id='".$_GET['myId']."'");
					    		     	}
					    		     	else{
					    						$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7'");
					    					}
					    		     }
					    		    else if($_GET['type'] == 'dl') 
					    		     {
					    		            if(isset($_GET['myId']))
    					    		     	{
    					    		     		$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8' and id='".$_GET['myId']."'");
    					    		     	}
    					    		     	else{
    					    		     		$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8'");
    					    		     	}
					    		     }
					    			if (mysqli_num_rows($sql) > 0) {
					    				$i =1;
					    				while($row = mysqli_fetch_assoc($sql))  { ?>
					    				<tr>
					    					<td><?php echo $i; ?></td>
					    					<?php 
					    					if(isset($row['image']) && $row['image'] !=""){
					    					?>
					    					<td class="img-profile" ><img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;"></td>
					    					<?php }else{?>
					    					<td class="img-profile" >Image Not Uploaded</td>
					    					<?php }?>
					    					<td><?php echo $row['first_name']; ?>
					    					<!--<td><a href="user_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success"   for="textarea"><?php echo $row['first_name']; ?></a>-->
					    				<!--	<a href="user_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success"  data-toggle="modal" data-target="#myModal_<?php echo $i; ?>" for="textarea"><?php echo $row['username']; ?></a>-->
                                                <!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Information:</h4> </center>
         <center>
             <div class="card">
  <img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;">
  <?php //print_r($row['id']); ?>
  <h5><span style="color:#3E020C;">NAME:</span>&nbsp;&nbsp;<?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></h5>
  <p class="title"><span style="color:#3E020C;">EMAIL:</span>&nbsp;&nbsp;<?php echo $row['email']; ?></p>
  <?php $sql1 = "SELECT statusname  FROM status where id ='".$row['status']."'"; 
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $statusname= $row1['statusname'];   
  ?>
  <p><span style="color:#3E020C;">PHONE:</span>&nbsp;&nbsp;<?php echo $row['phone']; ?></p>
  <p><span style="color:#3E020C;">DOB:</span>&nbsp;&nbsp;<?php echo $row['dob']; ?></p>
  
  <h4 style="background-color: #d9d9d9;padding:10px;">Uploading Information:</h4>
  <p><span style="color:#3E020C;">LIENCENSE:</span>&nbsp;&nbsp;<?php echo $row['liencense']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['lienimg']){ ?><img src="<?php echo $row['lienimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">ADHARCARD:</span>&nbsp;&nbsp;<?php echo $row['adharcard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['adharimg']){ ?><a data-magnify="gallery" href="<?php echo $row['adharimg']; ?>"><img src="<?php echo $row['adharimg']; ?>"></a><?php } ?></span></p>
  <p><span style="color:#3E020C;">PANCARD:</span>&nbsp;&nbsp;<?php echo $row['pancard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['panimg']){ ?><img src="<?php echo $row['pancardimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">GSTN:</span>&nbsp;&nbsp;<?php echo $row['gtsno']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['gstimg']){ ?><img src="<?php echo $row['gstimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">SIGNATURE:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['sign']){ ?><img src="<?php echo $row['sign']; ?>"><?php } ?></span></p>
   <p><span style="color:#3E020C;">RESUME:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['resume']){ ?><img src="<?php echo $row['resume']; ?>"><?php } ?></span></p>
   <?php if($row['user_role'] == '8') {?>
      <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Firm Information:</h4> </center>
      <p><span style="color:#3E020C;">FIRM NAME:</span>&nbsp;&nbsp;<?php echo $row['shop']; ?></p>
      <p><span style="color:#3E020C;">FIRM TYPE:</span>&nbsp;&nbsp;<?php echo $row['shoptype']; ?></p>
      <p><span style="color:#3E020C;">YEAR:</span>&nbsp;&nbsp;<?php echo $row['year']; ?></p>
      <p><span style="color:#3E020C;">SALE TYPE:</span>&nbsp;&nbsp;<?php echo $row['saletype']; ?></p>
      <?php } ?>
   <h4 style="background-color: #d9d9d9;padding:10px;">Education:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Degree</th><th>Year</th><th>Division</th></tr></thead>
   	<body>
     <?php
           $temp=explode(',', $row["degree"]);
           $temp1=explode(',', $row["degYear"]);
           $temp2=explode(',', $row["division"]);
              $n=count($temp);
                      if($n>1)
                      {
                for ($i=0; $i < $n ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr><?php } }?></body>
   </table></p>
   <h4 style="background-color: #d9d9d9;padding:10px;">Experience:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Work</th><th>Year</th><th>Position</th></tr></thead>
   	<body>
     <?php
          $temp3=explode(',', $row["workName"]);
          $temp4=explode(',', $row["exp"]);
          $temp5=explode(',', $row["position"]);
          $n1=count($temp3);
            
                      if($n1>1)
                      {
                for ($i=0; $i < $n1 ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr><?php } }?></body>
   </table></p>
   <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $row['regdate']; ?></p>
   <?php
   //echo "SELECT * form `approved_by` WHERE user_id = '".$row['id']."'";
   $sql_approved_data= mysqli_query($conn,"SELECT * FROM `approved_by` WHERE `user_id` = '".$row['id']."'");
   $result12=mysqli_fetch_assoc($sql_approved_data);
   $date=str_replace('am','',$result12['approved_date']);
   $date=str_replace('pm','',$date);
   //echo "SELECT group_name FROM groups WHERE group_id = '".$result['user_role_id']."'";
   if(sizeof($result12)){
    // echo "SELECT * FROM `users` WHERE `user_role` = '".$result12['user_role_id']."'";
   $sql_role_data= mysqli_query($conn, "SELECT group_name FROM groups WHERE group_id = '".$result12['user_role_id']."'");
   $results=mysqli_fetch_assoc($sql_role_data);

   $sql_name_get= mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$result12['approvel_user_id']."'");
   $name_get=mysqli_fetch_assoc($sql_name_get);
   $name= $name_get['first_name'].' '.$name_get['last_name'];
   //	print_r($results);
   ?>
  <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname.' by '. $results['group_name'].'('.$name.')'; ?></p>
  <p ><span style="color:#3E020C;">Approved Date:&nbsp;&nbsp;</span><?php echo $date; ?></p>
<?php }else{ ?> 

<p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
<?php } ?>
</div>
      </center>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                            <!-- Model End -->
					    					</td>
					    					<td><?php echo $row['email']; ?></td>
					    					<td><?php echo $row['phone']; ?></td>
					    					<td><?php $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					         if(isset($sql1) && $sql1 != ""){
					    					          while($row1 = mysqli_fetch_assoc($sql1)) {
					    					          	
					    					          	echo $row1['name']." ,";
					    					          }
					    					          }
					    					           ?></td>
					    					<td><?php $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					          if(isset($sql2) && $sql2 != ""){
					    					          while($row2 = mysqli_fetch_assoc($sql2)) {
					    					          	echo $row2['name'].",";
					    					          }
					    					      }
					    					          ?></td>
					    					<td><?php if($row['status'] == 7) {
					    								?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php 
					    					          } else {  
					    					          		// echo "string".$row['status'];
					    					          	?>
					    					          	<a href="statusupdate.php?idra=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&pg=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    					          <?php }?></td>
					    					<td>
					    					<?php if($row['user_role']=='7' || $row['user_role']=='8'){ ?>
					    					<a href="updatesalesperson.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a><?php } else if($row['user_role']=='6') { ?>
                                            <a href="updateasm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>       
					    						<?php } else { ?>
			<a href="updatersm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a> <?php }?>&nbsp;&nbsp; 
            <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
            <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a>
            </td>
					    				</tr>
					    				<?php $i++; }
					    			}

					    		} else if($row_login['user_role'] == 2) {
					    			if($_GET['type'] == 'gm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='3'");
					    		    }
					    		    else if($_GET['type'] == 'zsm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='4'");
					    		     }
					    		     else if($_GET['type'] == 'rsm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='5'");
					    		     }
					    		     else if($_GET['type'] == 'asm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='6'");
					    		     }
					    		     else if($_GET['type'] == 'sp') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7'");
					    		     }
					    		     else if($_GET['type'] == 'dl') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8'");
					    		     }
					    			if (mysqli_num_rows($sql) > 0) {
					    				$i =1;
					    				while($row = mysqli_fetch_assoc($sql))  { ?>
					    				<tr>
					    					<td><?php echo $i; ?></td>
					    					<td class="img-profile"><img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;"></td>
					    					<td><a href="#" data-toggle="modal" data-target="#myModal_<?php echo $i; ?>" for="textarea"><?php echo $row['username']; ?></a>
					    					    <!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Imformation:</h4> </center>
         <center><div class="card">
  <img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;">
  <h5><span style="color:#3E020C;">NAME:</span>&nbsp;&nbsp;<?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></h5>
  <p class="title"><span style="color:#3E020C;">EMAIL:</span>&nbsp;&nbsp;<?php echo $row['email']; ?></p>
  <?php $sql1 = "SELECT statusname  FROM status where id ='".$row['status']."'"; 
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $statusname= $row1['statusname'];   
  ?>
  <p><span style="color:#3E020C;">PHONE:</span>&nbsp;&nbsp;<?php echo $row['phone']; ?></p>
  <p><span style="color:#3E020C;">DOB:</span>&nbsp;&nbsp;<?php echo $row['dob']; ?></p>
  
  <h4 style="background-color: #d9d9d9;padding:10px;">Uploading Information:</h4>
  <p><span style="color:#3E020C;">LIENCENSE:</span>&nbsp;&nbsp;<?php echo $row['liencense']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['lienimg']){ ?><a data-magnify="gallery" href="../<?php echo $row['lienimg']; ?>"><img src="<?php echo $row['lienimg']; ?>"></a><?php } ?></span></p>
  <p><span style="color:#3E020C;">ADHARCARD:</span>&nbsp;&nbsp;<?php echo $row['adharcard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['adharimg']){ ?><img src="<?php echo $row['adharimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">PANCARD:</span>&nbsp;&nbsp;<?php echo $row['pancard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['panimg']){ ?><img src="<?php echo $row['pancardimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">GSTN:</span>&nbsp;&nbsp;<?php echo $row['gtsno']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['gstimg']){ ?><img src="<?php echo $row['gstimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">SIGNATURE:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['sign']){ ?><img src="<?php echo $row['sign']; ?>"><?php } ?></span></p>
   <p><span style="color:#3E020C;">RESUME:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['resume']){ ?><img src="<?php echo $row['resume']; ?>"><?php } ?></span></p>
   <?php if($row['user_role'] == '8') {?>
      <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Firm Information:</h4> </center>
      <p><span style="color:#3E020C;">FIRM NAME:</span>&nbsp;&nbsp;<?php echo $row['shop']; ?></p>
      <p><span style="color:#3E020C;">FIRM TYPE:</span>&nbsp;&nbsp;<?php echo $row['shoptype']; ?></p>
      <p><span style="color:#3E020C;">YEAR:</span>&nbsp;&nbsp;<?php echo $row['year']; ?></p>
      <p><span style="color:#3E020C;">SALE TYPE:</span>&nbsp;&nbsp;<?php echo $row['saletype']; ?></p>
      <?php } ?>
   <h4 style="background-color: #d9d9d9;padding:10px;">Education:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Degree</th><th>Year</th><th>Division</th></tr></thead>
   	<body>
     <?php
           $temp=explode(',', $row["degree"]);
           $temp1=explode(',', $row["degYear"]);
           $temp2=explode(',', $row["division"]);
              $n=count($temp);
                      if($n>1)
                      {
                for ($i=0; $i < $n ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr><?php } }?></body>
   </table></p>
   <h4 style="background-color: #d9d9d9;padding:10px;">Experience:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Work</th><th>Year</th><th>Position</th></tr></thead>
   	<body>
     <?php
          $temp3=explode(',', $row["workName"]);
          $temp4=explode(',', $row["exp"]);
          $temp5=explode(',', $row["position"]);
          $n1=count($temp3);
            
                      if($n1>1)
                      {
                for ($i=0; $i < $n1 ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr><?php } }?></body>
   </table></p>
   <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $row['regdate']; ?></p>
   <?php
   //echo "SELECT * form `approved_by` WHERE user_id = '".$row['id']."'";
   $sql_approved_data= mysqli_query($conn,"SELECT * FROM `approved_by` WHERE `user_id` = '".$row['id']."'");
   $result12=mysqli_fetch_assoc($sql_approved_data);
   $date=str_replace('am','',$result12['approved_date']);
   $date=str_replace('pm','',$date);
   //echo "SELECT group_name FROM groups WHERE group_id = '".$result['user_role_id']."'";
   if(sizeof($result12)){
    // echo "SELECT * FROM `users` WHERE `user_role` = '".$result12['user_role_id']."'";
   $sql_role_data= mysqli_query($conn, "SELECT group_name FROM groups WHERE group_id = '".$result12['user_role_id']."'");
   $results=mysqli_fetch_assoc($sql_role_data);

   $sql_name_get= mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$result12['approvel_user_id']."'");
   $name_get=mysqli_fetch_assoc($sql_name_get);
   $name= $name_get['first_name'].' '.$name_get['last_name'];
   //	print_r($results);
   ?>
  <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo 'Approved by '.$results['group_name'].'('.$name.')'; ?></p>
  <p ><span style="color:#3E020C;">Approved Date:&nbsp;&nbsp;</span><?php echo $date; ?></p>
<?php }else{ ?> 

<p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
<?php } ?>

</div>
      </center>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                            <!-- Model End -->
                                            
					    					</td>
					    					<td><?php echo $row['email']; ?></td>
					    					<td><?php echo $row['phone']; ?></td>
					    					<td><?php $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					          if(isset($sql1) && $sql1 != ""){
					    					          while($row1 = mysqli_fetch_assoc($sql1)) {
					    					          	
					    					          	echo $row1['name']." ,";
					    					          }
					    					          }
					    					           ?></td>
					    					<td><?php $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					          if(isset($sql2) && $sql2 != ""){
					    					          while($row2 = mysqli_fetch_assoc($sql2)) {
					    					          	
					    					          	echo $row2['name']." ,";
					    					          }
					    					          }
					    					          ?></td>
					    					<td><?php if($row['status'] == 7) {
					    								?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php

					    					          } else {  ?>
					    					          	<a href="statusupdate.php?idra=<?php echo $row['id'];?>&st=<?php echo $row['status'];?>&pg=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    					          <?php }?></td>
					    					<td>
                                            <?php if($row['user_role']=='7' || $row['user_role']=='8'){ ?>
					    					<a href="updatesalesperson.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a><?php } else if($row['user_role']=='6') { ?>
                                            <a href="updateasm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>       
					    						<?php } else { ?><a href="updatersm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a> <?php }?>&nbsp;&nbsp;
             <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
             <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a>
             </td>
					    				</tr>
					    				<?php $i++; }
					    			}
					    		} else if($row_login['user_role'] == 3) {
					    			if($_GET['type'] == 'zsm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='4'");
					    		     }
					    		     else if($_GET['type'] == 'rsm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='5'");
					    		     }
					    		     else if($_GET['type'] == 'asm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='6'");
					    		     }
					    		     else if($_GET['type'] == 'sp') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7'");
					    		     }
					    		     else if($_GET['type'] == 'dl') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8'");
					    		     }
					    			if (mysqli_num_rows($sql) > 0) {
					    				$i =1;
					    				while($row = mysqli_fetch_assoc($sql))  { ?>
					    				<tr>
					    					<td><?php echo $i; ?></td>
					    					<td class="img-profile"><img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;"></td>
					    					<td><a href="#" data-toggle="modal" data-target="#myModal_<?php echo $i; ?>" for="textarea"><?php echo $row['username']; ?></a>
					    						
					    						    <!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Imformation:</h4> </center>
         <center><div class="card">
  <img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;">
  <h5><span style="color:#3E020C;">NAME:</span>&nbsp;&nbsp;<?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></h5>
  <p class="title"><span style="color:#3E020C;">EMAIL:</span>&nbsp;&nbsp;<?php echo $row['email']; ?></p>
  <?php $sql1 = "SELECT statusname  FROM status where id ='".$row['status']."'"; 
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $statusname= $row1['statusname'];   
  ?>
  <p><span style="color:#3E020C;">PHONE:</span>&nbsp;&nbsp;<?php echo $row['phone']; ?></p>
  <p><span style="color:#3E020C;">DOB:</span>&nbsp;&nbsp;<?php echo $row['dob']; ?></p>
  
  <h4 style="background-color: #d9d9d9;padding:10px;">Uploading Information:</h4>
  <p><span style="color:#3E020C;">LIENCENSE:</span>&nbsp;&nbsp;<?php echo $row['liencense']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['lienimg']){ ?><img src="<?php echo $row['lienimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">ADHARCARD:</span>&nbsp;&nbsp;<?php echo $row['adharcard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['adharimg']){ ?><img src="<?php echo $row['adharimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">PANCARD:</span>&nbsp;&nbsp;<?php echo $row['pancard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['panimg']){ ?><img src="<?php echo $row['pancardimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">GSTN:</span>&nbsp;&nbsp;<?php echo $row['gtsno']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['gstimg']){ ?><img src="<?php echo $row['gstimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">SIGNATURE:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['sign']){ ?><img src="<?php echo $row['sign']; ?>"><?php } ?></span></p>
   <p><span style="color:#3E020C;">RESUME:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['resume']){ ?><img src="<?php echo $row['resume']; ?>"><?php } ?></span></p>
   <?php if($row['user_role'] == '8') {?>
      <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Firm Information:</h4> </center>
      <p><span style="color:#3E020C;">FIRM NAME:</span>&nbsp;&nbsp;<?php echo $row['shop']; ?></p>
      <p><span style="color:#3E020C;">FIRM TYPE:</span>&nbsp;&nbsp;<?php echo $row['shoptype']; ?></p>
      <p><span style="color:#3E020C;">YEAR:</span>&nbsp;&nbsp;<?php echo $row['year']; ?></p>
      <p><span style="color:#3E020C;">SALE TYPE:</span>&nbsp;&nbsp;<?php echo $row['saletype']; ?></p>
      <?php } ?>
   <h4 style="background-color: #d9d9d9;padding:10px;">Education:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Degree</th><th>Year</th><th>Division</th></tr></thead>
   	<body>
     <?php
           $temp=explode(',', $row["degree"]);
           $temp1=explode(',', $row["degYear"]);
           $temp2=explode(',', $row["division"]);
              $n=count($temp);
                      if($n>1)
                      {
                for ($i=0; $i < $n ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr><?php } }?></body>
   </table></p>
   <h4 style="background-color: #d9d9d9;padding:10px;">Experience:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Work</th><th>Year</th><th>Position</th></tr></thead>
   	<body>
     <?php
          $temp3=explode(',', $row["workName"]);
          $temp4=explode(',', $row["exp"]);
          $temp5=explode(',', $row["position"]);
          $n1=count($temp3);
            
                      if($n1>1)
                      {
                for ($i=0; $i < $n1 ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr><?php } }?></body>
   </table></p>
   <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $row['regdate']; ?></p>
   <?php
   //echo "SELECT * form `approved_by` WHERE user_id = '".$row['id']."'";
   $sql_approved_data= mysqli_query($conn,"SELECT * FROM `approved_by` WHERE `user_id` = '".$row['id']."'");
   $result12=mysqli_fetch_assoc($sql_approved_data);
   $date=str_replace('am','',$result12['approved_date']);
   $date=str_replace('pm','',$date);
   //echo "SELECT group_name FROM groups WHERE group_id = '".$result['user_role_id']."'";
   if(sizeof($result12)){
    // echo "SELECT * FROM `users` WHERE `user_role` = '".$result12['user_role_id']."'";
   $sql_role_data= mysqli_query($conn, "SELECT group_name FROM groups WHERE group_id = '".$result12['user_role_id']."'");
   $results=mysqli_fetch_assoc($sql_role_data);

   $sql_name_get= mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$result12['approvel_user_id']."'");
   $name_get=mysqli_fetch_assoc($sql_name_get);
   $name= $name_get['first_name'].' '.$name_get['last_name'];
   //	print_r($results);
   ?>
  <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo  'Approved by '.$results['group_name'].'('.$name.')'; ?></p>
  <p ><span style="color:#3E020C;">Approved Date:&nbsp;&nbsp;</span><?php echo $date; ?></p>
<?php }else{ ?> 

<p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
<?php } ?>

</div>
      </center>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                            <!-- Model End -->
					    					</td>
					    					<td><?php echo $row['email']; ?></td>
					    					<td><?php echo $row['phone']; ?></td>
					    					<td><?php $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					          if(isset($sql1) && $sql1 != ""){
					    					          while($row1 = mysqli_fetch_assoc($sql1)) {
					    					          	
					    					          	echo $row1['name']." ,";
					    					          }
					    					          }
					    					           ?></td>
					    					<td><?php $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					          if(isset($sql2) && $sql2 != ""){
					    					          while($row2 = mysqli_fetch_assoc($sql2)) {
					    					          	
					    					          	echo $row2['name']." ,";
					    					          }
					    					          }
					    					          ?></td>
					    					<td><?php if($row['status'] == 7) {
					    								?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php

					    					          } else {  ?>
					    					          	<a href="statusupdate.php?idgm=<?php echo $row['id'];?>&stgm=<?php echo $row['status'];?>&pggm=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    					          <?php }?></td>
					    					<td><?php if($row['user_role']=='7' || $row['user_role']=='8'){ ?>
					    					<a href="updatesalesperson.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a><?php } else if($row['user_role']=='6') { ?>
                                            <a href="updateasm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>       
					    						<?php } else { ?><a href="updatersm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a> <?php }?>&nbsp;&nbsp;  
             <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
             <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a>
             </td>
					    				</tr>
					    				<?php $i++; }
					    			}
					    		} else if($row_login['user_role'] == 4) {
					    			if($_GET['type'] == 'rsm') {
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='5' and state IN(".$row_login['state'].")");
					    		     }
					    		     else if($_GET['type'] == 'asm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='6' and state IN(".$row_login['state'].")");
					    		     }
					    		     else if($_GET['type'] == 'sp') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7' and state IN(".$row_login['state'].")");
					    		     }
					    		     else if($_GET['type'] == 'dl') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8' and state IN(".$row_login['state'].")");
					    		     }
					    			if (mysqli_num_rows($sql) > 0) {
					    				$i =1;
					    				while($row = mysqli_fetch_assoc($sql))  { ?>
					    				<tr>
					    					<td><?php echo $i; ?></td>
					    					<td class="img-profile"><img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;"></td>
					    					<td><a href="#" data-toggle="modal" data-target="#myModal_<?php echo $i; ?>" for="textarea"><?php echo $row['username']; ?></a>
					    						
					    						    <!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Imformation:</h4> </center>
         <center><div class="card">
  <img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;">
  <h5><span style="color:#3E020C;">NAME:</span>&nbsp;&nbsp;<?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></h5>
  <p class="title"><span style="color:#3E020C;">EMAIL:</span>&nbsp;&nbsp;<?php echo $row['email']; ?></p>
  <?php $sql1 = "SELECT statusname  FROM status where id ='".$row['status']."'"; 
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $statusname= $row1['statusname'];   
  ?>
  <p><span style="color:#3E020C;">PHONE:</span>&nbsp;&nbsp;<?php echo $row['phone']; ?></p>
  <p><span style="color:#3E020C;">DOB:</span>&nbsp;&nbsp;<?php echo $row['dob']; ?></p>
  
  <h4 style="background-color: #d9d9d9;padding:10px;">Uploading Information:</h4>
  <p><span style="color:#3E020C;">LIENCENSE:</span>&nbsp;&nbsp;<?php echo $row['liencense']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['lienimg']){ ?><img src="<?php echo $row['lienimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">ADHARCARD:</span>&nbsp;&nbsp;<?php echo $row['adharcard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['adharimg']){ ?><img src="<?php echo $row['adharimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">PANCARD:</span>&nbsp;&nbsp;<?php echo $row['pancard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['panimg']){ ?><img src="<?php echo $row['pancardimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">GSTN:</span>&nbsp;&nbsp;<?php echo $row['gtsno']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['gstimg']){ ?><img src="<?php echo $row['gstimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">SIGNATURE:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['sign']){ ?><img src="<?php echo $row['sign']; ?>"><?php } ?></span></p>
   <p><span style="color:#3E020C;">RESUME:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['resume']){ ?><img src="<?php echo $row['resume']; ?>"><?php } ?></span></p>
   <?php if($row['user_role'] == '8') {?>
      <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Firm Information:</h4> </center>
      <p><span style="color:#3E020C;">FIRM NAME:</span>&nbsp;&nbsp;<?php echo $row['shop']; ?></p>
      <p><span style="color:#3E020C;">FIRM TYPE:</span>&nbsp;&nbsp;<?php echo $row['shoptype']; ?></p>
      <p><span style="color:#3E020C;">YEAR:</span>&nbsp;&nbsp;<?php echo $row['year']; ?></p>
      <p><span style="color:#3E020C;">SALE TYPE:</span>&nbsp;&nbsp;<?php echo $row['saletype']; ?></p>
      <?php } ?>
   <h4 style="background-color: #d9d9d9;padding:10px;">Education:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Degree</th><th>Year</th><th>Division</th></tr></thead>
   	<body>
     <?php
           $temp=explode(',', $row["degree"]);
           $temp1=explode(',', $row["degYear"]);
           $temp2=explode(',', $row["division"]);
              $n=count($temp);
                      if($n>1)
                      {
                for ($i=0; $i < $n ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr><?php } }?></body>
   </table></p>
   <h4 style="background-color: #d9d9d9;padding:10px;">Experience:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Work</th><th>Year</th><th>Position</th></tr></thead>
   	<body>
     <?php
          $temp3=explode(',', $row["workName"]);
          $temp4=explode(',', $row["exp"]);
          $temp5=explode(',', $row["position"]);
          $n1=count($temp3);
            
                      if($n1>1)
                      {
                for ($i=0; $i < $n1 ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr><?php } }?></body>
   </table></p>
   <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $row['regdate']; ?></p>
   <?php
   //echo "SELECT * form `approved_by` WHERE user_id = '".$row['id']."'";
   $sql_approved_data= mysqli_query($conn,"SELECT * FROM `approved_by` WHERE `user_id` = '".$row['id']."'");
   $result12=mysqli_fetch_assoc($sql_approved_data);
   $date=str_replace('am','',$result12['approved_date']);
   $date=str_replace('pm','',$date);
   //echo "SELECT group_name FROM groups WHERE group_id = '".$result['user_role_id']."'";
   if(sizeof($result12)){
    // echo "SELECT * FROM `users` WHERE `user_role` = '".$result12['user_role_id']."'";
   $sql_role_data= mysqli_query($conn, "SELECT group_name FROM groups WHERE group_id = '".$result12['user_role_id']."'");
   $results=mysqli_fetch_assoc($sql_role_data);

   $sql_name_get= mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$result12['approvel_user_id']."'");
   $name_get=mysqli_fetch_assoc($sql_name_get);
   $name= $name_get['first_name'].' '.$name_get['last_name'];
   //	print_r($results);
   ?>
  <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo 'Approved by '.$results['group_name'].'('.$name.')'; ?></p>
  <p ><span style="color:#3E020C;">Approved Date:&nbsp;&nbsp;</span><?php echo $date; ?></p>
<?php }else{ ?> 

<p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
<?php } ?>

</div>
      </center>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                            <!-- Model End -->
					    					</td>
					    					<td><?php echo $row['email']; ?></td>
					    					<td><?php echo $row['phone']; ?></td>
					    					<td><?php $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					           if(isset($sql1) && $sql1 != ""){
					    					          while($row1 = mysqli_fetch_assoc($sql1)) {
					    					          	
					    					          	echo $row1['name']." ,";
					    					          }
					    					          }
					    					           ?></td>
					    					<td><?php $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					         if(isset($sql2) && $sql2 != ""){
					    					          while($row2 = mysqli_fetch_assoc($sql2)) {
					    					          	
					    					          	echo $row2['name']." ,";
					    					          }
					    					          }
					    					          ?></td>
					    					<td><?php if($row['status'] == 7) {
					    							?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php
					    					          } else {  ?>
					    					          <a href="statusupdate.php?idzm=<?php echo $row['id'];?>&stzm=<?php echo $row['status'];?>&pgzm=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    					          <?php }?></td>
					    					<td><?php if($row['user_role']=='7' || $row['user_role']=='8'){ ?>
					    					<a href="updatesalesperson.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a><?php } else if($row['user_role']=='6') { ?>
                                            <a href="updateasm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>       
					    						<?php } else { ?><a href="updatersm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a> <?php }?>&nbsp;&nbsp; 
             <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
             <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a>
             </td>
					    				</tr>
					    				<?php $i++; }
					    			}
					    		} else if($row_login['user_role'] == 5) {
					    			 if($_GET['type'] == 'asm') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='6' and state IN(".$row_login['state'].")");
					    		     }
					    		     else if($_GET['type'] == 'sp') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7' and state IN(".$row_login['state'].")");
					    		     }
					    		     else if($_GET['type'] == 'dl') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8' and state IN(".$row_login['state'].")");
					    		     }
					    			if (mysqli_num_rows($sql) > 0) {
					    				$i =1;
					    				while($row = mysqli_fetch_assoc($sql))  { ?>
					    				<tr>
					    					<td><?php echo $i; ?></td>
					    					<td class="img-profile"><img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;"></td>
					    					<td><a href="#" data-toggle="modal" data-target="#myModal_<?php echo $i; ?>" for="textarea"><?php echo $row['username']; ?></a>
					    						
					    						    <!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Imformation:</h4> </center>
         <center><div class="card">
  <img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;">
  <h5><span style="color:#3E020C;">NAME:</span>&nbsp;&nbsp;<?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></h5>
  <p class="title"><span style="color:#3E020C;">EMAIL:</span>&nbsp;&nbsp;<?php echo $row['email']; ?></p>
  <?php $sql1 = "SELECT statusname  FROM status where id ='".$row['status']."'"; 
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $statusname= $row1['statusname'];   
  ?>
  <p><span style="color:#3E020C;">PHONE:</span>&nbsp;&nbsp;<?php echo $row['phone']; ?></p>
  <p><span style="color:#3E020C;">DOB:</span>&nbsp;&nbsp;<?php echo $row['dob']; ?></p>
  
  <h4 style="background-color: #d9d9d9;padding:10px;">Uploading Information:</h4>
  <p><span style="color:#3E020C;">LIENCENSE:</span>&nbsp;&nbsp;<?php echo $row['liencense']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['lienimg']){ ?><img src="<?php echo $row['lienimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">ADHARCARD:</span>&nbsp;&nbsp;<?php echo $row['adharcard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['adharimg']){ ?><img src="<?php echo $row['adharimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">PANCARD:</span>&nbsp;&nbsp;<?php echo $row['pancard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['panimg']){ ?><img src="<?php echo $row['pancardimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">GSTN:</span>&nbsp;&nbsp;<?php echo $row['gtsno']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['gstimg']){ ?><img src="<?php echo $row['gstimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">SIGNATURE:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['sign']){ ?><img src="<?php echo $row['sign']; ?>"><?php } ?></span></p>
   <p><span style="color:#3E020C;">RESUME:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['resume']){ ?><img src="<?php echo $row['resume']; ?>"><?php } ?></span></p>
   <?php if($row['user_role'] == '8') {?>
      <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Firm Information:</h4> </center>
      <p><span style="color:#3E020C;">FIRM NAME:</span>&nbsp;&nbsp;<?php echo $row['shop']; ?></p>
      <p><span style="color:#3E020C;">FIRM TYPE:</span>&nbsp;&nbsp;<?php echo $row['shoptype']; ?></p>
      <p><span style="color:#3E020C;">YEAR:</span>&nbsp;&nbsp;<?php echo $row['year']; ?></p>
      <p><span style="color:#3E020C;">SALE TYPE:</span>&nbsp;&nbsp;<?php echo $row['saletype']; ?></p>
      <?php } ?>
   <h4 style="background-color: #d9d9d9;padding:10px;">Education:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Degree</th><th>Year</th><th>Division</th></tr></thead>
   	<body>
     <?php
           $temp=explode(',', $row["degree"]);
           $temp1=explode(',', $row["degYear"]);
           $temp2=explode(',', $row["division"]);
              $n=count($temp);
                      if($n>1)
                      {
                for ($i=0; $i < $n ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr><?php } }?></body>
   </table></p>
   <h4 style="background-color: #d9d9d9;padding:10px;">Experience:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Work</th><th>Year</th><th>Position</th></tr></thead>
   	<body>
     <?php
          $temp3=explode(',', $row["workName"]);
          $temp4=explode(',', $row["exp"]);
          $temp5=explode(',', $row["position"]);
          $n1=count($temp3);
            
                      if($n1>1)
                      {
                for ($i=0; $i < $n1 ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr><?php } }?></body>
   </table></p>
   <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $row['regdate']; ?></p>
   <?php
   //echo "SELECT * form `approved_by` WHERE user_id = '".$row['id']."'";
   $sql_approved_data= mysqli_query($conn,"SELECT * FROM `approved_by` WHERE `user_id` = '".$row['id']."'");
   $result12=mysqli_fetch_assoc($sql_approved_data);
   $date=str_replace('am','',$result12['approved_date']);
   $date=str_replace('pm','',$date);
   //echo "SELECT group_name FROM groups WHERE group_id = '".$result['user_role_id']."'";
   if(sizeof($result12)){
    // echo "SELECT * FROM `users` WHERE `user_role` = '".$result12['user_role_id']."'";
   $sql_role_data= mysqli_query($conn, "SELECT group_name FROM groups WHERE group_id = '".$result12['user_role_id']."'");
   $results=mysqli_fetch_assoc($sql_role_data);

   $sql_name_get= mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$result12['approvel_user_id']."'");
   $name_get=mysqli_fetch_assoc($sql_name_get);
   $name= $name_get['first_name'].' '.$name_get['last_name'];
   //	print_r($results);
   ?>
  <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo 'Approved by '.$results['group_name'].'('.$name.')'; ?></p>
  <p ><span style="color:#3E020C;">Approved Date:&nbsp;&nbsp;</span><?php echo $date; ?></p>
<?php }else{ ?> 

<p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
<?php } ?>

</div>
      </center>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                            <!-- Model End -->
					    					</td>
					    					<td><?php echo $row['email']; ?></td>
					    					<td><?php echo $row['phone']; ?></td>
					    					<td><?php $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					          if(isset($sql1) && $row1 != ""){
					    					          while($row1 = mysqli_fetch_assoc($sql1)) {
					    					          	
					    					          	echo $row1['name']." ,";
					    					          }
					    					          }
					    					           ?></td>
					    					<td><?php $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					          if(isset($sql2) && $sql2 != ""){
					    					          while($row2 = mysqli_fetch_assoc($sql2)) {
					    					          	
					    					          	echo $row2['name']." ,";
					    					          }
					    					          }
					    					          ?></td>
					    					<td><?php if($row['status'] == 7) {
					    								?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php
					    					          } else {  ?>
					    					          	<a href="statusupdate.php?idrm=<?php echo $row['id'];?>&strm=<?php echo $row['status'];?>&pgrm=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    					          <?php }?></td>
					    					<td><?php if($row['user_role']=='7' || $row['user_role']=='8'){ ?>
					    					<a href="updatesalesperson.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a><?php } else if($row['user_role']=='6') { ?>
                                            <a href="updateasm.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>       
					    						<?php } ?>&nbsp;&nbsp; 
             <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
             <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a>
             </td>
					    				</tr>
					    				<?php $i++; }
					    			}
					    		} else if($row_login['user_role'] == 6) {
					    			if($_GET['type'] == 'sp') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='7' and city IN(".$row_login['city'].")");
					    		     }
					    		     else if($_GET['type'] == 'dl') { 
					    			$sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and user_role='8' and city IN(".$row_login['city'].")");
					    		     }
					    			if (mysqli_num_rows($sql) > 0) {
					    				$i =1;
					    				while($row = mysqli_fetch_assoc($sql))  { ?>
					    				<tr>
					    					<td><?php echo $i; ?></td>
					    					<td class="img-profile"><img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;"></td>
					    					<td><a href="#" data-toggle="modal" data-target="#myModal_<?php echo $i; ?>" for="textarea"><?php echo $row['username']; ?></a>
					    						
					    						    <!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Imformation:</h4> </center>
         <center><div class="card">
  <img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;">
  <h5><span style="color:#3E020C;">NAME:</span>&nbsp;&nbsp;<?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></h5>
  <p class="title"><span style="color:#3E020C;">EMAIL:</span>&nbsp;&nbsp;<?php echo $row['email']; ?></p>
  <?php $sql1 = "SELECT statusname  FROM status where id ='".$row['status']."'"; 
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $statusname= $row1['statusname'];   
  ?>
  <p><span style="color:#3E020C;">PHONE:</span>&nbsp;&nbsp;<?php echo $row['phone']; ?></p>
  <p><span style="color:#3E020C;">DOB:</span>&nbsp;&nbsp;<?php echo $row['dob']; ?></p>
  
  <h4 style="background-color: #d9d9d9;padding:10px;">Uploading Information:</h4>
  <p><span style="color:#3E020C;">LIENCENSE:</span>&nbsp;&nbsp;<?php echo $row['liencense']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['lienimg']){ ?><img src="<?php echo $row['lienimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">ADHARCARD:</span>&nbsp;&nbsp;<?php echo $row['adharcard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['adharimg']){ ?><img src="<?php echo $row['adharimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">PANCARD:</span>&nbsp;&nbsp;<?php echo $row['pancard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['panimg']){ ?><img src="<?php echo $row['pancardimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">GSTN:</span>&nbsp;&nbsp;<?php echo $row['gtsno']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['gstimg']){ ?><img src="<?php echo $row['gstimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">SIGNATURE:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['sign']){ ?><img src="<?php echo $row['sign']; ?>"><?php } ?></span></p>
   <p><span style="color:#3E020C;">RESUME:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['resume']){ ?><img src="<?php echo $row['resume']; ?>"><?php } ?></span></p>
   <?php if($row['user_role'] == '8') {?>
      <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Firm Information:</h4> </center>
      <p><span style="color:#3E020C;">FIRM NAME:</span>&nbsp;&nbsp;<?php echo $row['shop']; ?></p>
      <p><span style="color:#3E020C;">FIRM TYPE:</span>&nbsp;&nbsp;<?php echo $row['shoptype']; ?></p>
      <p><span style="color:#3E020C;">YEAR:</span>&nbsp;&nbsp;<?php echo $row['year']; ?></p>
      <p><span style="color:#3E020C;">SALE TYPE:</span>&nbsp;&nbsp;<?php echo $row['saletype']; ?></p>
      <?php } ?>
   <h4 style="background-color: #d9d9d9;padding:10px;">Education:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Degree</th><th>Year</th><th>Division</th></tr></thead>
   	<body>
     <?php
           $temp=explode(',', $row["degree"]);
           $temp1=explode(',', $row["degYear"]);
           $temp2=explode(',', $row["division"]);
              $n=count($temp);
                      if($n>1)
                      {
                for ($i=0; $i < $n ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr><?php } }?></body>
   </table></p>
   <h4 style="background-color: #d9d9d9;padding:10px;">Experience:</h4>
   <p><table class="table table-bordered">
   	<thead><tr><th>Work</th><th>Year</th><th>Position</th></tr></thead>
   	<body>
     <?php
          $temp3=explode(',', $row["workName"]);
          $temp4=explode(',', $row["exp"]);
          $temp5=explode(',', $row["position"]);
          $n1=count($temp3);
            
                      if($n1>1)
                      {
                for ($i=0; $i < $n1 ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr><?php } }?></body>
   </table></p>
   <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $row['regdate']; ?></p>
   <?php
   //echo "SELECT * form `approved_by` WHERE user_id = '".$row['id']."'";
   $sql_approved_data= mysqli_query($conn,"SELECT * FROM `approved_by` WHERE `user_id` = '".$row['id']."'");
   $result12=mysqli_fetch_assoc($sql_approved_data);
   $date=str_replace('am','',$result12['approved_date']);
   $date=str_replace('pm','',$date);
   //echo "SELECT group_name FROM groups WHERE group_id = '".$result['user_role_id']."'";
   if(sizeof($result12)){
    // echo "SELECT * FROM `users` WHERE `user_role` = '".$result12['user_role_id']."'";
   $sql_role_data= mysqli_query($conn, "SELECT group_name FROM groups WHERE group_id = '".$result12['user_role_id']."'");
   $results=mysqli_fetch_assoc($sql_role_data);

   $sql_name_get= mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$result12['approvel_user_id']."'");
   $name_get=mysqli_fetch_assoc($sql_name_get);
   $name= $name_get['first_name'].' '.$name_get['last_name'];
   //	print_r($results);
   ?>
  <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo 'Approved by '.$results['group_name'].'('.$name.')'; ?></p>
  <p ><span style="color:#3E020C;">Approved Date:&nbsp;&nbsp;</span><?php echo $date; ?></p>
<?php }else{ ?> 

<p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
<?php } ?>

</div>
      </center>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                            <!-- Model End -->
					    					</td>
					    					<td><?php echo $row['email']; ?></td>
					    					<td><?php echo $row['phone']; ?></td>
					    					<td><?php $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					          if(isset($sql1) && $sql1 != ""){
					    					          while($row1 = mysqli_fetch_assoc($sql1)) {
					    					          	
					    					          	echo $row1['name']." ,";
					    					          }
					    					          }
					    					           ?></td>
					    					<td><?php $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					          if(isset($sql2) && $sql2 != ""){
					    					          while($row2 = mysqli_fetch_assoc($sql2)) {
					    					          	echo $row2['name'].",";
					    					         } }
					    					          ?></td>
					    					<td><?php if($row['status'] == 7) {
					    							?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php

					    					          } else {  ?>
					    					          	<a href="statusupdate.php?idam=<?php echo $row['id'];?>&stam=<?php echo $row['status'];?>&pgam=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    					          <?php }?></td>
					    					<td><?php if($row['user_role']=='8'){ ?>
					    					<a href="updatesalesperson.php?id=<?php  echo $row['id']; ?>&type=<?php echo $_GET['type']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a><?php  }?>&nbsp;&nbsp;&nbsp;&nbsp; 
             <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
             <a href="profile.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a>
             </td>
					    				</tr>
					    				<?php $i++; }
					    			}
					    		} else if($row_login['user_role'] == 7) {
					    			if($_GET['type'] == 'dl') { 
					    			 $sql = mysqli_query($conn, "SELECT * FROM users WHERE active = '1' and allot_to = '".$_SESSION['userId']."'");
					    		     }
					    			if (mysqli_num_rows($sql) > 0) {
					    				$i =1;
					    				while($row = mysqli_fetch_assoc($sql))  { ?>
					    				<tr>
					    					<td><?php echo $i; ?></td>
					    					<td class="img-profile"><img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;"></td>
					    					<td><a href="#" data-toggle="modal" data-target="#myModal_<?php echo $i; ?>" for="textarea"><?php echo $row['username']; ?></a>
					    						
					    						    <!-- Modal -->
<div id="myModal_<?php echo $i; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Information:</h4> </center>
         <center>
             <div class="card">
  <img src="<?php echo $row['image']; ?>" style="width:100px;height:100px;">
  <h5><span style="color:#3E020C;">NAME:</span>&nbsp;&nbsp;<?php echo $row['first_name']; ?>&nbsp;&nbsp;<?php echo $row['last_name']; ?></h5>
  <p class="title"><span style="color:#3E020C;">EMAIL:</span>&nbsp;&nbsp;<?php echo $row['email']; ?></p>
  <?php $sql1 = "SELECT statusname  FROM status where id ='".$row['status']."'"; 
                 $result1 = mysqli_query($conn, $sql1);
                 $row1 = mysqli_fetch_assoc($result1);
                 $statusname= $row1['statusname'];   
  ?>
  <p><span style="color:#3E020C;">PHONE:</span>&nbsp;&nbsp;<?php echo $row['phone']; ?></p>
  <p><span style="color:#3E020C;">DOB:</span>&nbsp;&nbsp;<?php echo $row['dob']; ?></p>
  
  <h4 style="background-color: #d9d9d9;padding:10px;">Uploading Information:</h4>
  <p><span style="color:#3E020C;">LIENCENSE:</span>&nbsp;&nbsp;<?php echo $row['liencense']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['lienimg']){ ?><img src="<?php echo $row['lienimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">ADHARCARD:</span>&nbsp;&nbsp;<?php echo $row['adharcard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['adharimg']){ ?><img src="<?php echo $row['adharimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">PANCARD:</span>&nbsp;&nbsp;<?php echo $row['pancard']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['panimg']){ ?><img src="<?php echo $row['pancardimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">GSTN:</span>&nbsp;&nbsp;<?php echo $row['gtsno']; ?>&nbsp;&nbsp;<span class="img-profile"><?php if($row['gstimg']){ ?><img src="<?php echo $row['gstimg']; ?>"><?php } ?></span></p>
  <p><span style="color:#3E020C;">SIGNATURE:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['sign']){ ?><img src="<?php echo $row['sign']; ?>"><?php } ?></span></p>
   <p><span style="color:#3E020C;">RESUME:</span>&nbsp;&nbsp;<span class="img-profile"><?php if($row['resume']){ ?><img src="<?php echo $row['resume']; ?>"><?php } ?></span></p>
   <?php if($row['user_role'] == '8') {?>
      <center style="margin-top:20px;"><h4 class="modal-title"><h4 style="background-color: #d9d9d9;padding:10px;">Firm Information:</h4> </center>
      <p><span style="color:#3E020C;">FIRM NAME:</span>&nbsp;&nbsp;<?php echo $row['shop']; ?></p>
      <p><span style="color:#3E020C;">FIRM TYPE:</span>&nbsp;&nbsp;<?php echo $row['shoptype']; ?></p>
      <p><span style="color:#3E020C;">YEAR:</span>&nbsp;&nbsp;<?php echo $row['year']; ?></p>
      <p><span style="color:#3E020C;">SALE TYPE:</span>&nbsp;&nbsp;<?php echo $row['saletype']; ?></p>
      <?php } ?>
   <h4 style="background-color: #d9d9d9;padding:10px;">Education:</h4>
   <p>
       <table class="table table-bordered">
   	<thead><tr><th>Degree</th><th>Year</th><th>Division</th></tr></thead>
   	<body>
     <?php
           $temp=explode(',', $row["degree"]);
           $temp1=explode(',', $row["degYear"]);
           $temp2=explode(',', $row["division"]);
              $n=count($temp);
                      if($n>1)
                      {
                for ($i=0; $i < $n ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp[$i];?></td><td><?php echo $temp1[$i];?></td><td><?php echo $temp2[$i];?></td></tr><?php } }?></body>
   </table>
   </p>
   <h4 style="background-color: #d9d9d9;padding:10px;">Experience:</h4>
   <p>
       <table class="table table-bordered">
   	<thead><tr><th>Work</th><th>Year</th><th>Position</th></tr></thead>
   	<body>
     <?php
          $temp3=explode(',', $row["workName"]);
          $temp4=explode(',', $row["exp"]);
          $temp5=explode(',', $row["position"]);
          $n1=count($temp3);
            
                      if($n1>1)
                      {
                for ($i=0; $i < $n1 ; $i++) { 
                  ?>

   	<tr><td><?php echo $temp3[$i];?></td><td><?php echo $temp4[$i];?></td><td><?php echo $temp5[$i];?></td></tr><?php } }?></body>
   </table>
   </p>
   <p><span style="color:#3E020C;">Joining Date:</span>&nbsp;&nbsp;<?php echo $row['regdate']; ?></p>
   <?php
   //echo "SELECT * form `approved_by` WHERE user_id = '".$row['id']."'";
   $sql_approved_data= mysqli_query($conn,"SELECT * FROM `approved_by` WHERE `user_id` = '".$row['id']."'");
   $result12=mysqli_fetch_assoc($sql_approved_data);
   $date=str_replace('am','',$result12['approved_date']);
   $date=str_replace('pm','',$date);
   //echo "SELECT group_name FROM groups WHERE group_id = '".$result['user_role_id']."'";
   if(sizeof($result12)){
    // echo "SELECT * FROM `users` WHERE `user_role` = '".$result12['user_role_id']."'";
   $sql_role_data= mysqli_query($conn, "SELECT group_name FROM groups WHERE group_id = '".$result12['user_role_id']."'");
   $results=mysqli_fetch_assoc($sql_role_data);

   $sql_name_get= mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$result12['approvel_user_id']."'");
   $name_get=mysqli_fetch_assoc($sql_name_get);
   $name= $name_get['first_name'].' '.$name_get['last_name'];
   //	print_r($results);
   ?>
  <p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo 'Approved by '.$results['group_name'].'('.$name.')'; ?></p>
  <p ><span style="color:#3E020C;">Approved Date:&nbsp;&nbsp;</span><?php echo $date; ?></p>
<?php }else{ ?> 

<p style="color:orange"><span style="color:#3E020C;">STATUS:&nbsp;&nbsp;</span><?php echo $statusname; ?></p>
<?php } ?>

</div>
      </center>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
                                            <!-- Model End -->
					    					</td>
					    					<td><?php echo $row['email']; ?></td>
					    					<td><?php echo $row['phone']; ?></td>
					    					<td><?php $sql1 = mysqli_query($conn, "SELECT name FROM states WHERE id IN (".$row['state'].")");
					    					         if(isset($row1) && $sql1 != ""){
					    					          while($row1 = mysqli_fetch_assoc($sql1)) {
					    					          	
					    					          	echo $row1['name']." ,";
					    					          }
					    					          }
					    					           ?></td>
					    					<td><?php $sql2 = mysqli_query($conn, "SELECT name FROM cities WHERE id IN (".$row['city'].")");
					    					          if(isset($sql2) && $sql2 != ""){
					    					          while($row2 = mysqli_fetch_assoc($sql2)) {
					    					          	echo $row2['name'].",";
					    					         } }
					    					          ?></td>
					    					<td><?php if($row['status'] == 7) {
					    								?> <p style="color:green;"><?php print_r(getUserStatus($row['status'])); ?></p>
                                                        <?php

					    					          } else {  ?>
					    					          <a href="statusupdate.php?idsp=<?php echo $row['id'];?>&stsp=<?php echo $row['status'];?>&pgsp=<?php echo $_GET['type']; ?>"><?php print_r(getUserStatus($row['status'])); ?></a>
					    					          <?php }?></td>
			<td><!-- <a href="updateasm.php?id=<?php  //echo $row['id']; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp; --> 
             <a href="deleteusers.php?id=<?php echo $row['id']; ?>" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
             <a href="addnew_order.php?id=<?php echo $row['id']; ?>" title="Add Order" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-shopping-cart"></span></a>
             <a href="user_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-xs btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a>
            </td>
					    				</tr>
					    				<?php $i++; }
					    			}
					    		} else if($row_login['user_role'] == 8) {
					    			
					    		}
					    		
					    	?>
					    </tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
   
  <!--  <script type="text/javascript">
   	 $(document).ready(function(){
        
        $(".featured").click(function(){
            $(".update_featured").click();
        });

        $(".upload_new").click(function() {
            var hero = $(this).attr('data-id');
            $(".upload_degree_"+hero).click();
            //$('.upload_new').closest('img').attr('src','');
        });
    });

   </script> -->
<?php include('layout/footer1.php');?>
<script src="js/jquery.magnify.js"></script>