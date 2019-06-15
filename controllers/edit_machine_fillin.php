<?php

include_once "db_connector.php";
if(isset($_POST['machine'])){

    //connect to database after they fill in RIN
    $conn = dbConnect();

    //retrieving rest of user data
    $name = $_POST['machine'];
    $stmt = $conn->prepare('SELECT * FROM hardware WHERE machineName=:name');
    $stmt->bindParam(':name',$name);
    $stmt->execute();
    $machine = $stmt->fetch();
    if(!$machine){
        echo "Machine doesn't exist";
    }
    else{
        echo $machine['inUse'].";";
        echo $machine['status'].";";
        echo $machine['usesPlastic'].";";
        echo $machine['multiple_extrusion'].";";
        echo $machine['num_extrusions'].";";
    }
}
else{
    echo "Did not select a machine";
}
?>
