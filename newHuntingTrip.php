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
    
    if($Days == NULL){
        $Days = 0;
    }
    if($Num_points == NULL){
        $Num_points = "NULL";
    }
    
    //Query to add a new hunting trip
    $sql = "INSERT INTO Hunting_trip (Trip_id, Tag_id, Hunter_id, Harvest, Points, First_year,Days) VALUE (".$newTripID.",".$Tag_id.",".$hunterID.",'".$Harvest."',".$Num_points.",'".$First_year."',".$Days.");";
    
    $result = $dbConn->query($sql) or die("Error");
    
    //Get current values for Num_hunters, Residency, Total_harvest, Days_hunted, and Num for sex
    //Get info about hunting tag
    $sql = "SELECT District_id,Animal,Sex FROM `Tags` WHERE Tag_id = ".$Tag_id.";";
    $result = $dbConn->query($sql) or die("Data query error");
    $district = 0;
    $animal = "";
    $sex = "";
    if($result-> num_rows > 0){
        while($row=$result->fetch_assoc()){
            $district = $row["District_id"];
            $animal = $row["Animal"];
            $sex = $row["Sex"];
        }
    }
    
    //Get hunter info
    $sql = "SELECT Resident FROM `Hunter` WHERE Hunter_id = ".$hunterID.";";
    $result = $dbConn->query($sql) or die("Data query error");
    $residency = "";
    if($result-> num_rows > 0){
        while($row=$result->fetch_assoc()){
            $residency = $row["Resident"];
        }
    }
    
    $currentYear = date("Y");
    
    $sexName = "";
        
    if($First_year == "true"){
        $sexName = "Num_first_years";
    }
    else{
        if($sex == "M"){
            $sexName = "Num_males";
        }
        else{
            $sexName = "Num_females";
        }
    }
    
    //Get current Harvest Estimate
    $sql = "SELECT Num_hunters, Total_harvest, Days_hunted, ".$sexName." FROM Harvest_estimate WHERE Liscense_year = ".$currentYear." AND District = ".$district." AND Animal = '".$animal."' AND Residency = '".$residency."';";
    $result = $dbConn->query($sql) or die("Data query error");
    $Num_hunters = 0;
    $Total_harvest = 0;
    $Days_hunted = 0;
    $NumSex = 0;
    if($result-> num_rows > 0){
        while($row=$result->fetch_assoc()){
            $Num_hunters = $row["Num_hunters"];
            $Total_harvest = $row["Total_harvest"];
            $Days_hunted = $row["Days_hunted"];
            $NumSex = $row[$sexName];
        }
    }
    
    //Set new values for Num_hunters, Residency, Total_harvest, Days_hunted, and Num for sex
    $newNum_hunters = $Num_hunters + 1;
    $newTotal_harvest = $Total_harvest;
    $newNumSex = $NumSex;
    if($Harvest == "true"){
        $newTotal_harvest = $Total_harvest + 1;
        $newNumSex = $NumSex + 1;
    }
    
    $newDays_hunted = $Days_hunted + $Days;
    
    $nonRes = "R";
    if($residency == "R"){
        $nonRes = "N";
    }
    
    //Update Harvest Estimates
    $sql = "UPDATE Harvest_estimate SET Num_hunters = ".$newNum_hunters." , Total_harvest = ".$newTotal_harvest." , Days_hunted = ".$newDays_hunted." , ".$sexName." = ".$newNumSex." WHERE Liscense_year = ".$currentYear." and District = ".$district." and Animal = '".$animal."' and Residency != '".$nonRes."';";
    
    $result = $dbConn->query($sql) or die("Error");
    
    header("Location: http://localhost:8080/tagtracker/huntingTrip.php");
}
?>