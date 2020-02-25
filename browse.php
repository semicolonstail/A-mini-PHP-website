<!DOCTYPE html >
<html>
  <head>
    <title>Browse</title>
    <meta charset="utf-8" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Lobster|Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
    <div id="mainpage">
      <?php

        include("header.php");
        //session_start();

        @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

        if($db->connect_error){
          echo "Sorry man, couldn't connect, this is why:" . $db->connect_error;
          exit();
        }



        if(isset($_GET['avali'])){

          $eventid = $_GET['avali'];
          $userid = $_SESSION['userid'];

          $query_up ="INSERT INTO event_user(eventID,userID)
                      VALUES ('$eventid','$userid')";

          $stmt_up = $db->prepare($query_up);
          $stmt_up->execute();

        }
        if(isset($_SESSION['userid'])){
          $query_find = "SELECT eventID FROM event_user
                         WHERE userID = " .$_SESSION['userid'];

           $stmt_find = $db->prepare($query_find);
           $stmt_find -> bind_result($eventid_find);
           $stmt_find -> execute();
           $event_find = array();
           while($stmt_find -> fetch()){
             $event_find[] = $eventid_find;
           }
        }
         //print_r($event_find);



        $searchholder = "";
        $searcheventname = "";

        if(isset($_POST) && !empty($_POST)){
          $searchholder = trim($_POST["holder"]);
          $searcheventname = trim($_POST["event_name"]);
        }


        $query = "SELECT event.eventID, event.eventName, eventcity.eventCityName,
                  event.eventSpot, event.eventDate, event.eventPrice,
                  holder.holderName FROM event
         JOIN event_holder ON event.eventID = event_holder.eventID
         JOIN holder ON holder.holderID = event_holder.holderID
         JOIN eventcity ON event.eventCityID = eventcity.eventCityID ";


        if ($searcheventname && !$searchholder){
          $query = $query . "WHERE event.eventName LIKE'%" . $searcheventname. "%'";
        }

        if (!$searcheventname && $searchholder){
          $query = $query . "WHERE holder.holderName LIKE'%" . $searchholder."%'";
        }

        if ($searcheventname && $searchholder){
          $query = $query . "WHERE holder.holderName LIKE'%" . $searchholder. "%' AND holder.holderName LIKE'%" . $searchholder."%'";
        }

        //echo $query;

        $stmt = $db->prepare($query);
        $stmt->bind_result($id, $name, $city, $spot, $date, $price, $holder);
        $stmt->execute();

      ?>
      <div id="browse_container">
        <div id="choose">
          <form action="" method="post" class="">
            <input type="text" class="searchtype" id="holder" name="holder" placeholder="Holder of the event">
            <input type="text" class="searchtype" id="event_name" name="event_name" placeholder="Name of the event">
            <button type="submit" class="searchbutton">Search</button>
          </form>
          <!--<dl>
            <dt>Categories:</dt>
            <dd id="cate">
              <a href=#>All</a>
              <a href=#>Music</a>
              <a href=#>Concert</a>
              <a href=#>Theatre</a>
              <a href=#>Sports</a>
              <a href=#>Family</a>
              <a href=#>Art</a>
            </dd>
          </dl>
          <dl>
            <dt>City：</dt>
            <dd id="city">
              <a href=#>All</a>
              <a href=#>Stockholm</a>
              <a href=#>Beijing</a>
              <a href=#>Chicago</a>
              <a href=#>London</a>
              <a href=#>Paris</a>
              <a href=#>Singapore</a>
            </dd>
          </dl>-->
        </div>
        <div id="event_list">
          <h4>Eventlist</h4>
          <?php
            //session_start();

            while($stmt -> fetch()){
             if(isset($_SESSION['userid'])){
               if(!in_array($id,$event_find)){
                 echo "<form action=";
                 if(isset($_SESSION['userid'])){
                   echo "''";
                 }else {
                   echo "login.php";
                 }
                 echo " method='get'><div class='detail'>";
                 echo "<h5>$name</h5>";
                 echo "<p>$date &nbsp; &nbsp; &nbsp; $spot &nbsp;&nbsp;&nbsp;$price SEK";
                 echo "<button name='avali' value='$id' class='button'> Reserve </button></p>";
                 echo "</form></div>";
               }
             }else{
                echo "<form action=";
                if(isset($_SESSION['userid'])){
                  echo "''";
                }else {
                  echo "login.php";
                }
                echo " method='get'><div class='detail'>";
                echo "<h5>$name</h5>";
                echo "<p>$date &nbsp; &nbsp; &nbsp; $spot &nbsp;&nbsp;&nbsp;$price SEK";
                echo "<button name='avali' value='$id' class='button'> Reserve </button></p>";
                echo "</form></div>";
              }
            }
          ?>
          <!--<div class="detail">
            <div class="pic"><img src="img/cats.png"/></div>
            <div class="text">
              <h5>Cats</h5>
              <p>2018.9.18<br/>Mercedes-Benz Arena <br/>Price: 380/	480/	580/	780/	980/	1280</p>
              <button class="button">Reserve</button>
            </div>
          </div>
          <div class="detail">
            <div class="pic"><img src="img/hv71.jpg"/></div>
            <div class="text">
              <h5>HV71</h5>
              <p>2018.10.9<br/>Elima <br/>Price: 380/	480/	580/	780/	980/	1280</p>
              <button class="button">Reserve</button>
            </div>
          </div>-->
        </div>
      </div>
      <?php include("footer.php");?>
    </div>
  </body>
</html>
