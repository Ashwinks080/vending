<?php

@include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>
   body{
      background-color:#66347f
   }

   table{
      background : #E3DFFD;
      border-radius: 25px;
      width:10%;
   }
  button{
   width: 25px;
    height: 25px;
    font-size: 16px;
    color: #fff;
    background-color: #66347f;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    margin-left: 5px; /* add some space to the left of the button */
    margin-right: 5px; /* add some space to the right of the button */
  }

  button:hover {
    background-color: #555;
}

button:active {
    background-color: #777;
}

span{
   display: inline-block; /* make the span a block element */
    padding-left: 10px; /* add some padding to the left of the span */
    padding-right: 10px; /* add some padding to the right of the span */
}
@media only screen and (max-width: 480px) {
    /* styles for screens with a maximum width of 480px (e.g. mobile devices) */
    button {
        width: 20px;
        height: 20px;
        font-size: 12px;
    }

    span {
        padding: 0 5px;
    }
}

</style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading"> Cart</h1>

   <table>

      <thead>
         <!-- <th>image</th> -->
         <!-- <th>code</th> -->
         <!-- <th>name</th>
         <th>Price</th>
         <th>Quantity</th>
         <th>price</th> -->
         <!-- <th>Action</th> -->
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td class="hoi"><img class="food-img" src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100"alt="">
            <br>
            <!-- <td><?php echo number_format($fetch_cart['code']); ?></td> -->
            <?php echo $fetch_cart['name']; ?>
            <br>
            ₹<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
    <form action="" method="post">
        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
        <button type="submit" name="update_quantity" value="<?php echo $fetch_cart['quantity']-1; ?>"> - </button>
        <span><?php echo $fetch_cart['quantity']; ?></span>
        <button type="submit" name="update_quantity" value="<?php echo $fetch_cart['quantity']+1; ?>"> + </button>
        <input type="hidden" name="update_update_btn">
    </form>
</td>
            <td>₹<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>"class="delete-btn">remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td style="border-radius:25px"><a href="checkout.php" class="option-btn" style="margin-top: 0;">checkout</a></td>
            
            <td style="text-align:center">Grand Total: ₹<?php echo $grand_total; ?>/-</td>
            <td></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="products.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Continue Shopping</a>
      <a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a>
      <!-- <a href="products.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Add more items</a> -->
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>