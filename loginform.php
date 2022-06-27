<?php
	include_once 'header.php';
?>

<div>
		<fieldset>
                     <legend>USER LOGIN</legend>
                     <form action="login.php" method="POST">
			<label>USER NAME : <input type="text" name ="uid" id="userName" size="30" required="required"></label><br><br>
			<label>PASSWORD : <input type="password" name ="pwd" id="password" size="30" required="required"></label><br><br>

			<input type ="submit" name="submit" value = "Login">
			<br><br>
			<p id="display"></p>
                  </form> 
		</fieldset>
               <p> New User?
			<a href = "signup.php" >Sign up</a>
               </p>
</div>

<?php
	include_once 'footer.php';
?>