<?php
$typeStrengths = ["Fire" => "Grass", "Grass" => "Water", "Water" => "Fire"];
$chosenTypes = ["Fire", "Grass", "Water"];

for($i=0; $i < count($typeStrengths); $i++){
    echo $chosenTypes[$i] . " is stronger than "
        . $typeStrengths[$chosenTypes[$i]] . "<br>";
}
?>