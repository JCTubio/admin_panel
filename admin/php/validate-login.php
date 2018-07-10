<?php
session_start();
unset($_SESSION['error']);
require('sql-conn.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM `user` WHERE username='$username'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])){
      $_SESSION['username'] = $row['fullname'];
      $_SESSION['avatar'] = $row['avatar'];
      header('Location: ../list-projects.php');
    } else {
      $_SESSION['error'] = "Invalid username or password.";
      header('Location: ../admin-login.php');
  }
}else{
  $_SESSION['error'] = "Invalid username or password.";
  header('Location: ../admin-login.php');
}
exit();
 ?>
