


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Cart Shopping</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@600&display=swap" rel="stylesheet">


</head>
<body>

    <?php 
        include("include/userfunction.php");
        include("include/header.php");
        include("include/navbar1.php");
       ?>
       <div class="row">
  <div class="col-75">
    <div class="container">
     
      <form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
    <input type="hidden" name="merchant_id" value="1216379">    <!-- Replace your Merchant ID -->
    <input type="hidden" name="return_url" value="http://localhost/new folder/onecartfinal/user/paystatus.php">
    <input type="hidden" name="cancel_url" value="http://localhost/new folder/onecartfinal/user/paystatus.php">
    <input type="hidden" name="notify_url" value="http://localhost/new folder/onecartfinal/user/include/paymentgateway.php">  
    <br><br>Order Details<br>
    <input type="hidden" name="order_id" value="ItemNo12345">
    <input type="hidden" name="items" value="Amount"><br>
    <input type="text" name="currency" value="LKR">
    <input type="text" name="amount" value="<?php echo getNetTotal(); ?>">  
    <br><br>Customer Details<br>
    <input type="text" name="first_name" placeholder="Saman" required>
    <input type="text" name="last_name" placeholder="Perera" required><br>
    <input type="hidden" name="email" placeholder="samanp@gmail.com">
    <input type="hidden" name="phone" placeholder="0771234567"><br>
    <input type="hidden" name="address" value="No.1, Galle Road">
    <input type="hidden" name="city" value="Colombo">
    <input type="hidden" name="country" value="Sri Lanka"><br><br> 
    <!-- <input type="hidden" name="status_code" value="">
    <input type="hidden" name="md5sig" value=""> -->
    <input name="submitpayment" type="image" src="https://www.payhere.lk/downloads/images/pay_with_payhere.png" style="width:200px;" value="Buy Now"">   
</form> 

    </div>
   
  </div>

 
</div>

              


       </form>
       <footer><?php
       include("include/footer.php");
       ?></footer>
       <body>
           </html>