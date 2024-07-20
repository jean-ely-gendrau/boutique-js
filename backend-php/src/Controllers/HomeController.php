<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\Slider;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Components\Carousel;
use App\Boutique\Enum\ClientExceptionEnum;
use App\Boutique\Exceptions\ClientExceptions;


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
        // Instance de CrudManager prenant en paramètre la table `products` et la classe `Products`
        $crudManager = new CrudManager('products', ProductsModels::class);

        // CrudManager user
        $crudManagerUser = new CrudManager('users', ProductsModels::class);

        // Instance de la classe Slide
        $horizontalSlide = new Slider();

        // Création d'un slider importent l'ensemble des produits
        if (isset($_SESSION['isConnected'])) {
            $user = $crudManagerUser->getByEmail($_SESSION['email']);

            // Si Nous n'avons aucun résultat dans la reqêtte précédante Throw
            if (empty($user)) {
                throw new ClientExceptions(ClientExceptionEnum::NotConnected); // EXCEPTION NotConnected
            }

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
        $content = $arguments['render']->render('accueil', $arguments);

        return $content;
    }
}
