<?php
$pokemonMoves = ["Scratch" => "Scratch", "Growl" => "Growl", "Bite" => "Bite"];
$chosenMove = "Growl";

if($pokemonMoves[$chosenMove] == $chosenMove){
    echo "The trainer uses " . $pokemonMoves[$chosenMove];
}
?>