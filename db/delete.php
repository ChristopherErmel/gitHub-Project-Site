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
         $id = $_GET['id'];
         
         require ('db/db.php');
         
         $sql = "DELETE FROM users WHERE id = :id";
         
         $cmd = $conn->prepare($sql);
         
         $cmd->bindParam(':id', $id);
         
         $cmd->execute();
         
         $cmd->closeCursor();
         
         ob_flush();
         echo "	
         <div class = 'mainHeading'>	
         <h2>User Deleted:</h2>
         <div class = 'mainHeadingInfo'>
          			<p>A User with an ID of ".$id." has been deleted!</p>
          			<p><br></p>
          			<p><br></p>
          			<p>WARNNING: !YOU WILL BE REDIRECTED TO THE HOME PAGE IN 15 SECCONDS!</p>
          		</div>
         </div>
         </div> ";
         header('refresh: 15; url=index.php');
         ?>
      <div class = 'mainSidebar'>
         <!--The main Side Bar Content of the page is here (right side)-->
         <div class = 'mainLinkBox'>
            <!--This is used for the links of the sidebar-->
            <a href="./allUsers.php">-----All Users-----</a>
            <a href="./form.php">-----Form-----</a>
            <a href="./myid.php">-----My ID-----</a>
            <a href="./about.php">-----About-----</a>
            <a href="./index.php">-----Home-----</a>
         </div>
      </div>
  </div>
   </body>
</html>