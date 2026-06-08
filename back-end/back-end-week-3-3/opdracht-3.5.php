<?php
$possibleTypes = ["Fire", "Water", "Electric"];
$chosenType = "Fire";

if($chosenType == $possibleTypes[0]){
    echo "The selected pokemon has the chosen type: ". $chosenType . "!";
}
else{
    echo "The selected pokemon doesn't have the chosen type: " . $chosenType;
}
?>