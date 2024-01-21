<?php session_start();
  include('layout/connect.php');
 if(!isset($_SESSION['userId']))
    {
      header("Location:index.php");
        exit();
    }

if(isset($_GET["action"]) && isset($_GET["id"]))
{
    if($_GET["action"] == "delete")
    {
        $id = $_GET["id"] ;
        mysqli_query($conn,"delete from notification where id = $id");
       echo '<script> window.location.assign("Manage_notification.php"); </script>' ;
    }
}

if(isset($_POST["submit"]))
{
    if($_FILES["file"]["name"])
    {
        $uploaddir = 'uploads/notification/';
        $attach = $uploaddir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $attach) ;
    }
    else
    {
        $attach = '';
    }
    
    echo $_FILES["file"]["name"] ;
    
    
    $role_id = $_POST["role_id"];
    $subject = $_POST["subject"];
    $message = $_POST["message"] ;
    
    $sql = "INSERT INTO `notification`(`user_role`, `subject`, `message`,`attachment`, `created_on`) VALUES ('$role_id','$subject','$message','$attach','".date("Y-m-d H:i:s")."')";
    $insert = mysqli_query($conn,$sql);
    
    echo '<script> window.location.assign("Manage_notification.php"); </script>' ;
}


if(isset($_POST["Personalsubmit"]))
{
    if($_FILES["file"]["name"])
    {
        $uploaddir = 'uploads/notification/';
        $attach = $uploaddir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $attach) ;
    }
    else
    {
        $attach = '';
    }
    
    echo $_FILES["file"]["name"] ;
    
    
    $user_id = $_POST["user_id"];
    $subject = $_POST["subject"];
    $message = $_POST["message"] ;
    
    $sql = "INSERT INTO `personal_message`(`user_id`, `subject`, `message`,`attachment`, `created_on`) VALUES ('$user_id','$subject','$message','$attach','".date("Y-m-d H:i:s")."')";
    $insert = mysqli_query($conn,$sql);
    
    echo '<script> window.location.assign("Manage_notification.php"); </script>' ;
}


include('layout/header1.php');
?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->



<link rel="stylesheet" href="css/bootstrap-select.css"> 
<style>
    @import url(https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css);

.select2-container .select2-selection--single {
     height: 35px;
}
</style>

<div class="content-wrapper">

<section class="content" style="min-height: auto;">
    <div class="box" style="margin-top: 0px;">
        <div class="box-header with-border">
            <h3 class="box-title" style="width:100%">
                <span onclick="allm()" style="cursor:pointer">Add New Notification </span>  
                <span class="pull-right" style="color:blue;cursor:pointer" onclick="personalm()">Send Personal Notification</span>
            </h3>
        </div>
        <div class="box-body main_div">
            <div class="col-lg-12 col-md-12 col-sm-12" id="nall">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Select Type :</label>
                    <select id="pd" name="role_id" class="form-control" data-max-options="20">
                        <option value="9">Boss Notification</option>
                        <option value="10">Office Notification</option>
                        <option value="0">All User</option>
                        <?php
                            $prosql = mysqli_query($conn,"SELECT *  FROM groups");
                            while($prodat=mysqli_fetch_array($prosql)){
                        ?>
                        <option value="<?php echo $prodat['group_id']; ?>"><?php echo $prodat['group_name']; ?></option>
                        <?php } ?>
                    </select>  
                </div>
                
                <div class="form-group">
                    <label class="control-label">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="What about this notification..">
                </div>
                
                <div class="form-group">
                    <label class="control-label">Message</label>
                    <textarea name="message" class="form-control" required rows="3" placeholder="Type your message here.."></textarea>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Attachment</label>
                    <input type="file" name="file" class="form-control">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="submit" value="submit" onclick="return confirm('Sure to Add Notification')">Add Notification</button>
                </div>
            </form>        
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12" id="npersonal" style="display:none;">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Select User :</label>
                    <select id="pd" name="user_id" class="form-control" data-max-options="20" required>
                        <option value="">Select User</option>
                        <?php
                            $prosql = mysqli_query($conn,"SELECT *  FROM users");
                            while($prodat=mysqli_fetch_array($prosql)){
                        ?>
                        <option value="<?php echo $prodat['id']; ?>"><?php echo $prodat['username'].' ('.$prodat['first_name'].' '.$prodat['last_name'].') ' ; ?></option>
                        <?php } ?>
                    </select>  
                </div>
                
                <div class="form-group">
                    <label class="control-label">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="What about this notification..">
                </div>
                
                <div class="form-group">
                    <label class="control-label">Message</label>
                    <textarea name="message" class="form-control" required rows="3" placeholder="Type your message here.."></textarea>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Attachment</label>
                    <input type="file" name="file" class="form-control">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="Personalsubmit" value="submit" onclick="return confirm('Sure to Add Notification')">Add Notification</button>
                </div>
            </form>        
            </div>
        </div>
    </div>
</section>


<section class="content" style="min-height: auto;">
    <div class="box" style="margin-top: 0px;">
        <div class="box-header with-border">
            <h3 class="box-title" style="width:100%">
                <span class="" onclick="showall()" style="cursor:pointer">All Notification</span>
                <span class="pull-right"  onclick="showpersonal()" style="color:blue;cursor:pointer">Personal Notification</span>
            </h3>
        </div>
        <div class="box-body main_div">
            <div class="row showall" >
                <table  class="table table-striped" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Role</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Attachment</th>
                            <th>Create On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ; $allnot = mysqli_query($conn,"select * from notification"); ?>
                        <?php while($shownoti = mysqli_fetch_array($allnot)){ ?>
                        <tr>
                            <td><?php echo $i ; ?></td>
                            <td>
                                <?php 
                                    if($shownoti["user_role"] == 0){ 
                                    echo "All User" ;
                                    }elseif($shownoti["user_role"] == 9){ 
                                    echo "Boss Notification" ;
                                    }elseif($shownoti["user_role"] == 10){ 
                                    echo "Office Notification" ;
                                    }else{ 
                                    $urid = $shownoti["user_role"] ; 
                                    $gpn = mysqli_query($conn,"SELECT *  FROM groups where group_id='$urid'"); $gpnd = mysqli_fetch_array($gpn) ; echo $gpnd["group_name"] ;
                                    } ?>
                            </td>
                            <td><?php echo $shownoti["subject"] ?></td>
                            <td><?php echo $shownoti["message"] ?></td>
                            <td><?php if($shownoti["attachment"] ){ ?><a href="<?php echo $shownoti["attachment"] ?>" target="_blank">Attachment</a><?php } ?></td>
                            <td><?php echo $shownoti["created_on"] ?></td>
                            <td><a href="Manage_notification.php?id=<?php echo $shownoti["id"] ?>&action=delete" onclick="return confirm('Are you sure to delete')"><i class="fa fa-trash text-red"></i></a></td>
                        </tr>
                        <?php $i++ ; } ?>
                    </tbody>
                </table>
            </div>
                
            <div class="row showpersonal" style="display:none">    
                <!---Personal Message-->
                <table  class="table table-striped " id="example1" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Role</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Attachment</th>
                            <th>Create On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ; $allnot = mysqli_query($conn,"select * from personal_message"); ?>
                        <?php while($shownoti = mysqli_fetch_array($allnot)){ ?>
                        <tr>
                            <td><?php echo $i ; ?></td>
                            <td>
                                <?php 
                                    $gpn = mysqli_query($conn,"SELECT *  FROM users where id='".$shownoti["user_id"]."'"); 
                                    $gpnd = mysqli_fetch_array($gpn) ; 
                                    echo $gpnd["username"].' ('.$gpnd["first_name"].' '.$gpnd["last_name"].')' ;
                                    ?>
                            </td>
                            <td><?php echo $shownoti["subject"] ?></td>
                            <td><?php echo $shownoti["message"] ?></td>
                            <td><?php if($shownoti["attachment"] ){ ?><a href="<?php echo $shownoti["attachment"] ?>" target="_blank">Attachment</a><?php } ?></td>
                            <td><?php echo $shownoti["created_on"] ?></td>
                            <td><a href="Manage_notification.php?id=<?php echo $shownoti["id"] ?>&action=delete" onclick="return confirm('Are you sure to delete')"><i class="fa fa-trash text-red"></i></a></td>
                        </tr>
                        <?php $i++ ; } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</section>

    
</div>



<?php include('layout/footer1.php'); ?>

<script>
    function personalm(){
        $('#nall').fadeOut("fast");
         $('#npersonal').fadeIn("fast");
    }
    
     function allm(){
         $('#npersonal').fadeOut(); 
        $('#nall').fadeIn();
    }
    
    function showall(){
          $('.showpersonal').fadeOut(); 
        $('.showall').fadeIn();
    }
    
    function showpersonal(){
          $('.showall').fadeOut(); 
        $('.showpersonal').fadeIn();
    }
</script>
