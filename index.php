<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

session_start();

?>

<div class="container">
    <?php
    if(isset( $_SESSION['id'] )){
        echo '<button id="logout_button" onclick="window.location.href = \'meta/inc/logout.php\';">Log Out</button>Welcome Hunter! <br> '.$_SESSION["Name"];
    } else {
        echo '<form action="profile.php" method="post">
        Hunter ID: <input type="text" name="id">
        <br>
        Password: <input type="password" name="password">
        <input type="submit" value="Submit">
    </form>';
    }
    
    ?>
</div>

<div class="clear"></div>

<?php 

include './meta/inc/footer.php';

?>