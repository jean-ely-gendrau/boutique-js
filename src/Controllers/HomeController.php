<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\Slider;
use App\Boutique\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;

/**
 * La classe TestRender étend Render et contient les méthodes pour afficher des variables et
 * renvoyer une vue (View) avec les données de l'exemple.
 */
class HomeController
{
    public function __construct()
    {
    }

    /**
     * Méthode RenderHome qui renvoie les arguments passé assigné à la clé 'render'.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return void
     */
    public function RenderHome(...$arguments)
    {
        /*
         * Utilisation de la méthode RenderHome afin de renvoyer l'ensemble des sélections de la page accueil
         */

        // Instance de CrudManager prenant en paramètre la table `products` et la classe `Products`
        $crudManager = new CrudManager('products', ProductsModels::class);

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
        $content = $arguments['render']->render('acceuil', $arguments);

        return $content;
    }
}