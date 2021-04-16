<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Forget Password</title>
        <link href="login.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        
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
    <center><h2>Forget Password</h2></center>
    </div>

    <center>
        <form action='forget_password.php' method='POST'>
            <p>Enter email here that you used on your account.<br/> We send link on your email to reset your password.</p>

            <div class="fields">
            <input type="text" name="email" placeholder="Enter your email" required>
            </div>

            <button type="submit"  class="btn solid" name="send_mail">Send</button>
            <a href="login.php" style="color:yellow;">Go back to Home page</a><br/><br/>
        </form>
    <center>
        </div>
    </body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();

$db=mysqli_connect("localhost","root","","onecart") or die("not connected");

if(isset($_POST['send_mail'])){
$email = mysqli_real_escape_string($db,$_POST['email']);
$user_check_query = "SELECT * FROM user WHERE  u_email = '$email' ";
$deliver_check_query = "SELECT * FROM deliver WHERE  d_email = '$email' ";
$admin_check_query = "SELECT * FROM admin WHERE  a_email = '$email' ";
$manager_check_query = "SELECT * FROM manager WHERE  m_email = '$email' ";
$result_u = mysqli_query($db,$user_check_query);
$result_d = mysqli_query($db,$deliver_check_query);
$result_a = mysqli_query($db,$admin_check_query);
$result_m = mysqli_query($db,$manager_check_query);
$user = mysqli_fetch_assoc($result_u);
$deliver = mysqli_fetch_assoc($result_d);
$admin = mysqli_fetch_assoc($result_a);
$manager = mysqli_fetch_assoc($result_m);


//$names= mysql_fetch_array($results);
//var_dump($username);
//$username = $names['u_name'];


$_SESSION['email'] = $email;
if($user){
require 'vendor/autoload.php';
$mail = new PHPMailer(true);

    try {
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'groupcs13ucsc@gmail.com';                     
    $mail->Password   = 'One13xy#@+!Cart';                         
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                   

    $mail->setFrom('groupcs13ucsc@gmail.com', 'Onecart');
    $mail->addAddress($_POST['email']);     
    
    
    $mail->isHTML(true);                                  
    $mail->Subject = "Reset Password";
    $mail->Body    = "<p>Dear user,</p><p> We received a request to reset your password at Onecart.
    Kindly click the below link to reset your password</p>
    http://localhost/onecart/reset_password.php
    <br><br>
    <p>With regrads,</p>
    <b>Onecart Team</b>";
    if($mail->send())
    {
        ?>
        <script>
        alert("<?php echo "Check your Mail"?>");
        header('location:forget_password.php');
        </script>
        <?php
    }

   
    } catch (Exception $e)    {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
  }
    else if($deliver){
    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'groupcs13ucsc@gmail.com';                     
        $mail->Password   = 'One13xy#@+!Cart';                         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;                                   
    
        $mail->setFrom('groupcs13ucsc@gmail.com', 'Onecart');
        $mail->addAddress($_POST['email']);     
        
        
        $mail->isHTML(true);                                  
        $mail->Subject = "Reset Password";
        $mail->Body    = "<p>Dear user,</p><p> We received a request to reset your password at Onecart.
        Kindly click the below link to reset your password</p>
        http://localhost/onecart/reset_password.php
        <br><br>
        <p>With regrads,</p>
        <b>Onecart Team</b>";
        if($mail->send())
        {
            ?>
            <script>
            alert("<?php echo "Check your Mail"?>");
            header('location:forget_password.php');
            </script>
            <?php
      
        }
    
       
        } catch (Exception $e)    {
             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }

    else if($admin){
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'groupcs13ucsc@gmail.com';                     
            $mail->Password   = 'One13xy#@+!Cart';                         
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                                   
        
            $mail->setFrom('groupcs13ucsc@gmail.com', 'Onecart');
            $mail->addAddress($_POST['email']);     
            
            
            $mail->isHTML(true);                                  
            $mail->Subject = "Reset Password";
            $mail->Body    = "<p>Dear user,</p><p> We received a request to reset your password at Onecart.
            Kindly click the below link to reset your password</p>
            http://localhost/onecart/reset_password.php
            <br><br>
            <p>With regrads,</p>
            <b>Onecart Team</b>";
            if($mail->send())
            {
                ?>
                <script>
                alert("<?php echo "Check your Mail"?>");
                header('location:forget_password.php');
                </script>
                <?php
          
            }
        
           
            } catch (Exception $e)    {
                 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
    }

        else if($manager){
            require 'vendor/autoload.php';
            $mail = new PHPMailer(true);
            
            try {
                $mail->isSMTP();                                           
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                  
                $mail->Username   = 'groupcs13ucsc@gmail.com';                     
                $mail->Password   = 'One13xy#@+!Cart';                         
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                   
            
                $mail->setFrom('groupcs13ucsc@gmail.com', 'Onecart');
                $mail->addAddress($_POST['email']);     
                
                
                $mail->isHTML(true);                                  
                $mail->Subject = "Reset Password";
                $mail->Body    = "<p>Dear user,</p><p> We received a request to reset your password at Onecart.
                Kindly click the below link to reset your password</p>
                http://localhost/onecart/reset_password.php
                <br><br>
                <p>With regrads,</p>
                <b>Onecart Team</b>";
                if($mail->send())
                {
                    ?>
                    <script>
                    alert("<?php echo "Check your Mail"?>");
                    header('location:forget_password.php');
                    </script>
                    <?php
              
                }
            
               
                } catch (Exception $e)    {
                     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
        }


        else{
             ?>
             <script>
             alert("<?php echo " Invalid Email "?>");
            </script>
            <?php
            }
}

?>

