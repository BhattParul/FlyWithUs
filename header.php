<?php
   include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
	    <title>Fly with us!!</title>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" href = "project.css">
	</head>
	<body>
		
		<h1> FLY WITH US!</h1>
             <?php
         session_start();
         if(isset($_SESSION['u_uid'])){
            echo "<h3 style='background-color:#e6e6fa; text-align:center; color:#191970;'>Welcome ".$_SESSION['u_name']."</h3>";
         }
      ?>
		<div>
			<nav>
				<ul>
					<li><a href = "index.php"> HOME </a></li>
					<li><a href = "flights.php"> FLIGHTS </a></li>
					<li><a href = "contact.php"> CONTACT_US </a></li>
					<?php
      
      if(isset($_SESSION['u_uid']))
      {
        echo '<a href="logout.php"><button type="button">Logout</button></a>';
      }
      else{
        echo '<a href="loginform.php"><button type="button">Log IN</button></a>';
      }
      ?>
				</ul>
			</nav>
		</div>