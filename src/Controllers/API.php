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
}
