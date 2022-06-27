<?php
               //construct the query
               $query = "SELECT * from flight where destination='FWU' ORDER by Date, Time LIMIT 5";
   
               //Execute the query
               $result = $conn->query ($query);
               if($result->num_rows > 0){
                  echo "<table align=\"center\"
                        border= \"1\">";
                  echo "<tr>
                        <th>FlightId</th>
                        <th>Airlines</th>
                        <th>PlaneType</th>
                        <th>Arrival_Date</th>
                        <th>Time</th>
                        <th>Origin</th>
                        <th>Status</th>
                        </tr>";
                  while ($row = $result->fetch_assoc()){
                     echo "<tr>
                     <td>".$row["FID"]."</td>
                     <td>".$row["Airlines"]."</td>
                     <td>".$row["PlaneType"]."</td>
                     <td>".$row["Date"]."</td>
                     <td>".$row["Time"]."</td>
                     <td>".$row["origin"]."</td>
                     <td>".$row["status"]."</td>
                     </tr>";
      }
      echo "</table>";
               }
               else{
                  echo "0 results.";
               }        
?>