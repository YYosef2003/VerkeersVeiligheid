<?php
function evolePokemon($currentstage){
    $evolutionStages = [
        "Pichu" => "Pikachu",
        "Pikachu" => "Raichu",
        "Charmander" => "Charmeleon",
        "Charmeleon" => "Charizard"
        ];

if (array_key_exists($currentstage,$evolutionStages)){
    $newStage = $evolutionStages[$currentStage];
    echo "De Pokémon is geëvolueerd naar $newStage!";
} else {
    echo "De Pokémon heeft geen verdere evolutie.";
}
}
?>
