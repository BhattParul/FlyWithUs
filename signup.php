<?php
   include_once 'header.php'
?>
<?php
               if(isset($_GET["signup"]) && $_GET["signup"] == 'success'){
                  include_once 'registered.php';
				  exit();
				  
			   }
               
?>
    <fieldset>
        <legend>Sign UP</legend>
        <form action="signupconn.php" method="POST">
          <label>Name :</label> <input type="text" name="name" placeholder="name"><br><br>
          <label>Passport Number :</label> <input type="text" name="passport_no" placeholder="passport number"><br><br>
          <label>Username : </label> <input type="text" name="uid" placeholder="Username"><br><br>
          <label>Password : </label> <input type="password" name="pwd" placeholder="password"><br><br>
          <button type="submit" name="submit" class="button" />Sign Up</button>
        </form>
    </fieldset>

<?php
      include_once 'footer.php'
?>
