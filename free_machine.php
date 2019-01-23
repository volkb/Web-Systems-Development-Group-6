<?php require_once 'controllers/auth_controller.php';?>
<?php
function generateInUseButtons(){
    require_once('controllers/db_connector.php');
    $conn = dbConnect();
    $stmt = $conn->prepare("SELECT machineName FROM hardware WHERE inUse = 1;");
    $stmt->execute();
    $count = 0;
    // Basically while there's still stuff to fetch we will generate buttons
    while($machine = $stmt->fetch()){
        $count++;
        $machineName = $machine['machineName'];
        // The controller takes a get parameter with the machine name and then frees that machine
        $href = "controllers/free_machine_controller.php?machinename=" . urlencode($machineName);
        echo "<div class='p-3'><h3>" . $machineName . "</h3>";
        echo "<a href='" . $href . "'><button type='button' class='btn btn-primary'>Free Machine</button></a></div>";
    }
    if($count == 0){
        echo "<h3> All Machines are available!</h3>";
    }
}
?>
<!DOCTYPE html>
<html>
<head class="bg-secondary">
  <?php include_once "style.php";?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Free Machine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-secondary">
  <div class="bg-secondary pt-3 p-2">
    <?php include_once 'nav_bar.php';?>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto text-center">
        <div class="card shadow-lg my-5">
          <div class="card-body">
          <h1 class="card-title text-center">Free A Machine</h1>
          <div id="machines">
              <?php generateInUseButtons() ?>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>




</body>
</html>
