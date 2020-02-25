<!DOCTYPE html >
<html>
  <head>
    <title>Log in Page</title>
    <meta charset="utf-8" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Lobster|Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
    <div id="mainpage">
      <?php include("header.php");?>

      <?php
      $fields = array("fusername" => "User Name",
                      "fpassword" => "Password");
      ?>

          <div id="login">
              <form action=<?php echo $_SERVER['PHP_SELF']?> method="POST">
                   <fieldset>
                        <legend>Login Form</legend>
                          <?php
                                  /*if (isset($message_login))
                                  {
                                    echo "<p>$message_login</p>\n";
                                  }*/
                                  foreach($fields as $field => $value)
                                  {
                                    if(preg_match("/pass/i",$field))
                                       $type = "password";
                                    else
                                       $type = "text";
                                    echo "<div class='field'>
                                      <label for='$field'>$value</label>
                                      <input class='logintype' name='$field' type='$type'
                                      value='".@$$field."' size='20' maxlength='50' />
                                      </div>\n";
                                  }
                          ?>
                         <input class="searchbutton" style="margin-left:450px" type="submit" name="login_button" value="Login" />
                  </fieldset>
              </form>
       </div>
       <?php

       $dbserver="localhost";
       $dbuser="root";
       $dbpass="";
       $dbname="eventinterested";

       @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

       if($db->connect_error){
         echo "Sorry man, couldn't connect, this is why:" . $db->connect_error;
         exit();
       }


       if(isset($_POST['fusername']) && !empty($_POST['fusername'])){
         $fusername = strip_tags(trim($_POST['fusername']));
         $sql = "SELECT firstName FROM user
                   WHERE firstName='$fusername'";
         $result_name = mysqli_query($db,$sql);
         $num_name = mysqli_num_rows($result_name);
         if($num_name > 0)
         {
           $sql = "SELECT firstName FROM user
                   WHERE firstName='$fusername'
                   AND password=md5('$_POST[fpassword]')";
           $result_pass = mysqli_query($db,$sql);
           $num_pass = mysqli_num_rows($result_pass);
           if($num_pass > 0)  //password matches
           {
             $sql = "SELECT firstName,userID,user_type FROM user
                       WHERE firstName='$fusername'";
             $result_user= $db->prepare($sql);
             $result_user -> bind_result($firstName,$userID,$user_type);
             $result_user -> execute();
             while($result_user->fetch()){
               session_start();
               $_SESSION['logname'] = $firstName;
               $_SESSION['usertype'] = $user_type;
               $_SESSION['userid'] = $userID;
             }
             if($user_type == "user"){
               header("Location: uploadfile.php");
             }
             if($user_type == "ad"){
               header("Location: admin.php");
             }
             if($user_type == "mo"){
               header("Location: moder.php");
             }
           }
           else  if($num_pass == 0)// password does not match
           {
             $message_login="The Login Name, '$fusername'
                     exists, but you have not entered the
                     correct password! Please try again.";
             echo "<p class='msg'>$message_login</p>";
           }
         }
         else if($num_name== 0)  // login name not found
         {
           $message_login = "The User Name you entered does not exist! Please try again.";
            echo "<p class='msg'>$message_login</p>";
         }
       }

       ?>

      <?php include("footer.php");?>
    </div>
  </body>
</html>
