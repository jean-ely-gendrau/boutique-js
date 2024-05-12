<?php

use Motor\Mvc\Utils\Render;
use Motor\Mvc\Components\Debug;
use Motor\Mvc\Exceptions\MotorMvcException;

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$serverName = $_SERVER['HTTP_HOST'];
$router = new AltoRouter();

// création instance de Render
$rendering = new Render();
// Appelle de la méthode addParams afin d'ajouter la variable $uri et $serverName
$rendering->addParams(['uri' => $uri, 'serverName' => $serverName]);

// Test de la route acceuil avec la méthode ProductTest de la classe TestRender
$router->map('GET', '/', 'HomeController#RenderHome', 'accueil');

// page de tout les produits café et thé
// $router->map('GET', '/produit/[a:categoryName]', 'produit', 'produit');
// $router->map('POST', '/produit/[a:categoryName]', 'produit', 'produit-post');

// // page detail du produit sélectionné
// $router->map('GET', '/detail/[a:id_product]', 'detail', 'detail');

// ---------------------------------

// page de tout les produits café et thé
$router->map('GET', '/produit/[a:categoryName]', 'ProductController#Produit', 'produit');
$router->map('POST', '/produit/[a:categoryName]', 'ProductController#Produit', 'produit-post');

// page detail du produit sélectionné
// $router->map('GET', '/detail/[a:id_product]', 'ElementProduit#produitElement', 'detail');

// Modification de la route 'detail' par 'details-produit', majuscule rajouté à la méthode ProduitElement
$router->map('GET', '/detail/[a:product_id]', 'ElementProduit#ProduitElement', 'details-produit');

// -------------------------------

$router->map('GET', '/api/products', 'ApiController#GetProductsAll', 'products');
$router->map('GET', '/api/products/[a:category]', 'ApiController#GetProductsByCategory', 'products-category');
$router->map('GET', '/api/category', 'ApiController#GetCategory', 'categorys');
$router->map('GET', '/api/orders', 'ApiController#GetOrders', 'orders');
$router->map('GET', '/api/users', 'ApiController#GetUsers', 'users');
$router->map('GET', '/api/users/[i:id]', 'ApiController#GetUserById', 'user');
$router->map('GET', '/api/products/[i:id]', 'ApiController#GetProductById', 'product');
$router->map('GET', '/api/category/[i:id]', 'ApiController#GetCategoryById', 'category');
$router->map('GET', '/api/orders/[i:id]', 'ApiController#GetOrderById', 'order');
$router->map('POST', '/api/Products', 'ApiController#addProducts', 'addProducts');
$router->map('POST', '/api/Category', 'ApiController#addCategory', 'addCategory');
$router->map('POST', '/api/Orders', 'ApiController#addOrders', 'addOrders');
$router->map('POST', '/api/Users', 'ApiController#addUsers', 'addUsers');
$router->map('POST', '/api/Products/[i:id]', 'ApiController#updateProducts', 'updateProducts');
$router->map('POST', '/api/Category/[i:id]', 'ApiController#updateCategory', 'updateCategory');
$router->map('POST', '/api/Orders/[i:id]', 'ApiController#updateOrders', 'updateOrders');
$router->map('POST', '/api/Users/[i:id]', 'ApiController#updateUsers', 'updateUsers');
$router->map('DELETE', '/api/Products/[i:id]', 'ApiController#deleteProducts', 'deleteProducts');
$router->map('DELETE', '/api/Category/[i:id]', 'ApiController#deleteCategory', 'deleteCategory');
$router->map('DELETE', '/api/Orders/[i:id]', 'ApiController#deleteOrders', 'deleteOrders');
$router->map('DELETE', '/api/Users/[i:id]', 'ApiController#deleteUsers', 'deleteUsers');

$router->map('GET', '/search', 'ApiController#GetProductsAll', 'search');

$router->map('GET', '/addtobasket/[a:product_id]', 'PanierController#AddToBasket', 'addtobasket');

$router->map('GET', '/produit/addtobasket/[a:product_id]', 'PanierController#AddToBasket', 'addtobasketProduit');

$router->map('GET', '/removefromcart/[a:product_id]', 'PanierController#RemoveFromCart', 'removefromcart');

// Route page profil
$router->map('GET', '/user', 'ProfilController#Profil', 'user-profile');
$router->map('GET', '/modification', 'modification', 'modification');
$router->map('POST', '/modification', 'ModificationController#Modification', 'modificationModification');
$router->map('GET', '/historique', 'HistoriqueController#Historique', 'historique');
//$router->map('POST', '/historique', 'HistoriqueController#Historique', 'historiqueTable');
$router->map('GET', '/panier', 'PanierController#Panier', 'panier');
//$router->map('POST', '/panier', 'PanierController#Panier', 'panierTable');

// Inscription/Connexion route
$router->map('GET', '/inscription', 'RegisterController#View', 'inscriptionForm');
$router->map('POST', '/inscription', 'RegisterController#Register', 'inscriptionRegister');
$router->map('GET', '/connexion', 'RegisterController#ViewConnect', 'connexionForm');
$router->map('POST', '/connexion', 'RegisterController#Connect', 'connexionConnect');


/****
 * BLOC CONDITION PROVISOIR POUR VOIR POUR LE PANEL ADMIN
 */
if ($rendering->give('role') === 'admin') {
  /****************************
   * Route API-HTML To JSON
   */
  $router->map('GET|POST', '/api-html/form/[a:tableName]', 'HtmlToJsonController#FormAdmin', 'api-html-tojson-form');
  $router->map('GET|POST', '/api-html/template/[a:pageTemplate]/[i:idGet]', 'HtmlToJsonController#Template', 'api-html-tojson-template');
  /****************************
   * Route Administration
   */
  $router->map('GET', '/panel-admin', 'AdminPanel#IndexPanel', 'admin-panel-index');
  /*
$router->map('GET', '/panel-admin/users', 'AdminPanel#IndexUsers', 'admin-panel-users');
$router->map('GET', '/panel-admin/products', 'AdminPanel#IndexProducts', 'admin-panel-products');
$router->map('GET', '/panel-admin/orders', 'AdminPanel#IndexOrders', 'admin-panel-orders');
$router->map('GET', '/panel-admin/category', 'AdminPanel#IndexCategory', 'admin-panel-category');
$router->map('GET', '/panel-admin/test', 'AdminPanel#IndexTest', 'admin-panel-test');
*/

  $router->map('GET|POST', '/panel-admin/[a:tableName]', 'AdminPanel#Index', 'admin-panel-select');
  $router->map('GET|POST', '/panel-admin/[a:tableName]/[i:id]', 'AdminPanel#Index', 'admin-panel-select-page');
}

$router->map('GET', '/deconnexion', 'RegisterController#Deconnect', 'deconnexion');

// Route filter controller
$router->map('GET', '/js-testAll/[a:idCat]', 'FilterPrice#produitElement', 'queryAll');
$router->map('GET', '/js-testSub/[a:idCat]/[a:idSubCat]', 'FilterPrice#produitElement', 'querySubCat');
$router->map('GET', '/js-testFilter/[a:idCat]/[a:filter]', 'FilterPrice#produitElement', 'queryFilter');
$router->map('GET', '/js-testBoth/[a:idCat]/[a:idSubCat]/[a:filter]', 'FilterPrice#produitElement', 'queryBoth');

// Route wishlist
$router->map('GET', '/favoris/[i:product]', 'Favoris#VerifyFavorite', 'testIsConnected');
$router->map('GET', '/addFavoris/[i:product]', 'Favoris#ToggleFavorite', 'addFavorite');
/**
 * Route d'exemple pour l'utilisation de la méthode post JS de teaCoffee Module
 */
$router->map('GET', '/sample-to-favorites', 'FilterPrice#produitElement', 'sample-add-to-favorites');
$router->map('POST', '/sample-connect-js', 'RegisterController#ConnectJS', 'sample-connect-js');
/**********
 * FormBuilder Routes Pour les testes
 */
// Inscription
$router->map('GET', '/form-test-inscription', 'FormControllerTest#RegistrationForm', 'form-registration');
$router->map('POST', '/form-test-inscription', 'FormControllerTest#RegistrationForm', 'form-registration-validate');

// Connect
$router->map('GET', '/form-test-connect', 'FormControllerTest#ConnectForm', 'form-connect');
$router->map('POST', '/form-test-connect', 'FormControllerTest#ConnectUser', 'form-connect-validate');

// define('BASE_TEMPLATE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

$router->map('GET', '/contact', 'contact', 'contact');
$router->map('POST', '/contact', 'RegisterController#ContactMail', 'contactForm');

/************* CGV/CGU ****************/

$router->map('GET', '/condition/cgv', 'condition/cgv', 'cgv');
$router->map('GET', '/condition/cgu', 'condition/cgu', 'cgu');

/************* Info Client ************/
$router->map('GET', '/information/livraison', 'information/livraison', 'livraison');
$router->map('GET', '/information/paiement', 'information/paiement', 'paiement');
$router->map('GET', '/information/boutique', 'information/boutique', 'boutique');
/*
  Classe-Render-View Route test
  Avec cette route nous allons appeler le contrôlleur TestRender

  paramètres de la route :

  $method = GET
  $route  = /test-render
  $target = TestRender#Index (le séparateur #) avec le séparateur on à le nom_du_controller # nom_de_la_method
  $name   = test-render-index

  Ici on appel la class TestRender avec la méthode View
*/
$router->map('GET', '/test-render', 'StripeController#TestGetArgument', 'test-render-index');

// Route à supprimer
$router->map('GET', '/basket', 'StripeController#Index', 'basket');

// Route renvoyant sur l'API Stripe checkout
$router->map('GET', '/stripe/pay', 'StripeController#Pay', 'pay');

// // Route si le paiment est abandonné
$router->map('GET', '/stripe/cancel', 'stripe/cancel', 'cancel');

// // Route si le paiement est confirmé
$router->map('GET', '/stripe/success', 'stripe/success', 'success');

/*
 Routeur: $_GET->/sample-modal-viewer
  Avec cette route nous allons afficher une page avec différente modal
Générer avec la CLASS ModalBuilder

  paramètres de la route :

  $method = GET
  $route  = /sample-modal-viewer
  $target = (C) ModalController # (M) Index 
  $name   = modal-controller-index

  (C) Controller
  (M) Method
*/
$router->map('GET', '/sample-modal-viewer', 'Modal\\ModalController#Index', 'modal-controller-index');

/*
  Class MailManager Route test
  Avec cette route nous allons faire un essaie d'envoie d'email

  paramètres de la route :

  $method = GET
  $route  = /test-mail-sender
  $target = TestMailSender#SendMail (le séparateur #) avec le séparateur on à le nom_du_controller # nom_de_la_method
  $name   = test-mail-sender

  Ici on appel la class TestMailSender avec la méthode SendMail
*/
$router->map('GET', '/test-mail-sender', 'TestMailSender#SendMail', 'test-mail-sender');

$router->map('GET', '/test-class', 'test-class', 'test-class'); // Route pour un essai avec la class Exemple

/*
 Cette route n'existe plus je la laisse pour un exemple des valeurs transmises par la méthode $_GET
  
  [*:slug]-[i:id] = $params['slug'] , $params['id']

  $router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
*/

$match = $router->match();

// SUPPRESSION DU HEADER SERA RENDU PAR LA CLASS RENDER
//require_once __DIR__ . '/../element/header.php';

// TRY POUR CAPTURER LES EXCEPTION
try {

  // Si la route est bien enregistré avec $router->map alors on execute la condition
  if (is_array($match)) :
    $params = $match['params'];

    /* Cas de Figure Du contrôlleur et de la méthod à appeler
   * Exemple : $router->map('GET', '/test-render', 'TestRender#Index', 'test-render-index');
   * Le controller TestRender
   * la méthod Index
   *
   *                      Modification apporté
   *
   * Ov va tester la $match['target'] variable avec str_contains
   *
   * Si la chaîne contient un # alors nous sommes dans le cas de figure
   * ou l'on souhaite faire appel à une class dite Contrôler (car elle va piloter l'exécution de notre code)
   *
   * - Traiter les données avant de les rendre au client
   * - Ajouter en base de données, faire des calculs ou toute autre action côté serveur
   */
    if (str_contains($match['target'], '#')) :
      // On assign les valeurs du tableau à
      // $contoller pour $match['target'][0]
      // $method    pour $match['target'][1]
      [$controllers, $method] = explode('#', $match['target']);

      // Définir le namespace du contrôlleur
      $controller = 'App\\Boutique\\Controllers\\' . $controllers;

      // On s'assure que la class existe pour éviter les erreurs. (fonction ternaire) condition ? true : false
      // Si c'est vrai on instancie la class Controller sinon on assigne false à la vartiable $controller
      $controller = class_exists($controller) ? new $controller() : false;

      /*
     * Récupération des valeurs transmises par $_POST
     * On parcourt le tableau $_POST et on assigne chaque valeur
     * $match['params']['post']['key';
     * Sur chaque valeur on applique un peu de sécuriser en effacer les caractères vides en début et fin de chaîne trim()
     * ensuite on convertit les caractères spéciaux en code html pour s'assurer qu'aucun code malveillant et transmis par l'utilisateur
     */
      if (isset($_POST)) {
        foreach ($_POST as $key => $value) {
          $match['params'][$key] = htmlspecialchars(trim($value));
        }

        //DEBUG var_dump($match);
      }

      /* Ajoute l'Uri dans les params à transmettre à la class Controller
        // Ajoute le nom de domaine dans les params à transmettre à la class Controller(Pour le lien des images par exemple)

        */
      $match['params']['render'] = $rendering;

      // Test De la Debug BAR : Debug::view($match);

      // $match['params']['uri'] = $uri;
      // $match['params']['serverName'] = $serverName;
      // Si le $controller à bien une méthode définit dans la target (il faut que cette méthode soit callable est non static)
      // https://www.php.net/manual/en/function.is-callable.php
      if (is_callable([$controller, $method])) :
        /*
             * Toutes les conditions sont remplies pour exécuter la méthode de notre contrôleur
             * on utilise call_user_func_array pour instanciées la class charger précédemment dans la variable $controller
             * en deuxième paramètre on lui passe un tableau d'argument que nous récupérons dans la méthode que l'ont à déclarer dans $method
             * 
             * exemple simple de la doc
               $func = function($arg1, $arg2) {
                    return $arg1 * $arg2;
                };

          var_dump(call_user_func_array($func, array(2, 4)));
          $arg1 = 2
          $arg2 = 4
          Ici il charge la function $func et il passe un tableau avec deux variable

          Cela permet de charger dynamique des function ou des méthodes définit dans les class.
       * https://www.php.net/manual/en/function.call-user-func-array.php
       */

        echo call_user_func_array([$controller, $method], $match['params']);
      else :
      /* EXCEPTION ICI */

      // COMMENTS CE CODE SERA A NETTOYER DANS LA VERSION FINAL
      //   goto error; // Si le controlleur est false ou que la méthode n'est pas de type callable exécution de : goto error  (goto peut être utilisé pour continuer l'exécution du script à un autre point du programme)
      endif;
    /*Si la page 'target' ne contient pas de # on créé une nouvelle instance de Render
     *
     * On appel la méthode defaultRender prenant en paramétre
     * le nom de la page ($match['target']) et la variable $serverName
     *
     * Enfin on affiche le resultat de la méthode
     */
    else :
      $rendering->addParams('params', $match['params']);
      echo $rendering->defaultRender($match['target']);
    endif;
  endif;
} catch (MotorMvcException $mvcException) {
  /*Si la page demandé est inexistante, nouvelle instance de Render
   *
   * On passe en paramétre de la méthode la page '404'
   *
   * Enfin On affiche le résultat de la méthode
   */
  $rendering->addParams('mvcException', $mvcException);
  echo $rendering->defaultRender('404');
}





   // COMMENTS CE CODE SERA A NETTOYER DANS LA VERSION FINAL
// GOTO ERROR
/*
else :
  error:
  echo $rendering->defaultRender('404');
/* APPEL ICI DE LA CLASS RENDER */
// require_once __DIR__ . '/../template/404.php';
//endif;