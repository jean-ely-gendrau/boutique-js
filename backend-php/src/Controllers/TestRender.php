<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\Slider;
use App\Boutique\Models\Orders;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Components\Carousel;

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
    public function TestRender(...$arguments)
    {
        /*
         * Utilisation de la méthode RenderHome afin de renvoyer l'ensemble des sélections de la page accueil
         */

        // Instance de Carousel
        $crudManager = new CrudManager('products', ProductsModels::class);

        // CrudManager user
        $crudManagerUser = new CrudManager('users', ProductsModels::class);

        // Instance de la classe Slide
        $horizontalSlide = new Slider();

        // Création d'un slider importent l'ensemble des produits
        if (isset($_SESSION['isConnected'])) {
            $user = $crudManagerUser->getByEmail($_SESSION['email']);
            $products = $crudManager->getAllProductFav($user->id);
        } else {
            $products = $crudManager->getAllProduct();
        }
        // var_dump($crudManager->getAllProduct());
        $allProducts = $horizontalSlide->generateProductList($products, 'id-scroll-x-1'); // Appel de la méthode generateProductList()
        $arguments['render']->addParams('product', $allProducts);

        // Création d'un slider importent l'ensemble des produits Café (id_category = 0)
        if (isset($_SESSION['isConnected'])) {
            $user = $crudManagerUser->getByEmail($_SESSION['email']);
            $productsCoffee = $crudManager->getAllByCategoryIdFav('1', $user->id);
        } else {
            $productsCoffee = $crudManager->getAllByCategoryId('1');
        }
        $allProductsCoffee = $horizontalSlide->generateProductList($productsCoffee, 'id-scroll-x-2');
        $arguments['render']->addParams('productsCoffee', $allProductsCoffee);

        // Création d'un slider importent l'ensemble des produits Thé (id_category = 1)
        if (isset($_SESSION['isConnected'])) {
            $user = $crudManagerUser->getByEmail($_SESSION['email']);
            $productsTea = $crudManager->getAllByCategoryIdFav('2', $user->id);
        } else {
            $productsTea = $crudManager->getAllByCategoryId('2');
        }
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
}
