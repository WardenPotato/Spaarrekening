<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 4/24/2018
 * Time: 11:23
 */
require_once "Settings.php";
class Users extends Settings
{
    public $pdo;
    private $userdata;
    public function __construct()
    {
        if(session_status() === PHP_SESSION_NONE)session_start();
        $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=$this->dbcharset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => true,
        ];
        $this->pdo = new PDO($dsn, $this->dbuser, $this->dbpass, $opt);
    }

    public function RegisterUser($email, $password){
        if ($this->LoginUser($email, $password) == false) {
            $stmt = $this->pdo->prepare("INSERT INTO login (email, password) VALUES(:email,:password)");
            return $stmt->execute(['email' => $email, 'password' => $password]) ? true : false;
        }
    }
    public function DeleteUser($loginID){
        $stmt = $this->pdo->prepare("DELETE FROM accounts WHERE idlogin = :loginID;DELETE FROM login WHERE idlogin = :loginID");
        return $stmt->execute(['loginID' => $loginID]) ? true : false;
    }
    public function LoginUser($email, $password){
        $stmt = $this->pdo->prepare("SELECT idlogin, email FROM login WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $_SESSION['UserID'] = $stmt->fetch(PDO::FETCH_ASSOC)["idlogin"];
        return $stmt->rowCount() == 1 ? true : false;
    }
    public function GetUserID($email, $password){
        $stmt = $this->pdo->prepare("SELECT idlogin FROM login WHERE email = :email AND password = :password");
        return $stmt->execute(['email' => $email, 'password' => $password]) ? $stmt->fetch(PDO::FETCH_ASSOC)["idlogin"] : false;
    }
    public function GetAccounts($loginID){
        $stmt = $this->pdo->prepare("SELECT * FROM login JOIN accounts USING (idlogin) WHERE idlogin = :loginID");
        return $stmt->execute(['loginID' => $loginID]) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false;
    }
    public function SetBalance($amount, $accountID){
        $stmt = $this->pdo->prepare("UPDATE accounts SET balance = :AddBalance WHERE account_id = :AccountID");
        return $stmt->execute(['AddBalance' => $amount, 'AccountID' => $accountID]) ? true : false;
    }
    public function AddBalance($amount, $accountID){
        $stmt = $this->pdo->prepare("UPDATE accounts SET balance = balance + :AddBalance WHERE account_id = :AccountID");
        return $stmt->execute(['AddBalance' => $amount, 'AccountID' => $accountID]) ? true : false;
    }
    public function RemoveBalance($amount, $accountID){
        $stmt = $this->pdo->prepare("SELECT balance FROM accounts WHERE account_id = :AccountID");
        $stmt->execute(['AccountID' => $accountID]);
        $currentBalance = $stmt->fetchColumn();
        if($currentBalance < $amount){
            echo"You cannot withdraw more than you have";
            return false;
        }else{
        $stmt = $this->pdo->prepare("UPDATE accounts SET balance = balance - :AddBalance WHERE account_id = :AccountID");
        return $stmt->execute(['AddBalance' => $amount, 'AccountID' => $accountID]) ? true : false;
        }
    }
    public function CreateAccount($loginID, $accountname){
        $stmt = $this->pdo->prepare("INSERT INTO accounts (idlogin, balance, name) VALUES(:loginID, 0, :accountname)");
        return $stmt->execute(['loginID' => $loginID, 'accountname' => $accountname]) ? true : false;
    }
}