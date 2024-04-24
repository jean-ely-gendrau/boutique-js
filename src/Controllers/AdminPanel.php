<?php

namespace App\Boutique\Controllers;

use App\Boutique\Entity\ProductsEntity;
use App\Boutique\Manager\CrudApi;
use App\Boutique\Models\Users;
use App\Boutique\Models\Category;
use App\Boutique\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;

/**
 * AdminPanel
 * Contrôlleur pour l'administration du site Web
 */
class AdminPanel
{
  private $userInit;
  private $testInit;
  private $categoryInit;
  private $productInit;

  public function __construct()
  {
    $this->userInit = new CrudApi('users', Users::class);
    $this->testInit = new CrudManager('users', Users::class);
    $this->categoryInit = new CrudManager('category', Category::class);
  }

  /**
   * Méthode IndexPanel
   *
   * Affichage du tableau de bord Administrateur Géneralisé
   * 
   * @param array ...$arguments Les arguments transmis à la méthode.
   * @return void
   */
  public function IndexPanel(...$arguments)
  {
    $usersSelect = $this->userInit->getAllPaginate();
    $countUsers = count($usersSelect);
    $panelAdmin = [
      [
        'icon-block' => 'fa fa-wallet',
        'title' => 'Total Paiements',
        'color' => 'green',
        'value' => '€3249',
        'isMove' => 'fas caret-up'
      ],
      [
        'icon-block' => 'fa-solid fa-bag-shopping',
        'title' => 'Total Commande',
        'color' => 'emerald',
        'value' => '3',
        'isMove' => 'fas caret-down'
      ],
      [
        'icon-block' => 'fa fa-solid fa-cart-shopping',
        'title' => 'Total Panier en attente',
        'color' => 'amber',
        'value' => '3',
        'isMove' => 'fas caret-up'
      ],
      [
        'icon-block' => 'fas fa-users',
        'title' => 'Total Utilisateurs',
        'color' => 'pink',
        'value' => $countUsers,
        'isMove' => 'fas fa-exchange-alt'
      ],
      [
        'icon-block' => 'fas fa-user-plus',
        'title' => 'Nouveaux Utilisateurs',
        'color' => 'yellow',
        'value' => '2',
        'isMove' => 'fas fa-caret-up'
      ],
      [
        'icon-block' => 'fas fa-server',
        'title' => 'Server en ligne',
        'color' => 'blue',
        'value' => '152'
      ],
      [
        'icon-block' => 'fas fa-tasks',
        'title' => 'Liste des tâches',
        'color' => 'indigo',
        'value' => '7 tâches'
      ],
      [
        'icon-block' => 'fas fa-tasks',
        'title' => 'Problème Client',
        'color' => 'red',
        'value' => '3',
        'isMove' => 'fas fa-caret-up'
      ],
    ];
    $render = $arguments['render'];
    /** @var \App\Boutique\Utils\Render $render */
    $render->addParams('panelAdmin', $panelAdmin);
    // Rendre le template
    $content = $render->renderAdmin('panel', $arguments);
    return $content;
  }


  /**
   * Méthode IndexPanel
   *
   * Affichage du tableau de bord Administrateur Utilisateurs
   * 
   * @param array ...$arguments Les arguments transmis à la méthode.
   * @return void
   */
  public function IndexUsers(...$arguments)
  {
    /* usersAllPaginate
    *  On utilise la méthode getAllPaginate du CrudApi
    */
    $usersAllPaginate = $this->userInit->getAllPaginate();
    //preg_replace('/\\\/', "", )
    echo json_encode($usersAllPaginate);
    /*
    $data['id_user'] = 1;
    $data['full_name'] = "test name";
    $data['email'] = "testmail@test.com";
    $data['password'] = "testpass";
    $data['birthday'] = "2020-04-18";
    $data['adress'] = "83000";

    $user = new Users($data);
    $this->testInit->update($user, ['id_user', 'full_name', 'email', 'password', 'birthday', 'adress']);
    */
    //var_dump($usersSelectAll);

    /** @var \App\Boutique\Utils\Render $render */
    $render = $arguments['render'];

    $render->addParams('usersAllPaginate', $usersAllPaginate);

    // Rendre le template
    $content = $render->renderAdmin('users', $arguments);
    //return $content;
  }

  /**
   * Méthode IndexProducts
   *
   * Affichage du tableau de bord Administrateur Produits
   * 
   * @param array ...$arguments Les arguments transmis à la méthode.
   * @return void
   */
  public function IndexProducts(...$arguments)
  {
    /* productsAllPaginate
    *  On utilise la méthode getAllPaginate du CrudApi
    */
    $productsApi = new ProductsEntity();
    $productsAllPaginate = $productsApi->getAllPaginate();

    //echo '<pre>', var_dump($productsAllPaginate), '</pre>';

    /** @var \App\Boutique\Utils\Render $render */
    $render = $arguments['render'];

    $render->addParams('productsAllPaginate', $productsAllPaginate);

    // Rendre le template
    $content = $render->renderAdmin('products', $arguments);
    return $content;
  }

  /**
   * Méthode IndexOrders
   *
   * Affichage du tableau de bord Administrateur Des commandes
   * 
   * @param array ...$arguments Les arguments transmis à la méthode.
   * @return void
   */
  public function IndexOrders(...$arguments)
  {
    // $usersSelect = $this->productInit->getAll();

    /** @var \App\Boutique\Utils\Render $render */
    $render = $arguments['render'];


    // Rendre le template
    $content = $render->renderAdmin('orders', $arguments);
    return $content;
  }

  /**
   * Méthode IndexOrders
   *
   * Affichage du tableau de bord Administrateur Des Categories et sous categories
   * 
   * @param array ...$arguments Les arguments transmis à la méthode.
   * @return void
   */
  public function IndexCategory(...$arguments)
  {
    $usersSelect = $this->categoryInit->getAll();

    /** @var \App\Boutique\Utils\Render $render */
    $render = $arguments['render'];


    // Rendre le template
    $content = $render->renderAdmin('category', $arguments);
    return $content;
  }

  /**
   * Méthode IndexTest
   *
   * Affichage du tableau de bord Administrateur Des Categories et sous categories
   * 
   * @param array ...$arguments Les arguments transmis à la méthode.
   * @return void
   */
  public function IndexTest(...$arguments)
  {
    $usersSelect = $this->categoryInit->getAll();

    /** @var \App\Boutique\Utils\Render $render */
    $render = $arguments['render'];

    $crudManager = new CrudManager('users', Users::class);
    $result = $crudManager->getAll();

    echo '<pre>',
    var_dump($result),
    '</pre>';
    // Rendre le template
    $content = $render->renderAdmin('test', $arguments);
    return $content;
  }
}
