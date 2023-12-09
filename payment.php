<?php
session_start();
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
   



<style>
  
.button-86 {
  all: unset;
  width: 100px;
  height: 30px;
  font-size: 16px;
  background: transparent;
  border: none;
  position: relative;
  color: #f0f0f0;
  cursor: pointer;
  z-index: 1;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-86::after,
.button-86::before {
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  z-index: -99999;
  transition: all .4s;
}

.button-86::before {
  transform: translate(0%, 0%);
  width: 100%;
  height: 100%;
  background: #66347f;
  border-radius: 10px;
}

.button-86::after {
  transform: translate(10px, 10px);
  width: 35px;
  height: 35px;
  background: #ffffff15;
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  border-radius: 50px;
}

.button-86:hover::before {
  transform: translate(5%, 20%);
  width: 110%;
  height: 110%;
}

.button-86:hover::after {
  border-radius: 10px;
  transform: translate(0, 0);
  width: 100%;
  height: 100%;
}

.button-86:active::after {
  transition: 0s;
  transform: translate(0, 5%);
}

    body{
      text-align: center;
      font-family: 'Josefin Sans', sans-serif;
      font-weight:700px;
      background-color: #ECC9EE;
    }
    svg{
      width:200px;
    height:200px;
     justify-content: center; 
     align-items: center;
     padding-top: 50px;
  }

  h1{
    padding-top:60px;
    color:#66347f;
    font-size: 50px;
  }
  h3{
    font-size:30px;
  }

  .new-butt{
    padding-top: 20px;
    display: flex;
  justify-content: center;
  }


  </style>
</head>
<body>
  <h1>Complete your payment</h1>
<?php
$actual_amount = $_SESSION['amount'];

$formatted_amount = number_format($actual_amount, 2);
$name = "manoj";
$vpa = "manoj909";


// Initialize curl
$curl = curl_init();

// Set the URL for the request
curl_setopt($curl, CURLOPT_URL, "https://upiqr.in/api/qr?name=" . urlencode($name) . "&vpa=" . urlencode($vpa) . "&amount=" . $formatted_amount);



// Set the request method to GET
curl_setopt($curl, CURLOPT_HTTPGET, true);

// Execute the request
$response = curl_exec($curl);

// Check for errors
if(curl_error($curl)) {
    echo 'Error: ' . curl_error($curl);
}

// Close the curl session
curl_close($curl);

// Output the response


echo $response;



?>

<h3>Once payment done click on next button</h3>
<div class="new-butt">
<button class="button-86" role="button" type="button" onclick="showAlert()" >Next</button>
</div>

<script>
function showAlert() {
  alert("Payment processing please wait...");
  window.location.href = "verification.php";
}
</script>
</body>
</html> 