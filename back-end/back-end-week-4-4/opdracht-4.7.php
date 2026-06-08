<?php
$pokemonEvolution = ["Chikorita" => "Bayleaf", "Pidgey" => "Pidgeotto",
                     "Bayleaf" => "Meganium", "Cyndaquil" => "Typhlosion"];
$chosenPokemon = ["Chikorita", "Pidgey", "Bayleaf", "Cyndaquil"];

for($i=0;$i < count($pokemonEvolution); $i++){
    echo $pokemonEvolution[$chosenPokemon[$i]] . " ";
}
?>