<?php
if(isset($_GET['alert'])) {
  $alert = $_GET['alert'];
  echo "<script>alert('$alert');</script>";
}

$newPageUrl = "https://snack-attack.xyz/failure.php";

// Set the number of seconds after which the page should refresh


// Set the headers to redirect to the new page after the timeout
$startTime = time();

include 'config.php';
 function ret_data(){
  $url = "https://api.thingspeak.com/channels/2136501/fields/1.json?api_key=A7HCLVKGSGSU0OEC&results=1";
  // Make the API request
  $data = file_get_contents($url);
     // Decode the JSON response
  $response = json_decode($data);
  
   $req_field = $response->feeds[0]->field1;
  return $req_field;
 }

 $init = ret_data();
 while ($init == 0 && time() - $startTime < 30) {
  sleep(2); // Wait for 5 seconds before fetching data again
  $init = ret_data();
 }


if ($init == 0) {
    $delete = "DELETE FROM `payment`"; 
  $snake = mysqli_query($conn,$delete);
  header("Location: $newPageUrl");
  exit(); // Make sure to exit the script after the redirect
}




$sql = "SELECT * FROM `payment` WHERE 1";
$check = mysqli_query($conn,$sql);
if(mysqli_num_rows($check)>0){
  while($row = mysqli_fetch_assoc($check)){
    $amount_check = $row['amount'];
    
  }
}

if($amount_check == $init){
  $delete = "DELETE FROM `payment`"; 
  $snake = mysqli_query($conn,$delete);
 header('location:success.php');
 exit();
}else{
  
  header('location:failure.php');
  exit();
}
?>