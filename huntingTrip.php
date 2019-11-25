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
            echo "<table>";
            echo "<thead><tr><th>Trip</th><th>Tag</th><th>Harvest</th><th>Points</th><th>First Year</th><th>Days</th></tr></thead>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["Trip_id"]."</td><td>".$row["Tag_id"]."</td><td>".$row["Harvest"]."</td><td>".$row["Points"]."</td><td>".$row["First_year"]."</td><td>".$row["Days"]."</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No hunting trips found";
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