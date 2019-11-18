<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

?>

<div class="container">
    <form action="profile.php" method="post">
        Hunter ID: <input type="text" name="id">
        <br>
        Password: <input type="password" name="password">
        <input type="submit" value="Submit">
    </form>
</div>

<div class="clear"></div>

<?php 

include './meta/inc/footer.php';

?>