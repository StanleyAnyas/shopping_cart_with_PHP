<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <form action="formhandler.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Enter your name">
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>