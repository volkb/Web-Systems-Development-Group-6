<?php
include_once "db_connector.php";

function getRCSID(){
    if(isset($_COOKIE['FORGE-SESSION'])){
        $sessionID = $_COOKIE['FORGE-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $rin = $conn->prepare("SELECT UserID FROM sessions WHERE sessionID = :sessionID");
        $rin->bindParam(':sessionID',$sessionID);
        $rin->execute();
        $rin_result = $rin->fetchColumn();

        //use RIN to get RCSID
        $result = $conn->prepare("SELECT rcsID FROM users WHERE rin = :rin");
        $result->bindParam(':rin',$rin_result);
        $result->execute();
        $ret_result = $result->fetchColumn();

        //return value
        return $ret_result;
    }else{
        return 404;
    }
}

function getName(){
    if(isset($_COOKIE['FORGE-SESSION'])){
        $sessionID = $_COOKIE['FORGE-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $rin = $conn->prepare("SELECT UserID FROM sessions WHERE sessionID = :sessionID");
        $rin->bindParam(':sessionID',$sessionID);
        $rin->execute();
        $rin_result = $rin->fetchColumn();

        //use RIN to get firstName
        $result = $conn->prepare("SELECT firstName FROM users WHERE rin = :rin");
        $result->bindParam(':rin',$rin_result);
        $result->execute();
        $ret_result = $result->fetchColumn();

        //return value
        //var_dump($ret_result);
        return $ret_result;
    }else{
        return 404;
    }
}

function getlastName(){
    if(isset($_COOKIE['FORGE-SESSION'])){
        $sessionID = $_COOKIE['FORGE-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $rin = $conn->prepare("SELECT UserID FROM sessions WHERE sessionID = :sessionID");
        $rin->bindParam(':sessionID',$sessionID);
        $rin->execute();
        $rin_result = $rin->fetchColumn();

        //use RIN to get firstName
        $result = $conn->prepare("SELECT lastName FROM users WHERE rin = :rin");
        $result->bindParam(':rin',$rin_result);
        $result->execute();
        $ret_result = $result->fetchColumn();

        //return value
        //var_dump($ret_result);
        return $ret_result;
    }else{
        return 404;
    }
}

function getEmail(){
    if(isset($_COOKIE['FORGE-SESSION'])){
        $sessionID = $_COOKIE['FORGE-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $rin = $conn->prepare("SELECT UserID FROM sessions WHERE sessionID = :sessionID");
        $rin->bindParam(':sessionID',$sessionID);
        $rin->execute();
        $rin_result = $rin->fetchColumn();

        //use RIN to get Email
        $result = $conn->prepare("SELECT email FROM users WHERE rin = :rin");
        $result->bindParam(':rin',$rin_result);
        $result->execute();
        $ret_result = $result->fetchColumn();

        //return value
        return $ret_result;
    }else{
        return 404;
    }
}

function getPerms(){
    if(isset($_COOKIE['FORGE-SESSION'])){
        $sessionID = $_COOKIE['FORGE-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $rin = $conn->prepare("SELECT UserID FROM sessions WHERE sessionID = :sessionID");
        $rin->bindParam(':sessionID',$sessionID);
        $rin->execute();
        $rin_result = $rin->fetchColumn();

        //use RIN to get Perms (Type)
        $result = $conn->prepare("SELECT type FROM users WHERE rin = :rin");
        $result->bindParam(':rin',$rin_result);
        $result->execute();
        $ret_result = $result->fetchColumn();

        //return value
        return $ret_result;
    }else{
        return 404;
    }
}

function getUses(){
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
        $ret_result = $result->fetchColumn();

        //return value
        return $ret_result;
    }else{
        return 404;
    }
}

function emailMachine($machine){
    //grab the Rin of that Machine
    $conn = dbConnect();
    $numUses = $conn->prepare("SELECT userID FROM projects WHERE machine = :machine");
    $stmt->bindParam(':machine',$machine);
    $numUses->execute();
    $rin_ret = $numUses->fetchColumn();

    //grab the email from that RIN
    $conn = dbConnect();
    $numUses = $conn->prepare("SELECT email FROM users WHERE rin = :rin");
    $stmt->bindParam(':rin',$rin_ret);
    $numUses->execute();
    //now we have the email
    $email_ret = $numUses->fetchColumn();
    return $email_ret;
}

function generateMachineDropDown($inUse){
    $connection = dbconnect();
    $stmt = $connection->prepare('SELECT machineName FROM hardware WHERE inUse = :inUse AND status = 1');
    $stmt->bindParam(':inUse',$inUse);
    $stmt->execute();
    $machines = $stmt->fetchall();
    foreach($machines as $machine){
        $item = "<option value=" . "\"" . $machine["machineName"] . "\"" . ">";
        $item .= $machine["machineName"];
        $item .= "</option>";
        echo $item;
    }
}

function generateTotalMachineDropDown(){
    $connection = dbconnect();
    $stmt = $connection->prepare('SELECT machineName FROM hardware WHERE 1');
    $stmt->execute();
    $machines = $stmt->fetchall();
    foreach($machines as $machine){
        $item = "<option value=" . "\"" . $machine["machineName"] . "\"" . ">";
        $item .= $machine["machineName"];
        $item .= "</option>";
        echo $item;
    }
}

function get_client_ip_server() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

function write_log(&$reportName){
    $createDate = date('m-d-Y');
    $timeStamp = date('m-d-Y__H_i_s');
    $path = "logs/$createDate.log";
    if(file_exists($path)) {
        $fp = fopen($path, "a+");
    }else{
        $fp = fopen($path, "a+");
        chmod($path,0770);

    }
    $ip = get_client_ip_server();
    $author = getName();
    $author .= getlastName();
    $txt = "[$timeStamp][$ip]$author Generated $reportName Report\n";
    fwrite($fp, $txt);
    fclose($fp);
    return;
}
?>
