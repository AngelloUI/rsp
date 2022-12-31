<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>rsp</title>
</head>
<body>
<div>
    <form action="input-page.php" method="post">
        <input name="input_params" type="text" size="25">
        <p>
            <span>players</span><br>
            <input name="players_amount" type="number" min="0" max="10" value="0">
        </p>
        <p>
            <span>computers</span><br>
            <input name="bots_amount" type="number" min="0" max="10" value="0">
        </p>
        <input type="reset" value="очистить">
        <input type="submit" value="отправить">
        <p>
            how to play?
        </p>
    </form>
</div>
</body>
</html>