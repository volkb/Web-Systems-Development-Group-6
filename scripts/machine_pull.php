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

//set all recieved string literals to bool ints and insert into packet for db
$insert_packet= [];
array_push($insert_packet,$ip);
foreach ($parsed_res['state']['flags'] as $flag){
  $flag = json_encode($flag);
  if($flag == "false"){
    array_push($insert_packet,0);
  }elseif ($flag == "true"){
    array_push($insert_packet,1);
  }else{
    array_push($insert_packet,-1);
  }
}

foreach ($parsed_res['temperature']['bed'] as $flag){
  $flag = json_encode($flag);
  $float_flag = (float) $flag;
 array_push($insert_packet,$float_flag);
}

foreach ($parsed_res['temperature']['tool0'] as $flag){
  $flag = json_encode($flag);
  $float_flag = (float) $flag;
  array_push($insert_packet,$float_flag);
}

for($i=0;$i<18;++$i){
  echo $insert_packet[$i];
  echo "\n";
}

//insert into db
$conn = dbConnect();
$stmt = $conn->prepare('INSERT INTO octoprint_metrics (	ip, cancelling, closedOrError, error, finishing, operational, paused, pausing, printing, ready, resuming, sd_ready, bed_temp_actual, bed_temp_offset, bed_temp_target, tool_temp_actual, tool_temp_offset, tool_temp_target) VALUES (:ip, :cancelling, :closedOrError, :error, :finishing, :operational, :paused, :pausing, :printing, :ready, :resuming, :sd_ready, :bed_temp_actual, :bed_temp_offset, :bed_temp_target, :tool_temp_actual, :tool_temp_offset, :tool_temp_target)');
$stmt->bindParam(':ip',$insert_packet[0]);
$stmt->bindParam(':cancelling',$insert_packet[1]);
$stmt->bindParam(':closedOrError',$insert_packet[2]);
$stmt->bindParam(':error',$insert_packet[3]);
$stmt->bindParam(':finishing',$insert_packet[4]);
$stmt->bindParam(':operational',$insert_packet[5]);
$stmt->bindParam(':paused',$insert_packet[6]);
$stmt->bindParam(':pausing',$insert_packet[7]);
$stmt->bindParam(':printing',$insert_packet[8]);
$stmt->bindParam(':ready',$insert_packet[9]);
$stmt->bindParam(':resuming',$insert_packet[10]);
$stmt->bindParam(':sd_ready',$insert_packet[11]);
$stmt->bindParam(':bed_temp_actual',$insert_packet[12]);
$stmt->bindParam(':bed_temp_offset',$insert_packet[13]);
$stmt->bindParam(':bed_temp_target',$insert_packet[14]);
$stmt->bindParam(':tool_temp_actual',$insert_packet[15]);
$stmt->bindParam(':tool_temp_offset',$insert_packet[16]);
$stmt->bindParam(':tool_temp_target',$insert_packet[17]);
$stmt->execute();

exit();
?>
