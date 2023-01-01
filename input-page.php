<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rsp</title>
</head>
<body>
<?php
$players_amount = null;
$bots_amount = null;
$input_params = null;
if (isset($_POST['input_params']) && isset($_POST['bots_amount']) && isset($_POST['players_amount'])) {
    $input_params = trim($_POST['input_params'], " ");
    $input_params = explode(" ", $input_params);
    if (count($input_params) % 2 == 0) {
        echo "amount of your params is even. Correct it";
    } else {
        $bots_amount = (int)($_POST['bots_amount']);
        $players_amount = (int)($_POST['players_amount']);
        echo "<form action='main.php' method='post'>";
        for ($i = 0; $i < $players_amount; ++$i) {
            echo "Player{$i}", "<select name='player$i'>";
            for ($j = 0; $j < count($input_params); ++$j) {
                echo "<option>", $input_params[$j], "</option>";
            }
            echo "</select>", "<br>";
        }
        echo "<br>", "<input type='submit' value='отправить'>", " ", "<input type='reset' value='очистить'>";
        echo "<input type='number' value='$players_amount' name='players_amount' hidden >";
        echo "<input type='number' value='$bots_amount' name='bots_amount' hidden >";
        $input_params = $_POST['input_params'];
        echo "<input type='text' value='$input_params' name='input_params' hidden >";
        echo "</form>";
    }
} else {
    echo "wrong params";
}
?>
</body>
</html>