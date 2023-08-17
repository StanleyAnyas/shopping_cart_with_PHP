<?php

ini_set('session.use_only_cookies', 1); // this means that the session id will only be available in cookies
ini_set('seesion.use_strict_mode', 1); // this means that the session id will only be available in cookies

session_set_cookie_params([
    'lifetime' => 60 * 60 * 24, // this means that the cookie will expire after 24 hours
    'path' => '/', // this means that the cookie will be available in the entire domain
    'domain' => 'localhost', // this means that the cookie will be available in the entire domain
    'secure' => true, // this means that the cookie will only be available in https
    'httponly' => true, // this means that the cookie will only be available in http
    'samesite' => 'Lax' // this means that the cookie will only be available in the same site
]);

session_start(); // this means that the session will start

// session_create_id(); // this means that a new session id will be created every time the user logs in and the old session id will be deleted

function regenerate_session_id() {
    session_regenerate_id(true); // this means that the session id will be regenerated every time the user logs in
    $_SESSION['last_regenertion'] = time();
}
$interval = 60 * 60; // here i am defining the interval of time that the session id will be regenerated

if (!isset($_SESSION['last_regenertion'])) {
    regenerate_session_id();
} elseif (time() - $_SESSION['last_regenertion'] >= $interval) {
    regenerate_session_id();
}