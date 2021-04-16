<?php

$plan = filter_input(INPUT_POST, 'rating__plan');
$staff = filter_input(INPUT_POST, 'rating__staff');
$food = filter_input(INPUT_POST, 'rating__food');


if (!empty($plan)){
if (!empty($staff)){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "onecartfinal";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);


if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
    $sql = "INSERT INTO rating(plan, staff, food) VALUES ('$plan','$staff','$food')";
    

if ($conn->query($sql)){
    echo "<script>alert('Thank you for Your feedback !')</script>";
	echo "<script>window.open('../indexuser.php', '_self')</script>";
}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}
else{
echo "plan should not be empty";
die();
}
}
else{
echo "staff should not be empty";
die();
}
?>