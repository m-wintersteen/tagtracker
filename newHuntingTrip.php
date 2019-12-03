<?php
include "./config/masterConfig.php";
include_once './meta/assets/dbconnect.inc';

session_start();

if ( ! empty( $_POST ) ) {
    //Code to Find a new trip id
    $sql = "SELECT Trip_id FROM `Hunting_trip` ORDER BY Trip_id DESC LIMIT 1";
    $result = $dbConn->query($sql) or die("Data query error");
    $newTripID = 0;
    if($result-> num_rows > 0){
        while($row=$result->fetch_assoc()){
            $newTripID = $row["Trip_id"] + 1;
        }
    }

    $hunterID = $_SESSION['id'];
    
    
    
    $Tag_id = $_POST['tags'];
    $Days = $_POST['Days'];
    $Num_points = $_POST['Num_points'];
    $Harvest = $_POST['Harvest'];
    $First_year = $_POST['First_year'];
    
    
    echo "Trip_id ".$newTripID." Tag_id ".$Tag_id." Hunter_id ".$hunterID." Harvest ".$Harvest." Points ".$Num_points." First_year ".$First_year." Days ".$Days;
    

    /*$stmt = $dbConn->prepare("INSERT INTO Hunting_trip VALUE (?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("isssss",$Hunter_id,$h_password,$Fname,$Minit,$Lname,$Resident);
    
    $stmt->execute();
    
    printf("%d Row inserted.\n", $stmt->affected_rows);
    
    $stmt->close();
    
    header("Location: http://localhost:8080/tagtracker/huntingTrip.php");
    */
}
?>