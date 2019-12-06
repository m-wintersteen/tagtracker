<?php 

include "./config/masterConfig.php";
include './meta/inc/header.php';

include_once './meta/assets/dbconnect.inc';

session_start();

?>

<script>
    function switchDiv() {
        var x = document.getElementById("signInDiv");
        var y = document.getElementById("newHunterDiv");
        var btn = document.getElementById("switch_btn");
        
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
            btn.innerHTML = "Sign Up";
        } else {
            x.style.display = "none";
            y.style.display = "block";
            btn.innerHTML = "Log In";
        }
    }

</script> 

<div class="container">
    <?php
    if(isset( $_SESSION['id'] )){
        echo '<button id="logout_btn" onclick="window.location.href = \'meta/inc/logout.php\';">Log Out</button><h1>Welcome '.$_SESSION["Name"]."</h1>";
        
        echo '<div id="huntingEstimates"><h2>Hunting Estimates</h2>';
        echo '<form action="hunting_estimate.php" method="post">
        <p>Year: <input type="text" name="year">
        <br>
        District: <input type="text" name="district">
        <br>
        Animal: <input type="text" name="animal">
        </p>
        <input type="submit" value="Find Hunting Estimate">
    </form></div>';
        
        echo '<div id="newHuntingTrip"><h2>Record a New Hunting Trip</h2>
        <form action="newHuntingTrip.php" method="post">
        <div class="dropdown"><p>Tags
        <select class="tag_dropdown" name="tags">';
        
        //Get tags from current year
        $currentYear = date("Y");

        $sql = "SELECT * FROM Tags WHERE NOT EXISTS (SELECT * FROM Hunting_trip WHERE Hunter_id = ".$_SESSION['id']." and Tags.Tag_id = Hunting_trip.Tag_id AND Harvest = 'true') AND Liscense_year = ".$currentYear." AND Hunter_id = ".$_SESSION['id'].";";

        $result = $dbConn->query($sql) or die("Data query error");

        $tags = array();
        $tagDesc = array();

        if($result-> num_rows > 0){
            while($row=$result->fetch_assoc()){
                array_push($tags,$row["Tag_id"]);
                $desc = "#".$row["Tag_id"]." Dist.".$row["District_id"]." ".ucfirst($row["Animal"])." ".ucfirst($row["Sex"]);
                array_push($tagDesc,$desc);
            }
        }
        
        foreach($tags as $i => $tag){
            echo '<option value="'.$tag.'">'.$tagDesc[$i].'</option>';
        } 
        echo '</select>
        </div>
        Number of Days Hunted: <input type="text" name="Days">
        <br>
        Did you Harvest?  <input type="radio" name="Harvest" value="true">Yes
        <input type="radio" name="Harvest" value="false" checked>No
        <br>
        Number of Points: <input type="text" name="Num_points">
        <br>
        First Year?  <input type="radio" name="First_year" value="true">Yes
        <input type="radio" name="First_year" value="false">No
        <br>
        </p>
        <input class="form_btn" type="submit" value="Submit">
        </form></div>
        ';
    } else {
        echo '<button id="switch_btn" onclick="switchDiv()">Sign Up</button>
        <div id="signInDiv">
        <form action="profile.php" method="post">
        Hunter ID: <input type="text" name="id">
        <br>
        Password: <input type="password" name="password">
        <br>
        <input class="form_btn" type="submit" value="Log In">
    </form>
    </div>
    <div id="newHunterDiv">
        <form action="newHunter.php" method="post">
        Hunter ID: <input type="text" name="id">
        <br>
        Password: <input type="password" name="password">
        <br>
        First Name: <input type="text" name="Fname">
        <br>
        Middle Initial: <input type="text" name="Minit">
        <br>
        Last Name: <input type="text" name="Lname">
        <br>
        Montana Resident: <input type="radio" name="Resident" value="Resident" checked>Resident
        <input type="radio" name="Resident" value="NonResident">Non Resident
        <br>
        <input class="form_btn" type="submit" value="Sign Up">
    </form>
    </div>';
    }
    
    ?>
    
</div>

<div class="clear"></div>  

<?php 

include './meta/inc/footer.php';

?>