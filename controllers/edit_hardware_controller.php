<?php
include_once "db_connector.php";
if(isset($_POST['name'])) {

  $conn = dbConnect();
  $stmt = $conn->prepare('UPDATE hardware SET inUse = :inUse, status = :status, usesPlastic = :usesPlastic, multiple_extrusion = :multiple_extrusion, num_extrusions = :num_extrusions WHERE machineName = :machineName');

  $machineName = $_POST['name'];
  $inUse = $_POST['usage'];
  $status = $_POST['status'];
  $usesPlastic = $_POST['plastic'];
  $multiple_extrusion = $_POST['ext'];
  $num_extrusions = $_POST['num_ext'];
  $stmt->bindParam(':machineName',$machineName);
  $stmt->bindParam(':inUse',$inUse);
  $stmt->bindParam(':status',$status);
  $stmt->bindParam(':usesPlastic',$usesPlastic);
  $stmt->bindParam(':multiple_extrusion',$multiple_extrusion);
  $stmt->bindParam(':num_extrusions',$num_extrusions);
  $stmt->execute();
  header("Location: ../myforge.php");
  exit();
}
else{
  die("ERROR");
}
?>
