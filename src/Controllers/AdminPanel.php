<?php

namespace App\Boutique\Controllers;

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
  private $categoryInit;
  private $productInit;

  public function __construct()
  {
    $this->userInit = new CrudApi('users', Users::class);
    $this->categoryInit = new CrudManager('category', Category::class);
    $this->productInit = new CrudManager('products', ProductsModels::class);
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
    /* usersSelectAll
    *  On utilise la méthode getAll du CrudManager
    * Afin de sélectionné 
    */
    $usersSelectAll = $this->userInit->getAllPaginate();
    var_dump($usersSelectAll);
    /** @var \App\Boutique\Utils\Render $render */
    $render = $arguments['render'];
    $render->addParams('usersSelectAll', $usersSelectAll);

    // Rendre le template
    $content = $render->renderAdmin('users', $arguments);
    return $content;
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
    $usersSelect = $this->productInit->getAll();

    /** @var \App\Boutique\Utils\Render $render */
    $render = $arguments['render'];


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
    $usersSelect = $this->productInit->getAll();

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
}
