<?php
 session_start();
 require 'db.php';
 if(!isset($_SESSION['logged_in']) OR $_SESSION['logged_in'] == 0)
 {
 $_SESSION['message'] = "You need to first login to access this page !!!";
 header("Location: Login/error.php");
 }
 $bid = $_SESSION['id'];
 if(isset($_GET['flag']))
 {
 $pid = $_GET['pid'];
 $sql = "INSERT INTO mycart (bid,pid)
 VALUES ('$bid', '$pid')";
 $result = mysqli_query($conn, $sql);
 }
?>
