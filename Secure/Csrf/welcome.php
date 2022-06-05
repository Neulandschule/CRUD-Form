<?php
session_start();

if (!isset($_SESSION["loggedin"])) {
    header("location: login.php");
    exit;
}


if (isset($_POST['logout'])) {
    unset($_SESSION["csrf_token"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["name"]);
    header('Location: login.php');
}

if (isset($_POST['send'])) {
    if ($_POST['csrf_token'] === $_SESSION["csrf_token"]) {
        echo $_SESSION["name"] . ' hat ' . $_POST['amount'] . ' an ' . $_POST['account'] . ' überwiesen.';
    } else {
        echo "Ungültiger Token";
    }
} else {
    $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
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
    <h1>Konto</h1>
    <form action="welcome.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? '' ?>">
        <p>
            <label for="amount">Betrag</label>
            <input id="amount" type="number" name="amount"><br>
        </p>
        <p>
            <label for="account">an Konto</label>
            <input id="account" type="text" name="account"><br>
        </p>
        <p>
            <input type="submit" name="send" value="Überweisen">
        </p>
    </form>

    <form action="welcome.php" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>

</html>