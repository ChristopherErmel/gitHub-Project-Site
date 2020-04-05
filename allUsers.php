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
            try {
              //authentication for user
              require('auth.php');
              //db connect
              require ('db/db.php');
              //query
              $sql = "SELECT * FROM users_account";
              //prepare
              $cmd = $conn->prepare($sql);
              //execute
              $cmd->execute();
              //fetchAll results
              $allUsers = $cmd->fetchAll();
            
              echo '
              <div class = "mainContent">
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
            
              //loop through the data and create tables
              foreach ($allUsers as $allUser) {
                //this will set up the correct image path for the images of each user
                if(!empty($allUser['name'])  && !empty($allUser['email']) && !empty($allUser['city']) && !empty($allUser['skills'])){
                $imageDestination = 'images/'.$allUser['image'];
                echo '<tr><td>' . $allUser['name'] . '</td>';
                echo '<td>' . $allUser['email'] . '</td>';
                echo '<td>' . $allUser['city'] . '</td>';
                echo '<td>' . $allUser['skills'] . '</td>';
            
                echo '<td>' . $allUser['social'] ."<br>". $allUser['website'] .'</td>';
                //displays the correct image in conjunction with the user
                echo "<td><img src=".$imageDestination." width='90px' height = '60px'></td></tr>";
               }
              }
            echo '</tbody></table>';
            
            $cmd->closeCursor();
            }
            catch(PDOException $e){
            
            }
            ?>
         <div class = 'mainHeading'>
            <h2>All User Records:</h2>
            <div class = 'mainHeadingInfo'>
               <p>Above is a full list of every user record on this site as well as their profile picture.</p>
               <p>Interested in a specific record? Search for it using any relevant information below.</p>
               <form method="post" action="allUsersSearch.php">
                  <fieldset class="form-group">
                     <button type="submit" class="col-sm-offset-2 btn btn-success">Search</button>
                     <label for="recordsearch" class="col-sm-2"></label>
                     <input name="recordsearch"/>
                  </fieldset>
               </form>
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