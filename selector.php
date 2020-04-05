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
            ob_start();
                    if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $idCheck=false;
                    $idFailed=false;
            
                      if (!empty($id) && !preg_match('/^[a-zA-Z ]+$/i', $id) && strlen($id) > 0 && strlen(trim($id)) !== 0){ //checks to see is id is empty and if it doesnt contains only letters and spaces. 
                        $idCheck=true;
                      }
                      else{$idCheck=false;
            
                        $idFail = "<div class = 'mainHeadingInfo'> <p>MyIDFeild:Cannot be Empty!</p></div></div>";//used for error messages...
                        $idFailed = true;
                       }
                    if ($idCheck==true) {
                          //db connect
                          require ('db/db.php');
                          //query
                          $sql = "SELECT * FROM users WHERE id=$id";
                          //prepare
                          $cmd = $conn->prepare($sql);
                          //execute
                          $cmd->execute();
                          //fetchAll results
                          $idUsers = $cmd->fetchAll();
            
                          echo '
                                  <div class = "mainContent">
                                          <table class="table">
                                            <thead>
                                                <th> Name </th>
                                                <th> Email </th>
                                                <th> City </th>
                                                <th> Skills </th>
                                                <th> Edit </th>
                                                <th> Delete </th>
                                            </thead>
                                          </div>
                                        <tbody>';
            
                                  //loop through the data and create tables
                                  foreach ($idUsers as $idUser) {
                                    echo '<td>' . $idUser['name'] . '</td>';
                                    echo '<td>' . $idUser['email'] . '</td>';
                                    echo '<td>' . $idUser['city'] . '</td>';
                                    echo '<td>' . $idUser['skills'] . '</td>';
                                    echo '<td><a href="form.php?id='. $idUser['id'] . '">Edit</a></td>';
                                    echo '<td><a href="delete.php?id=' . $idUser['id'] . '"onclick = "return confirm (\'Are you sure? Warning: This will permanently DELETE this record!\');">Delete</td></tr>';
            
                                  }
            
                                echo '</tbody></table>';
            
            
                                $cmd->closeCursor();
            
                                echo '<div class = "mainHeading">
                                      <h2><p>Personal Information:</p></h2>
                                      <div class = "mainHeadingInfo">
                                      <p>Above you can VIEW, EDIT and DELETE your information.</p>
                                      </div>
                                      </div>';
                    }
                    else {
                        echo "
                        <div class = 'mainContent'> 
                        <div class = 'mainHeading'> <p>Submission Error: </p>"; //if there were any errors display the messages.
                        if ($idFailed == true) {echo $idFail;}
                    }
                  }
                  ob_flush();
              ?>
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