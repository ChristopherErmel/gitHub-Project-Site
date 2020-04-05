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
      <?php require ('db/db.php'); ?>
      <?php require ('auth.php'); ?>
      <?php require('appvars.php'); ?>
   </head>
   <body>
      <div id = 'main'>
         <div class = 'mainContent'>
            <!--The main Content of the page is here (left side)-->
            <?php
               $id = null;
               $name = null;
               $email = null;
               $city = null;
               $skills = null;
               $website = null;
               $social = null;
               
               if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
               
                  $id = $_GET['id'];
               
                  require ('db/db.php');
               
                  $sql = "SELECT * FROM users_account WHERE user_id = :id;";
               
                  $cmd = $conn->prepare($sql);
               
                  $cmd->bindParam(':id', $id);
               
                  $cmd->execute();
               
                  $skills = $cmd->fetchAll();
               
                  foreach ($skills as $skill){
                     $name = $skill['name'];
                     $email = $skill['email'];
                     $city = $skill['city'];
                     $skills = $skill['skills'];
                     $website = $skill['website'];
                     $social = $skill['social'];
                     $image = $skill['image'];
                  }
               
                  $cmd->closeCursor();
               }       
               ?>
            <div class = 'contentBox'>
               <form enctype="multipart/form-data" method="post" action="validator.php">
                  <div class="form-group">
                     <input type="text" name="name" class="form-control" placeholder="Your Name" size="50" value="<?php echo $name; ?>">
                  </div>
                  <div class="form-group">
                     <input type="text" name="email" class="form-control" placeholder="YourEmail@example.com" size="50"value="<?php echo $email; ?>">
                  </div>
                  <div class="form-group">
                     <input type="text" name="city" class="form-control" placeholder="Your City" size="50"value="<?php echo $city; ?>">
                  </div>
                  <div class="form-group">
                     <input type="text" name="website" class="form-control" placeholder="YourWebsite.com" size="50"value="<?php echo $website; ?>">
                  </div>
                  <div class="form-group">
                     <input type="text" name="social_media" class="form-control" placeholder="@YourInstagram" size="50"value="<?php echo $social; ?>">
                  </div>
                  <div class="form-group">
                     <textarea name="skills" class="form-control" placeholder="Please list your best skills.(-skill1 -skill2 -skill3)   [MAX 75 Characters]" maxlength="75" cols="70" rows="2"><?php echo $skills; ?></textarea> 
                  </div>
                  <input type ="hidden" name="id" value="<?php echo $id; ?>">
                  <div>
                     <!-- inorder to select file for upload -->
                     <input type="file" name="image">
                  </div>
                  <input type="submit" name="submit" value="submit" class="btn btn-primary">
               </form>
            </div>
            <div class = 'mainHeading'>
               <h2>User Record Information:</h2>
               <div class = 'mainHeadingInfo'>
                  <p>Please input the following information: </p>
                  <p>Name, Email, City, Social Links, a small list of skills that you possess as well as a profile picture.</p>
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