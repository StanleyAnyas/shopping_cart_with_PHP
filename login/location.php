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
    <h3>
        This is the location page
    </h3>
    <?php
        if(isset($_SESSION['username'])){
            echo "Welcome " . $_SESSION['username'];
        }else{
            echo '<script type="text/javascript">alert("Please login");</script>';
            header("location: index.php");
            exit();
        }
    ?>
</body>
</html>
<?php
    include './footer.html';