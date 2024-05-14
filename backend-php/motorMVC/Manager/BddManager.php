<?php

namespace Motor\Mvc\Manager;

use Motor\Mvc\Enum\SecretsEnum;
use Motor\Mvc\Components\DockerSecrets;

class BddManager
{
    protected $link;
    private $dsn, $username, $password;

    public function __construct($config = null)
    {
        if (empty($config)) :
            // Modification de la méthode pour l'adapter avec les secrets de Docker.
            // Si la config est null on charge les paramètres de connexion à partir des secrets de Docker
            $key_variable = array('bdd', 'host', 'username', 'password', 'port', 'dsn', 'charset');
            $bdd = DockerSecrets::getSecrets(SecretsEnum::Name_BDD);
            $host = DockerSecrets::getSecrets(SecretsEnum::Host_BDD);
            $username = 'root';
            $password = DockerSecrets::getSecrets(SecretsEnum::Password_Root_BDD);
            $port = DockerSecrets::getSecrets(SecretsEnum::Port_BDD);
            $dsn = DockerSecrets::getSecrets(SecretsEnum::Dsn_BDD);
            $charset = DockerSecrets::getSecrets(SecretsEnum::Charset_BDD);
            $config = (object) compact($key_variable);

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
