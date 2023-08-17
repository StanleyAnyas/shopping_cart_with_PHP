<?php

$username = "stanley";
$password = "Okwukweamaka2001";
$options = [
    'cost' => 12,
];

$salt = bin2hex(random_bytes(32));
$pepper = "WeWillUseThisToPepperTheUsername";

echo "Salt: " . $salt . "<br>";

$dataToHash = $pepper . $username . $salt;

$hashedData = hash("sha256", $dataToHash);
$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options); // this means that the password is hashed using bcrypt and the cost is 12 which means that the password is hashed 2^12 times meaning that it is hashed 4096 times
echo "Hashed Password: " . $hashedPassword . "<br>";
echo "Hashed Data: " . $hashedData . "<br>";

/*************************************/

$thePepper = $pepper;
$storedSaltedHash = $salt;

$username2 = "stanley";

$verifyDataToHash = $thePepper . $username2 . $storedSaltedHash;

$verifyHashedData = hash("sha256", $verifyDataToHash);
echo "Verify Hashed Data: " . $verifyHashedData . "<br>";

if($verifyHashedData == $hashedData){
    echo "User Verified";
}else{
    echo "User Not Verified";
}
echo "<br>";
$pwdOnLogin = "Okwukweamaka2001";

if(password_verify($pwdOnLogin, $hashedPassword)){
    echo "Correct Password";
}else{
    echo "Incorrect Password";
}
