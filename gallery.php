<!DOCTYPE html >
<html>
  <head>
    <title>gallery</title>
    <meta charset="utf-8" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Lobster|Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
    <div id="mainpage">
      <?php include("header.php");?>
      <div id="gallery">
      <?php
      $dbserver="localhost";
      $dbuser="root";
      $dbpass="";
      $dbname="eventinterested";

      @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

      $query = "SELECT gallery.image_name FROM gallery";
      $stmt = $db->prepare($query);
      $stmt->bind_result($image_name);
      $stmt->execute();

      while($stmt->fetch()){
          echo "<img src='$image_name'/>";
      }
      ?>
      </div>
      <?php include("footer.php");?>
    </div>
  </body>
</html>
