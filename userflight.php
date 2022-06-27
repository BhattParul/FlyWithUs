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
?>

<?php
   if(isset($_GET["checkin"])){
      if($_GET["checkin"]=='success')
         echo "<h2>Checked in successfully!!</h2>";
      else
         echo "<h2>Error Checking In!!</h2>";
   }
   $psprt_no = $_SESSION['u_passport_no'];
   $checkSql = "Select * from Passenger where passportNumber='$psprt_no'";
   $checkboard = $conn->query($checkSql);
   if($checkboard->num_rows == 0){
      echo "<h2>You do not have any flights!!</h2>";
      include_once 'footer.php';
      exit();
   }
   $checkRow = $checkboard->fetch_assoc();
   $isboardingNum = $checkRow["BoardingNumber"];
   $sql = "Select f.FID as ccid  from Flight f, Passenger p where f.FID=p.FID AND passportnumber='$psprt_no'";
   $result = $conn->query ($sql);
               if($result->num_rows != 0){
                  if($result->num_rows ==2){
                  $rows = $result->fetch_assoc();
                  $currentfid = $rows["ccid"];
                  $query="Select f1.Airlines AS Air_lines,
                          f1.PlaneType AS Plane_Type, f1.date AS Arriving_Date,
                           f1.time AS Arriving_Time,f2.date AS Departing_Date,
                           f2.time AS Departing_Time,f1.origin AS Origin, f2.destination as Destination,
                           f1.status AS Sta_tus
                           from Flight f1, Flight f2
                           where f1.FID=$currentfid AND f1.destination = f2.origin
                           AND f1.destination= 'FWU'";
                  $res=$conn->query ($query);
                  $row = $res->fetch_assoc();
                  echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>Airlines</th>
                        <th>PlaneType</th>
                        <th>ArrivingDate</th>
                        <th>ArrivingTime</th>
                        <th>DepartingDate</th>
                        <th>DepartingTime</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Status</th>
                        <th>BoardingNumber</th>
                        </tr>";
                     echo "<tr>
                     <td>".$row["Air_lines"]."</td>
                     <td>".$row["Plane_Type"]."</td>
                     <td>".$row["Arriving_Date"]."</td>
                     <td>".$row["Arriving_Time"]."</td>
                     <td>".$row["Departing_Date"]."</td>
                     <td>".$row["Departing_Time"]."</td>
                     <td>".$row["Origin"]."</td>
                     <td>".$row["Destination"]."</td>
                     <td>".$row["Sta_tus"]."</td>
                     <td>";
                     if($isboardingNum==0)
                        echo "NULL";
                     else
                        echo $isboardingNum;
                     echo"</td>
                     </tr>";
                     echo "</table><br><br>";
                     }
                     else if($result->num_rows == 1){
                        $rows = $result->fetch_assoc();
                        $currentfid = $rows["ccid"];
                        $query = "Select FID, Airlines,PlaneType,Date,Time, Status, Origin, Destination from Flight where fid ='$currentfid'";
                        $tmp=$conn->query ($query);
                        echo "<table align=\"center\"
                        border= \"1\">";
                        echo "<tr>
                        <th>FlightId</th>
                        <th>Airlines</th>
                        <th>PlaneType</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>BoardingNumber</th>
                        </tr>";
                        while ($row = $tmp->fetch_assoc()){
                        echo "<tr>
                        <td>".$row["FID"]."</td>
                        <td>".$row["Airlines"]."</td>
                        <td>".$row["PlaneType"]."</td>
                        <td>".$row["Date"]."</td>
                        <td>".$row["Time"]."</td>
                        <td>".$row["Status"]."</td>
                        <td>".$row["Origin"]."</td>
                        <td>".$row["Destination"]."</td>
                        <td>";
                        if($isboardingNum==0)
                           echo "NULL";
                        else
                           echo $isboardingNum;
                        echo "</td>
                        </tr>";
                     }  
                     echo "</table><br><br>";
                     }
                    if($isboardingNum == 0){
                     echo "
                     <form action='checkin.php' method='POST'>           
                     <input type ='submit' name='submit' value = 'CheckIn'>
                     </form><br><br>";
                  }
               }
               else{
                  echo "<h2>NO flights!!</h2>";
               }
   
?>

<?php
   include_once 'footer.php';
?>
