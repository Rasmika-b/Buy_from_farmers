<?php
 if(isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] == 1)
 {
   $loginProfile = "My Profile: ". $_SESSION['Username'];
   $logo = "glyphicon glyphicon-user";
   if($_SESSION['Category']!= 1)
   {
     $link = "Login/profile.php";
   }
   else {
     $link = "profileView.php";
   }
 }
 else
 {  
   $loginProfile = "Login";
   $link = "index.php";
   $logo = "glyphicon glyphicon-log-in";
 }
?>
