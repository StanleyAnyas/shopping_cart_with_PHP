<?php
session_start();
    $name = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
   <h2>Welcome <?php echo $name ?> </h2>
   <form action="formhandler2.php" method="POST">
       <label for="name">Favourite food</label>
       <input type="text" name="favourite_food" id="favourite_food" placeholder="Enter your favourite food">
       <input type="submit" name="submit" value="Submit"> 
</body>
</html>
