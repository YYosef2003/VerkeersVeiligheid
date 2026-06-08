<?php
$pokemonType = ["Fire" => "Grass", "Water" => "Fire", "Grass" => "Water"];
$chosenType = "Fire";
$enemyType = "Grass";

if($pokemonType[$chosenType] == $enemyType){
    echo $chosenType . " is strong against " . $pokemonType[$chosenType];
}
else{
    echo $chosenType . " isn't strong against " . $enemyType;
}
?>