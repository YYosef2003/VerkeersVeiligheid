<?php
$attackPower = [100, 60, 30];
$selectedAttack = 0;

if ($attackPower[$selectedAttack] >= 100){
    echo "This attack has a very high attack power";
}
elseif ($attackPower[$selectedAttack] >= 70){
    echo "This attack has a high attack power";
}
elseif ($attackPower[$selectedAttack] > 30){
    echo "This attack has a moderate attack power";
}
else{
    echo "This attack has a low attack power";
}
?>