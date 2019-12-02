<?php 

session_start();
unset($_SESSION['id']);
header("Location: http://localhost:8080/tagtracker/");
?>