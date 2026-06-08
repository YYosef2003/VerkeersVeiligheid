<?php
$attackType = getRandomAttackType();

function getRandomAttackType() {
    $attackTypes = ["Normal", "Fire", "Water", "Electric", "Grass", "Ice", "Fighting", "Poison", "Ground"];


    $randomIndex = rand(0, count($attackTypes) - 1);
    $attackType = $attackTypes[$randomIndex];

    echo "Het willekeurige aanvalstype is: $attackType";

    return $attackType;
}
?>
