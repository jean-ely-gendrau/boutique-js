<?php

class Avatars
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * url_avatar
     *
     * @var string
     */
    private $url_avatar;

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
     * Get id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  int  $id  id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get url_avatar
     *
     * @return  string
     */
    public function getUrl_avatar()
    {
        return $this->url_avatar;
    }

    /**
     * Set url_avatar
     *
     * @param  string  $url_avatar  url_avatar
     *
     * @return  self
     */
    public function setUrl_avatar(string $url_avatar)
    {
        $this->url_avatar = $url_avatar;

        return $this;
    }
}
