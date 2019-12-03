<?php 

include "../config/masterConfig.php";
include '../meta/inc/emp_header.php';

include_once '../meta/assets/dbconnect.inc';

session_start();

?>

<div class="container">
    <?php
    if(isset( $_SESSION['eid'] )){
        echo '<button id="logout_btn" onclick="window.location.href = \'../meta/inc/elogout.php\';">Log Out</button><h1>Welcome '.$_SESSION["eName"]."</h1>";
        
        echo '<h2>Hunter Search</h2>';
        echo '<form action="hunter.php" method="post">
        <p>Montana Resident: <input type="radio" name="Resident" value="R" checked>Resident
        <input type="radio" name="Resident" value="N">Non Resident
        <br>
        Have Tag in District: <input type="text" name="district">
        <br>
        </p>
        <input type="submit" value="See Hunters">
    </form>';
    } else {
        echo '<div id="signInDiv">
        <form action="profile.php" method="post">
        Employee ID: <input type="text" name="id">
        <br>
        Password: <input type="password" name="password">
        <br>
        <input id="form_btn" type="submit" value="Log In">
    </form>
    </div>';
    }
    
    ?>
    
</div>

<div class="clear"></div>  

<?php 

include '../meta/inc/emp_footer.php';

?>