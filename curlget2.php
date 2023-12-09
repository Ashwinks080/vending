<?php


function sendReequest($value1, $value2 , $value3) {
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
sendReequest(0,0,0);

?>


