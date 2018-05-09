<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 10:13
 */
//Start Session if not already started
if(session_status() === PHP_SESSION_NONE)session_start();

//Set userID from session
$userID = $_SESSION['userID'];

//Initialize User class
require_once "User.php";
$User = new \User\User($userID);

//This is triggered if all items of the edit account form are set and does the appropriate action
if(isset($_POST["editAccountSelection1"]) and isset($_POST["editAccountSelection2"]) and isset($_POST["editAccount"])){
    $method = $_POST["editAccountSelection2"];
    $account = $_POST["editAccountSelection1"];
    $amount = $_POST["editAccount"];

    switch ($method) {
        case "Withdraw":
            $User->editAccount($account)->withdraw($amount);
            break;
        case "Deposit":
            $User->editAccount($account)->deposit($amount);
            break;
    }
}

//Print the accounts
$User->printAccounts();