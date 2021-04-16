<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "onecartfinal";
	
	$fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
	$u_address = filter_var($_POST["u_address"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $zip = filter_var($_POST["zip"], FILTER_SANITIZE_STRING);
    $longtitude = filter_var($_POST["longtitude"], FILTER_SANITIZE_STRING);
    $latitude = filter_var($_POST["latitude"], FILTER_SANITIZE_STRING);

	if (empty($fname)){
		die("Please enter your name");
	}
	if (empty($email) || !filter_var($email, FILTER_SANITIZE_STRING)){
		die("Please enter valid email address");
	}
		
	if (empty($u_address)){
		die("Please enter text");
	}	

	//Open a new connection to the MySQL server
	//see https://www.sanwebe.com/2013/03/basic-php-mysqli-usage for more info
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	
	$statement = $mysqli->prepare("INSERT INTO getaddress (fname, email, u_address, city, zip, longtitude, latitude) VALUES('$fname', '$email', '$u_address', '$city', '$zip', '$longtitude', '$latitude')"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	// $statement->bind_param('sss', $fname, $email, $u_address, $city, $zip, $longtitude, $latitude); //bind values and execute insert query
	
	if($statement->execute()){
		echo "<script>alert('Your Location and Address Saved !')</script>";
        echo "<script>window.open('payment.php', '_self')</script>";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>