<?php
$pokemonTypes = ["Fire", "Water", "Grass"];
$selectedType = "Fire";

if($selectedType == $pokemonTypes[0]){
    echo $selectedType . " is weak against water";
}
elseif($selectedType == $pokemonTypes[1]){
    echo $selectedType . " is weak against grass";
}
else{
    echo $selectedType . " is weak against fire";
}
?>