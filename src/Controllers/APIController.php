<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Category;
use App\Boutique\Models\Orders;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;

use stdClass;

class ApiController
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
    }

    public function GetProductsAll(...$arguments)
    {
        $GetProductsAll = $this->products->getAllProduct();

        $this->logToFile($GetProductsAll, 'Product');

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($GetProductsAll);
        exit;
    }

    public function GetCategory(...$arguments)
    {
        $GetGategoryAll = $this->category->getAll();

        $this->logToFile($GetGategoryAll, 'Category');

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($GetGategoryAll);
    }

    public function getOrders(...$arguments)
    {
        $GetordersAll = $this->orders->getAll();

        $this->logToFile($GetordersAll, 'Order');

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($GetordersAll);
    }

    public function getUsers(...$arguments)
    {
        $GetusersAll = $this->users->getAll();

        $this->logToFile($GetusersAll, 'User');

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($GetusersAll);
    }

    public function getProductsById($id)
    {
        $GetproductsById = $this->products->getById($id, 'id_product');

        $this->logToFile($GetproductsById, 'Product');

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($GetproductsById);
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

    public function getCategoryById($id)
    {
        $GetcategoryById = $this->category->getById($id, 'id_category');

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
    }

    public function getOrderById($id)
    {
        $GetorderById = $this->orders->getById($id, 'id_order');

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
    }

    public function getUserById($id)
    {
        $GetuserById = $this->users->getById($id, 'id_user');

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

    public function addProducts(...$arguments)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $result = $this->products->create($this->products, $data);

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
    }

    public function addCategory(...$arguments)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $result = $this->category->create($this->category, $data);

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
    }

    public function addOrders($data)
    {
        $order = new Orders();

        $result = $this->orders->create($order, $data);

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
    }

    public function addUsers(...$arguments)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $result = $this->users->create($this->users, $data);

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
    }

    public function updateProducts($id)
    {
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
    }

    public function updateCategory($id)
    {
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
    }

    public function updateOrders($id)
    {
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
    }

    public function updateUsers($id)
    {
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
    }

    public function deleteProducts($id)
    {
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
    }

    public function deleteCategory($id)
    {
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
    }

    public function deleteOrders($id)
    {
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
    }


    public function deleteUsers($id)
    {
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
    }
}
