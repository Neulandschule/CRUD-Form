<?php
session_start();
require "database.php";

if(isset($_SESSION['auth'])) {
    if ($_SESSION['auth'] == true) {
        header("location: welcome.php");
        exit;
    }
}

$email = $pwd = "";
$errors = [];

$ip = $_SERVER['REMOTE_ADDR'];
$limit = 3;
$timeout_min = 10;
$timeout = getTimeout($limit, $timeout_min, $db, $ip);

function setAttempts($db, $ip) {
    $sql = "INSERT INTO loginfails (ip) VALUES (?);";
    $stmt = $db->prepare($sql);
    $stmt->execute([$ip]);
}

function getTimeout($limit, $timeout_min, $db, $ip) {
    $sql = "SELECT COUNT(*) FROM loginfails WHERE ip = ? AND created_at > now() - interval ? minute;";
    $stmt = $db->prepare($sql);
    $stmt->execute([$ip, $timeout_min]);
    $data = $stmt->fetch();
    $tries = $data[0];

    if ($tries >= $limit) {
        return true;
    }
    return false;
}



if ($timeout) {
    echo "Limit erreicht. Bitte warte $timeout_min Minute(n).";
}
else {


    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $pwd = trim($_POST['pwd']);
    
        if ($email == '' || $pwd == '') {
            array_push($errors, 'Eingabe fehlt.');
        }
    
        if (empty($errors)) {
            $sql = "SELECT id, username, password FROM users WHERE email = ?;";
            $stmt = $db->prepare($sql);
            $stmt->execute([$email]);
            $data = $stmt->fetch();
    
            if (!$data) {
                array_push($errors, 'E-Mail nicht gefunden.');
                setAttempts($db, $ip);
            }
            else {
                if (password_verify($pwd, $data['password'])) {
                    $_SESSION["auth"] = true;
                    $_SESSION["id"] = $data['id'];
                    $_SESSION["username"] = $data['username'];  
                    header("location: welcome.php");
                }
                else {
                    array_push($errors, 'Passwort falsch.');
                    setAttempts($db, $ip);
                }
            }
    
        }
    }

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

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <p> 
            <label for="email">E-Mail</label>
            <input type="text" id="email" name="email">
        </p>

        <p> 
            <label for="pwd">Password</label>
            <input type="password" id="pwd" name="pwd">
        </p>

        <p>
            <input type="submit" value="Login" name="login">
        </p>


    </form>

    <p>
        <?php
            foreach($errors as $error) {
                echo $error."<br>";
            }
        ?>
    </p>
    
</body>
</html>