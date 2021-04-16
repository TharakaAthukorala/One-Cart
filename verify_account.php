<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css">
    <title>Onecart verify account</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="shortcut icon" type="image/png" href="../images/favicon.png">

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
    <center><h2>Verify Your Account</h2></center>
    </div>
    <center>
          <form action="authentication.php" method="POST">              
              <p>
                Dear User, Kindly fill up your OTP code that you received by email<br>
                We will help you to verify your account ASAP.
              </p>
              <div class="fields">
              <input type="text" name="email" placeholder="Your Email" required>
              </div>
              
              <div class="fields">
              <i class="fas fa-key"></i>
              <input type="text" placeholder="OTP code" name="otp_code" id="code">
            </div>   
            <button type="submit" class="btn solid" name="check_code">Verify</button>
          </form>     
      </center>
    </div>
</body>
</html>

