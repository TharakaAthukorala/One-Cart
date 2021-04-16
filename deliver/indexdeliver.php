<?php
session_start();
if(!isset($_SESSION['delivery_data'])){
    echo "Invalid login";
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliver Panel</title>
    <link rel="stylesheet" href="css/add.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


    <!-- <link rel="stylesheet" href="css/testheight.css"> -->
</head>
<body>

    <?php
        include("include/header.php");
        include("include/bodyleft.php");
        include("include/bodyright.php");
    ?>

</body>
</html>
