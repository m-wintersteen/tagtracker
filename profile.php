<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <button id="logout_btn" onclick="window.location.href = 'meta/inc/logout.php';">Log Out</button>
    <?php
        if ( ! empty( $_POST ) ) {
            $Hunter_id = $_POST['id'];
            $h_password = $_POST['password'];

            $sql = "SELECT Fname, Lname FROM Hunter WHERE Hunter_id='$Hunter_id' AND h_password='$h_password'";

            $result = $dbConn->query($sql) or die("Data query error");

            if($result-> num_rows > 0){
                while($row=$result->fetch_assoc()){
                    echo "Welcome Hunter! <br>".$row["Fname"]." ".$row["Lname"];
                    $_SESSION['id'] = $Hunter_id;
                    $_SESSION['Name'] = $row["Fname"]." ".$row["Lname"];
                }
            } else {
                echo "No user found";
            }
        } else if(isset( $_SESSION['id'] )){
            echo "Welcome Hunter! <br> ".$_SESSION['Name'];
        } else {
            header("Location: http://localhost:8080/tagtracker/");
        }
?>
</div>

<div class="clear"></div>

<?php 

include './meta/inc/footer.php';

?>