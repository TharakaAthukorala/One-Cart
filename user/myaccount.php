<?php
session_start();
?>

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
    <center>
    <div class="container">
      <form method="post" action="include/updateuser.php">

        <div class="row" style="width:85%">
      
            
            <label for="fname"> Full Name</label>
            <input type="text" id="username" name="username" placeholder="Saman Perera" required>
            <label for="email"> Email</label>
            <input type="text" id="email" name="email" placeholder="abc@example.com" required>
            <label for="adr"> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
            <label for="city"> City</label>
            <input type="text" id="city" name="city" placeholder="Colombo" required>
            <label for="city"> Postal Code</label>
            <input type="text" id="code" name="code" placeholder="12100" required>
            <label for="city"> <P>Phone Number </P></label>
            <input type="text" id="phone" name="phone" placeholder="*********" required>
          
            <label for="password" >Old Password</label>
            <input type="password" id="password1" name="password1"style="width:20%" placeholder="*************" required>
            <label for="password">New Password</label>
            <input type="password" id="password2" name="password2"style="width:20%" placeholder="*************" required>
            <label for="password">Confirm Password</label>
            <input type="password" id="password3" name="password3" style="width:20%" placeholder="*************" required>
            <h3>(If you don't want to change the password, type your recent password in these 3 columns)</h3>


</center>

</div>
<br><br>
<center>
<button type="submit" name="update_user" class="signupbtn" style="width:45% ;color: 	#006400 !important;
text-transform: uppercase;
background: #ffffff;
padding: 10px;
border: 4px solid 	#006400 !important;
border-radius: 6px;
display: inline-block;
transition: all 0.3s ease 0s;">Update</button>
</center>
      <!-- <button type="submit" name="cancel_update" class="signupbtn" style="width:45% ;color: #800000 !important;
text-transform: uppercase;
background: #ffffff;
padding: 10px;
border: 4px solid	#800000!important;
border-radius: 6px;
display: inline-block;
transition: all 0.3s ease 0s;">Cancel</button> -->
</form>
</div>


</body>
<br>
<footer><?php
include("include/footer.php");
?></footer>
</html>