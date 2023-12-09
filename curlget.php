<?php
 
 
@include 'config.php';
$query="SELECT  code,quantity FROM `cart`";
$result = mysqli_query($conn,$query);
 
$num= mysqli_num_rows($result);

$data = array();
if($num>0){
while($row =mysqli_fetch_assoc($result)){
   $data[]=$row;
  
}
}
 
 
// Initialize cURL
 
 
// Close the cURL session
function sendRequest($value1, $value2 , $value3) {
   // Set the URL for the Thingspeak API endpoint
   $url = "https://api.thingspeak.com/update?api_key=Z3NXE9SRZ9G3ET0Z&field1=" . $value1 . "&field2=" . $value2 ."&field3=" . $value3;
 
   // Initialize cURL
   $ch = curl_init();
 
   // Set the cURL options
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
   // Execute the cURL request
   $response = curl_exec($ch);
 
   // Close the cURL session
   curl_close($ch);
}

 
foreach ($data as $innerArray) {
  $value1 = $innerArray["code"];
  $value2 = $innerArray["quantity"];
  $value3 = $num;
  echo $value3;
  sendRequest($value1,$value2,$value3);
  sleep(15);
}


$delete = "DELETE FROM `cart`"; 
$snake = mysqli_query($conn,$delete);
?>


