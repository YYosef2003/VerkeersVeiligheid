<?php
$pokemonTeam = ["Charmander", "Bulbasaur", "Squirtle"];
$newPokemon = ["Pidgey"];
$pokemonTeam = array_merge($pokemonTeam, $newPokemon);
echo "This is my pokemon team: ";

for($i=0; $i<count($pokemonTeam);$i++){
    echo $pokemonTeam[$i]. ", ";
}
?>