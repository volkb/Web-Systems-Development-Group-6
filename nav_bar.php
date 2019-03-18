<?php include_once 'style.php';?>
<?php include_once 'controllers/functions.php';?>
<?php include_once 'scripts.php';?>
  <div class="container d-flex w-100 mx-auto my-auto flex-column align-middle">
    <header class="masthead mb-auto">
      <div class="inner">
          <!--        for update purposes-->
        <a href="index.php"><img src="logo/forgelogo revis3.png" width="50" class="masthead-brand"/></a>
        <nav class="nav nav-masthead justify-content-center roboto" id="mainNav">
          <a class="nav-link text-muted" href="index.php">Home</a>
          <a class="nav-link text-muted" href="equipment.php">Equipment</a>
          <a class="nav-link text-muted" href="hours.php">Hours</a>
          <a class="nav-link text-muted" href="gallery.php">Gallery</a>
          <a class="nav-link text-muted" href="news.php">News</a>
          <a class="nav-link text-muted" href="challenge.php">Forge Challenge</a>
          <a class="nav-link text-muted" href="contact.php">Contact</a>
          <a class="nav-link text-muted" href="forum/index.php"><i>Blacksmith</i></a>
          <?php
          if(isset($_COOKIE['FORGE-SESSION'])){
            echo "<a class=\"nav-link text-muted\" href=\"myforge.php\">My Forge</a>";
            echo "<a class=\"nav-link text-muted\" href=\"controllers/logout_controller.php\">Logout</a>";
          }else{
            echo "<a class=\"nav-link text-muted\" href=\"login.php\">Login </a>";
          }
          ?>
        </nav>
      </div>
    </header>
  </div>
