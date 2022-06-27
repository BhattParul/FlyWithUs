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
   include_once 'connection.php';
   $sql  = 'Select Airlines, Count(*) AS quantity from Flight group by Airlines';
   $result = $conn->query ($sql);
   
   if($result->num_rows > 0){
      echo "<table align=\"center\"
            border= \"1\">";
      echo "<tr>
            <th>Airlines</th>
            <th>NumberOfFlights</th>
            </tr>";
      while ($row = $result->fetch_assoc()){
         $link = "flightsfilter.php?name=".urlencode($row["Airlines"]);
         echo "<tr>
         <td><a style='text-decoration:none; display:block;' href=$link> ".$row["Airlines"]."</a></td>
         <td>".$row["quantity"]."</td>
         </tr>";
      }
      echo "</table>";
   }  
   else{
      echo 'No Airlines!!';
   }
?>

<?php
   
    include_once 'footer.php';
?>	