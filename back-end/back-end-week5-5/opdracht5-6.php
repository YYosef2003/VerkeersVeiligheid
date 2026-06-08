<?php
function calculateStats($baseLevel, $growthRate) {
    // Basisstatistieken van een willekeurige Pokémon (voorbeeldwaarden)
    $baseHP = 100;
    $baseAttack = 80;
    $baseDefense = 70;

    // Bereken de statistieken op basis van het niveau en de groeisnelheid
    $levelFactor = 0.5; // Aanpassen op basis van de specifieke groeisnelheid
    $currentHP = $baseHP + ($levelFactor * $baseLevel);
    $currentAttack = $baseAttack + ($levelFactor * $baseLevel);
    $currentDefense = $baseDefense + ($levelFactor * $baseLevel);

    // Druk de berekende statistieken af
    echo "Statistieken op niveau $baseLevel:\n";
    echo "HP: $currentHP\n";
    echo "Aanval: $currentAttack\n";
    echo "Verdediging: $currentDefense\n";
}

// Voorbeeldgebruik:
$baseLevel = 50; // Vervang door het gewenste basisniveau
$growthRate = "medium"; // Vervang door de specifieke groeisnelheid van de Pokémon

calculateStats($baseLevel, $growthRate);
?>
