<?php

require_once __DIR__ . '/../vendor/autoload.php';


$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');

$match = $router->match();

require '../elements/header.php';

if (is_array($match)) {
  $params = $match['params'];
  require "../templates/{$match['target']}.php";
} else {
  require "../templates/404.php";
}

require '../elements/footer.php';
