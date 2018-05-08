<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 17:43
 */
namespace User {

    use Database\DatabaseOperations;

    interface IID
    {
        public function getID(): int;
    }

    interface IName
    {
        public function getName(): string;
    }

    class User implements IID, IName
    {
        private $ID;
        private $email;
        private $name;
        private $accounts;
        private $database;

        public function __construct(int $ID, string $email, string $name)
        {
            $this->ID = $ID;
            $this->email = $email;
            $this->name = $name;
            $this->database = new DatabaseOperations();
            $this->loadAccounts();
        }

        public function getID(): int
        {
            return $this->ID;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getName(): string
        {
            return $this->name;
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

        public function deleteUser(): void
        {
            $this->database->deleteUser($this->ID);
        }

        private function loadAccounts(): void
        {
            foreach ($this->database->getAccounts($this->ID) as $index => $account) {
                foreach($account as $key => $value){
                    array_push($this->accounts, new BankAccount($key["account_id"], $key["name"], $key["balance"], $key["idlogin"]));
                }
            }
        }
    }

    class BankAccount implements IID, IName
    {
        private $ID;
        private $name;
        private $balance = 0;
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
            $this->database->setBalance($this->balance);
        }

        public function withdraw(int $amount): void
        {
            if ($amount > $this->balance) {
                throw new \Exception("Amount greater than available balance.");
            }

            $this->balance -= $amount;
            $this->database->setBalance($this->balance);
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
    }
}
