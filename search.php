<!doctype html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Search Results</title>
   </head>
   <body>
      <?php
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
         
         echo $final_sql; 
         
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
   </body>
</html>