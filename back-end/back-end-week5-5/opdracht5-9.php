<?php
$currentLevel = 10;
$experiencePoints = 1000;

calculateExperiencePoints($currentLevel, $experiencePoints);

function calculateExperiencePoints($currentLevel, $experiencePoints) {
    // Bereken het aantal ervaringspunten dat nodig is voor het volgende niveau
    $nextLevelExperiencePoints = $currentLevel * 100;

    // Als de ontvangen ervaringspunten voldoende zijn om naar het volgende niveau te gaan, verhoog dan het niveau met 1
    if ($experiencePoints >= $nextLevelExperiencePoints) {
        $newLevel = $currentLevel + 1;
    } else {
        // Anders blijft het niveau hetzelfde
        $newLevel = $currentLevel;
    }

    // Print het nieuwe ervaringsniveau
    echo "Het nieuwe ervaringsniveau is: $newLevel";
}
?>
