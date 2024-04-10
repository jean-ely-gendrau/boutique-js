<?php


$host = "localhost";
$db = "teacoffee";
$userDb = "root";
$passwordDb = "";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";


class Connexion {

    private $emailUser;

    private $passwordUser;
    
    private $dsn;
    private $userDb;
    private $passwordDb;

    public function __construct($emailUser,$passwordUser,$dsn, $userDb, $passwordDb) {
        $this->emailUser = $emailUser;
        $this->passwordUser = $passwordUser;
        $this->dsn = $dsn;
        $this->userDb = $userDb;
        $this->passwordDb = $passwordDb;
    }

    
    public function checkEmail() {
        $pdo = new PDO($this->dsn, $this->userDb, $this->passwordDb);
        $email = $this->emailUser;
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

   
    public function log() {
        $password = $this->passwordUser;
        $user = $this->checkEmail();
        if ($user) {
            if ($password == $user['password']) {
                return "YES password";
            } else {
                return "NO password"; 
            }
        } else {
            return "NO email"; 
        }
    }
}

// Example usage

$email = "esteban@gmail.com";
$password = "Testtest7@";
$connect = new Connexion($email,$password,$dsn, $userDb, $passwordDb);
$result = $connect->log();
echo $result;
?>
