<?php
include_once "db_connector.php";
include_once 'email_functions.php';

if(isset($_POST['rcsID']) && isset($_POST['password'])){
    if ($_POST['password'] != $_POST['password2']){
      echo "<script type='text/javascript'>alert('Passwords do not match!');</script>";
      exit();
    }
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $rin = $_POST['rin'];
    $rcsID = $_POST['rcsID'];
    $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $gender_clean= "";
    if(isset($_POST['gender'])){
        $gender_clean = strtolower($_POST['gender']);
    }
    $major = $_POST['major'];
    $major_clean = strtolower($major);


    $conn = dbConnect();
    //Checks to see if there are users in the database with the same rcsID
    $stmt = $conn->prepare('SELECT * FROM users WHERE rcsID = :rcsID');
    $stmt->bindParam(':rcsID',$rcsID);
    $stmt->execute();
    $duplicate_user = $stmt->fetch();
    if($duplicate_user){
      //Redirects the user to the create account page again and displays an error
      echo "<script type='text/javascript'>
                alert('That rcsID is unavailable!');
                window.location.replace(\" ../create_account.php \");
            </script>";
      exit();
    }
    $stmt = $conn->prepare('INSERT INTO users (FirstName,LastName,Email,RIN,rcsID,Password, type, gender, major, outstandingBalance,verified)
    VALUES (:firstname,:lastname,:email,:RIN,:rcsID,:Password, "user",:gender,:major,10,0)');
    $stmt->bindParam(':firstname',$first);
    $stmt->bindParam(':lastname',$last);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':RIN',$rin);
    $stmt->bindParam(':rcsID',$rcsID);
    $stmt->bindParam(':Password',$pass);
    $stmt->bindParam(':gender',$gender_clean);
    $stmt->bindParam(':major',$major_clean);
    $stmt->execute();
    sendConfirmation();
    header("Location: ../myforge.php");
    exit();
}else{
  die("ERROR");
}
?>
