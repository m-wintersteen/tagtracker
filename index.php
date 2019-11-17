<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

?>

<div class="container">
    <p>Demo</p>
    
    <?php
        echo "Hunter<br>";
        //Getting a random selection of the database for the banner
		$query = "
			SELECT *
			FROM Hunter";
		$result = $dbConn->query($query) or die("Data query error");
    
		while ($row = $result->fetch_object()) {
            echo $row->Hunter_id." ".$row->Fname." ".$row->Minit." ".$row->Lname." ".$row->Resident."<br>";
            
        }

?>
</div>

<div class="clear"></div>

<?php 

include './meta/inc/footer.php';

?>