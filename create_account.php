<?php require_once 'controllers/auth_controller.php'?>
<!doctype html>
<html class="bg-secondary" lang="en">
  <head>
    <?php include 'style.php';?>
    <meta charset="utf-8">
    <title>Create Account</title>
  </head>

  <body class="bg-secondary">
    <div class="bg-secondary pt-3 p-2">
        <?php include 'nav_bar.php';?>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card shadow-lg my-5">
            <div class="card-body">
              <h1 class="card-title text-center">Create Account</h1>
              <form action="controllers/ca_controller.php" method="post">

                <div class="form-group">
                  <input type="text" class="form-control" name="first" placeholder="First Name" required/>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="last" placeholder="Last Name" required/>
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="RPI E-mail" required/>
                </div>

                <div class="form-group">
                  <input type="number" class="form-control" min="660000000" max="999999999" name="rin" placeholder="RIN" required/>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="rcsID" placeholder="RCS ID" required/>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required/>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required/>
                </div>

                  <div class="form-group">
                      <input type="text" class="form-control" name="gender" placeholder="Gender (Optional)"/>
                  </div>

                  <div class="form-group">
                      <input type="text" class="form-control" name="major" placeholder="Major(s)" required/>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      I agree to pay the $15 membership Fee
                    </label>
                  </div>

                  <div class="text-center">
                    <button class="btn btn-primary btn-clock text-uppercase mt-2" type="submit" name="submit">Create</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
