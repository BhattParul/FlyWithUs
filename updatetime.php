<?php
   include_once 'header.php';
?>

<nav>
      <ul>
            <li><a href = "flights.php"> All_Flights </a></li>
            <li><a href = "airlines.php"> All_Airlines </a></li>
            <li><a href = "flightsconnected.php"> Connected_Flights </a></li>
            <?php
         //Check if the user is an admin or not.
         if(isset($_SESSION['u_uid'])){
            $admin = $_SESSION['u_admin'];
            if($admin == true){
            //Admin
            echo "<li><a href = 'updatetime.php'> Update </a></li>";
            echo "<li><a href = 'deletestaff.php'> Delete </a></li>";
            echo "<li><a href = 'more_queries.php'> More </a></li>";
         }
         else{ //Regular user
            echo "<li><a href = 'userflight.php'> Your Flight </a></li>";
   }
   }
?>  
      </ul>
</nav>
<?php
   include_once 'header.php';
   if(isset($_GET["time"]) && $_GET["time"] == 'updated'){
      echo "<br><p style='text-align:center;'>Time Update Successful!!</p><br>";
   }
   if(isset($_GET["time"]) && $_GET["time"] == 'error'){
      echo "<br><p style='text-align:center;'>Error: Updating Time!!</p><br>";
   }
   
 if(!isset($_GET["fid"])){
               $query = 'Select * from Flight';
               $result = $conn->query ($query);
               if($result->num_rows > 0){
                  echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>FlightId</th>
                        <th>Airlines</th>
                        <th>PlaneType</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        </tr>";
                  while ($row = $result->fetch_assoc()){
                     $link = "updatetime.php?fid=".urlencode($row["FID"]);
                     echo "<tr>
                     <td><a href=$link style='text-decoration:none;'>".$row["FID"]."</td>
                     <td>".$row["Airlines"]."</td>
                     <td>".$row["PlaneType"]."</td>
                     <td>".$row["Date"]."</td>
                     <td>".$row["Time"]."</td>
                     <td>".$row["status"]."</a></td>
                     </tr>";
                     }
                     echo "</table>";
                     }
      }
      else{
         $current =$_GET["fid"];
         $query = "Select * from Flight where FID = '$current'";
               $result = $conn->query ($query);
               if($result->num_rows > 0){
                  echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>FlightId</th>
                        <th>Airlines</th>
                        <th>PlaneType</th>
                        <th>Date</th>
                        <th>Time</th>
                        </tr>";
                  if ($row = $result->fetch_assoc()){
                     echo "<tr>
                     <td>".$row["FID"]."</td>
                     <td>".$row["Airlines"]."</td>
                     <td>".$row["PlaneType"]."</td>
                     <td>".$row["Date"]."</td>
                     <td>".$row["Time"]."</td>
                     </tr>";
                     }
                     echo "</table><br><br>";
                     }
                     echo "<div>
		<fieldset>
                     <legend>Update Time</legend>
                     <form action='update.php?fid=".$current. "' method='POST'>
			<label>New Time : <input type='text' name ='newtime' size='30' required='required' placeholder='hh:mm'></label><br><br>
			<label>New Date : <input type='text' name ='newdate' size='30' required='required' placeholder='yyyy-mm-dd'></label><br><br>

			<input type ='submit' name='submit' value = 'Submit'>
			<br><br>
                  </form> 
		</fieldset>
</div>";
                     }
   include_once 'footer.php';
?>