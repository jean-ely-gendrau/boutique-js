<?php

use App\Boutique\Utils\Render;

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$serverName = $_SERVER['HTTP_HOST'];
$router = new AltoRouter();
$rendering = new Render();
// création instance de Render

// Test de la route acceuil avec la méthode ProductTest de la classe TestRender
$router->map('GET', '/', 'TestRender#ProductTest', 'acceuil');

// Inscription/Connexion route
$router->map('GET', '/inscription', 'RegisterController#View', 'inscriptionForm');
$router->map('POST', '/inscription', 'RegisterController#Register', 'inscriptionRegister');
$router->map('GET', '/connexion', 'RegisterController#ViewConnect', 'connexionForm');
$router->map('POST', '/connexion', 'RegisterController#Connect', 'connexionConnect');
//

// define('BASE_TEMPLATE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

$router->map('GET', '/contact', 'contact', 'contact');

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
$router->map('GET', '/test-render', 'TestRender#Index', 'test-render-index');

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

// Si la route est bien enregistré avec $router->map alors on execute la condition
if (is_array($match)):
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
    if (str_contains($match['target'], '#')):
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
        $rendering->addParams(['uri' => $uri, 'serverName' => $serverName]);
        $match['params']['render'] = $rendering;
        // $match['params']['uri'] = $uri;
        // $match['params']['serverName'] = $serverName;
        // Si le $controller à bien une méthode définit dans la target (il faut que cette méthode soit callable est non static)
        // https://www.php.net/manual/en/function.is-callable.php
        if (is_callable([$controller, $method])):
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
        endif;
        /*Si la page 'target' ne contient pas de # on créé une nouvelle instance de Render
         *
         * On appel la méthode defaultRender prenant en paramétre
         * le nom de la page ($match['target']) et la variable $serverName
         *
         * Enfin on affiche le resultat de la méthode
         */
    else:
        echo $rendering->defaultRender($match['target'], $serverName);
    endif;
    /*Si la page demandé est inexistante, nouvelle instance de Render
     *
     * On passe en paramétre de la méthode la page '404'
     *
     * Enfin On affiche le résultat de la méthode
     */
else:
    echo $rendering->defaultRender("404", $serverName);

    /* APPEL ICI DE LA CLASS RENDER */
    // require_once __DIR__ . '/../template/404.php';
endif;
