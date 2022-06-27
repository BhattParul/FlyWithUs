<?php
   include_once 'connection.php';
   session_start();
   if(isset($_POST['submit']))
   {  
      $psprt_no = $_SESSION['u_passport_no'];
      echo $psprt_no;
      
      $board=mt_rand(100000, 999999);
      echo $board;
      
      $sql="UPDATE Passenger 
            Set BoardingNumber='$board'
            where passportNumber='$psprt_no'";
            
      if($conn->query($sql) === TRUE)
         header("Location: userflight.php?checkin=success");
      else
         header("Location: userflight.php?checkin=$psprt_no");
   }
   
?>