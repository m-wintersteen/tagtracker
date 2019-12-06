<?php 

include "../config/masterConfig.php";
include '../meta/inc/emp_header.php';

include_once '../meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <?php
        if ( ! empty( $_POST ) ) {
            if ( ! empty($_POST['Resident']) ){
                $options = [
                    "Resident" => $_POST['Resident'],
                    "District_id" => $_POST['district']
                ];
            }
            else{
                $options = [
                    "District_id" => $_POST['district']
                ];
            }
            
            
            $sql = "SELECT DISTINCT Hunter.Hunter_id, Fname, Lname, Resident FROM Hunter, Tags WHERE ";
            
            foreach($options as $i => $value){
                if($value != NULL){
                    if($i == "District_id"){
                        $sql = $sql." Hunter.Hunter_id = Tags.Hunter_id AND ".$i." = '".$value."' AND ";
                        echo "<h2>Hunters that have tags in district ".$value."</h2>";
                    }
                    else{
                        if(!is_numeric($value)){
                            $sql = $sql.$i." = '".$value."' AND ";
                        }
                        else{
                            $sql = $sql.$i." = ".$value." AND ";
                        }
                    }
                    
                }
            }
            $sql = substr($sql, 0, -5);
            
            $result = $dbConn->query($sql) or die("Data query error");
            
            if($result-> num_rows > 0){
                echo "<table>";
                echo "<thead><tr><th>Hunter ID</th><th>First Name</th><th>Last Name</th><th>Residency</th></tr></thead><tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["Hunter_id"]."</td><td>".$row["Fname"]."</td><td>".$row["Lname"]."</td><td>".$row["Resident"]."</td></tr>";
            }
                echo "</tbody></table>";
            } else {
                echo "No Hunters found";
            }
            
        }
?>
</div>

<div class="clear"></div>

<?php 

include '../meta/inc/emp_footer.php';

?>