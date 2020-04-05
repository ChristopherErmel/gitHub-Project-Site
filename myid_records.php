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
            <div class = 'mainContentHome'>
               <h3>MyID: </h3>
               <p>Here you can view, edit or delete your current record held on this site.</p>
               <h3>Form: </h3>
               <p>A form for registered users to create a personalized record.</p>
               <h3>All Users: </h3>
               <p>A page showing all records of registered users.</p>
            </div>
            <div class = 'mainHeading'>
               <?php            
                  require('auth.php');
                  //db connect
                  require ('db/db.php');
                  
                  $uID = $_SESSION['user_id'];
                  //query
                  $sql = "SELECT * FROM users_account WHERE user_id = ".$uID;
                  //prepare
                  $cmd = $conn->prepare($sql);
                  //execute
                  $cmd->execute();
                  //fetchAll results
                  $allUsers = $cmd->fetchAll();            
                  echo '
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
                  
                  echo '</tbody></table>';
                  }
                  $cmd->closeCursor();   
                  
                  ?>
               <!-- Below is used for some easy formatting.... -->
               <br />
               <br />
               <br />
               <br />
               <br />
               <div class = 'mainHeadingInfo'>
                  <p>If your information above is not correct please click <?php echo '<a href="form.php?id='. $_SESSION['user_id'] . '">Edit</a>';?> inorder to update your information.</p>
                  <p>If you would like to delete your information from our records please click <a href="delete.php">Delete</a>.</p>
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
      </div>
   </body>
</html>