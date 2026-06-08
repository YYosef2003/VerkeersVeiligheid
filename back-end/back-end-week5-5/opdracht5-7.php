<?php
function isTypeWeakAgainst($type1, $type2) {
$weaknesses = array(
"normal" => array("fighting"),
"fire" => array("water", "ground", "rock"),
"water" => array("electric", "grass")
);

return array_key_exists($type1, $weaknesses) && in_array($type2, $weaknesses[$type1]);
}
if (isTypeWeakAgainst("fire", "water")) {
echo "Fire is weak against water.";
} else {
echo "Fire is not weak against water.";
}
?>