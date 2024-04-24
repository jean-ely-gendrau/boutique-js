<?php

namespace App\Boutique\Models;

use DateTime;
use App\Boutique\Validators\ValidatorData;
use App\Boutique\Manager\PasswordHashManager;
use JsonSerializable;


class Users extends PasswordHashManager implements \JsonSerializable
{
    protected const EXCLUDE_PROPERTIES = ['password'];

    // #[ValidatorData('numeric')]
    private $id_user;
    #[ValidatorData('full_name')]
    private $full_name;
    #[ValidatorData('email')]
    private $email;
    #[ValidatorData('password')]
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
        $this->id_user = $data['id_user'] ?? '';
        $this->email = $data['email'] ?? '';

        $this->password = isset($data['password']) ? $this->hash($data['password']) : '';

        $this->birthday = isset($data['birthday']) ? $this->setDateTime($data['birthday']) : '';

        $this->adress = $data['adress'] ?? '';
        $this->role = 'user';
    }

    /* ----------------------------------- METHOD MAGIC ------------------------------ */
    /* __get magic
     * https://www.php.net/manual/en/language.oop5.magic.php
     */
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
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

    /* ----------------------------------- implements jsonSerialize ------------------------------ */
    /**
     * Method jsonSerialize
     *
     * Cette méthode retourne les propriétés de la classe sous forme de tableau
     * Cela permet l'encodage avec json_endode des propriétés privées.
     *  
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        // array_diff_key et EXCLUDE_PROPERTIES permettent de retirer des clés du résultat que l'on ne souhaite pas renvoyer.
        return array_diff_key(get_object_vars($this), array_flip(self::EXCLUDE_PROPERTIES));
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
        return $newDate->format('Y-m-d');
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

    public function update($full_name, $birthday, $adress, $password)
    {

        // Préparez une requête SQL pour mettre à jour l'enregistrement
        $sql = "UPDATE users SET full_name = :full_name, birthday = :birthday, adress = :adress, password = :password WHERE id_user = :id_user";

        // Préparez la requête avec PDO
        $stmt = $this->pdo->prepare($sql);

        // Liez les paramètres à la requête
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':birthday', $this->setDateTime($birthday));
        $stmt->bindParam(':adress', $adress);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_user', $this->id_user);

        // Exécutez la requête
        $stmt->execute();
    }
}
