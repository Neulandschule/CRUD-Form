<?php
session_start();

if (isset($_POST['login'])) {
    if ($_POST['pwd'] == '123') {
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = 'Tim';
    }
    header('Location: welcome.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <p>
            <label for="pwd">Passwort</label>
            <input id="pwd" type="text" name="pwd"><br>
        </p>
        <p>
            <input type="submit" name="login" value="Login">
        </p>
    </form>
</body>

</html>