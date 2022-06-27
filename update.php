<?php
   session_start();
   include_once 'connection.php';                                         //<!--REFERENCE :-https://youtu.be/LC9GaXkdxF8 YOUTUBE VIDEO-->
   if(isset($_POST['submit']))
   {
      $current =$_GET["fid"];
      $newtime= mysqli_real_escape_string($conn,$_POST['newtime']);
      $newdate= mysqli_real_escape_string($conn,$_POST['newdate']);
      ///Status needs to be updated.
      $sql="UPDATE Flight 
            Set time='$newtime',
               date = '$newdate',
               status = 'DELAYED'
               where FID='$current'";
      if($conn->query($sql) === TRUE)
         header("Location: updatetime.php?time=updated");
      else
         header("Location: updatetime.php?time=error");
   }
?>