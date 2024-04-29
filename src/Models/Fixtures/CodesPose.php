<?php

namespace App\Boutique\Models\Fixtures;

/**
 * CodePose
 *
 * Class Model de la Bdd shipping - table codepose
 */
class CodesPose
{
    protected string $commune;
    protected string $codepos;
    protected string $departement;

    public function __construct()
    {
    }

    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->property;
        }
    }

    public function __set(string $property, mixed $value)
    {
    }

    /**
     * Get the value of commune
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set the value of commune
     *
     * @return  self
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get the value of codepos
     */
    public function getCodepos()
    {
        return $this->codepos;
    }

    /**
     * Set the value of codepos
     *
     * @return  self
     */
    public function setCodepos($codepos)
    {
        $this->codepos = $codepos;

        return $this;
    }

    /**
     * Get the value of departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set the value of departement
     *
     * @return  self
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }
}
