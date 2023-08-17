<?php
declare(strict_types=1);

function isInputEmpty(string $username, string $password, string $email): bool
{
    if (empty($username) || empty($password) || empty($email)) {
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

function sanitizeInput(string $username, string $password, string $email): array
{
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    return [$username, $password, $email];
}