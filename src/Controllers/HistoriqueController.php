<?php


namespace App\Boutique\Controllers;

use App\Boutique\Utils\Render;
use App\Boutique\Models\Users;


class HistoriqueController extends Render
{
    public function __construct()
    {
        /* Action du constucteur */
    }

    /**
     * Méthode Index qui affiche les variables transmises à la méthode.
     *
     * @param array ...$arguments
     * @return void
     */
    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        return var_dump($arguments);
    }

    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments
     * @return string
     */
    public function View(...$arguments)
    {
        // $this->addParams('exemple', $exemple);
        $content = $this->render('historique', $arguments);
        return $content;
    }

    public function Historique(...$arguments)
    {

        echo "<pre>";
        // var_dump($arguments);
        foreach ($arguments as $key => $value) {
            echo $key . " => " . $value . "<br>";
        }
        echo "</pre>";
    }
}
