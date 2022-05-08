<?php
    if (isset($_POST['submit_btn'])) {
        echo "Hallo Welt";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Secure</title>
</head>
<body>

    <h1>XSS - SELF_PHP Exploit</h1>

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
        <input type="submit" name="submit_btn">
    </form>

    <a href="http://localhost/xss_php_self.php/%22%3E%3Cscript%3Ealert('xss')%3C/script%3E%3Cxxx%22">Attack</a>


</body>
</html>

<!--
    %22 = "
    %3C = <
    %3E = > 
    
    "><script>alert('xss')</script><xxx"
    %22%3E%3Cscript%3Ealert('xss')%3C/script%3E%3Cxxx%22
-->