<?php
$attackPower = [50, 60, 70, 80, 90, 100];
$counter = 0;

while(true){
    if($attackPower[$counter] >= 80){
        echo "There's at least one attack with
              an attack power equal to or higher than 80.";
        break;
    }
    elseif($counter >= count($attackPower) -1){
        echo "No attack with a power of 80 or higher was found.";
        break;
    }
    $counter++;
}
?>