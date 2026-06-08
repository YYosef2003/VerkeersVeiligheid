<?php
$attackPower = [60, 80, 90];
$desiredPower = 90;
for($i=0;$i<3;$i++){
    if($attackPower[$i] == $desiredPower){
        echo "An attack with a power of " . $desiredPower . " has been found!";
    }
    elseif ($i == 2){
        echo "No matches have been found";
    }
}
?>