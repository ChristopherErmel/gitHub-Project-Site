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
         <?php
            //authentication for user
            require('auth.php');
            require('db/db.php'); 
            //grabs the search
            $record_search = $_POST['recordsearch']; 
            //coverts what ever the search is to a list
            $search_words = explode(' ', $record_search); 
            //builds the sql query
            $query = "SELECT * FROM users_account WHERE ";  
            $where = ""; 
            //loop and build sql querry
            foreach($search_words as $word) {
            
            $where = $where. "name LIKE '%$word%' OR email LIKE '%$word%' OR city LIKE '%$word%' OR skills LIKE '%$word%' OR website LIKE '%$word%' OR social LIKE '%$word%' OR ";
            }
            
            $where = substr($where, 0, strlen($where)-4); 
            
            $final_sql = $query . $where; 
            
            $cmd = $conn->prepare($final_sql); 
            $cmd->execute(); 
            
            $allUsers = $cmd->fetchAll(); 
            
            echo '<div class = "mainContent">
                        <table class="table">
                          <thead>            
                            <th> Name </th>
                            <th> Email </th>
                            <th> City </th>
                            <th> Skills </th>
                            <th> Social Links </th>
                            <th> Profile Pic </th>
                          </thead>
                      </div>
                    <tbody>';
            
            
            foreach($allUsers as $user) {
             $imageDestination = 'images/'.$user['image'];
             echo '<tr><td>' . $user['name'] . '</td>';
             echo '<td>' . $user['email'] . '</td>';
             echo '<td>' . $user['city'] . '</td>';
             echo '<td>' . $user['skills'] . '</td>';
             echo '<td>' . $user['social'] ."<br>". $user['website'] .'</td>';
             //displays the correct image in conjunction with the user
             echo "<td><img src=".$imageDestination." width='90px' height = '60px'></td></tr>";
            }
            
            echo '</tbody></table>'; 
            
            $cmd->closeCursor(); 
            
            ?>
         <div class = 'mainHeading'>
            <h2>Search Completed:</h2>
            <div class = 'mainHeadingInfo'>
               <p>Above is a full list of every user record, referencing the keywords provided.</p>
               <p>To view all user records again click <a href="allUsers.php">here</a>.</p>
            </div>
         </div>
      </div>
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
   </body>
   </body>
</html>