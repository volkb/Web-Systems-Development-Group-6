<?php
include_once "db_connector.php";
require_once "admin_auth_controller.php";
if(isset($_POST['delete_machine'])) {

  $conn = dbConnect();
  $stmt = $conn->prepare('DELETE FROM hardware WHERE machineName = :machineName');

  $machineName = $_POST['delete_machine'];
  $stmt->bindParam(':machineName',$machineName);
  $stmt->execute();
  header("Location: ../myforge.php");
  exit();
}
else{
  die("ERROR");
}
?>
