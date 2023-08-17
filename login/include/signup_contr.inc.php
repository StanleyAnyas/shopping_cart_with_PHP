<?php

declare(strict_types=1);
require_once "signup_model.inc.php";

function isInputEmpty(string $username, string $password, string $confirm_password, $email): bool
{
    if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
        return true;
    }
    return false;
}

function isEmailValid(string $email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function isPasswordValid(string $password, string $confirm_password): bool
{
    if ($password !== $confirm_password) {
        return true;
    }
    return false;
}

function isUsernameTaken(string $username): bool
{
    if (checkUsernameIfTaken($username)){
        return true;
    }
    return false;
}

function isEmailTaken(string $email): bool
{
    if (checkEmailIfTaken($email)){
        return true;
    }
    return false;
}

// function hashed_password(string $password): string
// {
//     return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
// }