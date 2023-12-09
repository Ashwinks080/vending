<?php
session_start();
@include 'config.php';
include_once 'curlget2.php';

// if(isset($_POST['order_btn'])){

   //$name = $_POST['name'];
   //$number = $_POST['number'];
   //$email = $_POST['email'];
   //$method = $_POST['method'];
   //$flat = $_POST['flat'];
   //$street = $_POST['street'];
  // $city = $_POST['city'];
   //$state = $_POST['state'];
   //$country = $_POST['country'];
   //$pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
         
      };

      $_SESSION['amount'] = $price_total;
      $variableToSend = $price_total;
      echo '<a href="receiver.php?data=' . urlencode($variableToSend) . '">Go to Receiver</a>';



   // };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(total_products, total_price) VALUES('$total_product','$price_total')") or die('query failed');

   if($cart_query ){
         $payment_query = mysqli_query($conn, "INSERT INTO `payment` (amount) VALUES ('$price_total')") or die('query failed');
      echo '<a href="index1.php?var=' . urlencode($price_total) . '">Go to script 2</a>';
     
      if($payment_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : ₹".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
           
             
           
         </div>
            <a href='index1.php' class='btn'>Continue for payment</a>
            <a href='products.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   
}
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>
   body{
      background-color:#66347f;
   }
</style>
</head>
<body>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>