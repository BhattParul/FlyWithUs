<?php
   session_start();
   include_once 'connection.php';                                         //<!--REFERENCE :-https://youtu.be/LC9GaXkdxF8 YOUTUBE VIDEO-->
   if(isset($_POST['submit']))
   {
      $current =$_GET["sid"];
      ///Status needs to be updated.
      $sql="Delete from Staff where SID='$current'";
      if($conn->query($sql) === TRUE)
         header("Location: deletestaff.php?delete=deleted");
      else
         header("Location: deletestaff.php?delete=$current");
   }
?>