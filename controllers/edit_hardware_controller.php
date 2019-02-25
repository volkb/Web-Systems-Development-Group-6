<?php
include_once "db_connector.php";
if(isset($_POST['machineName'])) {
    try {
        $conn = dbConnect();

// get the machine name
        $machine = $_POST['machineName'];

//grab backup for defaults
        $stmt = $conn->prepare('SELECT * FROM hardware where machineName = :machine LIMIT 1');
        $stmt->bindParam(':machine', $machine);
        $stmt->execute();
        $backup = $stmt->fetchAll();

//replace necessary fields assuring to default any unfilled values
        if (!isset($_POST['service'])) {
            $service = $backup['status'];
        } else if (!isset($_POST['Materials'])) {
            $materials = $backup['multiple_extrusion'];
        } else if (!isset($_POST['num_ext'])) {
            $num_extrusions = $backup['num_extrusions'];
        } else {
            $service = $_POST['service'];
            $materials = $_POST['Materials'];
            $num_extrusions = $_POST['num_ext'];
        }

        //bind parameters and execute
        $stmt = $conn->prepare('UPDATE hardware SET status = :statusSet, multiple_extrusion = :materials, num_extrusions = :num_ext WHERE machineName = :name');
        $stmt->bindParam(':statusSet', $service);
        $stmt->bindParam(':materials', $materials);
        $stmt->bindParam(':num_ext', $num_extrusions);
        $stmt->bindParam(':name', $machine);
        $stmt->execute();
    }catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    //redirect
    header("Location: ../myforge.php");
    exit();
}