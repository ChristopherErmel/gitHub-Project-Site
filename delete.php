<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Christopher Ermel</title>
      <!--Style Sheet Links-->
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/main.css">
      <!-- Below is used to set the 1x1 ratio and remove default phone functionality -->
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="HandheldFriendly" content="true">
   </head>
   <body>
      <div id = 'main'>
      <div class = 'mainContent'>
         <!--The main Content of the page is here (left side)-->
         <?php
            ob_start();           
            session_start();       
            require ('db/db.php');
            
            $userName = $_SESSION['username'];
            
            //grabs the user_id var from the session
            $uID = $_SESSION['user_id'];
            //resets all personal info except there login and password.
            $sql = "UPDATE users_account SET name = null, email = null, city = null, skills = null, image = null, website = null, social = null WHERE user_id = ".$uID;
            
            $cmd = $conn->prepare($sql);
            
            $cmd->execute();
            
            $cmd->closeCursor();
            
            ob_flush();
            echo "  
            <div class = 'mainHeading'> 
            <h2>User Deleted:</h2>
            <div class = 'mainHeadingInfo'>
                  <p>All user info with an account name of ".$userName." has been deleted!</p>
                  <p><br></p>
                  <p><br></p>
                  <p>WARNNING: *YOU WILL BE REDIRECTED TO THE My ID PAGE IN 10 SECCONDS*</p>
                </div>
            </div>
            </div> ";
            header('refresh: 10; url=myid_records.php');
            ?>
         <div class = 'mainSidebar'>
            <!--The main Side Bar Content of the page is here (right side)-->
            <div class = 'mainLinkBox'>
               <!--This is used for the links of the sidebar-->
               <a href="./myid_records.php">-----My ID-----</a>
               <a href="./form.php">-----Form-----</a>
               <a href="./allUsers.php">-----All Users-----</a>
               <a href="./logout.php" title="Logout">-----LogOut-----</a>
            </div>
         </div>
      </div>
   </body>
</html>