<?php
$pokemonLevels = [5, 10, 15, 4, 6];

for($i=0; $i < count($pokemonLevels); $i++){
    if($pokemonLevels[$i] >= 10){
        echo "This level is greater than or equal to 10 <br>" ;
    }
    else{
        echo "This level is smaller than 10 <br>";
    }
}
?>