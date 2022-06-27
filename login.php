<?php
session_start();
include_once 'connection.php';                                         //<!--REFERENCE :-https://youtu.be/LC9GaXkdxF8 YOUTUBE VIDEO-->
if(isset($_POST['submit']))
{
  $uid= mysqli_real_escape_string($conn,$_POST['uid']);
  $pwd= mysqli_real_escape_string($conn,$_POST['pwd']);
  if ((empty($uid) || empty($pwd))) {
    header("Location: index.php?login=error");
    exit();
  }else {
    $sql="Select * from users where user_uid='$uid'";
    $result=mysqli_query($conn,$sql);
    $resultCheck= mysqli_num_rows($result);
  }

  if ($resultCheck < 1) {                                              //VALIDATION FOR THE RESULT
    header("Location: index.php?login=error");
    exit();
  }else {
    if ($row = mysqli_fetch_assoc($result)) {
      // de-hasing the $pwd
      if ($pwd != $row['user_password']) {
         $t=$row['user_password'];
        header("Location: index.php?login=error");
        exit();
      }else {
        // login
        $_SESSION['u_name'] = $row['user_name'];
            $_SESSION['u_passport_no'] = $row['user_passport_no'];
            $_SESSION['u_uid'] = $row['user_UID'];
            $_SESSION['u_admin'] = $row['admin'];
            header("Location: index.php?login=success");
        exit();
      }
    }
  }

}
else {
  header("Location: ../index.php?login=error");
  exit();
}

?>
