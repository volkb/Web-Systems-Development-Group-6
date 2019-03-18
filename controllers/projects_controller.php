<?php

include_once "db_connector.php";

//gets project information for projects not yet completed
$conn = dbConnect();
$stmt = $conn->prepare('SELECT * FROM projects');
$stmt->execute();
$result = $stmt->fetchAll();

if(!$result){
    echo "invalid";
}
else{
    echo json_encode($result, JSON_PRETTY_PRINT);
}


?>
