<?php
$pokemonTeam = ["Charmander", "Bulbasaur", "Squirtle", "Pidgey"];

$extraPokemon = ["Meowth", "Psyduck", "Rattata"];
$pokemonTeam = array_merge($pokemonTeam, $extraPokemon); // Voeg extra Pokémon toe aan ons team.


echo "MIjn nieuwe team is nu: " . $pokemonTeam[0]." , " . $pokemonTeam[1] . ", " .
    $pokemonTeam[2].",  " . $pokemonTeam[3] . ", " . $pokemonTeam[4]. " "  . $pokemonTeam[5] . ", " . $pokemonTeam[6];

