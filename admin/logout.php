<?php


session_start();//session to store information used across pages

unset($_SESSION['user_is_logged_in']);

session_destroy(); 

header("Location: ../index.php"); //using for the redirection to given page 


?>