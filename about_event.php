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

$query_pre = "SELECT event.eventID, event.eventName, eventcity.eventCityName,
          event.eventSpot, event.eventDate, event.eventPrice,
          holder.holderName FROM event
         JOIN event_holder ON event.eventID = event_holder.eventID
         JOIN holder ON holder.holderID = event_holder.holderID
         JOIN eventcity ON event.eventCityID = eventcity.eventCityID";

$stmt_pre = $db->prepare($query_pre);
$stmt_pre->bind_result($id, $name, $city, $spot, $date, $price, $holder);
$stmt_pre->execute();
//$stmt_pre = mysqli_query($db,$query_pre);
?>


<div id="moderater">



<div id="items">
  <table class="item" style="text-align:center">
    <thead>
      <tr>
        <th>Event</th>
        <th>City</th>
        <th>Spot</th>
        <th>Date</th>
        <th>Price</th>
        <th>Holder</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

  <?php
     while($stmt_pre->fetch()):?>
       <tr>
         <td><?php echo $name; ?></td>
         <td><?php echo $city; ?></td>
         <td><?php echo $spot; ?></td>
         <td><?php echo $date; ?></td>
         <td><?php echo $price; ?></td>
         <td><?php echo $holder; ?></td>
         <td>
           <a href="moder.php?edit_event=<?php echo $id; ?>" class="ebtn">Edit</a>
         </td>
         <td>
           <a href="process.php?delete_event=<?php echo $id; ?>" class="ebtn">Delete</a>
         </td>
       </tr>
  <?php endwhile;?>


  </table>
</div>
<div id="save" style="text-align:center">
      <form action="process.php" method="POST">

        <input type="hidden" name="eventid_update" value="<?php echo $eventid_edit ?>">

        <div class="field">
         <label>Event</lable>
         <input class="logintype" type="text" name="event" value="<?php echo $event_edit;?>" placeholder="Enter event name">
        </div>

        <div class="field">
         <label>City</lable>
         <select class="logintype" style="height:35px" name="city" value="<?php echo $city_edit;?>" placeholder="Choose city">

           <?php
           $query_city = "SELECT eventCityID,eventCityName FROM eventcity";

            $stmt_city = $db->prepare($query_city);
            $stmt_city -> bind_result($event_cityid,$event_city);
            $stmt_city -> execute();
            while($stmt_city -> fetch()){
              echo "<option value='";
              echo $event_cityid;
              echo "'>";
              echo $event_city;
              echo "</option>";
            }
           ?>
         </select>
        </div>



        <div class="field">
         <label>Spot</lable>
         <input class="logintype" type="text" name="spot" value="<?php echo $spot_edit;?>" placeholder="Enter spot">
        </div>

        <div class="field">
         <label>Date</lable>
         <input class="logintype" type="text" name="date" value="<?php echo $date_edit;?>" placeholder="Enter date">
        </div>

        <div class="field">
         <label>Price</lable>
         <input class="logintype" type="text" name="price" value="<?php echo $price_edit;?>" placeholder="Enter price">
        </div>

        <div class="field">
         <label>Holder</lable>
         <select class="logintype" style="height:35px" name="holder" value="<?php echo $holder_edit;?>" placeholder="Choose holder">

           <?php
           $query_holder = "SELECT holderName,holderID FROM holder";

            $stmt_holder = $db->prepare($query_holder);
            $stmt_holder -> bind_result($event_holder,$holderid);
            $stmt_holder -> execute();
            while($stmt_holder -> fetch()){
              echo "<option value='";
              echo $holderid;
              echo "'>";
              echo $event_holder;
              echo "</option>";
            }
           ?>
         </select>
       </div>

      <?php if($update_event == true):?>
         <button type="submit" name="update_event" class="searchbutton"  style="margin-top:50px">Update</button>
       <?php else: ?>
         <button type="submit" name="save_event" class="searchbutton" style="margin-top:50px">Save</button>
       <?php endif;?>
      </form>
</div>
</div>
