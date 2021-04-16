
<?php include ('authentication.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="login.css">
      <title>One Cart Shopping</title>

  </head>
  <body>
  <center>
    <div class="leftcontainer">
       <img src="images/white.png" alt="">
        <h1>One Cart Online Shopping</h1>
        <h2>Dear Customer,</h2>
        <h3>Log into your account for quick shopping...</h3>
        <h3>We save your time... </h3>
        <h1>HAPPY SHOPPING DAY!!</h1></center>

    </div>
      <div class="container1">
      <div class="header">
      <center><h2>Log In </h2></center>
      </div>
      <center>
      <form action="login.php" method="post">

      <div class="fields">

      <input type="text" name="email" placeholder="Your Email" required></div>

      <div class="fields">

      <input type="password" name="password_1" placeholder="Your Password" required></div>

      <button type="submit" name="login_user">Log in</button>

      <p>Not Registered?<a href="index.php" style="color:yellow;"><b>Register Here </b></a></p>

      <p>Forgot password?<a href="forget_password.php" style="color:yellow;"><b>Forget password</b></a></p></center>
      </form>
</center>
      </div>
  </body>

  </html>
