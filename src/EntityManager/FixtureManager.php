<?php

namespace App\Boutique\EntityManager;

use Motor\Mvc\Components\Debug;
use App\Boutique\Models\Category;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Fixtures\TypesTea;
use App\Boutique\Models\Fixtures\AromasTea;
use App\Boutique\Models\Fixtures\FlavorsTea;
use App\Boutique\Models\Fixtures\TypesCoffee;
use App\Boutique\Models\Fixtures\AromasCoffee;
use App\Boutique\Models\Fixtures\FlavorsCoffee;
use App\Boutique\Models\Users as U; // Model Users
use App\Boutique\Models\Fixtures\CountryProductTea;
use App\Boutique\Models\Fixtures\CharacteristicsTea;
use App\Boutique\Models\Fixtures\CountryProductCoffee;
use App\Boutique\Models\Fixtures\CharacteristicsCoffee;
use Motor\Mvc\Manager\CrudManager as CrudM; // Crud et un alias de CrudManager
use App\Boutique\Models\Fixtures\CodesPose as CP; // Model Code Postal // BDD SHIPPING
use App\Boutique\Models\Fixtures\UsersProfile as UsersFix; // Model Users Dummy // BDD SHIPPING

class FixtureManager extends CrudM
{
    protected $data;

    public function __construct(?string $model = null, array|object $data = null, $config = null)
    {
        parent::__construct();
        $this($model, $data, $config);
        // var_dump('model', $this->model);
        return $this;
    }

    public function updateUserPassword(array|object $data = null)
    {
        $this(U::class, $data);

        // Configuration de la connexion au service Shipping Code postal
        $configJsonBddCodePose = json_decode(
            json_encode([
                'dsn' => 'mysql',
                'bdd' => 'shipping',
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'port' => '3306',
                'charset' => 'utf8mb4',
            ]),
        );

        //   $user(CP::class, $data, $configJsonBddCodePose);
        // $codePose = $user->crud->getAll();
        // Debug::view($user);

        // getAll users
        //  $this->crud->getAll();

        // users traitement

        foreach ($this->crud->getAll() as $key => $user) {
            //format l'email de lutilisateur pour extraire avant le @
            $replace = substr(preg_replace('/[a-zA-Z0-9\-_.]+$/', '', $user->email), 0, -1);
            var_dump(ucfirst($replace . '83!'), $user);
            // Création Du mots de pass selon la statégie de mots de passe choisit.
            file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'passwdUser.txt', ucfirst($replace . '83!') . PHP_EOL, FILE_APPEND);
            var_dump($user);
            $user->setPassword(ucfirst($replace . '83!'));
            // Pour les 5 premier résulta de la table : admin
            if ($key < 5) {
                $user->setRole('admin');
            }
            $this->crud->update($user, ['password']);

            // exit();
        }
    }

    public function createUser(array|object $data = null)
    {
        //  $this(U::class, $data);

        // Configuration de la connexion au service Shipping usersprofile
        $configJsonBddShippingDataDummy = json_decode(
            json_encode([
                'dsn' => 'mysql',
                'bdd' => 'shipping',
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'port' => '3306',
                'charset' => 'utf8mb4',
            ]),
        );

        $this(UsersFix::class, $data, $configJsonBddShippingDataDummy);
        $crudCodePose = new CrudM('codespose', CP::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudUserNew = new CrudM('users', U::class);
        $paginate = $crudCodePose->crud->paginatePerPage(1, 1);
        $codePose = $crudCodePose->crud->getAll(); // Séléction de tout les enregistrements de la bdd shipping codespose

        //  Debug::view($paginate);

        // getAll users
        //  $this->crud->getAll();

        // users traitement
        $newUsers = [];
        $this->crud->paginatePerPage(2, 30);
        foreach ($this->crud->getAllPaginate() as $key => $user) {
            $newUsersModel = new U(); // Instance de Users Model
            $randSelectCodePose = rand(0, $paginate['number_pages'] - 1); // Numéro de l'index à séléctionné
            $codePoseSelected = $codePose[$randSelectCodePose];

            $newUsersModel->setFull_name("{$user->full_name}");
            $newUsersModel->setEmail("{$user->email}");
            $newUsersModel->setAdress("{$codePoseSelected->getCommune()} {$codePoseSelected->getCodepos()} - {$codePoseSelected->getDepartement()}");
            //format l'email de lutilisateur pour extraire avant le @
            $replace = substr(preg_replace('/[a-zA-Z0-9\-_.]+$/', '', $user->email), 0, -1);
            $newUsersModel->setBirthday($user->birthday);
            $newUsersModel->setPassword(ucfirst($replace . '83!'));
            $newUsersModel->setRole('user');
            $newUsers[] = $newUsersModel;
            // var_dump($newUsersModel);
            $crudUserNew->crud->create($newUsersModel, ['full_name', 'email', 'password', 'birthday', 'adress', 'role']);

            // exit();
        }
        var_dump($newUsers);
    }

    public function createProduct(array|object $data = null)
    {
        //  $this(U::class, $data);

        // Configuration de la connexion au service Shipping usersprofile
        $configJsonBddShippingDataDummy = json_decode(
            json_encode([
                'dsn' => 'mysql',
                'bdd' => 'shipping',
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'port' => '3306',
                'charset' => 'utf8mb4',
            ]),
        );

        // $this(ProductsModels::class, $data);
        $newProductManager = new CrudM('products', ProductsModels::class, 25, 1);
        $categories = new CrudM('category', Category::class, 25, 1);

        $crudFixtureCoffeeAromas = new CrudM('aromascoffee', AromasCoffee::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureCoffeeTypes = new CrudM('typescoffee', TypesCoffee::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureCoffeeCharacts = new CrudM('characteristicscoffee', CharacteristicsCoffee::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureCoffeeCountry = new CrudM('countryproductcoffee', CountryProductCoffee::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureCoffeeFlavors = new CrudM('FlavorsCoffee', FlavorsCoffee::class, 25, 1, $configJsonBddShippingDataDummy);

        //   $paginate = $crudCodePose->crud->paginatePerPage(1, 1);
        //    $codePose = $crudCodePose->crud->getAll(); // Séléction de tout les enregistrements de la bdd shipping codespose

        // Debug::view($categories->getSubCatByCategory_id(1));

        // getAll users
        //  $this->crud->getAll();

        // users traitement
        $newProducts = [];
        $priceFloat = [00, 25, 50];

        // $this->crud->paginatePerPage(2, 30);
        foreach ($categories->getSubCatByCategory_id(1) as $category) {
            foreach ($crudFixtureCoffeeTypes->crud->getAll() as $keyTypes => $typeCoffee) {
                $newProductsModel = new ProductsModels();

                $newProductsModel->setName("{$category->getName()} {$typeCoffee->name} {$category->getSubName()}");
                $newProductsModel->setDescription(
                    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit laudantium maxime dolorum dolorem veritatis itaque, aliquam inventore quasi vel iste quidem expedita hic animi, aliquid ad excepturi perspiciatis magnam quos!',
                );
                $float = rand(2, 14) . '.' . $priceFloat[rand(0, 2)];

                $newProductsModel->setPrice(number_format($float, 2, '.', ' '));
                $newProductsModel->setQuantity(rand(2, 100));
                $newProductsModel->setCategory_id($category->getCategory_id());
                $newProductsModel->setSub_category_id($category->getSub_id());
                $newUsers[] = $newProductsModel;
                // var_dump($newProductsModel);
                // $newProductManager->crud->create($newProductsModel, ['name', 'description', 'price', 'quantity', 'category_id', 'sub_category_id']);

                //  exit();
            }
        }
        // var_dump($newProducts);
    }

    public function createProductTea(array|object $data = null)
    {
        //  $this(U::class, $data);

        // Configuration de la connexion au service Shipping usersprofile
        $configJsonBddShippingDataDummy = json_decode(
            json_encode([
                'dsn' => 'mysql',
                'bdd' => 'shipping',
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'port' => '3306',
                'charset' => 'utf8mb4',
            ]),
        );

        // $this(ProductsModels::class, $data);
        $newProductManager = new CrudM('products', ProductsModels::class, 25, 1);
        $categories = new CrudM('category', Category::class, 25, 1);

        $crudFixtureTeaAromas = new CrudM('aromastea', AromasTea::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureTeaTypes = new CrudM('typestea', TypesTea::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureTeaCharacts = new CrudM('characteristicstea', CharacteristicsTea::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureTeaCountry = new CrudM('countryproducttea', CountryProductTea::class, 25, 1, $configJsonBddShippingDataDummy);
        $crudFixtureTeaFlavors = new CrudM('FlavorsTea', FlavorsTea::class, 25, 1, $configJsonBddShippingDataDummy);

        //   $paginate = $crudCodePose->crud->paginatePerPage(1, 1);
        //    $codePose = $crudCodePose->crud->getAll(); // Séléction de tout les enregistrements de la bdd shipping codespose

        // Debug::view($categories->getSubCatByCategory_id(1));

        // getAll users
        //  $this->crud->getAll();

        // users traitement
        $newProducts = [];
        $priceFloat = [00, 25, 50];

        // $this->crud->paginatePerPage(2, 30);
        foreach ($categories->getSubCatByCategory_id(1) as $category) {
            foreach ($crudFixtureTeaTypes->crud->getAll() as $keyTypes => $typeTea) {
                $newProductsModel = new ProductsModels();

                $newProductsModel->setName("{$category->getName()} {$typeTea->name} {$category->getSubName()}");
                $newProductsModel->setDescription(
                    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit laudantium maxime dolorum dolorem veritatis itaque, aliquam inventore quasi vel iste quidem expedita hic animi, aliquid ad excepturi perspiciatis magnam quos!',
                );
                $float = rand(2, 14) . '.' . $priceFloat[rand(0, 2)];

                $newProductsModel->setPrice(number_format($float, 2, '.', ' '));
                $newProductsModel->setQuantity(rand(2, 100));
                $newProductsModel->setCategory_id($category->getCategory_id());
                $newProductsModel->setSub_category_id($category->getSub_id());
                $newProductsModel->setImage_main(true);
                $newProductsModel->setUrl_image("{$category->getName()} {$typeTea->name}");

                $newUsers[] = $newProductsModel;
                // var_dump($newProductsModel);
                $newProductManager->crud->createProductWhitImage($newProductsModel, [
                    'name',
                    'description',
                    'price',
                    'quantity',
                    'category_id',
                    'sub_category_id',
                ]);

                //  exit();
            }
        }
        var_dump($newProducts);
    }
}
