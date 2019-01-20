<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'style.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome to the Forge</title>
  </head>
  <body class="text-center">
    <div class="text-center bg-primary w-100 h-100" style="background-image: url('homePagePhotos/cover.jpg');background-size:cover;background-position:center center;">
      <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">

        <header class="masthead">
          <div class="inner">
              <!-- <a href="index.php"><img src="logo/forgelogo revis3.png" width="50" class="masthead-brand d-none d-sm-block"/></a> -->
              <nav class="nav nav-masthead justify-content-center roboto m-auto" id="mainNav">
                  <a class="nav-link text-center m-auto p-1" href="index.php">Home</a>
                  <a class="nav-link text-center m-auto p-1" href="equipment.php">Equipment</a>
                  <a class="nav-link text-center m-auto p-1" href="hours.php">Hours</a>
                  <a class="nav-link text-center m-auto p-1" href="gallery.php">Gallery</a>
                  <a class="nav-link text-center m-auto p-1" href="news.php">News</a>
                  <a class="nav-link text-center m-auto p-1" href="contact.php">Contact</a>
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
          <!-- Displays on large screens -->
          <div class="container overflow-hidden m-auto d-none d-sm-block">
              <div class="row">
                  <div class="col-sm-12">
                      <h1 class="cover-heading p-0 m-0">THE FORGE</h1>
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <hr class="cover-hr p-0 mx-auto mb-3" />
                </div>
              </div>
              <div class="row">
                  <div class="col-sm-12">
                      <p class="roboto text-justify cover-description">The Forge intends to provide the environment to create a collaborative design community on campus, promoting communication, critical thinking, and STEAM (Science, Technology, Engineering, Arts, Mathematics) ideals. Through this, the Forge will provide easy and everyday access to rapid prototyping tools, communication and collaboration tools, and a casual area to work. The Forge will hold workshops, design competitions, and speakers involved in the Making Movement.</p>
                  </div>
              </div>
              <div class="row">
                <div class="text-center container m-auto p-3">
                    <h2 class="text-warning font-weight-bold" >WeR Gold</h2>
                    <p class="roboto">Support the Forge at weR Gold!</p>
                    <a class="btn btn-primary btn-warning" href="https://impact.rpi.edu/project/13495" target="_blank">Donate</a>
                </div>
              </div>
          </div>
          <!-- Displayes on large screens -->
          <!-- Displays on mobile screens -->
          <div class="container m-auto d-block d-sm-none">
              <div class="row">
                  <div class="col-sm-12">
                      <h1 class="mobile-cover-heading p-auto m-auto">THE FORGE</h1>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-12">
                      <p class="roboto cover-description p-auto">We are Rensselaer Polytechnic Institutes only interdisciplinary makerspace, and are 100% student run!</p>
                  </div>
              </div>
          </div>
          <!-- Displayes on mobile screens -->
      </div>
    </div>

    <div class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-4">
          <div class="row">
            <div class="col-sm-3 text-center">
              <i class="d-block  fa fa-5x fa-globe"></i>
            </div>
            <div class="col-sm-9">
              <h3 class="">Find Us Physically</h3>
              <p class="">We are located in the CII 2037. &nbsp;Take the elevators down in the Low building to the second floor. &nbsp;If the sign is flipped to OPEN, come on in. &nbsp;The open hours are linked below</p>
              <a class="btn btn-primary" href="hours.php">Hours of Operation
                <br> </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 p-4">
          <div class="row">
            <div class="col-sm-3 text-center">
              <i class="d-block  fa fa-5x fa-mouse-pointer"></i>
            </div>
            <div class="col-sm-9">
              <h3 class="">Find Us Virtually</h3>
              <ul class="list-group">
                <a href="https://www.facebook.com/RPIMakerSpace/" target="_blank" class="virtual_link">
                  <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info virtual_list_item">Facebook
                    <i class="fa fa-fw fa-facebook"></i>
                  </li>
                </a>
                <a href="https://www.instagram.com/rpi.forge/" target="_blank" class="virtual_link">
                  <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info virtual_list_item">Instagram
                    <i class="fa fa-fw fa-instagram"></i>
                  </li>
                </a>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row w-75 m-auto pt-2 pb-4 d-block d-sm-none">
        <hr />
          <div class="col-md-5 align-self-center p-2">
            <img class="card-img" src="weR.jpg">
          </div>
          <div class="col-md-7 p-2">
            <h3>Support Us</h3>
            <p class="">Contribute to our cause through the RPI weR Gold crowdfunding platform! 100% RPI-organized, weR Gold will match any and all of your donations. Help us reach our current goal of $6120! </p>
            <a class="btn btn-gold align-middle gold text-dark" href="https://impact.rpi.edu/project/13495" target="_blank">Donate</a>
          </div>
      </div>
      </div>
    </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
