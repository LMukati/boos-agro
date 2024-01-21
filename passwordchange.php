<?php
 session_start();
  include('layout/connect.php');
 if(!isset($_SESSION['userId']))
    {
        header("Location:index.php");
        exit();
    }
if(isset($_POST['submit'])) {
    $result = mysqli_query($conn, "SELECT *from users WHERE id='" . $_SESSION['userId'] . "'");
    $row = mysqli_fetch_array($result);
    $pass= md5($_POST['currentPassword']);
    if ($pass == $row['password']) {
        mysqli_query($conn, "UPDATE users set password='" . $pass . "' WHERE id='" . $_SESSION['userId'] . "'");
        $message = "Password Changed";
        header('Location:profile.php');
    } else
        $message = "Current Password is not correct";
}


?>