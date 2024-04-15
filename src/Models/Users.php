<?php

namespace App\Boutique\Models;

use DateTime;
use App\Boutique\Manager\PasswordHashManager;

class Users extends PasswordHashManager
{
    // #[ValidatorData('numeric')]
    private $id;
    // #[ValidatorData('full_name')]
    private $full_name;
    // #[ValidatorData('email')]
    private $email;
    // #[ValidatorData('password')]
    private $password;

    private $birthday;
    private $adress;
    private $role;
    private $created_at;
    private $updated_at;

    /**
     * Method __construct
     *
     * @param ?array $data [Les données du formulaire sous forme de tableau ce paramètre est facultatif]
     *
     * @return void
     */
    public function __construct(?array $data = null)
    {
        $this->full_name = $data['full_name'] ?? '';
        $this->email = $data['email'] ?? '';

        $this->password = isset($data['password'])
            ? $this->hash($data['password'])
            : '';

        $this->birthday = isset($data['birthday'])
            ? $this->setDateTime($data['birthday'])
            : '';

        $this->adress = $data['adress'] ?? '';
        $this->role = 'user';
    }

    /* ----------------------------------- METHOD MAGIC ------------------------------ */
    /* __get magic
     * https://www.php.net/manual/en/language.oop5.magic.php
     */
    public function __get(string $name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    } 

    /*
     * Depuis Php 8.2 il est recommandé de ne pas implémenter cette méthode
     * sinon on obtiendrait une erreur de ce type
     * Using Dynamic Properties on Classes running PHP 8.2 will lead to PHP Deprecated
     */
    public function __set(string $property, mixed $value)
    {
    }

    /* ----------------------------------- GETTER / SETTER ------------------------------ */
    /**
     * Method setDateTime
     *
     * Cette méthode retourne la date String au bon format SQL 'Y-m-d H:i:s'
     *
     * @param string $dateString [date string]
     *
     * @return void
     */
    public function setDateTime(string $dateString)
    {
        $newDate = new DateTime($dateString);
        return $newDate->format('Y-m-d H:i:s');
    }

    /**
     * Get the value of birthday
     *
     * Cette méthode retourne la date String sans l'heure pour calculer l'âge
     */
    public function getBirthday()
    {
        $newDate = new DateTime($this->birthday);
        return $newDate->format('Y-m-d');
    }
}
