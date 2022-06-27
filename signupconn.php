<?php

session_start();
/*
reference: https://www.youtube.com/watch?v=xb8aad4MRx8
*/

if(isset($_POST['submit'])){
   include_once 'connection.php';
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $passport_no = mysqli_real_escape_string($conn, $_POST['passport_no']);
  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  if(empty($name) || empty($passport_no) || empty($uid) || empty($pwd)){
    header("Location: signup.php?signup=empty");
    exit();
  }else{
    if (!preg_match("/^[a-zA-Z]*$/", $name)){
      header("Location: signup.php?signup=invalid");
      exit();
    }else{
      if(strlen($passport_no)!=10){
         header("Location: signup.php?signup=invalid");
         exit();
      }else{
        $sql = "SELECT * FROM users WHERE user_uid='$uid'";
        $result = mysqli_query($conn, $sql);
        $Check = mysqli_num_rows($result);

        if($Check > 0){
          header("Location: signup.php?signup=usertaken");
          exit();
        }else{
          $sql = "INSERT INTO users(user_name,user_passport_no,user_uid,user_password,admin) VALUES ('$name','$passport_no', '$uid', '$pwd',false);";
          mysqli_query($conn, $sql);
          header("Location: signup.php?signup=success");
          exit();
        }
      }
    }
  }
}
else{
  header("Location: signup.php");
  exit();
}

?>
