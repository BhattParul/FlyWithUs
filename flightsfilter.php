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
               if(!isset($_GET["name"])){
                  $sql = 'Select * from Flight';
               }
               else{
                  $name = $_GET["name"];
                  $sql = "Select * from Flight where Airlines = '$name' ORDER by Date, Time;";
                  }
            
               $result = $conn->query ($sql);
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
                  while ($row = $result->fetch_assoc()){
                     echo "<tr>
                     <td>".$row["FID"]."</td>
                     <td>".$row["Airlines"]."</td>
                     <td>".$row["PlaneType"]."</td>
                     <td>".$row["Date"]."</td>
                     <td>".$row["Time"]."</td>
                     </tr>";
      }
            echo "</table>";
               }
               else{
                  echo "0 results.";
               }
?>

<?php
   
    include_once 'footer.php';
?>	
