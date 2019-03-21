<?php
function getPrettyDate($date){
  $newDate = DateTime::createFromFormat('Y-m-d H:i:s',$date);
  return $newDate->format('F j - h:i A');
  //return date_format($date,"h:i A \- j M Y");
}

function generateSpecificTable($class, $id){//given a user, generate a recent project table
    if(isset($_COOKIE['FORGE-SESSION'])){
        $sessionID = $_COOKIE['FORGE-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $rin = $conn->prepare("SELECT UserID FROM sessions WHERE sessionID = :sessionID");
        $rin->bindParam(':sessionID',$sessionID);
        $rin->execute();
        $rin_result = $rin->fetchColumn();

        //use RIN to get 10 most recent Projects in reverse chronological order
        $result = $conn->prepare("SELECT * FROM projects WHERE userID = :rin ORDER BY startTime DESC LIMIT 10");
        $result->bindParam(':rin',$rin_result);
        $result->execute();
        $ret_result = $result->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $ret_result = 404; //if no values are found, throw 404 exception
    }

    //parse output into table
    if($ret_result > 0 && $ret_result != 404){
        //instantiate table format
        echo "<table class=\"table\">";
            echo"<thead>";
                echo"<tr>";
                    echo"<th scope=\"col\">#</th>";
                    echo"<th scope=\"col\">Date</th>";
                    echo"<th scope=\"col\">Machine</th>";
                    echo"<th scope=\"col\">Plastic Info</th>";
                    echo"<th scope=\"col\">Cost</th>";
                echo"</tr>";
            echo"</thead>";
        echo "<tbody>";
        //parse return value for info and infill table
        $count = 1;
        foreach($ret_result as $row){
            //var_dump($row);
            echo"<tr>";
                //#
                echo"<th scope=\"row\">$count</th>";

                //Date
                echo"<td>";
                echo getPrettyDate($row['startTime']);
                echo"</td>";

                //Machine
                echo"<td>";
                echo $row['machine'];
                echo"</td>";

                //plasticInfo
                echo"<td>";
                $info = formatPlastic($row);
                echo $info;
                echo"</td>";

                //cost
                echo"<td>";
                echo "$";
                echo $row['payment'];
                echo"</td>";

            echo"</tr>"; //end the table row
            $count++; //bump the index
        }
        echo "</tbody>";
        echo "</table>";

    }else if ($ret_result == 404){
        echo "<div class=\"$class\" id=\"$id\"> <h3> Looks like you haven't started any projects yet, get innovating!</h3></div>";
        return;
    }

}

function formatPlastic($row){
    $hasPlastic = checkPlastic($row['machine']);
    if($hasPlastic == 1) {
        $ret_str = $row['plasticBrand']; //Makerbot
        $ret_str .= " "; //Makerbot
        $ret_str .= $row['plastic']; //Makerbot PLA
        $ret_str .= ", "; //Makerbot PLA,
        $ret_str .= $row['plasticColor']; //Makerbot PLA, Red
        $ret_str .= " - "; //Makerbot PLA, Red -
        $ret_str .= $row['amount']; //Makerbot PLA, Red - 300
        if($row['machine'] == "Form 1+"){
            $ret_str .= "mL"; //Makerbot PLA, Red - 300mL,
        }else {
            $ret_str .= "g"; //Makerbot PLA, Red - 300g,
        }
        $ret_str .= "."; //Makerbot PLA, Red - PLA, 300

    }else{
        $ret_str = "None";
    }
    return $ret_str;
}

function checkPlastic($equipment){
    //echo $equipment;
    $conn = dbConnect();
    //grab the UserID (RIN) from the Session Data
    $machines = $conn->prepare("SELECT * FROM hardware;");
    $machines->execute();
    $machine_array = $machines->fetchAll(PDO::FETCH_ASSOC);

    $usesPlastic = 0;
    foreach($machine_array as $row){//iterate through machines
        if($row['machineName'] == $equipment){//match the machines
            if($row['usesPlastic'] == 1){//check plastic use
                $usesPlastic = 1;
                return $usesPlastic;
            }
        }
    }
    return $usesPlastic;//return default value for error handling.
}

function generateTotalTable($class, $id){//given an admin user, generate a workspace OLAP Cube Framework
    //grab needed values from the Database

    //for user stats
    $num_volunteers = (int)getVolunteers();
    $num_members = (int)getMembers();
    $conversion_rate = ($num_volunteers / $num_members)*100;

    //for printers
    $num_prints = getPrintStats("prints");
    $popular_machines = getPrintStats("popMachines");
    $popular_colors = getPrintStats("popColors");
    $total_grams = getPrintStats("grams");


    //instantiate table format
    echo"<table class=\"table\">";
        echo"<thead>";
            echo"<tr>";
                echo"<th scope=\"col\">Statistic</th>";
                echo"<th scope=\"col\">Data</th>";
            echo"</tr>";
        echo"</thead>";

    //num_members
    echo "<tbody>";
        echo"<tr>";
            echo"<th scope=\"row\">Members:</th>";
            echo"<td>";
            echo $num_members;
            echo"</td>";
        echo"</tr>";
    echo "</tbody>";

    //num_volunteers
    echo "<tbody>";
        echo"<tr>";
            echo"<th scope=\"row\">Volunteers:</th>";
            echo"<td>";
            echo $num_volunteers;
            echo"</td>";
        echo"</tr>";
    echo "</tbody>";

    //Volunteer_conversion Rate
    echo "<tbody>";
        echo"<tr>";
            echo"<th scope=\"row\">Volunteer Conversion Rate:</th>";
            echo"<td>";
            echo $conversion_rate;
            echo"%";
            echo"</td>";
        echo"</tr>";
    echo "</tbody>";

    //num_prints
    echo "<tbody>";
        echo"<tr>";
            echo"<th scope=\"row\">Total Prints:</th>";
            echo"<td>";
            echo $num_prints;
            echo"</td>";
        echo"</tr>";
    echo "</tbody>";

    //Total Grams
    echo "<tbody>";
        echo"<tr>";
            echo"<th scope=\"row\">Plastic Volume Sold:</th>";
            echo"<td>";
            echo $total_grams;
            echo"g/mL";
            echo"</td>";
        echo"</tr>";
    echo "</tbody>";

    //Top 5 Machines
    echo "<tbody>";
        echo"<tr>";
            echo"<th scope=\"row\">Top 5 Machines:</th>";
            echo"<td>";
            $p_mach = stringify($popular_machines,"machines");
            echo $p_mach;
            echo"</td>";
        echo"</tr>";
    echo "</tbody>";

    //Top 5 Machines
    echo "<tbody>";
        echo"<tr>";
            echo"<th scope=\"row\">Top 5 Colors:</th>";
            echo"<td>";
            $p_col = stringify($popular_colors,"colors");
            echo $p_col;
            echo"</td>";
        echo"</tr>";
    echo "</tbody>";
  echo "</table>";
}

function getMembers(){
    $conn = dbConnect();
    $numUsers = $conn->prepare("SELECT COUNT(rin) FROM users");
    $numUsers->execute();
    $users_ret = $numUsers->fetchColumn();
    return $users_ret;
}

function getVolunteers(){
    $conn = dbConnect();
    $numVol = $conn->prepare("SELECT COUNT(rin) FROM users WHERE type = \"volunteer\" OR type = \"admin\" OR type = \"TA\"");
    $numVol->execute();
    $vol_ret = $numVol->fetchColumn();
    return $vol_ret;
}

function getPrintStats($action){
    if($action == "prints") {
        $conn = dbConnect();
        $numUses = $conn->prepare("SELECT COUNT(pid) FROM projects");
        $numUses->execute();
        $uses_ret = $numUses->fetchColumn();
        return $uses_ret;
    }else if($action == "grams"){
        $conn = dbConnect();
        $numGrams = $conn->prepare("SELECT SUM(amount) FROM projects");
        $numGrams->execute();
        $grams_ret = $numGrams->fetchColumn();
        return $grams_ret;
    }else if($action == "popMachines"){
        $conn = dbConnect();
        $popMachines = $conn->prepare("SELECT machine FROM projects GROUP BY machine ORDER BY pid DESC LIMIT 5");
        $popMachines->execute();
        $machines_ret = $popMachines->fetchAll();
        return $machines_ret;
    }else if($action == "popColors"){
        $conn = dbConnect();
        $popColors = $conn->prepare("SELECT `plasticColor` FROM `projects` GROUP BY `plasticColor` ORDER BY COUNT(`plasticColor`) DESC LIMIT 5;");
        $popColors->execute();
        $colors_ret = $popColors->fetchAll();
        return $colors_ret;
    }
    return 404;
}

function stringify($array,$type){
    $ret_str = "";
    $numItems = count($array);
    $count = 1;
    foreach($array as $val){
        if($type == "machines") {
            $ret_str .= $val['machine'];
        }else if($type == "colors"){
            $ret_str .= $val['plasticColor'];
        }
        if($count != $numItems) {
            $ret_str .= ", ";
        }
        $count++;
    }
    return $ret_str;
}
?>
