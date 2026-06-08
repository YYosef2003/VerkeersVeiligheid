<?php

$pokemonTeam = ["Bulbasaur", "Squirtle", "Charmander","Pidgey"];
$duplicatePokemon = "Squirtle";
$pokemonTeam[] = $duplicatePokemon;
$newTeam = ["Jigglypuff", "Meowth", "Psyduck"];
$pokemonTeam = array_merge($pokemonTeam, $newTeam);
shuffle($pokemonTeam);
echo "My team consists of ";
for($i=0;$i<count($pokemonTeam);$i++){
    echo $pokemonTeam[$i] . ", ";
}
