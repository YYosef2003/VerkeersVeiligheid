<?php
$pokemonList = ["Pikachu", "Charmander", "Infernape",
                "Chikorita", "Emboar", "Charizard"];
$specificPokemon = "Charizard";
$listCount = count($pokemonList) -1;

for($i=0;$i < count($pokemonList); $i++){
    if($pokemonList[$i] == $specificPokemon){
        echo $specificPokemon . " has been found in the list!";
        break;
    }
    elseif($pokemonList[$i] != $specificPokemon && $i == $listCount){
        echo $specificPokemon . " has not been found in the list.";
    }
}










/*$modifiedLenght = count($pokemonList) -1;
for ($i = 0; $i < count($pokemonList); $i++) {
    if ($pokemonList[$i] == $specificPokemon) {
        echo "Charizard has been found!<br>";
        break;
    } elseif($modifiedLenght == $i) {
        echo "$specificPokemon has not been found in the list.";
    }
} */
?>