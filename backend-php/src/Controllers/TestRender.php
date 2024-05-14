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
        $carousel = new Carousel();

        // Passage des elements php dans la clé element, le chemin relatif des images dans la clé image
        // dans la méthode appelé RenderCarousel
        $RenderCarousel = $carousel->RenderCarousel([
            'element' => ['../../element/bannerCarousel.php'],
            'image' => [
                '/assets//images//banière//HomeCoffee.jpg',
                '/assets//images//banière//hearderCoffeePage.jpg',
                '/assets//images//banière//hearderCoffeePage2.jpg',
            ],
        ]);

        // Envoie de la variable $RenderCarousel déclaré dans la méthode addParams
        $arguments['render']->addParams('carousel', $RenderCarousel);

        // Instance de CrudManager prenant en paramètre la table `products` et la classe `Products`
        $crudManager = new CrudManager('products', ProductsModels::class);

        // Instance de la classe Slide
        $horizontalSlide = new Slider();

        // Création d'un slider importent l'ensemble des produits
        $products = $crudManager->getAllProduct();
        // var_dump($crudManager->getAllProduct());
        // $allProducts = $horizontalSlide->generateProductList($products, 'id-scroll-x-1'); // Appel de la méthode generateProductList()
        $arguments['render']->addParams('products', $products);

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
