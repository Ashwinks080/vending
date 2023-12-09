<?php
session_start();
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

require "vendor/autoload.php";

$success = true;
$keyId = "rzp_test_obDjejeSyxsNUV" ;
$keySecret = "VY2PQ7z8bD8jx7W3uLIqhTjQ";
$error = "Payment Failed"; 

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    include_once 'curlget.php';
  
    $html = "<p class='paysuctest'> Payment is Successful</p>
             <p class='paysuctest1'>Payment ID: {$_POST['razorpay_payment_id']}</p>";
              header( "refresh:5;url=index.php" );
}           
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
             header( "refresh:5;url=index.php" );
 }

echo $html;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title></title>
    <style>
        body{
            background-color: #66347f;
        }
.button-holder {
    text-align: center;
}
        .razorpay-payment-button {
  
  background-color: #FFFFFF;
  border: 1px solid #222222;
  border-radius: 8px;
  box-sizing: border-box;
  color: #222222;
  cursor: pointer;
  display: inline-block;
  font-family: Circular,-apple-system,BlinkMacSystemFont,Roboto,"Helvetica Neue",sans-serif;
  font-size: 16px;
  font-weight: 600;
  line-height: 20px;
  margin: 0;
  outline: none;
  padding: 13px 23px;
  position: relative;
  text-align: center;
  text-decoration: none;
  touch-action: manipulation;
  transition: box-shadow .2s,-ms-transform .1s,-webkit-transform .1s,transform .1s;
  user-select: none;
  -webkit-user-select: none;
  width: auto;
}

.razorpay-payment-button:focus-visible {
  box-shadow: #222222 0 0 0 2px, rgba(255, 255, 255, 0.8) 0 0 0 4px;
  transition: box-shadow .2s;
}

.razorpay-payment-button:active {
  background-color: #F7F7F7;
  border-color: #000000;
  transform: scale(.96);
}

.razorpay-payment-button:disabled {
  border-color: #DDDDDD;
  color: #DDDDDD;
  cursor: not-allowed;
  opacity: 1;
}
    </style>
</head>
<body>
<h1 class= "paysuctest2">Item has been dropped successfully </h1>
<h1 class= "paysuctest2">Please pick up your Product!</h1>
<h3></h3>
<div class="button-holder">
<button
    onclick="window.location.href ='index.php'"
        type="button"
        class="razorpay-payment-button">
        Back to Home
    </button>
</div>

</body>
</html>