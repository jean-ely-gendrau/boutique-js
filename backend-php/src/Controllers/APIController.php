<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Category;
use App\Boutique\Models\Orders;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;

use stdClass;
use App\Controllers\JWTController;

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
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->products->update($id, $data, 'id_product');

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
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->category->update($id, $data, 'id_category');

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
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->orders->update($id, $data, 'id_order');

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
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $data = json_decode(file_get_contents('php://input'), true);

            $result = $this->users->update($id, $data, 'id_user');

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
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $result = $this->products->delete($id, 'id_product');

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
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $result = $this->category->delete($id, 'id_category');

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
        if ($this->accesAPI == true) {

            $id = $arguments["id"];
            $result = $this->orders->delete($id, 'id_order');

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
        if ($this->accesAPI == true) {
            $id = $arguments["id"];
            $result = $this->users->delete($id, 'id_user');

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
