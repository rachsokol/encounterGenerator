<?php
session_name('hawkeye_gamer');
session_start();
require("cfd.php");
require("cfd_pdo.php");
require("cfd_srd.php");

//check if user is signed in
if(isset($_SESSION['USERNAME'])){
    require('header.php');
?>
<!--Gets encounter level from user -->
<div class="container text-center">
    <h2 style="text-align:center;">Encounter Generator</h2>
  <div class="row">
    <div class="col">
<form method='GET' style=" text-align:left;">
<label for="level" style="font-size:15pt">Encounter Level: </label>
  <select name="level" id="level">
      <!--keeps the level inside the dropdown even on refresh -->
  <option value="1"<? if ($_GET['level'] == '1') { ?>selected="true" <?php };  ?> >1</option>
  <option value="2"<? if ($_GET['level'] == '2') { ?>selected="true" <?php };  ?>>2</option>
  <option value="3"<? if ($_GET['level'] == '3') { ?>selected="true" <?php };  ?>>3</option>
  <option value="4"<? if ($_GET['level'] == '4') { ?>selected="true" <?php };  ?>>4</option>
  <option value="5"<? if ($_GET['level'] == '5') { ?>selected="true" <?php };  ?>>5</option>
  <option value="6"<? if ($_GET['level'] == '6') { ?>selected="true" <?php };  ?>>6</option>
  <option value="7"<? if ($_GET['level'] == '7') { ?>selected="true" <?php };  ?>>7</option>
  <option value="8"<? if ($_GET['level'] == '8') { ?>selected="true" <?php };  ?>>8</option>
  <option value="9"<? if ($_GET['level'] == '9') { ?>selected="true" <?php };  ?>>9</option>
  <option value="10"<? if ($_GET['level'] == '10') { ?>selected="true" <?php };  ?>>10</option>
  <option value="11"<? if ($_GET['level'] == '11') { ?>selected="true" <?php };  ?>>11</option>
  <option value="12"<? if ($_GET['level'] == '12') { ?>selected="true" <?php };  ?>>12</option>
  <option value="13"<? if ($_GET['level'] == '13') { ?>selected="true" <?php };  ?>>13</option>
  <option value="14"<? if ($_GET['level'] == '14') { ?>selected="true" <?php };  ?>>14</option>
  <option value="15"<? if ($_GET['level'] == '15') { ?>selected="true" <?php };  ?>>15</option>
  <option value="16"<? if ($_GET['level'] == '16') { ?>selected="true" <?php };  ?>>16</option>
  <option value="17"<? if ($_GET['level'] == '17') { ?>selected="true" <?php };  ?>>17</option>
  <option value="18"<? if ($_GET['level'] == '18') { ?>selected="true" <?php };  ?>>18</option>
  <option value="19"<? if ($_GET['level'] == '19') { ?>selected="true" <?php };  ?>>19</option>
  <option value="20"<? if ($_GET['level'] == '20') { ?>selected="true" <?php };  ?>>20</option>
</select>
<input style="margin:20px;" type="submit" name="submit" value="Get Monsters">
</form>
</div>
</div>
<?

  if(isset($_GET['submit'])){
$selectedLevel = $_GET['level'];
    function challenge_rating($selectedLevel){
        
        global $srdConnect;
        global $selectedLevel;
        global $random_monster;
        //random monster between 1 and 12, 13 is for pair
        $random_monster = rand(1,13);
        $selected_level = intval($selectedLevel);
        $Lvl10to12 = [-6.5,-5.5,-4.5,-3.667,-2.75,-1.833,-.875];
        $Lvl7to9 = [-5,-4.5,-3.5,-2.667,-1.833,-.875];
        $Lvl5to6 = [-5,-4,-3.5,-2.5,-1.667,-.833];
        $Lvl4 = [-4,-3,-2.5,-1.5,-.75];
        $Lvl3 = [-3,-2,-1.5,-.667];
        $Lvl2 = [-2,-1,-.5];
            //if statement for levels 1-7 that have a cr outside of the pattern
        if ($selected_level == 7 && $random_monster > 9 && $random_monster != 13){
            switch($random_monster){
                //doesnt work
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel - 6;
                break;
            }
            $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1"; 
        }
        else if ($selectedLevel == 6 && $random_monster > 4 && $random_monster != 13){
            switch($random_monster){
                case 5:
                case 6:
                  $challenge_rating =  $selectedLevel + $Lvl5to6[0];
                break;
                case 7:
                case 8:
                case 9:
                  $challenge_rating =  $selectedLevel + $Lvl7to9[0];
                break;
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel + $Lvl10to12[1];
                break;
            }
            $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
        }
        else if ($selectedLevel == 5 && $random_monster > 3 && $random_monster != 13){
            switch($random_monster){
                case 4:
                  $challenge_rating =  $selectedLevel + $Lvl4[0];
                 break;
                case 5:
                case 6:
                  $challenge_rating =  $selectedLevel + $Lvl5to6[1];
                break;
                case 7:
                case 8:
                case 9:
                  $challenge_rating =  $selectedLevel + $Lvl7to9[1];
                break;
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel + $Lvl10to12[2];
                break;
            }
            $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
        }
        else if ($selectedLevel == 4 && $random_monster > 2 && $random_monster != 13){
            switch($random_monster){
                case 3:
                  $challenge_rating =  $selectedLevel + $Lvl3[0];
                break;
                case 4:
                  $challenge_rating =  $selectedLevel + $Lvl4[1];
                 break;
                case 5:
                case 6:
                  $challenge_rating =  $selectedLevel + $Lvl5to6[2];
                break;
                case 7:
                case 8:
                case 9:
                  $challenge_rating =  $selectedLevel + $Lvl7to9[2];
                break;
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel + $Lvl10to12[3];
                break;
            }
            $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";;
        }
        else if ($selectedLevel == 3 && $random_monster > 1 || $selectedLevel == 3 && $random_monster == 13){
            switch($random_monster){
                case 2:
                  $challenge_rating =  $selectedLevel + $Lvl2[0];
                break;
                case 3:
                  $challenge_rating =  $selectedLevel + $Lvl3[1];
                 break;
                case 4:
                  $challenge_rating =  $selectedLevel + $Lvl4[2];
                 break;
                case 5:
                case 6:
                  $challenge_rating =  $selectedLevel + $Lvl5to6[3];
                break;
                case 7:
                case 8:
                case 9:
                  $challenge_rating =  $selectedLevel + $Lvl7to9[3];
                break;
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel + $Lvl10to12[4];
                break;
                case 13:
                    $challenge_rating = $selectedLevel - 1;
                    $challenge_rating2 = $selectedLevel - 2;
                 break;
            }
            $sql1 = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating2 ORDER by RAND() Limit 1";
            $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
        }
        else if ($selectedLevel == 2 && $random_monster > 1 || $selectedLevel == 2 && $random_monster == 13){
            switch($random_monster){
                case 2:
                  $challenge_rating =  $selectedLevel + $Lvl2[1];
                break;
                case 3:
                  $challenge_rating =  $selectedLevel + $Lvl3[2];
                 break;
                case 4:
                  $challenge_rating =  $selectedLevel + $Lvl4[3];
                 break;
                case 5:
                case 6:
                  $challenge_rating =  $selectedLevel + $Lvl5to6[4];
                break;
                case 7:
                case 8:
                case 9:
                  $challenge_rating =  $selectedLevel + $Lvl7to9[4];
                break;
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel + $Lvl10to12[5];
                break;
                case 13:
                    $challenge_rating = $selectedLevel - 1;
                    $challenge_rating2 = $selectedLevel - 1.5;
                 break;
            }
            $sql1 = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating2 ORDER by RAND() Limit 1";
            $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
        }
        else if ($selectedLevel == 1 && $random_monster > 1 || $selectedLevel == 1 && $random_monster == 13){
            switch($random_monster){
                case 2:
                  $challenge_rating =  $selectedLevel + $Lvl2[2];
                break;
                case 3:
                  $challenge_rating =  $selectedLevel + $Lvl3[3];
                 break;
                case 4:
                  $challenge_rating =  $selectedLevel + $Lvl4[4];
                 break;
                case 5:
                case 6:
                  $challenge_rating =  $selectedLevel + $Lvl5to6[5];
                break;
                //this works
                case 7:
                case 8:
                case 9:
                  $challenge_rating =  $selectedLevel + $Lvl7to9[5];
                break;
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel + $Lvl10to12[6];
                break;
                case 13:
                    $challenge_rating = $selectedLevel - .5;
                    //doesn't work for levels 1-3
                    $challenge_rating2 = $selectedLevel - .667;
                 break;
            }
            $sql1 = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating2 ORDER by RAND() Limit 1";
            $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
        }
       //this switch is for all of the levels that conform to a certain pattern
       else {
            switch($random_monster){
                case 1:
                $math = rand(0,1);
                $challenge_rating =  $selectedLevel + $math;
                $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                break;
                case 2:
                  $challenge_rating = $selectedLevel - 2;
                 $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                break;
                case 3:
                  $challenge_rating =  $selectedLevel - 3;
                  $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                break;
                case 4:
                  $challenge_rating =  $selectedLevel - 4;
                  $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                break;
                case 5:
                case 6:
                  $challenge_rating =  $selectedLevel - 5;
                  $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                break;
                case 7:
                case 8:
                case 9:
                  $challenge_rating =  $selectedLevel - 6;
                  $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                break;
                case 10:
                case 11:
                case 12:
                  $challenge_rating =  $selectedLevel - 7;
                  $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                break;
                case 13:
                    $challenge_rating = $selectedLevel - 1;
                    $challenge_rating2 = $selectedLevel -3;
                $sql = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating ORDER by RAND() Limit 1";
                $sql1 = "SELECT m.*, s.siname FROM monster m INNER JOIN size s ON m.siid = s.siid WHERE challenge_rating = $challenge_rating2 ORDER by RAND() Limit 1";
                 break;
                }
       }
       //challenge ratings that are decimals are displayed as fractions
if($challenge_rating < 1){     
function decimalToFraction($challenge_rating)
{
    //global $challenge_rating;
    // if ($challenge_rating < 0 || !is_numeric($challenge_rating)) {
    //     // Negative digits need to be passed in as positive numbers
    //     // and prefixed as negative once the response is imploded.
    //     return false;
    // }
    if ($challenge_rating == 0) {
        return [0, 0];
    }

    $tolerance = 1.e-2;

    $numerator = 1;
    $h2 = 0;
    $denominator = 0;
    $k2 = 1;
    $b = 1 / $challenge_rating;
    do {
        $b = 1 / $b;
        $a = floor($b);
        $aux = $numerator;
        $numerator = $a * $numerator + $h2;
        $h2 = $aux;
        $aux = $denominator;
        $denominator = $a * $denominator + $k2;
        $k2 = $aux;
        $b = $b - $a;
    } while (abs($challenge_rating - $numerator / $denominator) > $challenge_rating * $tolerance);
    
    return [
        $numerator,
        $denominator
    ];
}
    $fraction = decimalToFraction($challenge_rating);
}//end if   
if($challenge_rating2 < 1){     
function decimalToFraction2($challenge_rating2)
{       global $fraction;
    //global $challenge_rating;
    // if ($challenge_rating < 0 || !is_numeric($challenge_rating)) {
    //     // Negative digits need to be passed in as positive numbers
    //     // and prefixed as negative once the response is imploded.
    //     return false;
    // }
    if ($challenge_rating2 == 0) {
        return [0, 0];
    }

    $tolerance = 1.e-2;

    $numerator = 1;
    $h2 = 0;
    $denominator = 0;
    $k2 = 1;
    $b = 1 / $challenge_rating2;
    do {
        $b = 1 / $b;
        $a = floor($b);
        $aux = $numerator;
        $numerator = $a * $numerator + $h2;
        $h2 = $aux;
        $aux = $denominator;
        $denominator = $a * $denominator + $k2;
        $k2 = $aux;
        $b = $b - $a;
    } while (abs($challenge_rating2 - $numerator / $denominator) > $challenge_rating2 * $tolerance);
    
    return [
        $numerator,
        $denominator
    ];
}
    $fraction2 = decimalToFraction2($challenge_rating2);
}//end if 
            
            echo "<div class=\"row\" style=\"text-align:left;\">";
            echo "<div class=\"col\">";
            echo "<b>Encounter Level: </b>";
            echo $selectedLevel;
            echo "<br>";
            //display 13 as pair
            if($random_monster == "13"){
                echo "<b># of Monsters: </b>";
                echo "Pair";
            }else{
                echo "<b># of Monsters: </b>";
                echo $random_monster;
            }

  //run the query and fetch the data
        $result = $srdConnect->query($sql);
        while($row = $result->fetch()){
            echo "<h2>".$row['name'] . "</h2>";
            echo "<p><b>".$row['siname'] . " ".$row['type']. " (".$row['name'] ." ";
            if(!empty ($row['alignment'])){
            echo ", ".$row['alignment']. ") ". "</b></p>";
            }else{
                echo ")</b></p>";
            }
            echo "<div style=\"font-size:15pt;\">";
            echo "<table class=\"dd\">";
            echo "<tr><th>STR</th><th>DEX</th><th>CON</th><th>INT</th><th>WIS</th><th>CHA</th></tr>";
            echo "<tr><td>".$row['strength'] . "</td><td>".$row['dexterity'] . "</td><td>".$row['constitution'] . "</td><td>".$row['intelligence'] . "</td><td>".$row['wisdom'] . "</td><td>".$row['charisma'] . "</td><td>";
            echo "</table>";
        	echo "<b>Hit Dice: </b>".$row['hit_dice'] . "<br>";
        	echo "<b>Initiative: </b>".$row['initiative'] . "<br>";
        	echo "<b>Speed: </b>".$row['speed'] . "<br>";
        	echo "<b>Armor Class: </b>".$row['armor_class'] . "<br>";
        	echo "<b>Base Attack: </b>".$row['base_attack'] . "<b>  Grapple: </b>".$row['grapple'] . "<br>";
        	echo "<b>Attack: </b>".$row['attack'] . "<br>";
        	echo "<b>Full Attack: </b>".$row['full_attack'] . "<br>";
        	echo "<b>Space: </b>".$row['space'] . "   <b>Reach: </b>".$row['reach'] . "<br>";
        	echo "<b>Special Attacks: </b>".$row['special_attacks'] . "<br>";
        	echo "<b>Special Qualities: </b>".$row['special_qualities'] . "<br>";
        	echo "<b>Saves: </b>".$row['saves'] . "<br>";
        	if(!empty($row['skills'])){
        	echo "<b>Skills: </b>".$row['skills'] . "<br> ";
        	}
        	if(!empty($row['feats']) && empty($row['bonus_feats'])){
        	echo "<b>Feats: </b>".$row['feats'] . "<br>";
        	}
        	if(!empty($row['feats']) && !empty($row['bonus_feats'])){
        	echo "<b>Feats: </b>".$row['feats'] . "  ";
        	}
        	if(!empty($row['bonus_feats'])){
        	echo "<b>Bonus Feats: </b></b>".$row['bonus_feats'] . "<br>";
        	}
        	if(!empty($row['epic_feats'])){
        	echo "<b>Epic Feats: </b>".$row['epic_feats'] . "<br>";
        	}
        	if(!empty($row['advancement'])){
        	echo "<b>Advancement: </b>".$row['advancement'] . "<br>";
        	}
        	if(!empty($row['special_abilities'])){
        	echo "<b>Special Abilities: </b>".$row['special_abilities'] . "<br>";
        	}
        	if(!empty($row['stat_block'])){
        	echo "<b>Stat Block: </b>".$row['stat_block'] . "<br>";
        	}
        	if(!empty($row['environment'])){
        	echo "<b>Environment: </b>".$row['environment'] . "<br>";
        	}
        	if(!empty($row['organization'])){
        	echo "<b>Organization: </b>".$row['organization'] . "<br>";
        	}
        	if($challenge_rating < 1){
        	    echo "<b>Challenge Rating: </b>{$fraction[0]}/{$fraction[1]}\n";
        	    echo "<br>";
        	}else{
        	echo "<b>Challenge Rating: </b>$challenge_rating <br>";
        	}
        	if(!empty($row['treasure'])){
        	echo "<b>Treasure: </b>".$row['treasure'] . "<br>";
        	}
        	echo "</div>";
        	echo "</div>";
        }
        echo "<div class=\"row\" style=\"text-align:left;\">";
        echo "<div class=\"col\">";
        if($random_monster == 13){
        	
        $result = $srdConnect->query($sql1);
        while($row = $result->fetch()){
            echo "<br>";
            echo "<h2>".$row['name'] . "</h2>";
            echo "<p><b>".$row['siname'] . " ".$row['type']. " (".$row['name'] ." ";
            if(!empty ($row['alignment'])){
            echo ", ".$row['alignment']. ") ". "</b></p>";
            }else{
                echo ")</b></p>";
            }
            echo "<div style=\"font-size:15pt;\">";
            echo "<table class=\"dd\">";
            echo "<tr><th>STR</th><th>DEX</th><th>CON</th><th>INT</th><th>WIS</th><th>CHA</th></tr>";
            echo "<tr><td>".$row['strength'] . "</td><td>".$row['dexterity'] . "</td><td>".$row['constitution'] . "</td><td>".$row['intelligence'] . "</td><td>".$row['wisdom'] . "</td><td>".$row['charisma'] . "</td><td>";
            echo "</table>";
        	echo "<b>Hit Dice: </b>".$row['hit_dice'] . "<br>";
        	echo "<b>Initiative: </b>".$row['initiative'] . "<br>";
        	echo "<b>Speed: </b>".$row['speed'] . "<br>";
        	echo "<b>Armor Class: </b>".$row['armor_class'] . "<br>";
        	echo "<b>Base Attack: </b>".$row['base_attack'] . "<b>  Grapple: </b>".$row['grapple'] . "<br>";
        	echo "<b>Attack: </b>".$row['attack'] . "<br>";
        	echo "<b>Full Attack: </b>".$row['full_attack'] . "<br>";
        	echo "<b>Space: </b>".$row['space'] . "   <b>Reach: </b>".$row['reach'] . "<br>";
        	echo "<b>Special Attacks: </b>".$row['special_attacks'] . "<br>";
        	echo "<b>Special Qualities: </b>".$row['special_qualities'] . "<br>";
        	echo "<b>Saves: </b>".$row['saves'] . "<br>";
        	if(!empty($row['skills'])){
        	echo "<b>Skills: </b>".$row['skills'] . "<br> ";
        	}
        	if(!empty($row['feats']) && empty($row['bonus_feats'])){
        	echo "<b>Feats: </b>".$row['feats'] . "<br>";
        	}
        	if(!empty($row['feats']) && !empty($row['bonus_feats'])){
        	echo "<b>Feats: </b>".$row['feats'] . "  ";
        	}
        	if(!empty($row['bonus_feats'])){
        	echo "<b>Bonus Feats: </b></b>".$row['bonus_feats'] . "<br>";
        	}
        	if(!empty($row['epic_feats'])){
        	echo "<b>Epic Feats: </b>".$row['epic_feats'] . "<br>";
        	}
        	if(!empty($row['advancement'])){
        	echo "<b>Advancement: </b>".$row['advancement'] . "<br>";
        	}
        	if(!empty($row['special_abilities'])){
        	echo "<b>Special Abilities: </b>".$row['special_abilities'] . "<br>";
        	}
        	if(!empty($row['stat_block'])){
        	echo "<b>Stat Block: </b>".$row['stat_block'] . "<br>";
        	}
        	if(!empty($row['environment'])){
        	echo "<b>Environment: </b>".$row['environment'] . "<br>";
        	}
        	if(!empty($row['organization'])){
        	echo "<b>Organization: </b>".$row['organization'] . "<br>";
        	}
        	if($challenge_rating < 1){
        	    echo "<b>Challenge Rating: </b>{$fraction2[0]}/{$fraction2[1]}\n";
        	    echo "<br>";
        	}else{
        	echo "<b>Challenge Rating: </b>$challenge_rating2 <br>";
        	}
        	if(!empty($row['treasure'])){
        	echo "<b>Treasure: </b>".$row['treasure'] . "<br>";
        	}
        	//echo "Full Text: ".$row['full_text'] . "<br>";
        	echo "</div>";
        	echo "</div>";
        }//end while
           }//end if
        //}//end if
    }
  challenge_rating($selectedLevel);  

}


}else{ // if not logged in
	header("Location: ".$config_basedir);
}//end if
require("footer.php");
   /*
App: HGC
Author: Rachel Sokol
Description: This page is to generate the appropriate monster based on CR, number of monsters and Encounter level
Editor: Rachel Sokol
Date Edited: 1/11/24
Last made Changes: added description
*/
?>
