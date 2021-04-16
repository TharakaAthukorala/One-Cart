<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 session_start();
 function getIp() {                           //get user ids
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}
$id=getip(); 
 $username="";

 $email="";
 $nic="";
 $postal="";
 $city="";
 $address="";
 $phonenumber="";

 $errors = array();

$db=mysqli_connect("localhost","root","","onecartfinal") or die("not connected");
 // register user
 if(isset($_POST['reg_user'])){
 $username = mysqli_real_escape_string($db,$_POST['username']);

 $email = mysqli_real_escape_string($db,$_POST['email']);
 $postal =mysqli_real_escape_string($db,$_POST['postal']);
 $address =mysqli_real_escape_string($db,$_POST['address']);
 $city =mysqli_real_escape_string($db,$_POST['city']);
 $phonenumber =mysqli_real_escape_string($db,$_POST['phonenumber']);
 $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
 $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);

// var_dump($mail->send());
$otp = rand(100000,999999);

//$_SESSION['otp'] = $otp;
//$_SESSION['email'] = $email;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'groupcs13ucsc@gmail.com';                     //SMTP username
    $mail->Password   = 'One13xy#@+!Cart';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('groupcs13ucsc@gmail.com', 'Onecart');
    $mail->addAddress($_POST['email']);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Your verify code";
    $mail->Body    = "<p>Dear $username </p> <h3>Your verification code is $otp <br></h3>
     <p>Use this code to verify your account.</p>
     <br><br>
     <p>With regrads,</p>
     <b>Onecart Team</b>";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

if(!$mail->send()){
    ?>
    <script>
    alert("<?php echo " Invalid Email "?>");
    </script>
    <?php
    }else{
        $password = md5($password_1);
        $query = "INSERT INTO user(u_id,u_name,u_email,u_pass,u_city,u_add,u_code,u_phone,u_reg_date,otp,verify) VALUES('$id','$username','$email','$password','$city','$address','$postal','$phonenumber',Now(),'$otp',0)";
        mysqli_query($db,$query);
        $_SESSION['email'] = $email;
        $_SESSION['success'] ="You are now logged in";
        header('location:verify_account.php');
    ?>
    <?php
    }

       
//form validation
if(empty($username)){
    array_push($errors,"User name is required.");
}
if(empty($email)){array_push($errors,"Email is required.");}
if(empty($password_1)){array_push($errors,"Password is required.");}
if($password_1 != $password_2){array_push($errors, "Passwords do not match");}


// check db for existing user with same username
$user_check_query = "SELECT * FROM user WHERE  u_email = '$email' ";
$results = mysqli_query($db,$user_check_query);
$user = mysqli_fetch_assoc($results);


if($user){

    array_push($errors,"Email is already exist.");
}

 }
if(isset($_POST['check_code'])){
    $email=$_POST['email'];
    $otp=$_POST['otp_code'];
    if(empty($email))
    {
        ?>
        <script>
        alert("<?php echo " You must enter your email "?>");
        </script>
        <?php
    }
    else if(empty($otp))
    {
        ?>
        <script>
        alert("<?php echo " You must enter your otp code  "?>");
        </script>
        <?php

    }
    else if(count($errors)== 0)
    {
        $query_1 ="SELECT * FROM user WHERE u_email='$email' AND otp='$otp'";
        $results_1=mysqli_query($db,$query_1);
        if(mysqli_num_rows($results_1)){
            $verify=1;
            $data=mysqli_fetch_assoc($results_1);
            $_SESSION['user_data']=$data;
            $q="UPDATE user SET verify='$verify'  WHERE  u_email='$email' ";
            $_SESSION['email']=$email;
            $_SESSION['success']="Verfiy account done, you may sign in now";
            mysqli_query($db,$q);
            header("location:login.php"); 
           
      
       }
       
  }
}





//login

if(isset($_POST['login_user'])){
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password_1']);
    if(empty($email)){
        array_push($errors,"Email is required");
    }
    if(empty($password)){
        array_push($errors,"Password is required");

    }


    if(count($errors)==0){
        $password =md5($password);


        $query_1 ="SELECT * FROM user WHERE u_email='$email' AND u_pass='$password' AND   verify='1' ";
      
        $query_2="SELECT * FROM manager WHERE m_email='$email' AND m_pass='$password' AND  verify='1'  ";
       
        $query_3="SELECT * FROM deliver WHERE d_email='$email' AND d_pass='$password'   AND d_verify='1' ";
      
        $query_4="SELECT * FROM admin WHERE a_email='$email' AND a_password='$password'";
        $results_1=mysqli_query($db,$query_1);
        $results_2=mysqli_query($db,$query_2);
        $results_3=mysqli_query($db,$query_3);
        $results_4=mysqli_query($db,$query_4);

        if(mysqli_num_rows($results_1)){
            $data=mysqli_fetch_assoc($results_1);
            $_SESSION['user_data']=$data;
            $_SESSION['email']=$email;
            $_SESSION['success']="Login is successful.";
            header("location:user/indexuser.php");
        }else if(mysqli_num_rows($results_2)){
            $data=mysqli_fetch_assoc($results_2);
            $_SESSION['manager_data']=$data;
            $_SESSION['email']=$email;
            $_SESSION['success']="Login is successful.";
            header("location:manager/indexmanager.php?home");

        }else if(mysqli_num_rows($results_3)){
            $data=mysqli_fetch_assoc($results_3);
            $_SESSION['delivery_data']=$data;
            $_SESSION['email']=$email;
            $_SESSION['success']="Login is successful.";
            header("location:deliver/indexdeliver.php?home");
        }else if(mysqli_num_rows($results_4)){
            $data=mysqli_fetch_assoc($results_4);
            $_SESSION['admin_data']=$data;
            $_SESSION['email']=$email;
            $_SESSION['success']="Login is successful.";
            header("location:admin/indexadmin.php?home");
        }else{
    array_push($errors,"wrong login.");
}
    }

}
 
?>