<?php
if(!isset($_SESSION)){
  session_start();
}


$dbserver="localhost";
$dbuser="root";
$dbpass="";
$dbname="eventinterested";

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if($db->connect_error){
  echo "Sorry man, couldn't connect, this is why:" . $db->connect_error;
  exit();
}

$first_name_edit = "";
$email_edit = "";
$phone_edit = "";
$address_edit = "";
$usertype_edit = "";
$update_user = false;
$userid_edit = 0;


$event_edit = "";
$city_edit = "";
$spot_edit = "";
$date_edit = "";
$price_edit = "";
$holder_edit = "";
$update_event = false;
$eventid_edit = 0;







if(isset($_POST['save_user'])){
    $first_name = $_POST['firstName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $usertype = $_POST['usertype'];


    $query_new_user ="INSERT INTO user(firstName,email,phone,address,user_type)
                VALUES ('$first_name','$email','$phone','$address','$usertype')";

    $stmt_new_user = $db->prepare($query_new_user);
    $stmt_new_user->execute();

    $_SESSION['tip'] = "Record has been saved!";
    if($_SESSION['usertype'] == "ad"){
      header("Location:admin.php");
    }else if($_SESSION['usertype'] == "mo"){
      header("Location:moder.php");
    }

}



if(isset($_POST['save_event'])){
    $event = $_POST['event'];
    $city = $_POST['city'];
    $spot = $_POST['spot'];
    $date = $_POST['date'];
    $price = $_POST['price'];
    $holder = $_POST['holder'];

    $query_repeat = "SELECT eventID FROM event
                       WHERE eventName = '$event' AND eventCityID = $city " ;

    $stmt_repeat = mysqli_query($db,$query_repeat);
    $stmt_num = mysqli_num_rows($stmt_repeat);

    if($stmt_num>0){

      /*$item_repeat = $stmt_repeat->fetch_array();
      $eventid_edit = $item_repeat['eventID'];
      $update_user = true;*/

      $_SESSION['tip'] = "The event has been exsit, you just can edit it!";

      if($_SESSION['usertype'] == "ad"){
        header("Location:admin.php");
      }else if($_SESSION['usertype'] == "mo"){
        header("Location:moder.php");
      }

    }else{


    $query_new_event ="INSERT INTO event(eventName,eventCityID,eventSpot,eventDate,eventPrice)
                VALUES ('$event','$city','$spot','$date','$price')";
    //echo $query_new_event;

    $stmt_new_event = $db->prepare($query_new_event);
    $stmt_new_event->execute();

    $query_holderid = "SELECT eventID FROM event
                       WHERE eventName = '$event' AND eventCityID = $city" ;
    //echo $query_holderid;

     $stmt_holderid = $db->prepare($query_holderid);
     $stmt_holderid -> bind_result($eventid);
     $stmt_holderid -> execute();

     $stmt_holderid -> fetch();
     $query_holder_event = "INSERT INTO event_holder(eventID,holderID)
                              VALUES ('$eventid','$holder')";

     @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
     $stmt_holder_event = $db->prepare($query_holder_event);
     $stmt_holder_event->execute();

    $_SESSION['tip'] = "Record has been saved!";

    if($_SESSION['usertype'] == "ad"){
      header("Location:admin.php");
    }else if($_SESSION['usertype'] == "mo"){
      header("Location:moder.php");
    }

  }
}








if(isset($_GET['delete_user'])){
  $userID = $_GET['delete_user'];
  //echo $userID;

  $query_dele_user = "DELETE FROM user WHERE userID=$userID";

  $stmt_dele_user = $db->prepare($query_dele_user);
  $stmt_dele_user->execute();

  $_SESSION['tip'] = "Record has been deleted!";
  if($_SESSION['usertype'] == "ad"){
    header("Location:admin.php");
  }else if($_SESSION['usertype'] == "mo"){
    header("Location:moder.php");
  }

}

if(isset($_GET['delete_event'])){
  $eventID = $_GET['delete_event'];
  //echo $userID;

  $query_dele_event = "DELETE FROM event WHERE eventID=$eventID";

  $stmt_dele_event = $db->prepare($query_dele_event);
  $stmt_dele_event->execute();

  $_SESSION['tip'] = "Record has been deleted!";
  if($_SESSION['usertype'] == "ad"){
    header("Location:admin.php");
  }else if($_SESSION['usertype'] == "mo"){
    header("Location:moder.php");
  }

}









 if(isset($_GET['edit_user'])){
   $userID = $_GET['edit_user'];

   $update_user = true;

   $query_edit = "SELECT userID,firstName,email,phone,address,user_type FROM user WHERE userID=$userID";
   $stmt_edit = mysqli_query($db,$query_edit);
   $stmt_num = mysqli_num_rows($stmt_edit);
   if($stmt_num == 1){
         $item_edit = $stmt_edit->fetch_array();
         $userid_edit = $item_edit['userID'];
         $first_name_edit = $item_edit['firstName'];
         $email_edit = $item_edit['email'];
         $phone_edit = $item_edit['phone'];
         $address_edit = $item_edit['address'];
         $usertype_edit = $item_edit['user_type'];
   }
 }



 if(isset($_GET['edit_event'])){
   $eventID = $_GET['edit_event'];

   $update_event = true;

   $query_edit = "SELECT event.eventID, event.eventName, eventcity.eventCityName,
             event.eventSpot, event.eventDate, event.eventPrice,
             holder.holderName FROM event
            JOIN event_holder ON event.eventID = event_holder.eventID
            JOIN holder ON holder.holderID = event_holder.holderID
            JOIN eventcity ON event.eventCityID = eventcity.eventCityID WHERE event.eventID=$eventID";

    //echo $query_edit;
    $stmt_edit = $db->prepare($query_edit);
    $stmt_edit->bind_result($id, $name, $city, $spot, $date, $price, $holder);
    $stmt_edit->execute();

   ///$stmt_edit = mysqli_query($db,$query_edit);
   //$stmt_num = mysqli_num_rows($stmt_edit);
   //if($stmt_num == 1){
         $stmt_edit->fetch();
         $eventid_edit = $id;
         $event_edit = $name;
         $city_edit = $city;
         $spot_edit = $spot;
         $date_edit = $date;
         $price_edit = $price;
         $holder_edit = $holder;
   //}
 }







  if(isset($_POST['update_user'])){
     $userID_update = $_POST['userid_update'];
     $first_name_update = $_POST['firstName'];
     $email_update = $_POST['email'];
     $phone_update = $_POST['phone'];
     $address_update = $_POST['address'];
     $usertype_update = $_POST['usertype'];

     $query_update = "UPDATE user SET firstName='$first_name_update',email='$email_update',phone='$phone_update',
     address='$address_update',user_type='$usertype_update' WHERE userID=$userID_update";

     $stmt_update = $db->prepare($query_update);
     $stmt_update->execute();

     $_SESSION['tip'] = "Record has been updated!";

     if($_SESSION['usertype'] == "ad"){
       header("Location:admin.php");
     }else if($_SESSION['usertype'] == "mo"){
       header("Location:moder.php");
     }
  }



  if(isset($_POST['update_event'])){
    $eventID_update = $_POST['eventid_update'];
    $event_update = $_POST['event'];
    $city_update = $_POST['city'];
    $spot_update = $_POST['spot'];
    $date_update = $_POST['date'];
    $price_update = $_POST['price'];
    $holder_update = $_POST['holder'];



     $query_update = "UPDATE event SET eventName='$event_update',eventCityID='$city_update',eventSpot='$spot_update',
     eventDate='$address_update',eventPrice='$price_update' WHERE eventID=$eventID_update";

     $stmt_update = $db->prepare($query_update);
     $stmt_update->execute();

     $query_holder_update = "UPDATE event_holder SET holderID ='$holder_update' WHERE eventID=$eventID_update";

     @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

     $stmt_holder_update = $db->prepare($query_holder_update);
     $stmt_holder_update->execute();

     $_SESSION['tip'] = "Record has been updated!";

     if($_SESSION['usertype'] == "ad"){
       header("Location:admin.php");
     }else if($_SESSION['usertype'] == "mo"){
       header("Location:moder.php");
     }
  }

?>
