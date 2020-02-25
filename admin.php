<!DOCTYPE html >
<html>
  <head>
    <title>admin</title>
    <meta charset="utf-8" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Lobster|Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
    <div id="mainpage">


      <?php include("header.php");
      //session_start();
      if($_SESSION['usertype'] != "ad"){
        header("Location: login.php");
      }

      if(isset($_SESSION['tip'])){
        echo "<p class='msg'>";
        echo $_SESSION['tip'];
        unset($_SESSION['tip']);
        echo "</p>";
      }
      //echo $_SESSION['usertype'];
      require_once 'process.php';
      ?>
      <?php
       include("about_event.php");
       include("about_user.php");
      ?>
      <?php include("footer.php");?>
    </div>
  </body>
</html>
