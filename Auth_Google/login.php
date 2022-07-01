<?php
require_once 'vendor/autoload.php';
session_start();

if (isset($_SESSION["auth"])) {
    header("location: secret.php");
    exit;
}

$client = new Google\Client();
$client->setClientId('HIER ID EINFÜGEN');
$client->setClientSecret('HIER SECRET EINFÜGEN');
$client->setRedirectUri('http://localhost/php/google/login.php');
$client->addScope("email");
$client->addScope("profile");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form action="">
        <label for="email">E-Mail</label>
        <input type="email" id="email" name="email"><br>
        <label for="pwd">Password</label>
        <input type="password" id="pwd" name="pwd"><br>
        <input type="submit" value="Anmelden">
    </form>
    <p>Noch kein Konto? -> <a href="#">Registrieren</a></p>

    <?php
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        $oauth = new Google\Service\Oauth2($client);
        $info = $oauth->userinfo->get();
        //Datenbank
        $_SESSION['auth'] = true;
        $_SESSION['name'] = $info->name;
        header("location: secret.php");
    } else {
        echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
    }

    ?>
</body>

</html>