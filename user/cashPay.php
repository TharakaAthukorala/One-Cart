<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "onecartfinal";
	$p_type = filter_var($_POST["p_type"], FILTER_SANITIZE_STRING);
	$status_code = filter_var($_POST["status_code"], FILTER_SANITIZE_STRING);
	
	// $p_type = filter_var($_POST["p_type"], FILTER_SANITIZE_STRING);
    // $p_date = $_POST['p_date'];

	//see https://www.sanwebe.com/2013/03/basic-php-mysqli-usage for more info
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
    if($status_code==1){
        $statement = $mysqli->prepare(" INSERT INTO paymentdetails(p_type, p_date) VALUES('$p_type', NOW()) ");
        if($statement->execute()){
            echo "<script>alert('Pay after Receive !')</script>";
            echo "<script>window.open('indexuser.php', '_self')</script>";
        }else{
            print $mysqli->error; //show mysql error if any
        }
    }

}