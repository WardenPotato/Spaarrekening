<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 4/24/2018
 * Time: 11:23
 */

class DatabaseOperations
{
var $dbhost = 'localhost:3306';
var $dbuser = 'root';
var $dbpass = 'root';

    function RegisterUser($email, $password){

        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass);
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }

        if(! get_magic_quotes_gpc() ) {
            $temp_email = addslashes ($email);
            $temp_password = addslashes ($password);
        }else {
            $temp_email = $email;
            $temp_password = $password;
        }

        $sql = "INSERT INTO login ". "(email, password) ". "VALUES('$temp_email','$temp_password')";

        mysqli_select_db($conn,'spaarrekening');
        $retval = mysqli_query( $conn, $sql );

        if($retval) {
            header("Location: login.php");
        }

        mysqli_close($conn);
    }
    function LoginUser($email, $password){

        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass);
        if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
        }

        if(! get_magic_quotes_gpc() ) {
            $temp_email = addslashes ($email);
            $temp_password = addslashes ($password);
        }else {
            $temp_email = $email;
            $temp_password = $password;
        }

        $sql = "SELECT idlogin, email FROM login WHERE email = '$temp_email' AND password = '$temp_password'";
        mysqli_select_db($conn,'spaarrekening');
        $retval = mysqli_query( $conn, $sql );

        if (mysqli_num_rows($retval) == 1){
            mysqli_close($conn);
            return true;
        }
        else {
            mysqli_close($conn);
            return false;
        }
    }
    function GetBalance($email, $password){
        if($this->LoginUser($email, $password) == true){

        }
    }
}