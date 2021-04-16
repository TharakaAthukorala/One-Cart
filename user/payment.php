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
        require "include/userfunction.php";
        include("include/header.php");
        include("include/navbar1.php");
        // include("processPay.php");
    ?>
    <center>
<div class="payoption" style="width:70%; height:70%; color:#800000;">
<br><br>
 <h1>Select Payment Option</h1>
 <br><br>
    
        <button type="button"id="paybut"  name="cash"style="width:45% ;color: 	#006400 !important;
            text-transform: uppercase;
            background: #ffffff;
            padding: 10px;
            border: 4px solid 	#006400 !important;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.3s ease 0s;" ><a style="text-decoration:none;color: 	#006400 !important;" href="cash.php"> Cash on delivery</a> 
        </button>
        <br><br>
        <h2>OR</h2>
        <br><br>
</form><form method='post'>
        <button  type="button" id="paybut" name="card"style="width:45% ;color: 	#006400 !important;
text-transform: uppercase;
background: #ffffff;
padding: 10px;
border: 4px solid 	#006400 !important;
border-radius: 6px;
display: inline-block;
transition: all 0.3s ease 0s;" ><a style="text-decoration:none;color: 	#006400 !important;" href="onlinepay.php">Card Payment</a> </button>

<br><br>

<img src="../images/visamaster.jfif" alt="">
</form>

</center>
  
</div>
<br><br>
<footer>
    
    <?php 
      include("include/footer.php");
     ?>
      </footer>
     
</body>
 
</html>