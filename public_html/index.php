<?php

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$serverName = $_SERVER['HTTP_HOST'];
$router = new AltoRouter();

$router->map('GET', '/', 'acceuil', 'acceuil');
$router->map('GET', '/contact', 'contact', 'contact');

$router->map('GET', '/test-class', 'test-class', 'test-class'); // Route pour un essai avec la class Exemple
/*
 Cette route n'existe plus je la laisse pour un exemple des valeurs transmises par la méthode $_GET
  
  [*:slug]-[i:id] = $params['slug'] , $params['id']

  $router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
*/
$match = $router->match();

/*
  Cette partie devra être modifiée par la suite;
  une classe sera utilisée pour faire le rendu du template ainsi que le header et le footer
  les fonctions de Php ob_start() et ob_get_clean() ou ob_get_flush()
  devront être utilisés pour arriver à cela.  
*/
require_once __DIR__ . '/../element/header.php';

if (is_array($match)) {
    $params = $match['params'];

    require_once __DIR__ . "/../template/{$match['target']}.php";
} else {
    require_once __DIR__ . '/../template/404.php';
}

require_once __DIR__ . '/../element/footer.php';
