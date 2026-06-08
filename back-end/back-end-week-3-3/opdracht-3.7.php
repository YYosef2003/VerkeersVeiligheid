<?php
$pokemonHealth = [70, 90, 60];
$pokemonTally = 0;

for($i=0;$i<2;$i++) {
    if ($pokemonHealth[$i] >= 70) {
        $pokemonTally++;
    }
}
echo $pokemonTally . " pokemon are in good health."
?>