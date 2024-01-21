<?php
 session_start();
  include('layout/connect.php');
 if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
include('layout/header1.php');
 
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Last Login List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Last Login List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">last login List</h3>

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
        <th>Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Role</th>
        <th>Last Login</th>
       
      </tr>
    </thead>
    <tbody>
     <?php   $sql = "SELECT *  FROM users where active='1'" ;
                               $result = mysqli_query($conn, $sql);
                                 if (mysqli_num_rows($result) > 0)
                                     {
                                    $i =1;
                                    while($row = mysqli_fetch_assoc($result)) 
                                      {
                                        //print_r($row );
                                    $nameTemp=$row['first_name'].' '.$row['last_name'];
                                    $name=ucwords($nameTemp);
                                
                                   $sql1=mysqli_query($conn,"SELECT group_name FROM groups WHERE group_id = '".$row['user_role']."'");
                                    $role=mysqli_fetch_assoc($sql1);
                                    //print_r($role);

                           ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $role['group_name']; ?></td>
        <td><?php echo $row['last_login']; ?></td>

        
      </tr>
      <?php  $i++; } } ?>
    </tbody>
  </table>
  </div>

        </div>
        <!-- /.box-body -->
       
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('layout/footer1.php');?>
 