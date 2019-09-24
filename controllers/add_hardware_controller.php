<?php
include_once "db_connector.php";
require_once "admin_auth_controller.php";
if(isset($_POST['addName'])){
    $machineName = $_POST['addName'];
    $usesPlastic = $_POST['addPlastic'];
    $multiple_extrusion = $_POST['addExt'];
    $num_extrusions = $_POST['addNum_ext'];

    $conn = dbConnect();
    //Checks to see if there are users in the database with the same rcsID
    $stmt = $conn->prepare('SELECT * FROM hardware WHERE machineName = :machineName');
    $stmt->bindParam(':machineName',$machineName);
    $stmt->execute();
    $duplicate_machine = $stmt->fetch();
    if($duplicate_machine){
        //Redirects the user to the machine page again and displays an error
        echo "<script type='text/javascript'>
                alert('That Machine already exists. Consider using a naming scheme such as \"Prusa#3\"');
                window.location.replace(\" ../edit_machine.php\");
            </script>";
        exit();
    }
    $stmt = $conn->prepare('INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`, `multiple_extrusion`, `num_extrusions`)
      VALUES (0,1,:machineName,:usesPlastic,:mult_ext,:num_ext)');
    $stmt->bindParam(':machineName',$machineName);
    $stmt->bindParam(':usesPlastic',$usesPlastic);
    $stmt->bindParam(':mult_ext',$multiple_extrusion);
    $stmt->bindParam(':num_ext',$num_extrusions);
    $stmt->execute();
   header("Location: ../myforge.php");
    exit();
}else{
    die("ERROR");
}
?>
