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
               session_start();
               
                $id = null;
                $uID = null;
                $lastId = null;
                $sendId = false;
                if(isset($_POST['submit'])){
                
                $id = $_POST['id'];
                $uID = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $city = $_POST['city']; 
                $skills = $_POST['skills'];
                //grabs social sites
                $website = $_POST['website'];
                $social = $_POST['social_media'];
                //grabs all the image variables from the array
                $image = $_FILES['image'];
                $imageName = $_FILES['image']['name'];
                $imageTmpName = $_FILES['image']['tmp_name'];
                $imageSize = $_FILES['image']['size'];               
                $imageError = $_FILES['image']['error'];
                $imageType = $_FILES['image']['type'];
                //record checks
                $nameCheck=false;
                $emailCheck=false;
                $cityCheck=false;
                $skillsCheck=false;
                $imageCheck=false;
                //social checks
                $websiteCheck=false;
                $socialCheck=false;
                //record failed checks
                $nameFailed=false;
                $emailFailed=false;
                $cityFailed=false;
                $skillsFailed=false;
                $imageFailed=false;
                //social failed checks
                $websiteFailed=false;
                $socialFailed=false;
               
                //grabs the extention of the file name. 
                $imageExt = explode('.', $imageName);
                //set it to low and grabs again
                $imageActualExt = strtolower(end($imageExt));
                //sets the extentions into an array
                $allowedExt = array('png', 'jpeg', 'jpg');
               
               
                //this will check to see if the actualextention is one of the allowed types
                if (in_array($imageActualExt, $allowedExt)){
                   //checks for upload errors
                     if ($imageError === 0){
                         //checks for the file size is less then 200kb
                         if($imageSize < 200000){
                             
                             //we are now uploading the file to our root folder.
                             $imageDestination = 'images/'.$imageName;
                             //we are now moving the file
                             move_uploaded_file($imageTmpName, $imageDestination);
                             //setting the imagecheck to true for the sql insert statement below.
                             $imageCheck = true;
                           }
                         else{
                           $imageFail = "<div class = 'mainHeadingInfo'> <p>ImageFeild:File size too large. Please use a file size of under 200kb.</p></div>";//used for error messages...
                        $imageFailed = true;
                         }
                       }
                       else{
                           $imageFail = "<div class = 'mainHeadingInfo'> <p>ImageFeild:There was an error uploading your image. Please try again.</p></div>";//used for error messages...
                         $imageFailed = true;
                       }  
                       }             
                  else {
               
                       $imageFail = "<div class = 'mainHeadingInfo'> <p>ImageFeild:Only file types of 'PNG' 'JPEG' 'JPG' Allowed!</p></div>"; //used for error messages...
                       $imageFailed = true;
                  }
               
               
                   if (!empty($name) && preg_match('/^[a-zA-Z ]+$/i', $name) && strlen($name) > 0 && strlen(trim($name)) !== 0){ //checks to see if name is empty and if it contains only letters and spaces and that its not just a whitespace.
                    $nameCheck=true;
                  }
                  else{$nameCheck=false;
                
                   $nameFail = "<div class = 'mainHeadingInfo'> <p>NameFeild:Only Letters and Spaces Allowed!(Cannot be empty)</p></div>";//used for error messages...
                    $nameFailed = true;
                   }
                
                  if (!empty($email && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ){ //checks to see is email is empty and if it is a valid email address. 
                    $emailCheck=true;
                  }
                  else{$emailCheck=false;
                
                      $emailFail = "<div class = 'mainHeadingInfo'> <p>EmailFeild:Must Contain a Valid Email(example@exmaple.com)!</p></div>";//used for error messages...
                      $emailFailed = true;                       
                  }
               
                  if (!empty($city) && preg_match('/^[a-zA-Z ]+$/i', $city) && strlen($city) > 0 && strlen(trim($city) !== 0)){ //checks to see is city is empty and if it contains only letters and spaces and that is not just whitespace. 
                    $cityCheck=true;
                  }
                  else{$cityCheck=false;
                
                    $cityFail = "<div class = 'mainHeadingInfo'> <p>CityFeild:Only Letters and Spaces Allowed!(Cannot be empty)</p></div>";//used for error messages...
                    $cityFailed = true;                     
                  }
                  if (!empty($skills) && strlen($skills) > 0 && strlen(trim($skills)) !== 0){ //checks to see if skills is empty and if it contains only letters and spaces. 
                    $skillsCheck=true;
                  }
                  else{$skillsCheck=false;
                
                    $skillsFail = "<div class = 'mainHeadingInfo'> <p>SkillsFeild:Can Not Be Empty(We know you have skills)!</p></div>"; //used for error messages...
                    $skillsFailed = true;
                  }                   
               
                if ($nameCheck==true && $emailCheck==true && $cityCheck==true && $skillsCheck==true && $imageCheck==true) {
                
                require ('db/db.php');
                
                if(!empty($id)){ //check if this is an update or a new submission
                
                  $sql = "UPDATE users_account SET name = :name, email = :email, city = :city, skills = :skills, image = :image, website = :website, social = :social WHERE user_id = ".$uID;
                  $lastId = $id;
                  
                }
                else {
               
                   //grabs the user_id var from the session
                   $uID = $_SESSION['user_id'];
                   //will only update the current users information. 
                   $sql = "UPDATE users_account SET name = :name, email = :email, city = :city, skills = :skills, image = :image, website = :website, social = :social WHERE user_id = ".$uID;
               
                   $sendId = true; //to send the original id if needed instead of looking for a new one.                  
                
                }
                
                $cmd = $conn->prepare($sql); 
                             
                $cmd->bindParam(':name', $name);
                $cmd->bindParam(':email', $email); 
                $cmd->bindParam(':city', $city); 
                $cmd->bindParam(':skills', $skills);
                $cmd->bindParam(':image', $imageName); 
                $cmd->bindParam(':website', $website); 
                $cmd->bindParam(':social', $social); 
                
                $cmd->execute();
                
                if($sendId == true){
                $stmt = $conn->query("SELECT LAST_INSERT_ID()");
                $lastId = $stmt->fetchColumn();
                }
                
                echo "
                <div class = 'mainContentNumber'>
                <p>Info</p>
                </div>
                <div class = 'mainContentInfo'>
                <h3>Submission Success!</h3>
                <p>Thank you for your record! <br>You have the ability to view, edit, and delete this record on your My ID page.</p>
                  </div>
                ";
                               
                if($sendId == true){
                  echo "<div class = 'mainHeading'> <p>Submission Recived: </p>"; //if there were any errors display the 
                }
                else {
                  echo "<div class = 'mainHeading'> <p>Your Record has been Updated: </p>"; //if there were any errors display the 
                }
                
                echo "<div class = 'mainHeadingInfo'> <p>Info About: ",$name,"</p></div>";
                echo "<div class = 'mainHeadingInfo'> <p>----------------------------------</p></div>";
                echo "<div class = 'mainHeadingInfo'> <p>Email: ",$email,"</p></div>";
                echo "<div class = 'mainHeadingInfo'> <p>City: ",$city,"</p></div>";
                echo "<div class = 'mainHeadingInfo'> <p>Skills: ",$skills,"</p></div>";
                echo "<div class = 'mainHeadingInfo'> <p>Profile Pic: ",$imageName,"</p></div>";
                echo "<div class = 'mainHeadingInfo'> <p>Social Links: <b>Website:</b> ",$website," <b>Social Media:</b> ",$social,"</p></div>";
               
                $cmd->closeCursor();
                }
                else {
                    echo "<div class = 'mainHeading'> <p>Submission Error: </p>"; //if there were any errors display the messages.
                    if ($nameFailed == true) {echo $nameFail;}
                    if ($emailFailed == true) {echo $emailFail;}
                    if ($cityFailed == true) {echo $cityFail;}
                    if ($skillsFailed == true) {echo $skillsFail;}
                    if ($imageFailed == true) {echo $imageFail;}
                 }              
                }              
                ?>
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
      </div>
      </div>
   </body>
</html>