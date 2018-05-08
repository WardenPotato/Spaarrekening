<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/4/2018
 * Time: 19:36
 */
require "Users.php";
$User = new Users();
if(session_status() === PHP_SESSION_NONE)session_start();
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