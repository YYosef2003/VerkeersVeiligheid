<?php

global $pokemonTeam;

unset($pokemonTeam[1]);

$pokemonTeam = array_values($pokemonTeam); // Reset de indexen na verwijdering

echo "De tweede Pokémon is vertrokken. Mijn team nu bestaat uit: " . $pokemonTeam[0] . ", " . $pokemonTeam[1] . ", " . $pokemonTeam[2] . ".";

?>
