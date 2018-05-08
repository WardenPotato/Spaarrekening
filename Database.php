<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 19:33
 */
namespace Database {
    use \PDO;
    require_once "Settings.php";

    class DBConnection extends \Settings
    {
        public $pdo;

        public function __construct()
        {
            //if(session_status() === PHP_SESSION_NONE)session_start();
            $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=$this->dbcharset";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => true,
            ];
            $this->pdo = new PDO($dsn, $this->dbuser, $this->dbpass, $opt);
        }
    }

    class DatabaseOperations extends DBConnection
    {

        public function registerUser(string $email, string $password): bool
        {
            if (!$this->userExists($email, $password)) {
                $stmt = $this->pdo->prepare("INSERT INTO login (email, password) VALUES(:email,:password)");
                return $stmt->execute(['email' => $email, 'password' => $password]) ? true : false;
            }
            return false;
        }

        public function deleteUser(int $userID): bool
        {
            $stmt = $this->pdo->prepare("DELETE FROM accounts WHERE idlogin = :loginID;DELETE FROM login WHERE idlogin = :loginID");
            return $stmt->execute(['loginID' => $userID]) ? true : false;
        }

        public function userExists(string $email, string $password): bool
        {
            $stmt = $this->pdo->prepare("SELECT email FROM login WHERE email = :email AND password = :password");
            $stmt->execute(['email' => $email, 'password' => $password]);
            return $stmt->rowCount() == 1 ? true : false;
        }

        public function getAccounts(int $loginID): array
        {
            $stmt = $this->pdo->prepare("SELECT * FROM login JOIN accounts USING (idlogin) WHERE idlogin = :loginID");
            $stmt->execute(['loginID' => $loginID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function setBalance(int $amount, int $accountID): bool
        {
            $stmt = $this->pdo->prepare("UPDATE accounts SET balance = :Balance WHERE account_id = :AccountID");
            return $stmt->execute(['Balance' => $amount, 'AccountID' => $accountID]) ? true : false;
        }

        public function createAccount(int $loginID, string $name): int
        {
            $stmt = $this->pdo->prepare("INSERT INTO accounts (idlogin, balance, name) VALUES(:loginID, 0, :accountname)");
            return $stmt->execute(['loginID' => $loginID, 'accountname' => $name]) ? $stmt->fetch(PDO::FETCH_ASSOC)["account_id"] : false;
        }
    }
}