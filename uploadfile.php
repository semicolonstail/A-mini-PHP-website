<!DOCTYPE html >
<html>
  <head>
    <title>uploadfile</title>
    <meta charset="utf-8" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Lobster|Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
    <div id="mainpage">
      <?php include("header.php");
          //session_start();
          if(isset($_SESSION['usertype']) && $_SESSION['usertype'] != "user"){
            header("Location: login.php");
          }
      ?>

      <div id="upload">
        <form action=<?php echo $_SERVER['PHP_SELF']?> method="POST" enctype="multipart/form-data">
          <input class="" type="file" name="userfile"/>
          <input class="searchbutton" type="submit" value="Upload"/>
        </form>

        <?php
        $msg="";

         if(isset($_FILES['userfile'])){
           $ext_error = 0;
           $size_error = 0;
           $repeat = 0;
           $extensions = array('jpg','jpeg','gif','png');
           $file_ext = explode('.',$_FILES['userfile']['name']);
           $file_ext = end($file_ext);
           if(!in_array($file_ext,$extensions)){
             $msg="Sorry, your file type is wrong.";
             echo "<p class='msg'>$msg</p>";
             $ext_error = 1;
           }
           if ($_FILES["userfile"]["size"] > 500000) {
              $msg="Sorry, your file is too large.";
              echo "<p class='msg'>$msg</p>";
              $size_error = 1;
           }
          if (file_exists('images/'.$_FILES['userfile']['name'])) {
              $msg = "Sorry, file already exists.";
              echo "<p class='msg'>$msg</p>";
              $repeat = 1;
          }
           if($ext_error == 0 && $size_error == 0 && $repeat == 0){
             if(move_uploaded_file($_FILES['userfile']['tmp_name'],'images/'.$_FILES['userfile']['name'])){
               $filenewname = 'images/'.$_FILES['userfile']['name'];
               $msg="Success!";
               echo "<p class='msg'>$msg</p>";

               $dbserver="localhost";
               $dbuser="root";
               $dbpass="";
               $dbname="eventinterested";

               @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

               if($db->connect_error){
                 echo "Sorry man, couldn't connect, this is why:" . $db->connect_error;
                 exit();
               }
               if(isset($_FILES['userfile']) && !empty($_FILES['userfile'])){
                 $query_upload = "INSERT INTO gallery (image_name)
                 VALUES ('$filenewname')";

                 $stmt_upload = $db->prepare($query_upload);
                 $stmt_upload->execute();

               }
             }else {
               echo "<p class='msg'>sorry, it is failed!</p>";
             }
           }
         }
        ?>
      </div>

      <?php include("footer.php");?>
    </div>
  </body>
</html>
