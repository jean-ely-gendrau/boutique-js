<?php

namespace App\Boutique\Controllers;

class TestRender
{
    public function __construct()
    {
        /* Action du constucteur */
    }

    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        return var_dump($arguments);
    }
}
