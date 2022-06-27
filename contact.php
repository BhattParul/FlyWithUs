<?php
	include_once 'header.php';
   if(isset($_GET["send"])){
      echo "<h2>Thank you! Your message has been sent. We will contact you as soon as possible.</h2>";
   }
   else{
?>

	<h3>For any queries, contact us at: </h3>
	<p>Fly With US! <br> 5434 Route 48 <br> Fictional Land, WI 34241 </p>
	<p>Phone : 604-928-4200 </p> 
	<p>Fax : 604-928-4201 </p>
	<p>Email : fly@withus.com </p>
	<fieldset>
		<legend>Contact Us:</legend>
             <form action="contact.php?send=success" method="post">
		<label>First Name : <input type="text" name ="firstname" id="firstName" size="30" required="required"></label><br><br>
		<label>Last Name : <input type="text" name ="lastname" id="lastName" size="30" ></label><br><br>
		<label>E-mail: <input type="text" name ="email" id="mail" required="required"></label><br><br>
		<label>Comments: <br><textarea name="comments" id ="comments" cols="40" rows ="5" required="required"></textarea></label><br><br>
		<input type ="submit" name="submit" value="Send Now">
             </form>
	</fieldset>
						
<?php
      }
    include_once 'footer.php';
?>