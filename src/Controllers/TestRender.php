<?php

namespace App\Boutique\Controllers;

use PDO;
use App\Boutique\Manager\BddManager;
use App\Boutique\Components\Exemple;
use App\Boutique\Utils\Render;
use App\Boutique\Models\TestProducts;
use App\Boutique\Components\FileImportJson;
use App\Boutique\Components\Slider;
use App\Boutique\Models\Orders;
use App\Boutique\Manager\CrudManager;
use App\Boutique\Models\ProductsAlex;
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

        // Instance de CrudManager prenant en paramètre la table `products` et la classe `Products`
        $crudManager = new CrudManager('products', ProductsAlex::class);

        // Instance de la classe Slide
        $horizontalSlide = new Slider();

        // Création d'un slider importent l'ensemble des produits
        $products = $crudManager->getAll();
        $allProducts = $horizontalSlide->generateProductList($products, 'id-scroll-x-1'); // Appel de la méthode generateProductList()
        $arguments['render']->addParams('product', $allProducts);

        // Création d'un slider importent l'ensemble des produits Café (id_category = 0)
        $productsCoffee = $crudManager->getAllById('0', 'id_category');
        $allProductsCoffee = $horizontalSlide->generateProductList($productsCoffee, 'id-scroll-x-2');
        $arguments['render']->addParams('productsCoffee', $allProductsCoffee);

        // Création d'un slider importent l'ensemble des produits Thé (id_category = 1)
        $productsTea = $crudManager->getAllById('1', 'id_category');
        $allProductsTea = $horizontalSlide->generateProductList($productsTea, 'id-scroll-x-3');
        $arguments['render']->addParams('productsTea', $allProductsTea);

        // Initialisation de la variable $content avec l'ensemble des arguments passé par la méthode addParams dans la clé `render`
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

    /**
     * Fonction ProductMethodTest qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */
    public function ProductMethodTest(...$arguments)
    {
        // Test de la méthode getById du CrudManager pour la classe Orders
        $crudManager = new CrudManager('products', ProductsAlex::class);
        // $tableIdProduct = $crudManager->getById('1', 'id_product');
        $tableIdProduct = $crudManager->getAll();
        var_dump($tableIdProduct);
        $arguments['render']->addParams('product', $tableIdProduct);
        $content = $arguments['render']->render('test-orders', $arguments);
        return $content;
    }
}
