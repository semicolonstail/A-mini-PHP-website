<!DOCTYPE html >
<html>
  <head>
    <title>Log Out</title>
    <meta charset="utf-8" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Lobster|Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
    <div id="mainpage">
      <?php include("header.php");?>
      <div id="logout">
        <form action="" method="POST">
            <input class="searchbutton" style="margin:50px 350px 0" type="submit" name="logout_button" value="Logout" />
        </form>
      </div>
      <?php
      if(isset($_POST['logout_button'])){
        session_destroy();
        header("Location:login.php");
      }
      ?>
      <?php include("footer.php");?>
    </div>
  </body>
</html>
