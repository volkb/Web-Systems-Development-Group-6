<?php
if(isset($_COOKIE['FORGE-SESSION'])){
  require_once('controllers/db_connector.php');
  $conn = dbConnect();
  $stmt = $conn->prepare("SELECT * FROM sessions WHERE sessionID = :sessID");
  $stmt->bindParam(":sessID", $_COOKIE['FORGE-SESSION']);
  $stmt->execute();
  $session = $stmt->fetch();
  if($session){
    header("Location: ./myforge.php");
  }else{
    setcookie("FORGE-SESSION",'', time() - 36000,'/');
  }
}
?>
<!doctype html>
<html lang="en" class="bg-secondary">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <?php include 'style.php';?>
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
            <h1 class="card-title text-center">Sign In</h1>
              <form action="controllers/login_controller.php" method="post">
                <div class="form-group">
                    <label for="rcsID">RCS ID:</label>
                    <input type="text" class="form-control" name="rcsID" placeholder="Enter RCS ID" required autofocus />
                </div>

                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required />
                  </div>

                  <div class="text-center" id="submit">
                    <button class="btn btn-primary btn-clock text-uppercase" type="submit">Sign in</button>
                  </div>
                  <div class="text-center" style="display: none" id="verify">
                      <p>Please Verify Your Email <a href="controllers/auto_verify_email.php">Resend Email</a></p>
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>

      </div>
  </div>
</body>
</html>
