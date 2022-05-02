<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=crud', 'root', '');
} catch (PDOExcepton $e) {
    echo $e->getMessage();
    exit;
}

$create_status = '';
$edit_status = '';
$show_edit = false;

if(isset($_POST['btnCreate'])) {
    $firstname = htmlentities($_POST['firstname']);
    $lastname = htmlentities($_POST['lastname']);

    $sql = "INSERT INTO users (firstname, lastname) 
            VALUES (?, ?);";
    $stmt = $db->prepare($sql);
    if ($stmt->execute([$firstname, $lastname])) {
        $create_status = 'Datensatz hinzugefügt.';
    }
    
}




//Edit
if(isset($_POST['btnSelectEdit'])) {
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_POST['edit_id']]);
    $data_edit = $stmt->fetchAll();
    $show_edit = true;
}

if(isset($_POST['btnUpdate'])) {
    $id = htmlentities($_POST['edit_id']);
    $firstname = htmlentities($_POST['firstname']);
    $lastname = htmlentities($_POST['lastname']);

    $sql = "UPDATE users
            SET firstname=?, lastname=?
            WHERE id=?;";
    $stmt = $db->prepare($sql);
    if ($stmt->execute([$firstname, $lastname, $id])) {
        $edit_status = 'Datensatz geänder.';
    }
}

if(isset($_POST['btnDelete'])) {
    $id = htmlentities($_POST['delete_id']);
    $sql = "DELETE FROM users
            WHERE id=?;";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

}

//READ
$sql = "SELECT * FROM users";
$stmt = $db->query($sql);
$data = $stmt->fetchAll();


?>

<body>
    
    <h1>CRUD</h1>

    <h2>Create</h2>

    <form action="crud_form.php" method="POST">
        <label for="firstname">Vorname</label>
        <input id="firstname" type="text" name="firstname"><br>
        <label for="lastname">Nachname</label>
        <input id="lastname" type="text" name="lastname"><br>
        <input type="submit" name="btnCreate">
    </form>
    <?php echo $create_status ?>


    <h2>Read</h2>
    <?php
        foreach ($data as $user) {
            echo $user['firstname'].' '. $user['lastname'];
            ?>
            <form action="crud_form.php" method="POST">
                <input type="hidden" name="edit_id" value="<?php echo $user['id'] ?>">
                <input type="submit" name="btnSelectEdit" value="Edit">
            </form>
            <form action="crud_form.php" method="POST">
                <input type="hidden" name="delete_id" value="<?php echo $user['id'] ?>">
                <input type="submit" name="btnDelete" value="Löschen">
            </form>
            <?php
            echo '<br>';
        }
    ?>

    <h2>Update</h2>
    
    <? if ($show_edit): ?>
    <form action="crud_form.php" method="POST">
        <input type="hidden" name="edit_id" value="<?php echo $data_edit[0]['id'] ?>">
        <label for="firstname">Vorname</label>
        <input id="firstname" type="text" name="firstname" value="<?php echo $data_edit[0]['firstname'] ?>"><br>
        <label for="lastname">Nachname</label>
        <input id="lastname" type="text" name="lastname" value="<?php echo $data_edit[0]['lastname'] ?>"><br>
        <input type="submit" name="btnUpdate">
    </form>
    <? endif; ?>
    <?php echo $edit_status ?>


</body>
</html>