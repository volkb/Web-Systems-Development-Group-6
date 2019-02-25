<?php

include_once "db_connector.php";
if(isset($_POST['machine'])){

    //connect to database after they fill in RIN
    $conn = dbConnect();

    //retrieving rest of user data
    $m_name = $_POST['machine'];
    $stmt = $conn->prepare('SELECT * FROM hardware WHERE machineName=:name');
    $stmt->bindParam(':name',$m_name);
    $stmt->execute();
    $user = $stmt->fetch();
    if(!$user){
        echo "Machine doesn't exist";
    }
    else{
        echo $user['status'].";";
        echo $user['usesPlastic'].";";
        echo $user['multiple_extrusion'].";";
        echo $user['num_extrusions'].";";
    }
}
else{
    echo "Did not select a machine";
}
?>
