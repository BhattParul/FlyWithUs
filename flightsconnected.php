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
   $sql  = "Select f1.FID AS FlightId, f1.Airlines AS Air_lines,
            f1.PlaneType AS Plane_Type, f1.date AS Arriving_Date,
            f1.time AS Arriving_Time,f2.date AS Departing_Date,
            f2.time AS Departing_Time,f1.origin AS Origin, f2.destination as Destination,
            f1.status AS Sta_tus
            from Flight f1, Flight f2
            where f1.FID=f2.FID AND f1.destination = f2.origin
            AND f1.destination= 'FWU'";
   $result = $conn->query ($sql);
   
   if($result->num_rows > 0){
      echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>FlightId</th>
                        <th>Airlines</th>
                        <th>PlaneType</th>
                        <th>Arriving_Date</th>
                        <th>Arriving_Time</th>
                        <th>Departing_Date</th>
                        <th>Departing_Time</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Status</th>
                        </tr>";
      while ($row = $result->fetch_assoc()){
                     echo "<tr>
                     <td>".$row["FlightId"]."</td>
                     <td>".$row["Air_lines"]."</td>
                     <td>".$row["Plane_Type"]."</td>
                     <td>".$row["Arriving_Date"]."</td>
                     <td>".$row["Arriving_Time"]."</td>
                     <td>".$row["Departing_Date"]."</td>
                     <td>".$row["Departing_Time"]."</td>
                     <td>".$row["Origin"]."</td>
                     <td>".$row["Destination"]."</td>
                     <td>".$row["Sta_tus"]."</td>
                     </tr>";
                     
                     
                     }
                     echo "</table><br><br>";
      }
   else{
      echo 'No Connected Flights!!';
   }
?>

<?php
   
    include_once 'footer.php';
?>	