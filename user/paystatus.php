


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
       <h1 style="color:#800000">Payhere Return Payment Status:</h1>
       <br><br><br>
        <center>
    
 

      <form method="post" action="processPay.php" >   
    <input type="hidden" name="merchant_id" value="1216379">    <!-- Replace your Merchant ID -->
  
    <!-- <input type="hidden" name="order_id" value="ItemNo12345"> -->
    <input type="hidden" name="status_code" value="2">
    <input type="hidden" name="p_type" value="card">
    <!-- <input type="text" name="payment_id" value="" hidden> -->

   
        <ul>
<button type="submit"name="paysuccess" value="submit" style="width:45% ;color: 	#006400 !important;
text-transform: uppercase;
background: #ffffff;
padding: 10px;
border: 4px solid 	#006400 !important;
border-radius: 6px;
display: inline-block;
transition: all 0.3s ease 0s;" ><b>Payment Success</b></button>

        </ul>
   

    
</form>

   
    
<br><br>
    <form method="post" action="processPay.php">   
  <input type="hidden" name="merchant_id" value="1216379">    <!-- Replace your Merchant ID -->

  <!-- <input type="hidden" name="order_id" value="ItemNo12345"> -->
  <input type="hidden" name="status_code" value="-2">
  <!-- <input type="text" name="payment_id" value="" hidden> -->
 
  
      <ul>
<button type="submit"  name="paysuccess" value="submit" style="width:45% ;color: 	#800000 !important;
text-transform: uppercase;
background: #ffffff;
padding: 10px;
border: 4px solid 	#800000 !important;
border-radius: 6px;
display: inline-block;
transition: all 0.3s ease 0s;"><b>Payment Failed</b></button>

      </ul>
 

  
</form>

   
 

</center>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
   <footer>
       <?php
       include("include/footer.php")
       ?>
   </footer>  
       
       <body>
           </html>