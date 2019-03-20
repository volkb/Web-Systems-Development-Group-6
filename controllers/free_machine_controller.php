<?php
if(isset($_GET['machinename'])){
    $machineName = $_GET['machinename'];
    require_once('db_connector.php');
    $conn = dbConnect();
    // Machine is no longer in use because we just freed it
    $stmt = $conn->prepare("UPDATE hardware SET inUse = 0 WHERE machineName=:machineName;");
    $stmt->bindParam(":machineName", $machineName);
    $stmt->execute();
    $stmt = $conn->prepare("SELECT timesFailed FROM projects WHERE machine = :machineName AND endTime IS NULL");
    $stmt->bindParam(":machineName", $machineName);
    $stmt->execute();
    $failed = $stmt->fetchColumn();
    if ($failed != 0){
      $stmt = $conn->prepare("UPDATE projects SET endTime = :endTime, success = 0 WHERE machine = :machineName AND endTime IS NULL;");
      date_default_timezone_set("America/New_York");
      $end = date("Y-m-d H:i:s",time());
      $stmt->bindParam(":machineName", $machineName);
      $stmt->bindParam(":endTime", $end);
      $stmt->execute();
    }
    else{
      $stmt = $conn->prepare("UPDATE projects SET endTime = :endTime, success = 1 WHERE machine = :machineName AND endTime IS NULL;");
      date_default_timezone_set("America/New_York");
      $end = date("Y-m-d H:i:s",time());
      $stmt->bindParam(":machineName", $machineName);
      $stmt->bindParam(":endTime", $end);
      $stmt->execute();
    }
    header("Location: ../free_machine.php");
}else{
    echo "Invalid GET Paramaters!";
    header("Location: ../index.php");
    exit();
}
?>
