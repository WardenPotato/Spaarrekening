<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/9/2018
 * Time: 08:39
 */
//Start Session if not already started
if(session_status() === PHP_SESSION_NONE)session_start();

//Initialize database class
require_once "Database.php";
$database = new \Database\DatabaseOperations();

//This triggers if we detect a session with the email and pwd variable set
//Purpose: remember login of this session and redirect away from login if one is found
if(isset($_SESSION['email']) and isset($_SESSION['pwd'])){
    if ($database->UserExists($_SESSION['email'], $_SESSION['pwd'])) {
        header("Location: rekening.php");
    }else{
        echo"Session detection triggered without right login";
    }
}

//This triggers if we detect cookies with the login_email and login_password variables set
//Purpose: remember login of a user that ticked the 'Remember me' box
if(isset($_COOKIE['login_email']) and isset($_COOKIE['login_password'])){
    if ($database->UserExists($_COOKIE['login_email'], $_COOKIE['login_password'])) {
        $_SESSION['email'] = $_COOKIE['login_email'];
        $_SESSION['pwd'] = $_COOKIE['login_password'];
        header("Location: rekening.php");
    }else{
        echo"Session cookie detection triggered without right login";
    }
}