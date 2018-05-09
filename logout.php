<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/3/2018
 * Time: 21:46
 */
session_start();
$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
setcookie('login_email', FALSE, time() - 100, '/', $domain, false);
setcookie('login_password', FALSE, time() - 100, '/', $domain, false);
header("Location: index.php");
