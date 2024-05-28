<?php

namespace App\Boutique\Controllers;

use stdClass;
use App\Boutique\Models\Users;
use App\Boutique\Models\Orders;
use App\Boutique\Models\Category;
use Motor\Mvc\Manager\CrudManager;

use Motor\Mvc\Manager\SessionManager;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Validators\ValidatorData;
use App\Boutique\Controllers\JWTController;
use Motor\Mvc\Validators\ReflectionValidator;

class ApiController extends JWTController
{
    private $products;
    private $category;
    private $orders;
    private $users;

    public function __construct()
    {
        $this->products = new CrudManager('products', ProductsModels::class);
        $this->category = new CrudManager('category', Category::class);
        $this->orders = new CrudManager('orders', Orders::class);
        $this->users = new CrudManager('users', Users::class);
        //  $this->accesAPI = $this->jwt();
    }

    public function GetProductsAll(...$arguments)
    {

        // cette fonction permet de récupérer tous les produits de la base de données et de les afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $GetProductsAll = $this->products->getAllProduct();

            $this->logToFile($GetProductsAll, 'Product');

            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($GetProductsAll);
            exit;
        } else {
            header('Location: /404');
        }
    }

    public function GetCategoryAll(...$arguments)
    {
        if ($this->accesAPI == true) {

            // cette fonction permet de récupérer toutes les catégories de la base de données et de les afficher en format json si l'utilisateur a accès à l'API
            $GetGategoryAll = $this->category->getAll();

            $this->logToFile($GetGategoryAll, 'Category');

            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($GetGategoryAll);
        } else {
            header('Location: /404');
        }
    }

    public function GetOrdersAll(...$arguments)
    {
        if ($this->accesAPI == true) {

            // cette fonction permet de récupérer toutes les commandes de la base de données et de les afficher en format json si l'utilisateur a accès à l'API
            $GetordersAll = $this->orders->getAll();

            $this->logToFile($GetordersAll, 'Order');

            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($GetordersAll);
        } else {
            header('Location: /404');
        }
    }

    public function getUsers(...$arguments)
    {
        if ($this->accesAPI == true) {

            // cette fonction permet de récupérer tous les utilisateurs de la base de données et de les afficher en format json si l'utilisateur a accès à l'API
            $GetusersAll = $this->users->getAll();

            $this->logToFile($GetusersAll, 'User');

            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($GetusersAll);
        } else {
            header('Location: /404');
        }
    }

    public function getProductsById(...$arguments)
    {

        // cette fonction permet de recupérer un produit par son id et de l'afficher en format json si l'utilisateur a accès à l'API

        if ($this->accesAPI == true) {
            $id = $arguments["id"];

            $GetproductsById = $this->products->getById($id);

            $this->logToFile($GetproductsById, 'Product');

            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($GetproductsById);
        } else {
            header('Location: /404');
        }
    }

    private function logToFile($data, $type)
    {

        // cette fonction permet de créer un fichier log et d'y inscrire les actions effectuées par l'utilisateur
        $logFile = '../../config/logs/logfile.txt';
        if (!file_exists($logFile)) {
            $directory = dirname($logFile);

            // Create the directory if it doesn't exist
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }

            // Create the file
            touch($logFile);
        }

        // Now you can use error_log
        $logMessage = $data ? "{$type} retrieved successfully." : "Failed to retrieve {$type}.";
        error_log($logMessage, 3, $logFile);
    }

    public function getCategoryById(...$arguments)
    {

        // cette fonction permet de recupérer une catégorie par son id et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];

            $GetcategoryById = $this->category->getById($id);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $GetcategoryById ? "Category retrieved successfully." : "Failed to retrieve category.";
            error_log($logMessage, 3, $logFile);
            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode($GetcategoryById);
        } else {
            header('Location: /404');
        }
    }

    public function getOrderById(...$arguments)
    {

        // cette fonction permet de recupérer une commande par son id et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];

            $GetorderById = $this->orders->getById($id);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $GetorderById ? "Order retrieved successfully." : "Failed to retrieve order.";
            error_log($logMessage, 3, $logFile);
            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode($GetorderById);
        } else {
            header('Location: /404');
        }
    }

    public function getUserById(...$arguments)
    {

        // cette fonction permet de recupérer un utilisateur par son id et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];

            $GetuserById = $this->users->getById($id);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $GetuserById ? "User retrieved successfully." : "Failed to retrieve user.";
            error_log($logMessage, 3, $logFile);
            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode($GetuserById);
        } else {
            header('Location: /404');
        }
    }

    public function addProducts(...$arguments)
    {
        /** @param \Motor\MVC\Utils\Render $render */
        $render = $arguments['render'];
        $response = ['errors' => "Une erreur est survenue lors de l'ajout de produit"];
        // cette fonction permet d'ajouter un produit à la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        //COMMENTS JWT  if ($this->accesAPI == true) {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($arguments) {
            $productsModel = new ProductsModels($arguments);
        } else {
            $productsModel = new ProductsModels($data);
        }

        $result = $this->products->create($productsModel, ['name', 'description', 'price', 'quantity', 'category_id', 'sub_category_id']);


        // Si l'utisateur est déjà enregistrer SQLSTATE[23000]  => Duplicate entry
        if (is_string($result) &&  str_contains($result, 'SQLSTATE[23000]')) {
            $response = ['errors' => "Un produit existe déjà pour {$arguments['name']}"];
            http_response_code(402);
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($response);
            exit();
        }

        $response = ['success' => "Enregistrement de produit validé"];
        $logFile = '../../config/logs/logfile.txt';
        if (!file_exists($logFile)) {
            $directory = dirname($logFile);

            // Create the directory if it doesn't exist
            if (!is_dir($directory)) {
                if (@mkdir($directory, 0777, true)) {
                    // Create the file
                    touch($logFile);
                }
            }
        }

        // Now you can use error_log
        $logMessage = $result ? "Product was added successfully." : "Failed to add product.";
        @error_log($logMessage, 3, $logFile);

        http_response_code(201);
        header('Content-Type: application/json; charset=utf-8;');
        echo json_encode($response);
        exit();
        //COMMENTS JWT   } else {
        //COMMENTS JWT  header('Location:/404');
        //COMMENTS JWT   }
    }

    public function addCategory(...$arguments)
    {

        // cette fonction permet d'ajouter une catégorie à la base de données et de l'afficher en format json si l'utilisateur a accès à l'API 
        if ($this->accesAPI == true) {
            $data = json_decode(file_get_contents('php://input'), true);

            $categoryModel = new Category($data);

            $result = $this->category->create($categoryModel, $data);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Category was added successfully." : "Failed to add category.";
            error_log($logMessage, 3, $logFile);
            http_response_code(201);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/404');
        }
    }

    public function addOrders($data)
    {

        // cette fonction permet d'ajouter une commande à la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {


            $data = json_decode(file_get_contents('php://input'), true);

            $ordersModel = new Orders($data);
            $result = $this->orders->create($ordersModel, $data);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Order was added successfully." : "Failed to add order.";
            error_log($logMessage, 3, $logFile);
            http_response_code(201);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/404');
        }
    }

    public function addUsers(...$arguments)
    {
        /** @param \Motor\MVC\Utils\Render $render */
        $render = $arguments['render'];
        $response = ['errors' => "Une erreur est survenue lors de l'ajout utilisateurs"];
        // cette fonction permet d'ajouter un utilisateur à la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        //COMMENTS JWT   if ($this->accesAPI == true) {

        $data = json_decode(file_get_contents('php://input'), true);


        if ($arguments) {
            $userModel = new Users($arguments);
        } else {
            $userModel = new Users($data);
        }

        // On setPassword pour ajouter le password non hash afin que la class ReflectionValidator puisse vérifier l'exactitude du password avant d'être hash par la méthode.
        $userModel->setPassword($arguments['password'] ?? "");

        $errorsIntercept = ReflectionValidator::validate($userModel); // VALIDATOR PHP

        // réponse JSON 402 avec le corps suivant : {'errors' : $errors}
        if ($errorsIntercept) {
            // ERROR
            $response = ['errors' => $errorsIntercept];
            http_response_code(402);
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($response);
            exit();
        }

        // Pas d'erreur on commence la procédure d'enregistrement.
        $userModel->setPassword($userModel->hash($arguments['password'])); // HASH du password avant l'entrer enBDD
        $result = $this->users->create($userModel, ['full_name', 'email', 'password', 'role']);

        // Si l'utisateur est déjà enregistrer SQLSTATE[23000]  => Duplicate entry
        if (is_string($result) && str_contains($result, 'SQLSTATE[23000]')) {
            $response = ['errors' => "Un compte existe déjà pour {$arguments['email']}"];
            http_response_code(402);
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($response);
            exit();
        }

        $response = ['success' => "Enregistrement utilisateur réussit"]; // Résponse success
        $logFile = '../../config/logs/logfile.txt';
        if (!file_exists($logFile)) {
            $directory = dirname($logFile);

            // Create the directory if it doesn't exist
            if (!is_dir($directory)) {
                if (@mkdir($directory, 0777, true)) {
                    // Create the file
                    touch($logFile);
                }
            }
        }

        // Now you can use error_log
        $logMessage = $result ? "User was added successfully." : "Failed to add user.";
        @error_log($logMessage . PHP_EOL, 3, $logFile);

        http_response_code(201); // CODE 201
        header('Content-Type: application/json; charset=utf-8;'); // header
        echo json_encode($response);
        exit();
        //COMMENTS JWT   } else {
        //COMMENTS JWT      header('Location:/404');
        //COMMENTS JWT   }
    }

    public function updateProducts(...$arguments)
    {

        // cette fonction permet de mettre à jour un produit dans la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->products->update($id, $data);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Product with ID $id was updated successfully." : "Failed to update product with ID $id.";
            error_log($logMessage, 3, $logFile);
            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/404');
        }
    }

    public function updateCategory(...$arguments)
    {

        // cette fonction permet de mettre à jour une catégorie dans la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->category->update($id, $data);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Category with ID $id was updated successfully." : "Failed to update category with ID $id.";
            error_log($logMessage, 3, $logFile);
            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/404');
        }
    }

    public function updateOrders(...$arguments)
    {

        // cette fonction permet de mettre à jour une commande dans la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->orders->update($id, $data);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Order with ID $id was updated successfully." : "Failed to update order with ID $id.";
            error_log($logMessage, 3, $logFile);
            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/404');
        }
    }

    public function updateUsers(...$arguments)
    {

        // cette fonction permet de mettre à jour un utilisateur dans la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        // cette fonction permet de mettre à jour un utilisateur dans la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        //COMMENTS JWT if ($this->accesAPI == true) {
        $result = false;
        $id = $arguments["id"];
        $data = json_decode(file_get_contents('php://input'), true);
        if ($arguments) {
            $userModel = new Users($arguments);
        } else {
            $userModel = new Users($data);
        }
        $userModel?->setId($id);
        if ($userModel->id) {
            $result = $this->users->update($userModel, ['id', 'full_name', 'email', 'birthday']);
        }

        $logFile = '../../config/logs/logfile.txt';
        if (!file_exists($logFile)) {
            $directory = dirname($logFile);

            // Create the directory if it doesn't exist
            if (!is_dir($directory)) {
                if (@mkdir($directory, 0777, true)) {
                    // Create the file
                    touch($logFile);
                };
            }
        }

        // Now you can use error_log
        $logMessage = $result ? "User with ID $id was updated successfully." : "Failed to update user with ID $id.";
        @error_log($logMessage, 3, $logFile);
        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode(['success' => 'Modification enregistrée avec succès']);
        //COMMENTS JWT  } else {
        //COMMENTS JWT      header('Location:/404');
        //COMMENTS JWT  }
    }

    public function deleteProducts(...$arguments)
    {

        // cette fonction permet de supprimer un produit de la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $result = $this->products->delete($id);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Product with ID $id was deleted successfully." : "Failed to delete product with ID $id.";
            error_log($logMessage, 3, $logFile);
            http_response_code(204);
        } else {
            header('Location:/404');
        }
    }

    public function deleteCategory(...$arguments)
    {

        // cette fonction permet de supprimer une catégorie de la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $result = $this->category->delete($id);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Category with ID $id was deleted successfully." : "Failed to delete category with ID $id.";
            error_log($logMessage, 3, $logFile);
            header('Content-Type: application/json; charset=utf-8;');
            http_response_code(204);
        } else {
            header('Location:/404');
        }
    }

    public function deleteOrders(...$arguments)
    {

        // cette fonction permet de supprimer une commande de la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {

            $id = $arguments["id"];
            $result = $this->orders->delete($id);

            $logFile = '../../config/logs/logfile.txt';
            if (!file_exists($logFile)) {
                $directory = dirname($logFile);

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                // Create the file
                touch($logFile);
            }

            // Now you can use error_log
            $logMessage = $result ? "Order with ID $id was deleted successfully." : "Failed to delete order with ID $id.";
            error_log($logMessage, 3, $logFile);
            header('Content-Type: application/json; charset=utf-8;');
            http_response_code(204);
        } else {
            header('Location:/404');
        }
    }


    public function deleteUsers(...$arguments)
    {
        /** @param \Motor\MVC\Utils\Render $render */
        $render = $arguments['render'];

        $result = false;
        $response = ['errors' => "Une erreur c'est produite."];
        // cette fonction permet de supprimer un utilisateur de la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        //COMMENTS JWT    if ($this->accesAPI == true) {
        /**

         */
        if (isset($arguments["id"])) {

            $id = intval($arguments["id"]);

            // Si on essaie de supprimer un administrateur
            // Il faudrait améliorer la condition
            // En allant récupérer le résultat et vérifier le rôle.
            if ($id <= 5) {
                $response = ['errors' => "Vous ne pouvez pas supprimer cet utilisateur, contactez l'administration."];
                goto goto_response;
            }

            if ($result = $this->users->delete($id)) {
                $response = ['success' => "Supprimer avec succées."];
            }
        }
        goto_response:
        // Log the deletion
        $logFile = '../../config/logs/logfile.txt';
        if (!file_exists($logFile)) {
            $directory = dirname($logFile);

            // Create the directory if it doesn't exist
            if (!is_dir($directory)) {
                if (@mkdir($directory, 0777, true)) {
                    // Create the file
                    touch($logFile);
                }
            }
        }

        // Now you can use error_log
        $logMessage = $result ? "User with ID $id was deleted successfully." : "Failed to delete user with ID $id.";
        @error_log($logMessage, 3, $logFile);


        header('Content-Type: application/json; charset=utf-8;');
        http_response_code(200);
        echo json_encode($response);
        exit();
        //COMMENTS JWT  } else {
        //COMMENTS JWT      header('Location:/404');
        //COMMENTS JWT  }
    }
}
