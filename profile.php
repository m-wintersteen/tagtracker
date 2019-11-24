<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <?php
    if(isset( $_SESSION['id'])){
        echo '<button id="logout_btn" onclick="window.location.href = \'meta/inc/logout.php\';">Log Out</button><h1>Welcome '.$_SESSION["Name"]."</h1>";
    }
    
        if ( ! empty( $_POST ) ) {
            $Hunter_id = $_POST['id'];
            $h_password = $_POST['password'];

            $sql = "SELECT * FROM Hunter WHERE Hunter_id='$Hunter_id' AND h_password='$h_password'";

            $result = $dbConn->query($sql) or die("Data query error");

            if($result-> num_rows > 0){
                echo "<h2>My Info</h2>";
                echo "<table>";
                 echo "<thead><tr><th>First Name</th><th>Middle Initial</th><th>Last Name</th><th>Residency</th></tr></thead><tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["Fname"]."</td><td>".$row["Minit"]."</td><td>".$row["Lname"]."</td><td>".$row["Resident"]."</td></tr>";
                    $_SESSION['id'] = $Hunter_id;
                    $_SESSION['Name'] = $row["Fname"]." ".$row["Lname"];
                }
                echo "</tbody></table>";
            } else {
                echo "No user found";
            }
        } else if(isset( $_SESSION['id'] )){
            $sql = "SELECT * FROM Hunter WHERE Hunter_id=".$_SESSION['id'].";";
            
            $result = $dbConn->query($sql) or die("Data query error");

            if($result-> num_rows > 0){
                echo "<h2>My Info</h2>";
                echo "<table>";
                 echo "<thead><tr><th>First Name</th><th>Middle Initial</th><th>Last Name</th><th>Residency</th></tr></thead><tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["Fname"]."</td><td>".$row["Minit"]."</td><td>".$row["Lname"]."</td><td>".$row["Resident"]."</td></tr>";
                }
                echo "</tbody></table>";
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