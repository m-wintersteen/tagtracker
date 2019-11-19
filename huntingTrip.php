<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <?php
    
    if(isset($_SESSION['id'])){
        echo "Here are all the hunting trips for ".$_SESSION['Name']."<br>";
        
        $sql = "SELECT * FROM Hunting_trip WHERE Hunter_id = ".$_SESSION["id"].";";
            
        $result = $dbConn->query($sql) or die("Data query error");
        
        if($result-> num_rows > 0){
            while($row=$result->fetch_assoc()){
                echo "Trip: ".$row["Trip_id"]."Tag: ".$row["Tag_id"]."Harvest: ".$row["Harvest"]." Points: ".$row["Points"]." First Year: ".$row["First_year"]." Days: ".$row["Days"]."<br>";
            }
        } else {
            echo "No tags found";
        }
    } else {
        header("Location: http://localhost:8080/tagtracker/");
    }
?>
</div>

<div class="clear"></div>

<?php 

include './meta/inc/footer.php';

?>