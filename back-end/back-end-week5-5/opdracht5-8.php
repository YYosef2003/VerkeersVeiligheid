<?php
function battlePokemon($pokemon1, $pokemon2)
{
    $pokemon1Health = rand(1, 100);
    $pokemon2Health = rand(1, 100);

    if ($pokemon1Health > $pokemon2Health) {
        echo "$pokemon1 heeft het gevecht gewonnen!";
    } else if ($pokemon2Health > $pokemon1Health) {
        echo "$pokemon2 wint het gevecht!";
    } else {
        echo "Het gevecht is geeindigt in een gelijkspel";
    }
}

battlePokemon("Pikachu", "Charizard");
?>
