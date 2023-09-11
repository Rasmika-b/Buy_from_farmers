<?php
 $serverName = "localhost";
 $userName = "root";
 $password = "";
 $dbName = "buy from farmers";
 $conn = mysqli_connect($serverName, $userName, $password, $dbName);
 if (!$conn)
 {
  die("Connection failed: " . mysqli_connect_error());
 }
?>
