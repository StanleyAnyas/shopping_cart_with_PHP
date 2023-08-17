<?php
declare(strict_types=1);
require_once 'forget_model.inc.php';

function isInputEmpty($email, $password, $confirmNewPassword): bool 
{
    if(empty($email) || empty($password) || empty($confirmNewPassword)){
        return true;
    }
    return false;
}

function isEmailValid($email): bool 
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}

function isPasswordValid($password): bool 
{
    if(strlen($password) < 8){
        return true;
    }
    return false;
}

function isPasswordSame($password, $confirmNewPassword): bool 
{
    if($password !== $confirmNewPassword){
        return true;
    }
    return false;
}

function CheckIfEmailExist($email) :bool
{
    if(checkIfEmailExistInDatabase($email)){
        return true;
    }
    return false;
}

function hashPassword($password): string
{
    $options = [
        'cost' => 12,
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}
