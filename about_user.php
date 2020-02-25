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

$query_pre = "SELECT userID,firstName,email,phone,address,user_type FROM user";

$stmt_pre = mysqli_query($db,$query_pre);

?>


<div id="admin">



<div id="items">
  <table class="item" style="text-align:center">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>User Type</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

  <?php
     while($item = $stmt_pre->fetch_assoc()):?>
       <tr>
         <td><?php echo $item['firstName']; ?></td>
         <td><?php echo $item['email']; ?></td>
         <td><?php echo $item['phone']; ?></td>
         <td><?php echo $item['address']; ?></td>
         <td><?php echo $item['user_type']; ?></td>
         <td>
           <a href="admin.php?edit_user=<?php echo $item['userID']; ?>" class="ebtn">Edit</a>
         </td>
         <td>
           <a href="process.php?delete_user=<?php echo $item['userID']; ?>" class="ebtn">Delete</a>
         </td>
       </tr>
  <?php endwhile;?>


  </table>
</div>
<div id="save" style="text-align:center">
      <form action="process.php" method="POST">

        <input type="hidden" name="userid_update" value="<?php echo $userid_edit ?>">

        <div class="field">
         <label>Frist Name</lable>
         <input class="logintype" type="text" name="firstName" value="<?php echo $first_name_edit;?>" placeholder="Enter first name">
        </div>

        <div class="field">
         <label>Email</lable>
         <input class="logintype" type="email" name="email" value="<?php echo $email_edit;?>" placeholder="Enter email">
        </div>

        <div class="field">
         <label>Phone</lable>
         <input class="logintype" type="text" name="phone" value="<?php echo $phone_edit;?>" placeholder="Enter phone">
        </div>

        <div class="field">
         <label>Address</lable>
         <input class="logintype" type="text" name="address" value="<?php echo $address_edit;?>" placeholder="Enter address">
        </div>

        <div class="field">
         <label>User Type</lable>
         <select class="logintype" style="height:35px" name="usertype" value="<?php echo $usertype_edit;?>" placeholder="Choose user type">
           <option value="user">User</option>
           <option value="ad">Admin</option>
           <option value="mo">Moderator</option>
         </select>
        </div>
        <?php if($update_user == true):?>
         <button type="submit" name="update_user" class="searchbutton"  style="margin-top:50px">Update</button>
       <?php else: ?>
         <button type="submit" name="save_user" class="searchbutton" style="margin-top:50px">Save</button>
       <?php endif;?>
      </form>
</div>
</div>
