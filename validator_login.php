<?php ob_start(); ?>
<html>
   <body>
      <?php 
         ob_start(); 
           require('db/db.php'); 
           //grabs the username and password from the login page
           $username = $_POST['username'];
           $password = $_POST['password'];
           //looks for a user with the same username
           $sql = "SELECT * FROM users_account WHERE username = :username;";
         
           $stmt = $conn->prepare($sql);
           $stmt->bindParam(':username', $username); 
           $stmt->execute();
           $user = $stmt->fetch();
           //checks that the username and password(hashed), match and starts or continues there session.
         	if ($user && password_verify($password, $user['password']))
         	{
         
         		$links = true;
         		//start or continue the session
         	    session_start(); 
         	    //stores the users unique identifier in a session variable
         	    $_SESSION['user_id'] = $user['user_id'];
         	    $_SESSION['username'] = $user['username'];
         
         	    header('location:myid_records.php');
         	}
         
         	else {
         
         		header('location:invalid_login.php');
         	    exit(); 
         	}
         
         	  $cmd->closeCursor(); 
         
         ob_flush(); 
         ?>
   </body>
</html>
<?php ob_flush(); ?>