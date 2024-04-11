<?php

namespace App\Boutique\Components;
class Register
{
    private $nameUser;
    private $emailUser;
    private $passwordUser;
    private $dsn;
    private $userDb;
    private $passwordDb;

    public function __construct($nameUser, $emailUser, $passwordUser)
    {
        $this->nameUser = $nameUser;
        if ($this->validateEmail($emailUser)) {
            $this->emailUser = $emailUser;
        } else {
            throw new Exception("Invalid email format");
        }
        if ($this->validatePassword($passwordUser)) {
            $this->passwordUser = $passwordUser;
        } else {
            throw new Exception("Invalid password format");
        }
        $this->dsn = $dsn;
        $this->userDb = $userDb;
        $this->passwordDb = $passwordDb;
    }
    public function getName()
    {
        return $this->nameUser;
    }
    public function getEmail()
    {
        return $this->emailUser;
    }
    public function getPassword()
    {
        return $this->passwordUser;
    }
    public function setName($nameUser)
    {
        $this->name = $nameUser;
    }
    public function setEmail($emailUser)
    {
        $this->email = $emailUser;
    }
    public function setPassword($passwordUser)
    {
        $this->password = $passwordUser;
    }
    public function insert()
    {
        $dsn = $this->dsn;
        $userDb = $this->userDb;
        $passwordDb = $this->passwordDb;
        $pdo = new PDO($dsn, $userDb, $passwordDb);
        $sql = "INSERT INTO users (full_name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $this->nameUser);
        $stmt->bindParam(':email', $this->emailUser);
        $stmt->bindParam(':password', $this->passwordUser);
        $stmt->execute();
    }
    private function validatePassword($password)
    {
        $pattern = '/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])[a-zA-Z0-9!@#$%^&*()_+]{8,}$/';
        return preg_match($pattern, $password);
    }
    private function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

