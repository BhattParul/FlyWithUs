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
<div>
   <h1>Select any query to see the results!!</h1>
   <ul>
      <li><a href = "more_queries.php?query=1"> Number of passengers with extra weight </a></li>
      <li><a href = "more_queries.php?query=2"> Number of Staff members in each flight </a></li>
      <li><a href = "more_queries.php?query=3"> All Airlines having a flight of their every plane type available</a></li>
   </ul>
</div>

<?php
   //session_start();
   if(!isset($_GET["query"])){
      //Do nothing
   }
   else if ($_GET["query"] == '1'){
      $query = "SELECT Count(*) AS cnt from baggage where Additional_Fees is not null AND Additional_Fees > 0";
   
               //Execute the query
               $result = $conn->query ($query);
               $row = $result->fetch_assoc();
               echo "<h2>There are ".$row["cnt"]." passengers in total travelling with additional weight.</h2>";
                  
   }
   else if ($_GET["query"] == '2'){
      $query = "SELECT FID, Count(*) AS cnt from flight_Staff group by FID";
   
               //Execute the query
               $result = $conn->query ($query);
               echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>FlightID</th>
                        <th>NumberOfStaff</th>
                        </tr>";
                  while ($row = $result->fetch_assoc()){
                     echo "<tr>
                     <td>".$row["FID"]."</td>
                     <td>".$row["cnt"]."</td>
                     </tr>";
                  }
                  echo "</table><br>";
                  
                  }
   else if ($_GET["query"] == '3'){
      //query not working :(
      $query = "Select DISTINCT f1.Airlines from flight f1
                  where NOT EXISTS(
                  (Select DISTINCT p.PlaneType
                  from planecapacity p
                  where p.Airlines=f1.Airlines
                  AND NOT EXISTS
                  (Select DISTINCT f2.PlaneType
                  from flight f2
                  where f2.Airlines=p.Airlines
                  AND f2.PlaneType=p.PlaneType)
               ))";
               $result = $conn->query($query);
               if($result->num_rows > 0){
               echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>Airlines</th>
                        </tr>";
                  while ($row = $result->fetch_assoc()){
                     echo "<tr>
                     <td>".$row["Airlines"]."</td>
                     </tr>";
                  }
                  echo "</table>";
               }
               else{
                  echo "Zero results.";
               }
   }
   else{
      //Do nothing
   }
   
   
?>

<?php
   include_once 'footer.php';
?>
