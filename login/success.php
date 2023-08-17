<?php
    require_once './config.php';
    include './header.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>
        <?php
            echo "Welcome " . $_SESSION["userDetails"]["username"] . "!";
        ?>
    </h3>
</body>
</html>