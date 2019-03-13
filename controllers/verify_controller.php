<?php
include_once 'verify-email.php';
$verified = checkVerify();
if($verified == 1){
    header("Location: ../index.php");
}else{
    header("Location: ../verify_email.html");
}
?>
