<?php

namespace App\Boutique\Controllers;

use PDO;
use App\Boutique\Manager\BddManager;
use App\Boutique\Components\Exemple;
use App\Boutique\Utils\Render;
use App\Boutique\Models\TestProducts;
use App\Boutique\Components\HorizontalSelector;
use App\Boutique\Components\FileImportJson;
use App\Boutique\Models\Orders;
use App\Boutique\Manager\CrudManager;
use App\Boutique\Models\Users;

/**
 * La classe TestRender étend Render et contient les méthodes pour afficher des variables et
 * renvoyer une vue (View) avec les données de l'exemple.
 */
class TestRender
{
    public function __construct()
    {
    }

    /**
     * Méthode Index qui affiche les variables transmises à la méthode.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return void
     */
    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        // Créer une instance de BddManager
        // $bddManager = new BddManager();

        // // Instancier la classe Products en lui passant BddManager

        // $horizontalSelector = new HorizontalSelector($bddManager);
        // // $horizontalSelector->generateProductList($product);

        // $arguments['render']->addParams('product', $horizontalSelector);
        // // Ajouter l'instance de Products aux paramètres du rendu
        // // $this->addParams('horizontalSelector', $horizontalSelector);

        // // Rendre le template
        // $content = $arguments['render']->render('test-render', $arguments);
        // return $content;
        $bddManager = new BddManager();

        $horizontalSelector = new HorizontalSelector($bddManager);
        $productHtml = $horizontalSelector->generateProductList(); // Appel de la méthode generateProductList()

        /*Test affichage seo.fr.json*/

        $arguments['render']->addParams('product', $productHtml);

        $content = $arguments['render']->render('test-render', $arguments);
        return $content;
    }

    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function View(...$arguments)
    {
        // Test de la méthode getById du CrudManager pour la classe Orders
        $crudManager = new CrudManager('orders', Orders::class);
        $tableIdOrder = $crudManager->getById('1', 'id_order');
        $arguments['render']->addParams('order', $tableIdOrder);
        $content = $arguments['render']->render('test-orders', $arguments);
        return $content;
    }

    /**
     * ProductTest créé une instance de la classe 'Products' avec une instance de 'BddManager' en paramètre,
     * ajoute le nouvel objet $product dans les paramètres de addParams, et renvoie le template 'acceuil'
     * avec les arguments fourni
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'acceuil' avec les arguments fournis.
     */
    public function ProductTest(...$arguments)
    {
        // Créer une instance de BddManager
        $bddManager = new BddManager();

        // Instancier la classe Products en lui passant BddManager
        $product = new TestProducts($bddManager);

        // Ajouter l'instance de Products aux paramètres du rendu
        $arguments['render']->addParams('product', $product);

        // Rendre le template
        return $arguments['render']->render('acceuil', $arguments);
    }
}
