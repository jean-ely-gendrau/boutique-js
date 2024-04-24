<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\Slider;
use App\Boutique\Models\Orders;
use App\Boutique\Manager\CrudManager;
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
    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        //!SECTION
        $carousel = new Carousel();

        //passage methode'../../element/itemCarousel.php'], ['/assets//images//banière//HomeCoffee.jpg'
        $RenderCarousel = $carousel->RenderCarousel([
            'element' => ['../../element/bannerCarousel.php'],
            'image' => [
                '/assets//images//banière//HomeCoffee.jpg',
                '/assets//images//banière//hearderCoffeePage.jpg',
                '/assets//images//banière//hearderCoffeePage2.jpg',
            ],
        ]);

        //
        $arguments['render']->addParams('carousel', $RenderCarousel);

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
