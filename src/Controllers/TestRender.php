<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\Exemple;
use App\Boutique\Utils\Render;

class TestRender extends Render
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
    public function View(...$arguments)
    {
        $exemple = Exemple::Test();
        $this->addParams('exemple', $exemple);
        $content = $this->render('test-render', $arguments);
        return $content;
    }
}
