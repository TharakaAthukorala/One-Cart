<?php
function getIp() {                           //get user ids
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
 } 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$id=getIp();
$username="";
$email="";
$postal="";
$city="";
$address="";
$phonenumber="";



$db=mysqli_connect("localhost","root","","onecartfinal") or die("not connected");
// register user
if(isset($_POST['update_user'])){
$username = mysqli_real_escape_string($db,$_POST['username']);

$email = mysqli_real_escape_string($db,$_POST['email']);
$postal =mysqli_real_escape_string($db,$_POST['code']);
$address =mysqli_real_escape_string($db,$_POST['address']);
$city =mysqli_real_escape_string($db,$_POST['city']);
$phonenumber =mysqli_real_escape_string($db,$_POST['phone']);
$password_1 = mysqli_real_escape_string($db,$_POST['password1']);
$password_2 = mysqli_real_escape_string($db,$_POST['password2']);
$password_3 = mysqli_real_escape_string($db,$_POST['password3']);



// $user_pass=$db->prepare("SELECT u_pass FROM user WHERE u_id='$id'");



// $user_pass=md5($user_pass);

// if($user_pass==$password_1){
    if($password_2==$password_3){
        $password = md5($password_2);
        $update_user=$db->prepare("UPDATE user SET u_id='$id',u_name='$username',u_email='$email',u_pass='$password',u_city='$city',u_add='$address',u_code='$postal',u_phone='$phonenumber',u_reg_date=NOW() WHERE u_id='$id'");
   if($update_user->execute()){
    echo "<script>alert('Your Account update successfully !')</script>";
    echo "<script>window.open('../indexuser.php', '_self')</script>";
   }else{
    print $mysqli->error; 
   }
    }

// }
//register the user no error
}

}
?>