<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;

use App\Boutique\Models\Users;
use App\Boutique\Models\Orders;
use DateTime;

class PanierController
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
    }

    public function Panier(...$arguments)
    {

        if (!isset($_SESSION['email'])) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /inscription');
            exit();
        }
    
        /** @var \Motor\Mvc\Utils\Render */
        $render = $arguments['render'];
        $IdclientCrudManager = new CrudManager('users', Users::class);

        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
        $id = $Idclient->id;

        $panier = new CrudManager('orders', Orders::class);
        $paniers = $panier->getbyidbasket($id); // Get the orders by the client's id    
        // Return both the client's ID and the orders
        $render->addParams('paniers', $paniers);
        return  $render->render('panier', $arguments);
    }

    public function AddToBasket(...$arguments)
    {
        if (!isset($_SESSION['email'])) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /inscription');
            exit();
        }
        
        /** @var \Motor\Mvc\Utils\Render */
        $render = $arguments['render'];
        
        $IdclientCrudManager = new CrudManager('users', Users::class);
        
        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
        $id = $Idclient->id;
        
        $idproduct = $arguments["product_id"] ?? null; // Get the product's id
        
        
        $panier = new CrudManager('orders', Orders::class);
        
        $panier->CreateOrder($id, $idproduct); // Create an order (add a product to the basket
        
        
        $render->addParams('addtobasket', $panier);
        
        header("Content-type: application/json;charset=utf-8");
        http_response_code(200);
        echo json_encode(["success" => "ok"]);
        exit();
        // return  $render->render('addtobasket', $arguments);
    }
    
    public function RemoveFromCart(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render */
        $render = $arguments['render'];
       
        $IdclientCrudManager = new CrudManager('users', Users::class);

        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
        $id = $Idclient->id;

        $idproduct = $arguments["product_id"] ?? null; // Get the product's id

        $panier = new CrudManager('orders', Orders::class);

        $panier->RemoveFromCart($id, $idproduct); // Remove an order (remove a product from the basket)
        $render->addParams('removefromcart', $panier);
        header("Content-type: application/json;charset=utf-8");
        http_response_code(200);
        echo json_encode($panier);
        exit();
        // $render->addParams('removefromcart', $panier);
        // return  $render->render('removefromcart', $arguments);
    }

    public function PanierDynamique(...$arguments){
        if(isset($_SESSION['isConnected'])){
            /** @var \Motor\Mvc\Utils\Render */
            $render = $arguments['render'];
       

            $IdclientCrudManager = new CrudManager('users', Users::class);
            
            $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
            $id = $Idclient->id;
             
            $panier = new CrudManager('orders', Orders::class);
            $paniers = $panier->getbyidbasket($id);   
            $render->addParams('panier-modal', $paniers);
            
            
            header("Content-type: application/json;charset=utf-8");
            http_response_code(200);
            echo json_encode($paniers);
            exit();
        }
    }
}
    