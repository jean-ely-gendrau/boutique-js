<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\Users;
use App\Boutique\Manager\CrudApi;
use App\Boutique\Models\Category;
use App\Boutique\Manager\CrudManager;
use App\Boutique\EntityManager\UsersEntity;
use App\Boutique\EntityManager\ProductsEntity;

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

    protected static function replaceUriWithReference($argumentsCall)
    {
        return preg_replace('/\/[0-9]*/', '', $argumentsCall);
    }
    /**
     * Méthode Index
     *
     * Affichage du tableau de bord Administrateur selon la table séléctionné (key : tableName)
     *
     * @param array ...$argumentsCall [uri,serverName,render,$_POST sous forme de key,$_GET sous forme de key] tous les arguments seront indexé dans le tableau sous forme de key => value.
     * @return void
     */
    public function Index(...$argumentsCall)
    {
        /** @var \App\Boutique\Utils\Render $render */
        $render = $argumentsCall['render'];

        switch ($argumentsCall['tableName']) {
            /*******
             * User
             */
            case 'users':
                /* selectAllPaginate
                 *  On utilise la méthode getAllPaginate du CrudApi
                 */
                $usersApi = new UsersEntity();

                $render->addParams('paginatePerPage', $usersApi->paginatePerPage(isset($argumentsCall['id']) ? $argumentsCall['id'] : 1, 10));

                $selectAllPaginate = $usersApi->getAllPaginate();
                if (isset($argumentsCall['id'])) {
                    $replaceURI = $render->getParams('uri');
                    $render->setParams('uri', str_replace("/{$argumentsCall['id']}", '', $replaceURI));
                }
                //var_dump($render->getParams('uri'));
                $render->addParams('categoryName', 'Utilisateurs');
                $render->addParams('selectAllPaginate', $selectAllPaginate);

                break;

            /*******
             * Products
             */
            case 'products':
                /* selectAllPaginate
                 *  On utilise la méthode getAllPaginate du CrudApi
                 */
                $productsApi = new ProductsEntity();

                $render->addParams('paginatePerPage', $productsApi->paginatePerPage(isset($argumentsCall['id']) ? $argumentsCall['id'] : 1, 5));

                $selectAllPaginate = $productsApi->getAllPaginate();

                if (isset($argumentsCall['id'])) {
                    $replaceURI = $render->getParams('uri');
                    $render->setParams('uri', str_replace("/{$argumentsCall['id']}", '', $replaceURI));
                }

                //var_dump($render->getParams('uri'));
                $render->addParams('categoryName', 'produits');
                $render->addParams('selectAllPaginate', $selectAllPaginate);

                break;

            /********
             * Category
             */
        }
        // Rendre le template
        $content = $render->renderAdmin($argumentsCall['tableName'], $argumentsCall);

        return $content;
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
                'isMove' => 'fas caret-up',
            ],
            [
                'icon-block' => 'fa-solid fa-bag-shopping',
                'title' => 'Total Commande',
                'color' => 'emerald',
                'value' => '3',
                'isMove' => 'fas caret-down',
            ],
            [
                'icon-block' => 'fa fa-solid fa-cart-shopping',
                'title' => 'Total Panier en attente',
                'color' => 'amber',
                'value' => '3',
                'isMove' => 'fas caret-up',
            ],
            [
                'icon-block' => 'fas fa-users',
                'title' => 'Total Utilisateurs',
                'color' => 'pink',
                'value' => $countUsers,
                'isMove' => 'fas fa-exchange-alt',
            ],
            [
                'icon-block' => 'fas fa-user-plus',
                'title' => 'Nouveaux Utilisateurs',
                'color' => 'yellow',
                'value' => '2',
                'isMove' => 'fas fa-caret-up',
            ],
            [
                'icon-block' => 'fas fa-server',
                'title' => 'Server en ligne',
                'color' => 'blue',
                'value' => '152',
            ],
            [
                'icon-block' => 'fas fa-tasks',
                'title' => 'Liste des tâches',
                'color' => 'indigo',
                'value' => '7 tâches',
            ],
            [
                'icon-block' => 'fas fa-tasks',
                'title' => 'Problème Client',
                'color' => 'red',
                'value' => '3',
                'isMove' => 'fas fa-caret-up',
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
        /* selectAllPaginate
         *  On utilise la méthode getAllPaginate du CrudApi
         */
        $selectAllPaginate = $this->userInit->getAllPaginate();
        //preg_replace('/\\\/', "", )

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

        $render->addParams('selectAllPaginate', $selectAllPaginate);

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
        /* selectAllPaginate
         *  On utilise la méthode getAllPaginate du CrudApi
         */
        $productsApi = new ProductsEntity();
        $selectAllPaginate = $productsApi->getAllPaginate();

        // var_dump($productsApi->paginatePerPage(1, 10));
        //echo '<pre>', var_dump($selectAllPaginate), '</pre>';

        /** @var \App\Boutique\Utils\Render $render */
        $render = $arguments['render'];

        $render->addParams('selectAllPaginate', $selectAllPaginate);
        $render->addParams('paginatePerPage', $productsApi->paginatePerPage(1, 10));
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

        echo '<pre>', var_dump($result), '</pre>';
        // Rendre le template
        $content = $render->renderAdmin('test', $arguments);
        return $content;
    }
}
