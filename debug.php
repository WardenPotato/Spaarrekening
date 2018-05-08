<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 21:20
 */
require_once "Database.php";
$magic = new \Database\DatabaseOperations();
print_r($magic->GetAccounts(5));