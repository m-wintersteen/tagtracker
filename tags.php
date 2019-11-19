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
            while($row=$result->fetch_assoc()){
                echo "Tag: ".$row["Tag_id"]." District: ".$row["District_id"]." Animal: ".$row["Animal"]." Type: ".$row["Bow_rifle"]." Liscense Year: ".$row["Liscense_year"]."<br>";
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