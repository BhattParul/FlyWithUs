<nav>
      <ul>
            <li><a href = "flights.php"> All_Flights </a></li>
            <li><a href = "airlines.php"> All_Airlines </a></li>
            <li><a href = "flightsconnected.php"> Connected_Flights </a></li>
            <?php
         //Check if the user is login and if so, as an admin or not.
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
<p>
         <label>Sort by:</label>
         <ul>
            <li><a href = "flights.php?sort=airlines"> Airlines </a></li>
            <li><a href = "flights.php?sort=time"> Time </a></li>
      </ul>
         
</p>

<?php
               if(!isset($_GET["sort"]))
                  $query = 'Select * from Flight ORDER by Date, Time';
               else if($_GET["sort"]=='airlines')
                  $query = 'Select * from Flight ORDER by Airlines';
               else
				      $query = 'Select * from Flight ORDER by Date, Time';
            
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
                  while ($row = $result->fetch_assoc()){
                     $link = "flightsfilter.php?name=".urlencode($row["Airlines"]);
                     //echo "<br> PID: ". $row["PID"]. " | PName : ". $row["PName"]. " | Price: " . $row["Price"]. "<br>";
                     echo "<tr>
                     <td>".$row["FID"]."</td>
                     <td><a href=$link>".$row["Airlines"]."</a></td>
                     <td>".$row["PlaneType"]."</td>
                     <td width='100'>".$row["Date"]."</td>
                     <td>".$row["Time"]."</td>
                     </tr>";
      }
            echo "</table>";
               }
               else{
                  echo "0 results.";
               }
?>