<?php

namespace Motor\Mvc\Manager;

class BddManager
{
    protected $link;
    private $dsn, $username, $password;

    public function __construct($config = null)
    {
        if (empty($config)):
            // Si la config est null on charge le fichier à partir du dossier config
            $configs = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '../../config/config.json'));
            $config = $configs->database->pdo;
        endif;

        $this->dsn = "{$config->dsn}:dbname={$config->bdd};host={$config->host};port={$config->port}";
        $this->username = $config->username;
        $this->password = $config->password;
        $this->connect();
    }

    public function linkConnect()
    {
        return $this->link;
    }

    private function connect()
    {
        $this->link = new \PDO($this->dsn, $this->username, $this->password);
    }

    public function __sleep()
    {
        return ['dsn', 'username', 'password'];
    }

    public function __wakeup()
    {
        $this->connect();
    }
}
