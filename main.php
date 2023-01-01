<?php
include "Game.php";
if (isset($_POST['players_amount']) && isset($_POST['bots_amount']) && isset($_POST['input_params'])) {
    $players_amount = (int)$_POST['players_amount'];
    $bots_amount = (int)$_POST['bots_amount'];
    $input_params = trim($_POST['input_params'], " ");
    $input_params = explode(" ", $input_params);
    $players_moves = array();
    for ($i = 0; $i < $players_amount; ++$i){
        $players_moves[$i] = $_POST["player$i"];
    }
    $game = new Game($players_amount, $bots_amount, $input_params, $players_moves);
    var_dump($game->findWinner());
}

