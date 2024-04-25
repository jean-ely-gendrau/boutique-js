<?php

use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Category;
use App\Boutique\Models\Orders;
use App\Boutique\Models\Users;
use App\Boutique\Manager\CrudManager;

class API
{

    private $products;
    private $category;
    private $orders;
    private $users;

    public function __construct()
    {
        $this->products = new CrudManager("products", ProductsModels::class);
        $this->category = new CrudManager("category", Category::class);
        $this->orders = new CrudManager("orders", Orders::class);
        $this->users = new CrudManager("users", Users::class);
    }

    public function getProductsAll()
    {

        $GetproductsAll = $this->products->getAll();


        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetproductsAll);
    }

    public function getCategory()
    {

        $GetgategoryAll = $this->category->getAll();


        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetgategoryAll);
    }

    public function getOrders()
    {

        $GetordersAll = $this->orders->getAll();

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetordersAll);
    }

    public function getUsers()
    {

        $GetusersAll = $this->users->getAll();

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetusersAll);
    }

    public function getProductsById($id)
    {

        $GetproductsById = $this->products->getById($id, 'id_product');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetproductsById);
    }

    public function getCategoryById($id)
    {

        $GetcategoryById = $this->category->getById($id, 'id_category');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetcategoryById);
    }

    public function getOrderById($id)
    {

        $GetorderById = $this->orders->getById($id, 'id_order');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetorderById);
    }

    public function getUserById($id)
    {

        $GetuserById = $this->users->getById($id, 'id_user');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($GetuserById);
    }

    public function addProducts()
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->products->create($this->products, $data);

        http_response_code(201);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function addCategory()
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->category->create($this->category, $data);

        http_response_code(201);

        header('Content-Type: application/json');

        echo json_encode($data);
    }
    /*
    public function addOrders()
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->orders->create($this->orders, $data);

        http_response_code(201);

        header('Content-Type: application/json');

        echo json_encode($data);
    }
*/
    public function addUsers()
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->users->create($this->users, $data);

        http_response_code(201);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function updateProducts($id)
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->products->update($id, $data, 'id_product');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function updateCategory($id)
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->category->update($id, $data, 'id_category');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function updateOrders($id)
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->orders->update($id, $data, 'id_order');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function updateUsers($id)
    {

        $data = json_decode(file_get_contents('php://input'), true);

        $this->users->update($id, $data, 'id_user');

        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function deleteProducts($id)
    {

        $this->products->delete($id, 'id_product');

        http_response_code(204);
    }

    public function deleteCategory($id)
    {

        $this->category->delete($id, 'id_category');

        http_response_code(204);
    }

    public function deleteOrders($id)
    {

        $this->orders->delete($id, 'id_order');

        http_response_code(204);
    }
}
