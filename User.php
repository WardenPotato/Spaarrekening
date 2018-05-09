<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 17:43
 */
namespace User {

    require_once "Database.php";
    use Database\DatabaseOperations;

    interface IID
    {
        public function getID(): int;
    }

    interface IName
    {
        public function getName(): string;
    }

    class User implements IID
    {
        private $ID;
        private $email;
        private $accounts;
        private $database;
        private $firstName;
        private $lastName;

        public function __construct(int $ID)
        {
            $this->ID = $ID;
            $this->accounts = array();
            $this->database = new DatabaseOperations();
            $this->email = $this->database->getEmail($this->ID);
            $this->loadAccounts();
            $this->firstName = $this->database->getFirstName($this->ID);
            $this->lastName = $this->database->getLastName($this->ID);
        }

        public function getID(): int
        {
            return $this->ID;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getFirstName(): string
        {
            return $this->firstName;
        }

        public function getLastName(): string
        {
            return $this->lastName;
        }

        public function addAccount(string $name): void
        {
            $accountID = $this->database->createAccount($this->ID, $name);
            array_push($this->accounts, new BankAccount($accountID, $name, 0, $this->ID));
        }

        public function getAccounts(): array
        {
            return $this->accounts;
        }

        public function editAccount($accountID): BankAccount
        {
            return $this->accounts[$accountID];
        }

        public function deleteUser(): void
        {
            $this->database->deleteUser($this->ID);
        }

        public function printAccounts(): void
        {
            echo"Accounts: <br>";
            foreach($this->accounts as $account) {
                $account->printDetails();
            }
        }

        private function loadAccounts(): void
        {
            foreach ($this->database->getAccounts($this->ID) as $value => $key) {
                $this->accounts[intval($key["account_id"])] = new BankAccount(intval($key["account_id"]), $key["name"], intval($key["balance"]), intval($key["idlogin"]));
            }
        }
    }

    class BankAccount implements IID, IName
    {
        private $ID;
        private $name;
        private $balance;
        private $userID;
        private $database;

        public function __construct(int $ID, string $name, int $balance, int $userID)
        {
            $this->ID = $ID;
            $this->name = $name;
            $this->balance = $balance;
            $this->userID = $userID;
            $this->database = new DatabaseOperations();
        }

        public function deposit(int $amount): void
        {
            $this->balance += $amount;
            $this->database->setBalance($this->balance, $this->ID);
        }

        public function withdraw(int $amount): void
        {
            if ($amount > $this->balance) {
                throw new \Exception("Amount greater than available balance.");
            }

            $this->balance -= $amount;
            $this->database->setBalance($this->balance, $this->ID);
        }

        public function getID(): int
        {
            return $this->ID;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getBalance(): int
        {
            return $this->balance;
        }

        public function printDetails(): void
        {
            echo"$this->ID ";
            echo"$this->name ";
            echo"$this->balance ";
            echo"$this->userID<br>";
        }
    }
}
