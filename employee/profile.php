<?php 

include "../config/masterConfig.php";
include '../meta/inc/emp_header.php';

include_once '../meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <?php
    if(isset( $_SESSION['eid'])){
        echo '<button id="logout_btn" onclick="window.location.href = \'../meta/inc/elogout.php\';">Log Out</button><h1>Welcome '.$_SESSION["eName"]."</h1>";
    }
    
        if ( ! empty( $_POST ) ) {
            $Employee_id = $_POST['id'];
            $e_password = $_POST['password'];

            $sql = "SELECT * FROM Employee WHERE Employee_id='$Employee_id' AND e_password='$e_password'";

            $result = $dbConn->query($sql) or die("Data query error");

            if($result-> num_rows > 0){
                echo '<button id="logout_btn" onclick="window.location.href = \'../meta/inc/elogout.php\';">Log Out</button><h1>Welcome!</h1>';
                
                echo "<h2>My Info</h2>";
                echo "<table>";
                 echo "<thead><tr><th>First Name</th><th>Middle Initial</th><th>Last Name</th><th>Hours Worked</th></tr></thead><tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["Fname"]."</td><td>".$row["Minit"]."</td><td>".$row["Lname"]."</td><td>".$row["Hours_worked"]."</td></tr>";
                    $_SESSION['eid'] = $Employee_id;
                    $_SESSION['eName'] = $row["Fname"]." ".$row["Lname"];
                }
                echo "</tbody></table>";
            } else {
                echo "No user found";
            }
        } else if(isset( $_SESSION['eid'] )){
            $sql = "SELECT * FROM Employee WHERE Employee_id='".$_SESSION['eid']."';";
            
            $result = $dbConn->query($sql) or die("Data query error");

            if($result-> num_rows > 0){
                echo "<h2>My Info</h2>";
                echo "<table>";
                 echo "<thead><tr><th>First Name</th><th>Middle Initial</th><th>Last Name</th><th>Hours Worked</th></tr></thead><tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr><td>".$row["Fname"]."</td><td>".$row["Minit"]."</td><td>".$row["Lname"]."</td><td>".$row["Hours_worked"]."</td></tr>";
                }
                echo "</tbody></table>";
            }
        } else {
            header("Location: http://localhost:8080/tagtracker/employee/");
        }
?>
</div>

<div class="clear"></div>

<?php 

include '../meta/inc/footer.php';

?>