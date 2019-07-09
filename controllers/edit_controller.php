<?php

include_once "db_connector.php";
if(isset($_POST['rcsID']) && isset($_POST['rin'])){

  /**
   * if password doesn't need to be changed
   */
  $conn = dbConnect();
  $backup_rin = $_POST['rin'];
  $stmt = $conn->prepare('SELECT * FROM users WHERE rin = :rin LIMIT 1');
  $stmt->bindParam(':rin',$backup_rin);
  $stmt->execute();
  $backup = $stmt->fetch();

  if(!(isset($_POST['password']))){
    $conn = dbConnect();
    // get the rin
    $rin = $_POST['rin'];
    //update query
    $stmt = $conn->prepare('UPDATE users SET rcsID = :rcsID, firstName = :firstname, lastName = :lastname, email = :email WHERE rin = :rin');

    //replace necessary fields
    //for first name
    if(isset($_POST['first']) && $_POST['first'] != ''){
      $first = $_POST['first'];
    }else{
      $first = $backup['firstName'];
    }

    //for last name
    if(isset($_POST['last']) && $_POST['last'] != ''){
      $last = $_POST['last'];
    }else{
      $last = $backup['lastName'];
    }

    //for email
    if(isset($_POST['email']) && $_POST['email'] != ''){
      $email = $_POST['email'];
    }else{
      $email = $backup['email'];
    }

    //for rin
    if(isset($_POST['rin']) && $_POST['rin'] != ''){
      $rin = $_POST['rin'];
    }else{
      $rin = $backup['rin'];
    }

    //for rcsID
    if(isset($_POST['rcsID']) && $_POST['rcsID'] != ''){
      $rcsID = $_POST['rcsID'];
    }else{
      $rcsID = $backup['rcsID'];
    }

    //bind the params to the query
    $stmt->bindParam(':firstname',$first);
    $stmt->bindParam(':lastname',$last);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':rin',$rin);
    $stmt->bindParam(':rcsID',$rcsID);
    $stmt->execute();
    exit();
  }
  /**
   * if password needs to be changed
   */
  else{
    $conn = dbConnect();
    // get the rin
    $rin = $_POST['rin'];
    //update query
    $stmt = $conn->prepare('UPDATE users SET rcsID = :rcsID, firstName = :firstname, lastName = :lastname, email = :email, password = :password, type = :type WHERE rin = :rin');

    //replace necessary fields
    //for first name
    if(isset($_POST['first']) && $_POST['first'] != ''){
      $first = $_POST['first'];
    }else{
      $first = $backup['firstName'];
    }

    //for last name
    if(isset($_POST['last']) && $_POST['last'] != ''){
      $last = $_POST['last'];
    }else{
      $last = $backup['lastName'];
    }

    //for email
    if(isset($_POST['email']) && $_POST['email'] != ''){
      $email = $_POST['email'];
    }else{
      $email = $backup['email'];
    }

    //for rin
    if(isset($_POST['rin']) && $_POST['rin'] != ''){
      $rin = $_POST['rin'];
    }else{
      $rin = $backup['rin'];
    }

    //for rcsID
    if(isset($_POST['rcsID']) && $_POST['rcsID'] != ''){
      $rcsID = $_POST['rcsID'];
    }else{
      $rcsID = $backup['rcsID'];
    }

    //for permissions
    if(isset($_POST['perms']) && $_POST['perms'] != ''){
      $perms = $_POST['perms'];
    }else{
      $perms = $backup['type'];
    }

    //for password
    if(isset($_POST['password']) && $_POST['password'] != ''){
      $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }else{
      $password = $backup['password'];
    }

    //assign params to query
    $stmt->bindParam(':firstname',$first);
    $stmt->bindParam(':lastname',$last);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':rin',$rin);
    $stmt->bindParam(':rcsID',$rcsID);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':type',$perms);
    $stmt->execute();
    header("Location: ../myforge.php");
    exit();
  }
}else{
  die("ERROR");
}
?>
