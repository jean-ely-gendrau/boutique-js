<?php

namespace App\Boutique\Controllers;

use App\Boutique\EntityManager\OrdersEntity;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudApi;
use Motor\Mvc\Components\Debug;
use App\Boutique\Models\Category;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\EntityManager\UsersEntity;
use App\Boutique\EntityManager\ProductsEntity;
use App\Boutique\Enum\BasketSvgEnum;
use App\Boutique\Forms\ProductsAdminForms;
use App\Boutique\Forms\SelectBoxForms;
use Motor\Mvc\Builder\ModalBuilder;

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
     * Method returnJson
     *
     * @param int $codeHTTP [code de la réponse http]
     * @param mixed $data [les données à transmettre dans le corp du body]
     *
     * @return void
     */
    protected function returnJson(int $codeHTTP, mixed $data): void
    {
        header('Content-type: application/json; charset=utf-8');
        http_response_code($codeHTTP);
        echo json_encode($data);
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
        /** @var \Motor\MVC\Utils\Render $render */
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

                $render->addParams('paginatePerPage', $usersApi->paginatePerPage(isset($argumentsCall['id']) ? $argumentsCall['id'] : 1, 50));

                $selectAllPaginate = $usersApi->getAllPaginate();
                if (isset($argumentsCall['id'])) {
                    $replaceURI = $render->getParams('uri');
                    $render->addParams('uri', str_replace("/{$argumentsCall['id']}", '', $replaceURI));
                }

                $newModalUser = new ModalBuilder();
                $newModalUser->setIdModal('modal-form-users');
                $newModalUser->addHeader('modal-add-users-adm', '<h2 class="text-gray-900 text-base md:text-lg text-center block w-full p-2.5 dark:text-white">Formulaire utilisateurs</h2>')
                    ->addBody('body-modal-add-users-adm', '<div id="form-registration"></div>');

                $buttonModalUser =   $newModalUser->renderOpenButton('
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Ajouter un utilisateur', [
                    'type' => 'button',
                    'class' =>
                    'flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
                    'data-js' => 'handleViewHtml,click',
                    'data-route' => '/api-html/form/users',
                    'data-target-id' => 'form-registration',
                ]);

                $render->addParams([
                    'newModalUser' => $newModalUser,
                    'buttonModalUser' => $buttonModalUser
                ]);

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

                $render->addParams('paginatePerPage', $productsApi->paginatePerPage(isset($argumentsCall['id']) ? $argumentsCall['id'] : 1, 50));

                $selectAllPaginate = $productsApi->getAllPaginate();

                if (isset($argumentsCall['id'])) {
                    $replaceURI = $render->getParams('uri');
                    $render->addParams('uri', str_replace("/{$argumentsCall['id']}", '', $replaceURI));
                }
                //var_dump($selectAllPaginate);
                //var_dump($render->getParams('uri'));
                $newModalProduct = new ModalBuilder();
                $newModalProduct->setIdModal('modal-form-product');
                $newModalProduct->addHeader('modal-add-product-adm', '<h2 class="text-gray-900 text-base md:text-lg text-center block w-full p-2.5 dark:text-white">Formulaire produits</h2>')
                    ->addBody('body-modal-add-product-adm', '<div id="admin-form-product"></div>');

                $buttonModalProduct =   $newModalProduct->renderOpenButton('
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Ajouter un produit', [
                    'type' => 'button',
                    'class' =>
                    'flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
                    'data-js' => 'handleViewHtml,click',
                    'data-route' => '/api-html/form/products',
                    'data-target-id' => 'body-modal-add-product-adm',
                ]);
                $render->addParams([
                    'newModalProduct' => $newModalProduct,
                    'buttonModalProduct' => $buttonModalProduct
                ]);
                $render->addParams('categoryName', 'produits');
                $render->addParams('selectAllPaginate', $selectAllPaginate);

                break;


                /*******
                 * orders
                 */
            case 'orders':
                /* selectAllPaginate
                     *  On utilise la méthode getAllPaginate du CrudApi
                     */
                $ordersApi = new OrdersEntity();

                $render->addParams('paginatePerPage', $ordersApi->paginatePerPage(isset($argumentsCall['id']) ? $argumentsCall['id'] : 1, 50));

                $selectAllPaginate = $ordersApi->getAllPaginate();

                $render->addParams(['getEnumStatus' => explode(',', str_replace(['enum', '(', ')', "'"], '', $ordersApi->getColumnParam('status')['Type'])), 'selectBoxStatus' => SelectBoxForms::class, 'basketStatus' => BasketSvgEnum::class]);
                if (isset($argumentsCall['id'])) {
                    $replaceURI = $render->getParams('uri');
                    $render->addParams('uri', str_replace("/{$argumentsCall['id']}", '', $replaceURI));
                }
                //var_dump($selectAllPaginate);
                //var_dump($render->getParams('uri'));
                $newModalOrder = new ModalBuilder();
                $newModalOrder->setIdModal('modal-form-order');
                $newModalOrder->addHeader('modal-add-order-adm', '<h2 class="text-gray-900 text-base md:text-lg text-center block w-full p-2.5 dark:text-white">Formulaire commandes</h2>')
                    ->addBody('body-modal-add-order-adm', '<div></div>');

                $buttonModalOrder =   $newModalOrder->renderOpenButton('
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Créer une commande', [
                    'type' => 'button',
                    'class' =>
                    'flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
                    'data-js' => 'handleViewHtml,click',
                    'data-route' => '/api-html/form/orders',
                    'data-target-id' => 'body-modal-add-order-adm',
                ]);
                $render->addParams([
                    'newModalOrder' => $newModalOrder,
                    'buttonModalOrder' => $buttonModalOrder
                ]);

                $render->addParams('categoryName', 'commandes');
                $render->addParams('selectAllPaginate', $selectAllPaginate);

                break;
        }
        // Rendre le template
        $content = $render->renderAdmin("admin/{$argumentsCall['tableName']}", $argumentsCall);

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
        $content = $render->renderAdmin('admin/panel', $arguments);
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
        $content = $render->renderAdmin('admin/users', $arguments);
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
        $content = $render->renderAdmin('admin/products', $arguments);
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
        $content = $render->renderAdmin('admin/orders', $arguments);
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
        $content = $render->renderAdmin('admin/category', $arguments);
        return $content;
    }
}
