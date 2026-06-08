<?php
$pokemonHealth = [60, 80, 90, 40, 30, 10];

for($i=0;$i<count($pokemonHealth); $i++){
    if($pokemonHealth[$i] < 40){
        echo "At least one pokemon is unhealthy.";
        break;
    }
    else{
        echo "This pokemon is healthy <br>";
    }
}
?>