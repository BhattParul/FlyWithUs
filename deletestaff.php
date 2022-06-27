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
            echo "<li><a href = 'userflight.php'> Your_Flight </a></li>";
   }
   }
?>  
      </ul>
</nav>
<?php
   include_once 'header.php';
   if(isset($_GET["delete"]) && $_GET["delete"] == 'deleted'){
      echo "<br><p style='text-align:center;'>Staff Delete Successful!!</p><br>";
   }
   if(isset($_GET["delete"]) && $_GET["delete"] == 'error'){
      echo "<br><p style='text-align:center;'>Error: Deleting SID!!</p><br>";
   }
   
 if(!isset($_GET["sid"])){
                  $query = 'Select SID, Position from Staff';
               $result = $conn->query ($query);
               if($result->num_rows > 0){
                  echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>StaffID</th>
                        <th>Position</th>
                        </tr>";
                  while ($row = $result->fetch_assoc()){
                     $link = "deletestaff.php?sid=".urlencode($row["SID"]);
                     //echo "<br> PID: ". $row["PID"]. " | PName : ". $row["PName"]. " | Price: " . $row["Price"]. "<br>";
                     echo "<tr>
                     <td><a href=$link>".$row["SID"]."</a></td>
                     <td>".$row["Position"]."</td>
                     </tr>";
                     }
                     }
                     echo "</table>";
                     }
      else{
         $current =$_GET["sid"];
         $query = "Select SID, Position from Staff where SID = '$current'";
               $result = $conn->query ($query);
               if($result->num_rows > 0){
                  echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>StaffID</th>
                        <th>Position</th>
                        </tr>";
                  if ($row = $result->fetch_assoc()){
                     echo "<tr>
                     <td>".$row["SID"]."</td>
                     <td>".$row["Position"]."</td>
                     </tr>";
                     }
                     echo "</table><br><br>";
                     }
                     echo " 
                     <form action='delete.php?sid=".$current. "' method='POST'>           
                     <input type ='submit' name='submit' value = 'Confirm Delete'>
                     </form>
			<br><br>";
         }
         include_once 'footer.php';
?>