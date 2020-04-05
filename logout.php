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
   <!-- This will log the user out of the site, and show them the logout page. -->
   <?php 
      ob_start();
      
      //access the session
      session_start();
      //remove all variables
      session_unset();
      //end the session
      session_destroy();
      
      ob_flush();
      ?>
   <body>
      <div id = 'main'>
         <div class = 'mainContent'>
            <!--The main Content of the page is here (left side)-->
            <div class = 'mainContentAbout'>
               <h3>Logged Out:</h3>
               <p>Thank you for visting our site!</p>
            </div>
            <div class = 'mainHeading'>
               <h2>Logged Out:</h2>
               <div class = 'mainHeadingInfoAbout'>
                  <br>
                  <p>If this was a mistake, please click here to <a href="myid.php">Log In</a> again.</p>
               </div>
            </div>
         </div>
         <div class = 'mainSidebar'>
            <!--The main Side Bar Content of the page is here (right side)-->
            <div class = 'mainLinkBox'>
               <a href="./index.php">-----Home-----</a>
               <a href="./myid.php">-----My ID-----</a>               
               <a href="./register.php">-----Register-----</a>
               <a href="./about.php">-----About-----</a>
            </div>
         </div>
      </div>
   </body>
</html>