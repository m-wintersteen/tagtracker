<?php 

session_start();
unset($_SESSION['eid']);
header("Location: http://localhost:8080/tagtracker/employee");
?>