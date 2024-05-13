<?php

use App\Boutique\Models\Users;

class UsersAvatars extends Users
{
    /**
     * users_id
     *
     * @var int
     */
    private $users_id;

    /**
     * avatars_id
     *
     * @var int
     */
    private $avatars_id;

    public function __construct()
    {
    }

    /* ----------------------------------- METHOD MAGIC ------------------------------ */

    /**
     * Get magic __get
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    /**
     * Set magic __set
     *
     * @param string $property La propriétée
     * @param mixed $value La valeur de la propriétée
     * @return self
     */
    public function __set(string $property, mixed $value)
    {
    }

    /************************************** Getter/Setter ***********************************/

    /**
     * Get users_id
     *
     * @return  int
     */
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * Set users_id
     *
     * @param  int  $users_id  users_id
     *
     * @return  self
     */
    public function setUsers_id(int $users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }

    /**
     * Get avatars_id
     *
     * @return  int
     */
    public function getAvatars_id()
    {
        return $this->avatars_id;
    }

    /**
     * Set avatars_id
     *
     * @param  int  $avatars_id  avatars_id
     *
     * @return  self
     */
    public function setAvatars_id(int $avatars_id)
    {
        $this->avatars_id = $avatars_id;

        return $this;
    }
}
