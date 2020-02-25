<!DOCTYPE html >
<html>
  <head>
    <title>My Interested</title>
    <meta charset="utf-8" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Lobster|Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
    <div id="mainpage">
      <?php include("header.php");?>
      <div id="interested_container">
        <div id="interested_list">
          <h4>My Interested List</h4>
          <?php
          //session_start();
          if(!isset($_SESSION['usertype'])){
            header("Location: login.php");
          }

          @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

          if($db->connect_error){
            echo "Sorry man, couldn't connect, this is why:" . $db->connect_error;
            exit();
          }

          if(isset($_GET['avali'])){

            $eventid = $_GET['avali'];
            $userid = $_SESSION['userid'];

            $query_up ="DELETE FROM event_user
                        WHERE userID = '$userid' AND eventID = '$eventid'";
            //echo $query_up;

            $stmt_up = $db->prepare($query_up);
            $stmt_up->execute();

          }


          $query = "SELECT event.eventID, event.eventName, eventcity.eventCityName, event.eventSpot, event.eventDate, event.eventPrice, holder.holderName FROM event
           JOIN event_holder ON event.eventID = event_holder.eventID
           JOIN holder ON holder.holderID = event_holder.holderID
           JOIN eventcity ON event.eventCityID = eventcity.eventCityID
           JOIN event_user ON event.eventID = event_user.eventID WHERE event_user.userID = ".$_SESSION['userid'];

           $stmt = $db->prepare($query);
           $stmt->bind_result($id, $name, $city, $spot, $date, $price, $holder);
           $stmt->execute();

           while($stmt->fetch()){
               echo "<form action='' method='get'><div class='detail'>";
               echo "<h5>$name</h5>";
               echo "<p>$date &nbsp; &nbsp; &nbsp; $spot &nbsp;&nbsp;&nbsp;$price SEK";
               echo "<button name='avali' value='$id' class='button'> Return </button></p>";
               echo "</form></div>";
             }
          ?>

          <!--<div class="detail">
            <div class="pic"><img src="img/cats.png"/></div>
            <div class="text">
              <h5>Cats</h5>
              <p>2018.9.18<br/>Mercedes-Benz Arena <br/>Price: 380/	480/	580/	780/	980/	1280</p>
            </div>
            <div class="button">
              <a href=#>Return</a>
            </div>
          </div>
          <div class="detail">
            <div class="pic"><img src="img/hv71.jpg"/></div>
            <div class="text">
              <h5>HV71</h5>
              <p>2018.10.9<br/>Elima <br/>Price: 380/	480/	580/	780/	980/	1280</p>
            </div>
            <div class="button">
              <a href=#>Return</a>
            </div>
          </div>-->
        </div>
      </div>
      <?php include("footer.php");?>
    </div>
  </body>
</html>
