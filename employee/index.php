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