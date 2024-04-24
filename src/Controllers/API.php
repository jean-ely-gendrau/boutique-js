<?php




use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Category;
use App\Boutique\Models\Orders;
use App\Boutique\Models\Users;








class API
{

    private $products;
    private $category;
    private $orders;
    private $users;


    public function __construct()
    {
        $this->products = new ProductsModels();
        $this->category = new Category();
        $this->orders = new Orders();
        $this->users = new Users();
    }

    public function getProducts()
    {

        return json_encode($this->products->getName());
    }

    public function getCategories()
    {
        return json_encode($this->category->getCategories());
    }

    public function getOrders()
    {
        return json_encode($this->orders->getOrders());
    }

    public function getUsers()
    {
        return json_encode($this->users->getUsers());
    }
}
