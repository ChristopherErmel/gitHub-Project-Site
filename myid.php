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
               <!--Below is the main login form.-->
               <form method="post" action="validator_login.php">
                  <fieldset class="form-group">
                     <label for="username" class="col-sm-2">User Name:</label>
                     <input name="username" required type="username" />
                  </fieldset>
                  <fieldset class="form-group">
                     <label for="password" class="col-sm-2">Password:</label>
                     <input name="password" required type="password" />
                  </fieldset>
                  <button type="submit" class="col-sm-offset-2 btn btn-success">Log In</button>
               </form>
            </div>
            <div class = 'mainHeading'>
               <h2>MyID Login: </h2>
               <div class = 'mainHeadingInfo'>
                  <p>Use the form above to login to your MyID Account.</p>
                  <p>You will then be able to View, Edit or Delete your record.</p>
                  <p></p>
                  <p>If you are new to the site please <a href="register.php" title="Register">register</a> for a new account, in order to create your My ID record.</p>
               </div>
            </div>
         </div>
         <div class = 'mainSidebar'>
            <!--The main Side Bar Content of the page is here (right side)-->
            <div class = 'mainLinkBox'>
               <!--This is used for the links of the sidebar-->
               <a href="./index.php">-----Home-----</a>
               <a href="./myid.php">-----My ID-----</a>               
               <a href="./register.php">-----Register-----</a>
               <a href="./about.php">-----About-----</a>
            </div>
         </div>
      </div>
   </body>
</html>