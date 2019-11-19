<?php
include "./config/masterConfig.php";
include_once './meta/assets/dbconnect.inc';

if ( ! empty( $_POST ) ) {
    $Hunter_id = $_POST['id'];
    $h_password = $_POST['password'];
    $Fname = $_POST['Fname'];
    $Minit = $_POST['Minit'];
    $Lname = $_POST['Lname'];
    $Resident = $_POST['Resident'];

    $stmt = $dbConn->prepare("INSERT INTO Hunter VALUE (?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("isssss",$Hunter_id,$h_password,$Fname,$Minit,$Lname,$Resident);
    
    $stmt->execute();
    
    printf("%d Row inserted.\n", $stmt->affected_rows);
    
    $stmt->close();
    
    header("Location: http://localhost:8080/tagtracker/");
}
?>