<?php include("config.php");?>
<header>
  <div id="starter">
    <div id="logotype">
      <a href="index.php"><img src="img/logotype.png"/></a>
      <h1>My Interested Event</h1>
    </div>
    <div id="searchbar">
      <?php
      session_start();

      $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT']);
      if ($_SESSION['check'] != hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT'])){
        session_destroy();
      }


      if(isset($_SESSION['logname'])){
        echo "<h3 style='margin:0'>";
        if($_SESSION['usertype']=="ad"){
          echo "<a class='logname' href='admin.php'>";
        }
        if($_SESSION['usertype']=="mo"){
          echo "<a class='logname' href='moder.php'>";
        }
        if($_SESSION['usertype']=="user"){
          echo "<a class='logname' href='uploadfile.php'>";
        }
        echo "Hi ".$_SESSION['logname']." !</a></h3>";
      }
      ?>
      <a href="browse.php"><img src="img/search.png"/></a>
      <?php
      //session_start();


      if(isset($_SESSION['logname'])){
        echo "<a href='logout.php'><img src='img/logout.png'/></a>";
      }else{
        echo "<a href='login.php'><img src='img/login.png'/></a>";
      }
      ?>
      <a href="gallery.php"><img src="img/gallery.png"/></a>
    </div>
  </div>
  <div id="nav">
    <ul>
      <li><a class="<?php echo($current_page == 'index.php') ? 'active':null ?>" href="index.php">Home</a></li>
      <li><a class="<?php echo($current_page == 'about.php') ? 'active':null ?>" href="about.php">About us</a></li>
      <li><a class="<?php echo($current_page == 'browse.php') ? 'active':null ?>" href="browse.php">Browse events</a></li>
      <li><a class="<?php echo($current_page == 'my_interested.php') ? 'active':null ?>" href="my_interested.php">My interested events</a></li>
      <li><a class="<?php echo($current_page == 'contact.php') ? 'active':null ?>" href="contact.php">Contact us</a></li>
   </ul>
  </div>
</header>
