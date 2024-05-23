<?php

namespace App\Boutique\Controllers;

use stdClass;
use App\Boutique\Models\Users;
use App\Boutique\Models\Orders;
use App\Boutique\Models\Category;
use Motor\Mvc\Manager\CrudManager;

use App\Boutique\Models\ProductsModels;
use App\Boutique\Controllers\JWTController;


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
        $this->accesAPI = $this->jwt();
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
            header('Location: /connexion');
        }
    }

    public function GetCategory(...$arguments)
    {
        if ($this->accesAPI == true) {

            // cette fonction permet de récupérer toutes les catégories de la base de données et de les afficher en format json si l'utilisateur a accès à l'API
            $GetGategoryAll = $this->category->getAll();

            $this->logToFile($GetGategoryAll, 'Category');

            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($GetGategoryAll);
        } else {
            header('Location: /connexion');
        }
    }

    public function getOrders(...$arguments)
    {
        if ($this->accesAPI == true) {

            // cette fonction permet de récupérer toutes les commandes de la base de données et de les afficher en format json si l'utilisateur a accès à l'API
            $GetordersAll = $this->orders->getAll();

            $this->logToFile($GetordersAll, 'Order');

            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($GetordersAll);
        } else {
            header('Location: /connexion');
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
            header('Location: /connexion');
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
            header('Location: /connexion');
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
            header('Location: /connexion');
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
            header('Location: /connexion');
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
        }
    }

    public function addProducts(...$arguments)
    {

        // cette fonction permet d'ajouter un produit à la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $data = json_decode(file_get_contents('php://input'), true);

            $productsModel = new ProductsModels($data);

            $result = $this->products->create($productsModel, $data);

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
            $logMessage = $result ? "Product was added successfully." : "Failed to add product.";
            error_log($logMessage, 3, $logFile);
            http_response_code(201);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/connexion');
        }
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
            header('Location:/connexion');
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
            header('Location:/connexion');
        }
    }

    public function addUsers(...$arguments)
    {

        // cette fonction permet d'ajouter un utilisateur à la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $data = json_decode(file_get_contents('php://input'), true);

            $userModel = new Users($data);

            $result = $this->users->create($userModel, $data);

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
            $logMessage = $result ? "User was added successfully." : "Failed to add user.";
            error_log($logMessage . PHP_EOL, 3, $logFile);
            http_response_code(201);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/connexion');
        }
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
            header('Location:/connexion');
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
            header('Location:/connexion');
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
            header('Location:/connexion');
        }
    }

    public function updateUsers(...$arguments)
    {

        // cette fonction permet de mettre à jour un utilisateur dans la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->users->update($id, $data);

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
            $logMessage = $result ? "User with ID $id was updated successfully." : "Failed to update user with ID $id.";
            error_log($logMessage, 3, $logFile);
            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode($data);
        } else {
            header('Location:/connexion');
        }
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
            header('Location:/connexion');
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
            http_response_code(204);
        } else {
            header('Location:/connexion');
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
            http_response_code(204);
        } else {
            header('Location:/connexion');
        }
    }


    public function deleteUsers(...$arguments)
    {

        // cette fonction permet de supprimer un utilisateur de la base de données et de l'afficher en format json si l'utilisateur a accès à l'API
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $result = $this->users->delete($id);

            // Log the deletion
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
            $logMessage = $result ? "User with ID $id was deleted successfully." : "Failed to delete user with ID $id.";
            error_log($logMessage, 3, $logFile);
            http_response_code(204);
        } else {
            header('Location:/connexion');
        }
    }
}
