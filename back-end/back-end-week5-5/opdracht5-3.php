<?php
function isTypeStrongAgainst($type1, $type2){
    $typeStrengths = ["Fire" => "Grass", "Water" => "Fire","Grass" => "Water"];

    if($typeStrengths[$type1] == $type2){
        echo "The type" . $type1 . " is strong against " . $typeStrengths[$type1];
    } else {
        echo"Het type " . $type1 . "   is niet sterk tegenover het type Grass. ";
    }
}

isTypeStrongAgainst("Water", "Grass");
?>
