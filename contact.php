<!DOCTYPE html>
<html class="bg-secondary">

<head>
  <?php include 'style.php';?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-secondary">
  <div class="bg-secondary pt-3 p-2">
      <?php include 'nav_bar.php';?>

      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="text-center pt-3 display-4 text-primary">Contact Us</h1>
                  <p class="text-center">Looking to get in touch?</p>

                  <!--manual adjustment to center the container-->
                  <div id = "container">
                      <div class="row">
                          <div class="col-md-6 p-4">
                              <div class="row">
<!--                                  <div class="col-sm-3 text-center">-->
<!--                                      <i class="d-block  fa fa-5x fa-globe"></i>-->
<!--                                  </div>-->
                                  <div class="col-sm-9">
                                      <h3 class="">Find us Physically</h3>
                                      <p class="">We are located in the CII 2037. &nbsp;Take the elevators down in the Low building to the second floor. &nbsp;If the sign is flipped to OPEN, come on in. &nbsp;</p>
                                      <a class="btn btn-primary" href="hours.php">Hours of Operation
                                          <br> </a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6 p-4">
                              <div class="row">
<!--                                  <div class="col-sm-3 text-center">-->
<!--                                      <i class="d-block  fa fa-5x fa-mouse-pointer"></i>-->
<!--                                  </div>-->
                                  <div class="col-sm-12">
                                      <h3 class="">Find us Virtually</h3>
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


                      <?php
                      if(isset($_POST['submit'])){

                          $to = "roberr5@rpi.edu";
                          $from = $_POST['email'];
                          $name = $_POST['name'];
                          $subject = $_POST['subject'];
                          $message = $_POST['message'];
                          $headers = "From: " . $from;
                          $right = "Mail successfully sent";
                          $wrong = "There was an error sending your email.  Please try again later";


                          if (mail($to,$subject,$message,$headers))
                              echo "<script type='text/javascript'>alert('$right');</script>";
//                              echo "Mail successfully sent";
                          else
                              echo "<script type='text/javascript'>alert('$wrong');</script>";
                         // You can also use header('Location: thank_you.php'); to redirect to another page.
                      }
                      ?>
<!--                          <div class="row">-->
                      <!DOCTYPE html>
                      <head>
                          <title>Contact Us</title>
                      </head>
                      <body>

                      <div id = "container" style="width:100%">
                          <div class="row">
                              <div class="col-md-6 p-4">
                                  <div class="row">
                                      <div class="col-sm-9">
                                        <h3 class="">Email Us</h3>
                                      </div>
                                  </div>
                                <p class="">Contact us directly by filling out the following form.</p>
                                  <form class="form-horizontal" style="margin-left: -15px" role="form" method="post" action="">

                                      <div class="form-group">
                                          <label for="name" class="col-sm-2 control-label">Name</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="email" class="col-sm-2 control-label">Email</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="email" name="email" placeholder="example@domain.com">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="subject" class="col-sm-2 control-label">Subject</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="subject" name="subject">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="message" class="col-sm-2 control-label">Message</label>
                                          <div class="col-sm-10">
                                              <textarea class="form-control" rows="5" name="message"></textarea>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-sm-10 col-sm-offset-2">
                                              <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                                          </div>
                                      </div>

                                  </form>
                              </div>

                              <div class="col-md-6 p-4">
                                  <h3 class="">Support Us</h3>
                                  <p class="">Contribute to our cause through the RPI weR Gold crowdfunding platform!  All contributions made to our cause will be matched by an anonymous donor.  Help us reach our current goal of $6120! </p>

                                  <a class="btn btn-primary" href="https://impact.rpi.edu/project/13495">weR Gold
<!--                                  Social Media Buttons-->
                                      <a href="https://impact.rpi.edu/project/13495" target="_blank" class="virtual_link">

                                      </a>
                                  <div >
<!--                                      border: 2px solid red-->
                                      <img src="weR.jpg" title="weRImage" style="margin-top: 20px; width:100%;" alt="weRImage" />
                                    </div>

                              </div>
                          </div>

                      </div>

                      </div>


                  </div>

              </div>

          </div>
      </div>
  </div>


<!--  </div>-->
  <?php include 'footer.php';?>
</body>

</html>
