

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
	<style>
        
		.container {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}
		.dot-windmill {
			position: relative;
			width: 10px;
			height: 10px;
			border-radius: 5px;
			background-color: #6f42c1;
			color: #6F42C1;
			transform-origin: 5px 15px;
			animation: dot-windmill 2s infinite linear;
			margin-left: 5px;
		}
		.dot-windmill::before,
		.dot-windmill::after {
			content: "";
			display: inline-block;
			position: absolute;
		}
		.dot-windmill::before {
			left: -8.66254px;
			top: 15px;
			width: 10px;
			height: 10px;
			border-radius: 5px;
			background-color: #6f42C1;
			color: #6f42C1;
		}
		.dot-windmill::after {
			left: 8.66254px;
			top: 15px;
			width: 10px;
			height: 10px;
			border-radius: 5px;
			background-color: #6f42C1;
			color: #6f42C1;
		}

		@keyframes dot-windmill {
			0% {
				transform: rotateZ(0deg) translate3d(0, 0, 0);
			}
			100% {
				transform: rotateZ(720deg) translate3d(0, 0, 0);
			}
		}

        h1{
            font-family: 'Lobster', cursive;
            color: #6f42c1;
        }
        body{
            background-color: #EEC9EE;
        }
	</style>
</head>
<body>
	<div class="container">
		<h1>PROCESSING YOUR PAYMENT</h1>
		<div class="dot-windmill"></div>
	</div>
	
<?php

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

</body>
</html>

