<?php


function sendReeequest($value1) {
   // Set the URL for the Thingspeak API endpoint
   $url = "https://api.thingspeak.com/update?api_key=I7EPR2LE62CBIF3A&field1=" . $value1;
 
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


?>
