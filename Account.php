<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 4/24/2018
 * Time: 13:43
 */

namespace Account;


class Balance
{
    var $money = 0;
    function __construct()
    {
        require "DatabaseOperations.php";
        $db = new DatabaseOperations();
    }
    function SetBalance($amount){}
    function AddBalance(){}
    function GetBalance(){}
}