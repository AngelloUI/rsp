<?php
$players_amount = null;
$bots_amount = null;
$input_params = null;
if (isset($_POST['input_params']) && isset($_POST['bots_amount']) && isset($_POST['players_amount'])) {
    $input_params = trim($_POST['input_params']," ");
    $input_params = explode(" ", $input_params);
    if (count($input_params) % 2 == 0){
        echo "amount of your params is even. Correct it";
    }else{
        $bots_amount = (int)($_POST['bots_amount']);
        $players_amount = (int)($_POST['players_amount']);

    }
} else {
    echo "wrong input data",'<br>';
}