<?php
session_start();
  include('layout/connect.php');
if(isset($_POST['get_username']))
{
 $user_name=str_replace(' ', '', $_POST['get_username']);
 random_username($user_name);
 exit();
}

function random_username($user_name)
{
 $new_name1 = $user_name.mt_rand(0,10000);
 $result = substr($new_name1, 0, 3);
 $newstring = substr($new_name1, -2);
 $new_name = $result.$newstring;
 check_user_name($new_name,$user_name);
}

function check_user_name($new_name,$user_name)
{
 include('layout/connect.php');
 $select = mysqli_query($conn, "select * from users where username='$new_name'");
 if(mysqli_num_rows($select))
 {
  random_username($user_name);
 }
 else
 {
  echo $new_name;
 }
} ?>