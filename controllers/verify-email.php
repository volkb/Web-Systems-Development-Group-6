<?php
require_once 'functions.php';
require_once 'db_connector.php';
function checkVerify(){
    if (isset($_COOKIE['FORGE-SESSION'])) {
        $sessionID = $_COOKIE['FORGE-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $rin = $conn->prepare("SELECT UserID FROM sessions WHERE sessionID = :sessionID");
        $rin->bindParam(':sessionID', $sessionID);
        $rin->execute();
        $rin_result = $rin->fetchColumn();

        //check to see if the user is already verified
        $verified = $conn->prepare("SELECT verified FROM users WHERE rin = :rin");
        $verified->bindParam(':rin', $rin_result);
        $verified->execute();
        $verified_result = $verified->fetchColumn();

        //if user is already verified, return 1 else update column in DB
        if ($verified_result == 1) {
            return 1;
        } else {
            $update = $conn->prepare("UPDATE users SET verified= 1 WHERE rin = :rin");
            $update->bindParam(':rin', $rin_result);
            $update->execute();
            return 0;
        }
    }
}
?>