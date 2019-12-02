<?php 

include "../config/masterConfig.php";
include '../meta/inc/emp_header.php';

include_once '../meta/assets/dbconnect.inc';

session_start();

?>


<div class="container">
    <?php
    
    if(isset($_SESSION['eid'])){
        echo "Search or Add Tag<br>";
        
         
    } else {
        header("Location: http://localhost:8080/tagtracker/employee");
    }
?>
</div>

<div class="clear"></div>

<?php 

include '../meta/inc/emp_footer.php';

?>