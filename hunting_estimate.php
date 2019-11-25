<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <?php
        if ( ! empty( $_POST ) ) {
            $year = $_POST['year'];
            $district = $_POST['district'];
            $animal = $_POST['animal'];
            
            $sql = "SELECT * FROM Harvest_estimate WHERE Liscense_year = ".$year." AND District = ".$district." AND Animal = '".$animal."';";
            
            echo $sql;
            
            $result = $dbConn->query($sql) or die("Data query error");
            
            if($result-> num_rows > 0){
                echo "<table>";
                echo "<thead><tr><th>Liscense Year</th><th>District</th><th>Animal</th><th>Number of Hunters</th><th>Residency</th><th>Total Harvest</th><th>Days Hunted</th><th>Number of Males</th><th>Number of Females</th><th>Number of First Years</th><th>Number of Points</th></tr></thead><tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["Liscense_year"]."</td><td>".$row["District"]."</td><td>".$row["Animal"]."</td><td>".$row["Num_hunters"]."</td><td>".$row["Residency"]."</td><td>".$row["Total_harvest"]."</td>
                    <td>".$row["Days_hunted"]."</td>
                    <td>".$row["Num_males"]."</td><td>".$row["Num_females"]."</td><td>".$row["Num_first_years"]."</td><td>".$row["Num_points"]."</td></tr>";
            }
                echo "</tbody></table>";
            } else {
                echo "No Hunting Estimate found";
            }
            
        }
?>
</div>

<div class="clear"></div>

<?php 

include './meta/inc/footer.php';

?>