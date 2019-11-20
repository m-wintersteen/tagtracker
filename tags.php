<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <?php
    
    if(isset($_SESSION['id'])){
        echo "Here are all the tags for ".$_SESSION['Name']."<br>";
        
        $sql = "SELECT * FROM Tags WHERE Hunter_id = ".$_SESSION["id"].";";
            
        $result = $dbConn->query($sql) or die("Data query error");
        if($result-> num_rows > 0){
            echo "<table>";
            echo "<thead><tr><th>Tag</th><th>District</th><th>Animal</th><th>Type</th><th>Liscense</th></tr></thead><tbody>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["Tag_id"]."</td><td>".$row["District_id"]."</td><td>".$row["Animal"]."</td><td>".$row["Bow_rifle"]."</td><td>".$row["Liscense_year"]."</td></tr>";
            }
            echo "</tbody></table>";
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