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
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="HandheldFriendly" content="true">
   </head>
   <body>
      <div id = 'main'>
      <div class = 'mainContent'>
         <!--The main Content of the page is here (left side)-->
         <div class = 'mainTable'>
            <?php
               require ('db/db.php');
               //require ('db/query.php');
               
               $query = "SELECT * FROM users"; 
               $result = mysql_query($query);
               
               echo "<table>"; // start a table 
               
               while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
               echo "<tr><td>" . $row['name'] . "</td><td>" . $row['email']. "</td><td>" . $row['city']. "</td><td>" . $row['skills'] . "</td></tr>";  //$row['index'] the index here is a field name
               }
               
               echo "</table>"; //Close the table in HTML
               
               mysql_close(); //Make sure to close out the database connection
               ?>
         </div>
         <div class = 'mainHeading'>
            <h2>
               <p>Users: </p>
            </h2>
            <div class = 'mainHeadingInfo'>
               <p>Above is a list of all users on this site, and their information.</p>
            </div>
         </div>
      </div>
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
   </body>
</html>