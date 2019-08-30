<?php
//import db_connector
include_once "../controllers/db_connector.php";

//curl octoprint API for into payload
$curl = curl_init();
$url = "http://129.161.152.150/api/printer";
$headers = array();
$headers[] = 'X-Api-Key: B212B3897BBF4AC9B510FED41E9E7FCB';
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

//decode recieved JSON into string literal
$parsed_res = json_decode($result,true);

//set ip of machine to a variable
$ip = "129.161.152.150";

//set all recieved string literals to bool ints
$flag_bools= [];
foreach ($parsed_res['state']['flags'] as $flag){
  $flag = json_encode($flag);
  if($flag == "false"){
    array_push($flag_bools,0);
  }elseif ($flag == "true"){
    array_push($flag_bools,1);
  }else{
    array_push($flag_bools,-1);
  }
}
//format insert packet for database
for($i = 0; $i<11; ++$i){
  //echo $flag_bools[$i];
}

//insert into db
$conn = dbConnect();
?>
