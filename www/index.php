<?php
//check to see if they're logged in  
if(!isset($_SESSION['logged_in'])) { 
    header("Location: anonymous.php"); 
} else {
	header("Location: welcome.php");
}
?>