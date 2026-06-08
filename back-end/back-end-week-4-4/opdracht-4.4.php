<?php
$pokemonHealth = [100, 80, 75, 25];
$counter = 0;

while(count($pokemonHealth) > $counter){
    if($pokemonHealth[$counter] >= 50){
        echo "Pokemon number is in good health.<br>";
    }
    else{
        echo "This pokemon is in bad health.";
    }
    $counter++;
}
?>