<?php
	include_once 'header.php';
?>

<?php
   if(isset($_GET["login"])){
      if($_GET["login"] == 'success'){
       echo "<h2 style='text-align:center;'>Login Successful !!</h2>";
      }
      if($_GET["login"] == 'error'){
       echo "<h2 style='text-align:center;'>Login Error !!</h2>";
      }
   }
?>

<div>
   <fieldset>
      <legend>FLIGHT UPDATES</legend>
      <div>
            <nav>
                  <ul>
                        <li><a href = "index.php?flight=arr"> ARRIVALS </a></li>
                        <li><a href = "index.php?flight=dep"> DEPARTURES </a></li>
                  </ul>
            </nav>
       </div>
      <?php
               if(!isset($_GET["flight"]))
                  include_once 'arrivals.php';
               else if($_GET["flight"]=='dep')
                  include_once 'departure.php';
               else
				  include_once 'arrivals.php';
               
      ?>
               
                

                   
<?php
   
    include_once 'footer.php';
?>	