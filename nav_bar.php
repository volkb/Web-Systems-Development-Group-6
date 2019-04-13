<?php include_once 'style.php';?>
<?php include_once 'controllers/functions.php';?>
<?php include_once 'scripts.php';?>
  <div class="container d-flex w-100 mx-auto my-auto flex-column align-middle">
    <header class="masthead mb-auto">
      <div class="inner">
          <!--        for update purposes-->
        <a href="index.php"><img src="logo/Official Logo No Print.png" width="8%" class="masthead-brand"/></a>

        <nav class="nav nav-masthead justify-content-center roboto" id="mainNav">
          <a class="nav-link text-muted" href="index.php">Home</a>

          <a class="nav-link text-muted" href="gallery.php">Gallery</a>
          <a class="nav-link text-muted" href="news.php">News</a>
          <a class="nav-link text-muted" href="forum/index.php" target="_blank">Forum</a>
          <a class="nav-link text-muted dropdown-toggle pr-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Info
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="hours.php">Hours</a>
            <a class="dropdown-item" href="contact.php">Contact</a>
            <a class="dropdown-item" href="equipment.php">Equipment</a>
          </div>
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
