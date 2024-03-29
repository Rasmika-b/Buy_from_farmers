<?php
 session_start();
 require 'db.php';
 if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
   $productType = $_POST['type'];
   $productName = dataFilter($_POST['pname']);
   $productInfo = $_POST['pinfo'];
   $productPrice = dataFilter($_POST['price']);
   $fid = $_SESSION['id'];
   $sql = "INSERT INTO fproduct (fid, product, pcat, pinfo, price)
   VALUES ('$fid', '$productName', '$productType', 
  '$productInfo', '$productPrice')";
   $result = mysqli_query($conn, $sql);
   if(!$result)
   {
     SESSION['message'] = "Unable to upload Product !!!";
     header("Location: Login/error.php");
   }
   else {
      $_SESSION['message'] = "successfull !!!";
   }
   $pic = $_FILES['productPic'];
   $picName = $pic['name'];
   $picTmpName = $pic['tmp_name'];
   $picSize = $pic['size'];
   $picError = $pic['error'];
   $picType = $pic['type'];
   $picExt = explode('.', $picName);
   $picActualExt = strtolower(end($picExt));
   $allowed = array('jpg','jpeg','png');
   if(in_array($picActualExt, $allowed))
   {
     if($picError === 0)
     {
       $_SESSION['productPicId'] = $_SESSION['id'];
       $picNameNew = $productName.$_SESSION['productPicId'].".".$picActualExt ;
       $_SESSION['productPicName'] = $picNameNew;
       $_SESSION['productPicExt'] = $picActualExt;
       $picDestination = "images/productImages/".$picNameNew;
       move_uploaded_file($picTmpName, $picDestination);
       $id = $_SESSION['id'];
       $sql = "UPDATE fproduct SET picStatus=1, pimage='$picNameNew' WHERE product='$productName';";
       $result = mysqli_query($conn, $sql);
       if($result)
       {
         $_SESSION['message'] = "Product Image Uploaded successfully !!!";
         header("Location: market.php");
       }
       else
       {
           //die("bad");
          $_SESSION['message'] = "There was an error in 
          uploading your product Image! Please Try again!";
          header("Location: Login/error.php");
       }
     }
     else
     {
       _SESSION['message'] = "There was an error in uploading your product image! Please Try again!";
       header("Location: Login/error.php");
     }
   }
   else
   {
     $_SESSION['message'] = "You cannot upload files with this extension!!!";
     header("Location: Login/error.php");
   }
 }
 function dataFilter($data)
 {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
?>
