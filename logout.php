<?php
   session_start();
   unset($_SESSION["useremail"]);
   unset($_SESSION["password"]);
   
   
  
   header('Refresh:1; url = login.php');
?>