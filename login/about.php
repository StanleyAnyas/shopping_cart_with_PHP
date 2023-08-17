<?php
    require_once './config.php';
    include './header.html';
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
    <div>
    <?php
        if(isset($_SESSION['username'])){
            echo "Welcome " . $_SESSION['username'];
        }else{
            echo '<script type="text/javascript">alert("Please login");</script>';
            header("location: index.php");
            exit();
        }
    ?>
    </div>
    <form action = "about.php" method = "post">
        <input type="submit" name="logout" value="logout">
    </form>
</body>
</html>

<?php
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("location: index.php");
        exit();
    }
    include './footer.html';