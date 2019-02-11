<?php
include_once "db_connector.php";
include_once 'verify-email.php';
$conn = dbConnect();
if(isset($_POST['rcsID']) && isset($_POST['password'])){
  //User Information
  $rcsID = $_POST['rcsID'];
  $user_pass = $_POST['password'];
  $stmt = $conn->prepare('SELECT * FROM users WHERE rcsID=:user');
  $stmt->bindParam(':user',$rcsID);
  $stmt->execute();
  $user = $stmt->fetch();
  if(!$user){
    echo "<script>
    alert('Your rcsID or password is incorrect!');
    window.location.replace(\" ../login.php \");
    </script>";
  }else{
    if(password_verify($user_pass,$user['password'])){
      $stmt = $conn->prepare('INSERT INTO sessions (sessionID, userID,expiration)
      VALUES (:sessionID,:userID,:expiration)');
      //Unique sessionID
      $sessionID = uniqid('',true);
      $stmt->bindParam(':sessionID',$sessionID);
      $stmt->bindParam(':userID',$user['rin']);
      //Users can stay logged in for a day
      $expiration_date = date("Y-m-d H:i:s",time() + (24*60*60));
      $stmt->bindParam(':expiration',$expiration_date);
      $stmt->execute();
      //Makes a cookie and gives that to the user for future verification
      setcookie("FORGE-SESSION",$sessionID, time() + (24*60*60),'/');
          header("Location: verify_controller.php");
    }else{
      echo "<script>
      alert('Your rcsID or password is incorrect!');
      window.location.replace(\" ../login.php \");
      </script>";
    }
  }
}else{
    die("ERROR");
}

function callVerify(){

}
