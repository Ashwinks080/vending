
<html>

<head>
	<title>UPI Gateway - Payment Test Demo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
	<div class="container p-5">
		<div class="row">
			<div class="col-md-7 mb-2">
				<?php
				@include 'config.php';
				include_once 'curlget2.php';
				$cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
				$price_total = 0;
				if(mysqli_num_rows($cart_query) > 0){
					while($product_item = mysqli_fetch_assoc($cart_query)){
						$product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
						$product_price = number_format($product_item['price'] * $product_item['quantity']);
						$price_total += $product_price;
						
					}};
				
				if (isset($_POST['payment'])) {
					$key = "1db79ef3-a97e-48b2-b34f-c817fc7ec487";	// Your Api Token https://merchant.upigateway.com/user/api_credentials
					$post_data = new stdClass();
					$post_data->key = $key;
					$post_data->client_txn_id = (string) rand(100000, 999999); // you can use this field to store order id;
					$post_data->amount = $_POST['txnAmount'];
					$post_data->p_info = "product_name";
					$post_data->customer_name = "ashwin";
					$post_data->customer_email = "xyz@gmail.com";
					$post_data->customer_mobile = "0000000000";
					$post_data->redirect_url = "https://redirect_page.php"; // automatically ?client_txn_id=xxxxxx&txn_id=xxxxx will be added on redirect_url
					$post_data->udf1 = "extradata";
					$post_data->udf2 = "extradata";
					$post_data->udf3 = "extradata";

					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'https://api.ekqr.in/api/create_order',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => json_encode($post_data),
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						),
					));
					$response = curl_exec($curl);
					curl_close($curl);

					$result = json_decode($response, true);
					if ($result['status'] == true) {
						echo '<script>location.href="' . $result['data']['payment_url'] . '"</script>';
						exit();
					}

					echo '<div class="alert alert-danger">' . $result['msg'] . '</div>';
				}
				?>
				<h2>CHECK AMOUNT AND PAY</h2>
				<hr>
				<form action="" method="post">
					<h4>Txn Amount (₹):</h4>
					<input type="text" name="txnAmount" value="<?php echo htmlspecialchars($price_total); ?>" class="form-control" placeholder="Enter Txn Amount" readonly><br>
					<input type="submit" name="payment" value="Payment" class="btn btn-primary">
				</form>
			</div>
		</div>

	</div>
</body>

</html>