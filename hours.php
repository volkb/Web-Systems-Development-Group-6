<!DOCTYPE html>
<html class="bg-secondary">

  <head>
    <?php include 'style.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hours</title>
  </head>

  <body class="text-center">
  <div class="text-center bg-primary w-100 h-100" style="background-image: url('homePagePhotos/CII2037Blurred.jpg');background-size:cover;background-position:center center;">
    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">

      <header class="masthead">
        <div class="inner">
          <a href="index.php"><img src="logo/Official Logo No Print.png" width="8%" class="masthead-brand"/></a>
          <nav class="nav nav-masthead justify-content-center roboto m-auto" id="mainNav">
            <a class="nav-link text-center m-auto p-1" href="index.php">Home</a>
            <a class="nav-link text-center m-auto p-1" href="status_bars.php">Status Bars</a>
            <a class="nav-link text-center m-auto p-1" href="gallery.php">Gallery</a>
            <a class="nav-link text-center m-auto p-1" href="news.php">News</a>
            <a class="nav-link text-center m-auto p-1" href="forum/index.php" target="_blank">Forum</a>
            <a class="nav-link text-center m-auto p-1 dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Info
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="hours.php">Hours</a>
              <a class="dropdown-item" href="contact.php">Contact</a>
              <a class="dropdown-item" href="equipment.php">Equipment</a>
            </div>

            <?php
            if(isset($_COOKIE['FORGE-SESSION'])){
              echo "<a class=\"nav-link text-center m-auto p-1\" href=\"myforge.php\">My Forge</a>";
              echo "<a class=\"nav-link text-center m-auto p-1\" href=\"controllers/logout_controller.php\">Logout</a>";
            }else{
              echo "<a class=\"nav-link text-center m-auto p-1\" href=\"login.php\">Login </a>";
            }
            ?>
          </nav>
        </div>
      </header>

      <div class="row">
<!--      Calender-->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12 p-0 h-100 w-100">
                <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=k2r6osjjms6lqt41bi5a7j48n0%40group.calendar.google.com&amp;color=%23A32929&amp;ctz=America%2FNew_York"
                        style="border-width:0" frameborder="0" scrolling="no" width="90%" height="600"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
  </div>

<!--  Location Footer-->
  <div class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12 p-4">
            <div class="row">
              <div class="col-sm-3 text-center">
                <i class="d-block  fa fa-5x fa-globe"></i>
              </div>
              <div class="col-sm-9">
                <h3 class="">Where to Find Us</h3>
                <p class="">Located in
                  <b style="font-weight: bold;">CII 2037</b>, we can be found by taking the elevator in the Low building down to the second floor and following the hallway to the left. &nbsp;We are also up the stairs from WRPI and overlooking the MILL floor.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
  <?php include 'scripts.php';?>
</html>
