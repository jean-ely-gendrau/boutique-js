<?php

namespace App\Boutique\Models;

use JsonSerializable;

class Category implements JsonSerializable
{
    /**
     * id
     *
     * @var mixed
     */
    private $id;

    /**
     * name
     *
     * @var mixed
     */
    private $name;

    /**
     * description
     *
     * @var mixed
     */
    private $description;

    /*** Properties da la table Sub_Category */

    /**
     * sub_id
     *
     * @var int
     */
    private $sub_id;

    /**
     * category_id
     *
     * @var int
     */
    private $category_id;

    /**
     * subName
     *
     * @var string
     */
    private $subName;

    /**
     * subDescription
     *
     * @var string
     */
    private $subDescription;

    public function __construct()
    {
        /* Action du contructure au besoins */
    }

    /**************************************** Getter/Setter **********************************************/

    /**
     * Get id
     *
     * @return  mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id_category
     *
     * @param  mixed  $id  id_category
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get name
     *
     * @return  mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  mixed  $name  name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return  mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param  mixed  $description  description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        // array_diff_key et EXCLUDE_PROPERTIES permettent de retirer des clés du résultat que l'on ne souhaite pas renvoyer.
        return get_object_vars($this);
    }

    /**
     * Get sub_id
     *
     * @return  int
     */
    public function getSub_id()
    {
        return $this->sub_id;
    }

    /**
     * Set sub_id
     *
     * @param  int  $sub_id  sub_id
     *
     * @return  self
     */
    public function setSub_id(int $sub_id)
    {
        $this->sub_id = $sub_id;

        return $this;
    }

    /**
     * Get subName
     *
     * @return  string
     */
    public function getSubName()
    {
        return $this->subName;
    }

    /**
     * Set subName
     *
     * @param  string  $subName  subName
     *
     * @return  self
     */
    public function setSubName(string $subName)
    {
        $this->subName = $subName;

        return $this;
    }

    /**
     * Get subDescription
     *
     * @return  string
     */
    public function getSubDescription()
    {
        return $this->subDescription;
    }

    /**
     * Set subDescription
     *
     * @param  string  $subDescription  subDescription
     *
     * @return  self
     */
    public function setSubDescription(string $subDescription)
    {
        $this->subDescription = $subDescription;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return  int
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set category_id
     *
     * @param  int  $category_id  category_id
     *
     * @return  self
     */
    public function setCategory_id(int $category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }
}
