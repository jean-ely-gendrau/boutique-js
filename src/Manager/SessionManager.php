<?php

namespace App\Boutique\Manager;

use App\Boutique\Interfaces\SessionInterface;

class SessionManager implements SessionInterface
{
    public function __construct()
    {
        /* session_status() retourne 
      PHP_SESSION_DISABLED si les sessions sont désactivées.
      PHP_SESSION_NONE si les sessions sont activées, mais qu'aucune n'existe.
      PHP_SESSION_ACTIVE si les sessions sont activées, et qu'une existe. 
    */
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // START SESSION
    }

    /**
     * Method give
     *
     * Retroune la valeur Si la clé existe dans le tableau global de $_SESSION
     * Si la valeur n'existe pas null sera retourné.
     *
     * @param string $key [clé de la valeur à retourner]
     *
     * @return void
     */
    public function give(string $key)
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * Method add
     *
     * Ajoute un ou plusieurs paire clé/valeur au tableau global $_SESSION
     *
     * @param array $params [clé et valeur à ajouter au tableau global de $_SESSION]
     *
     * @return self
     */
    public function add(array $params): self
    {
        foreach ($params as $key => $val):
            $_SESSION[$key] = $val;
        endforeach;

        return $this;
    }

    /**
     * Method remove
     *
     * Retire une ou plusieurs clés et sa valeur dans le tableau global de $_SESSION
     *
     * @param array $params [un tableau assosiatif des paramètres à retirer du tableau global de $_SESSION]
     *
     * @return void
     */
    public function remove(array $params): void
    {
        foreach ($params as $val):
            if ($this->has($val)):
                unset($_SESSION[$val]);
            endif;
        endforeach;
    }

    /**
     * Method clear
     *
     * Détruit la session en cour.
     *
     * @return void
     */
    public function clear(): void
    {
        session_unset();
    }

    /**
     * Method has
     *
     * retourn true si la clé existe dans le tableau global de $_SESSION
     *
     * @param string $key [la clé à vérifier]
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }
}
