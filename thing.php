<?php



@include 'config.php';


    $url = "https://api.thingspeak.com/channels/2136501/fields/1.json?api_key=A7HCLVKGSGSU0OEC&results=1";

   
// Set the initial value of the variable to 0
$receivedValue = 0;

// Loop for 2 seconds or until a non-zero value is received

while ($receivedValue == 0) {
  // Fetch the value from the ThingSpeak server
  $value = file_get_contents($url);

  // Convert the value to a number
  $receivedValue = intval($value);

  // Wait for 1 second before checking again
  sleep(2);
}

// If a non-zero value was received, assign it to a new variable
if ($receivedValue != 0) {
  $nonZeroValue = $receivedValue;
  echo 1;
}
?>


<?php

  $sql = "SELECT * FROM `payment` WHERE 1";
$check = mysqli_query($conn,$sql);
if(mysqli_num_rows($check)>0){
  while($row = mysqli_fetch_assoc($check)){
    $amount_check = $row['amount'];

    echo $amount_check;
    
  }
}

// if($amount_check == $req_field){
//     $delete = "DELETE FROM `payment`"; 
//   $snake = mysqli_query($conn,$delete);
//   header('location:success.php');
//   
//   }else{
//   echo 0;
//   }
  

  ?>