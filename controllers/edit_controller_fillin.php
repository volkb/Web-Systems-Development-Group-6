<?php

include_once "db_connector.php";
if(isset($_POST['rin'])){

    //connect to database after they fill in RIN
    $conn = dbConnect();

    //retrieving rest of user data
    $rin = $_POST['rin'];
    $stmt = $conn->prepare('SELECT * FROM users WHERE rin=:user');
    $stmt->bindParam(':user',$rin);
    $stmt->execute();
    $user = $stmt->fetch();
    if(!$user){
        echo "RIN doesn't exist";
    }
    else{
        echo $user['rcsID'].".%.";
        echo $user['firstName'].".%.";
        echo $user['lastName'].".%.";
        echo $user['email'].".%.";
        echo $user['type'].".%.";
    }
}
else{
    echo "Did not fill in a RIN";
}


?>
