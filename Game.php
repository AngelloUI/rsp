<?php

final class Game
{
    private int $players_amount;
    private int $bots_amount;
    private array $input_params;
    private array $players_moves;
    private array $bots_moves;

    public function __construct($players_amount, $bots_amount, $input_params, $players_moves)
    {
        $this->players_amount = $players_amount;
        $this->bots_amount = $bots_amount;
        $this->input_params = $input_params;
        $this->players_moves = $players_moves;
        for ($i = 0; $i < $players_amount; ++$i){
            echo "player{$i} move: {$this->players_moves[$i]}","<br>";
        }
        $this->generateBotsMoves();
    }

    private function generateBotsMoves(): void
    {
        for ($i = 0; $i < $this->bots_amount; ++$i) {
            $this->bots_moves[$i] = $this->input_params[rand(0, count($this->input_params)-1)];
            echo "bot{$i} move: {$this->bots_moves[$i]}","<br>";
        }
    }

    public function generateTableOfWDL(): void
    {
        echo "<table>";
        for ($i = 0; $i <= count($this->input_params); ++$i){
            echo "<tr>";
            if ($i == 0){
                echo "<th></th>";
                for ($j = 0; $j < count($this->input_params); ++$j){
                    echo "<th>{$this->input_params[$j]}</th>";
                }
            }else{
                echo "<th>{$this->input_params[$i-1]}</th>";
                for ($j = 1; $j <= count($this->input_params); ++$j){
                    if ($this->winner($this->input_params[$i-1],$this->input_params[$j-1]) == "FIRST"){
                        echo "<td>WIN</td>";
                    }
                    if ($this->winner($this->input_params[$i-1],$this->input_params[$j-1]) == "SECOND"){
                        echo "<td>LOSE</td>";
                    }
                    if ($this->winner($this->input_params[$i-1],$this->input_params[$j-1]) == "DRAW"){
                        echo "<td>DRAW</td>";
                    }
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>","<br>","<br>","<br>";
    }

    private function winner($player1Move, $player2Move): string
    {
        if ($player1Move == $player2Move) {
            return "DRAW";
        }
        $player1MoveIndex = 0;
        for ($i = 0; $i < count($this->input_params); ++$i) {
            if ($player1Move == $this->input_params[$i]) {
                $player1MoveIndex = $i;
            }
        }
        if ($player1MoveIndex > (count($this->input_params) - 1) / 2) {
            $i = (count($this->input_params) - 1) / 2;
            $currentPreIndex = $player1MoveIndex - 1;
            while ($i != 0) {
                if ($player2Move == $this->input_params[$currentPreIndex]) {
                    return "SECOND";
                }
                --$i;
                --$currentPreIndex;
            }
            return "FIRST";
        }
        if ($player1MoveIndex <= (count($this->input_params) - 1) / 2) {
            $i = (count($this->input_params) - 1) / 2;
            $currentNextIndex = $player1MoveIndex + 1;
            while ($i != 0) {
                if ($player2Move == $this->input_params[$currentNextIndex]) {
                    return "FIRST";
                }
                --$i;
                ++$currentNextIndex;
            }
            return "SECOND";
        }
        return "STH is wrong";
    }

    public function findWinner(): string
    {
        $currentMove = $this->players_moves[0];
        $wins = array();
        $loses = array();
        $draws = array();
        $l_move = "";
        $d_move = "";
        for ($i = 0; $i < $this->players_amount; ++$i) {
            if ($this->winner($currentMove,$this->players_moves[$i]) === "FIRST"){
                $wins[] = "player$i";
            }
            if ($this->winner($currentMove,$this->players_moves[$i]) === "SECOND"){
                $loses[] = "player$i";
                $l_move = $this->players_moves[$i];
            }
            if ($this->winner($currentMove,$this->players_moves[$i]) === "DRAW"){
                $draws[] = "player$i";
                $d_move = $currentMove;
            }
        }
        for ($i = 0; $i < $this->bots_amount; ++$i) {
            if ($this->winner($currentMove,$this->bots_moves[$i]) === "FIRST"){
                $wins[] = "bot$i";
            }
            if ($this->winner($currentMove,$this->bots_moves[$i]) === "SECOND"){
                $loses[] = "bot$i";
            }
            if ($this->winner($currentMove,$this->bots_moves[$i]) === "DRAW"){
                $draws[] = "bot$i";
            }
        }
        if ((!empty($wins) && !empty($loses) && !empty($draws)) || (empty($wins) && empty($loses) && empty($draws))){
            return "DRAWWWWWW";
        }
        if (empty($loses)){
            for ($i = 0; $i < count($draws); ++$i){
                echo $draws[$i], "<br>";
            }
            echo "<br>";
            return "move: $d_move";
        }
        if (empty($wins)){
            for ($i = 0; $i < count($loses); ++$i){
                echo $loses[$i], "<br>";
            }
            echo "<br>";
            return "move: $l_move";
        }
        return "sth is wrong";
    }
}