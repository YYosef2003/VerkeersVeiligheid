<?php
$pokemonHealth = ["Charizard" => 100, "Turtwig" => "60"];
$selectedPokemon = "Turtwig";

//switch ($pokemonHealth[$selectedPokemon]){
//    case "Turtwig":
//        echo "test";
//        break;
//    case "test":
//}

if ($pokemonHealth[$selectedPokemon] == 100) {
    echo "The pokemon is in good health";
}
elseif ($pokemonHealth[$selectedPokemon] > 75){
    echo "The pokemon is in reasonable health";
}
elseif ($pokemonHealth[$selectedPokemon] > 50){
    echo "The pokemon is hurt";
}
elseif ($pokemonHealth[$selectedPokemon] > 25){
    echo "The pokemon is in critical condition";
}
else{
    echo "The pokemon has fainted";
}

?>