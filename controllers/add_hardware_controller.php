<?php
include_once "db_connector.php";
if(isset($_POST['machineName'])){
    $machineName = $_POST['addMachineName'];
    $type = $_POST['usesPlastic'];
    $machine_materials = $_POST['addMaterials'];
    if($machine_materials == "null" || !isset($_POST['addMaterials'])){
        $machine_materials = 0;
    }
    $extrusions = $_POST['add_num_ext'];
    if($type == '0'){
        $extrusions = 0;
    }
    if($extrusions == '1' && $machine_materials == '1'){
        //Redirects the user to the machine page again and displays an error
        echo "<script type='text/javascript'>
                alert('\"Multiple Extrusion Status\" Means More Than 1 filament or extruder is being used, you selected 1, please correct your error.');
                window.location.replace(\" ../edit_machine.php\");
            </script>";
        exit();
    }


    $conn = dbConnect();
    //Checks to see if there are users in the database with the same rcsID
    $stmt = $conn->prepare('SELECT * FROM hardware WHERE machineName = :m_name');
    $stmt->bindParam(':m_name',$machineName);
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
    $stmt->bindParam(':usesPlastic',$type);
    $stmt->bindParam(':mult_ext',$machine_materials);
    $stmt->bindParam(':num_ext',$extrusions);
    $stmt->execute();
   header("Location: ../myforge.php");
    exit();
}else{
    die("ERROR");
}
?>
