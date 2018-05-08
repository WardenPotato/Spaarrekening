<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 10:13
 */
require "Users.php";
$User = new Users();
if(session_status() === PHP_SESSION_NONE)session_start();
print_r($_POST);
if(isset($_POST["editAccountSelection1"]) and isset($_POST["editAccountSelection2"]) and isset($_POST["editAccount"])){
    $method = $_POST["editAccountSelection2"];
    $account = $_POST["editAccountSelection1"];
    $amount = $_POST["editAccount"];
    $userid = $User->GetUserID($_SESSION['email'], $_SESSION['pwd']);
    //echo $method . "<br>";
    //echo $amount . "<br>";
    //echo $account . "<br>";
    switch ($method) {
        case "Withdraw":
            $User->RemoveBalance($amount, $account);
            break;
        case "Deposit":
            $User->AddBalance($amount, $account);
            break;
        case "Set":
            $User->SetBalance($amount, $account);
            break;
    }

}


if(isset($_SESSION['email']) and isset($_SESSION['pwd'])){
    if ($User->LoginUser($_SESSION['email'], $_SESSION['pwd']) == true) {
        $userid = $User->GetUserID($_SESSION['email'], $_SESSION['pwd']);
        echo"Accounts: <br>";
        foreach ($User->GetAccounts($userid) as $key => $value) {
            foreach($value as $key => $var){
                echo"$var" . " ";
            }
            echo"<br>";
        }
    }
}