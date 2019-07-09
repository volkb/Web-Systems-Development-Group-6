<?php
include "controllers/auth_controller.php";
include "controllers/print_form_controller.php";
include "controllers/functions.php";
?>
<!DOCTYPE html>
<html class="bg-light">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Job Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'style.php'?>
    <?php include 'scripts.php'?>
</head>


<body class="bg-light">
<div class="bg-light pt-3 p-2">
    <?php include 'nav_bar.php'?>
</div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-9 mx-auto">
          <div class="card shadow-lg my-5">
            <div class="card-body">
              <h1 class="card-title text-center">Checkout a Machine</h1>
              <form action="controllers/print_form_controller.php" name ='print_form' method="post">

                  <div class="form-group mb-4">
                    <label for="machine" id="machinelabel">Machine Name</label>
                    <select class="form-control w-25" name="machine" id="machine" required>
                      <?php generateMachineDropDown(0) ?>
                    </select>
                  </div>
                  <hr />

                <div id="plasticinfo">
                  <div class="form-row">
                      <div class="col-md-4">
                        <label for="plastic" id="plasticlabel">Plastic Type</label>
                        <select class="form-control" name="plastic" id="plastictype" class="required">
                          <?php generatePlasticsDropDown() ?>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <label for="amount" id="amountlabel">Amount of Plastic (g)</label>
                        <input type="text" class="form-control required" id="plasticamount" name="amount"/>
                        <small id="amountsmall" class="form-text text-muted ml-1"> (0 if reprint)</small>
                        <small id="printprice" class="form-text text-muted ml-1"></small>
                      </div>


                      <div class="col-md-4">
                        <label for="brand" id="brandlabel">Plastic Brand</label>
                        <input type="text" class="form-control required" name="brand" id="brand"/>
                      </div>
                    </div>

                  <div class="form-row">
                    <div class="col-md-6 mb-2">
                        <label for="temp" id="templabel">Print Temperature</label>
                        <input type="text" class="form-control required" name="temp" id="temp"/>
                    </div>
                    <div class="col-md-6 mb-2">
                      <label for="color" id="colorlabel">Color of Plastic</label>
                      <input type="text" class="form-control required" name="color" id="color"/>
                    </div>
                  </div>

                  <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" name="usersfilament" id="usersfilament">
                    <label class="form-check-label" for="usersfilament">Using my own filament / Approved reprint.</label>
                  </div>
                  <hr />
                </div>


                <label>Estimated Time to Completion</label>
                <div class="form-row">
                  <div class="col-md-6 mb-2">
                    <input type="number" class="form-control" id="hours" name="hours" min="0" max="240" placeholder="Hours" required  />
                  </div>
                  <div class="col-md-6 mb-2">
                    <input type="number" class="form-control" id="minutes" name="minutes" min="0" max="59" placeholder="Minutes" required  />
                  </div>
                </div>

                <div class="form-group mb-4">
                  <input type="checkbox" name="forclass" value="1"/>
                  <label for="forclass">This print is for a class</label>
                </div>

                <hr />




                <div id="reprintpolicy">
                  <p class="text-center"><strong>Reprint Policy:</strong></p>
                  <p>Your total print is under 50g/7mL. If your print has failed and has consumed less than 50g/7mL of plastic you will not be charged
                  for up to two additional reprint attempts.</p>
                  <p><strong>The volunteer present has final say. If you wish to appeal your claim, please email kronmm@rpi.edu</strong></p>


                  <div class="form-group">
                    <input type="checkbox" name="reprintpolicy" value="agree" class="required"/>
                    <label for="reprintpolicy"> I agree to the reprint policy.</label>
                  </div>
                  <hr id='sectiondivider2'/>
                </div>

                <div class="form-row">
                  <div class="col-md-8 mb-4">
                    <label for="initials" >Initials</label>
                    <input type="text" class="form-control" name="initials"/>
                    <small id="initialssmall" class="form-text text-muted ml-1">By initialing here, you agree to pay the charge shown.</small>
                  </div>
                  <div class="col-md-4 mb-4">
                    <label for="cost">Cost</label>
                    <input id="cost" type="text" class="form-control" name="cost" placeholder="$0.00" readonly />
                  </div>
                </div>

                <div class="text-center">
                  <button class="btn btn-primary btn-clock text-uppercase" type="submit" name="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


</body>
<script src="js/jquery-3.3.1.min.js"></script>
<?php include "js/print_form.php";?>


</html>
