<?php

namespace App\Boutique\Models;

use App\Boutique\Manager\BddManager;
use PDO;

class Products
{
    private $dataBase;

    public function __construct(BddManager $bddManager)
    {
        $this->dataBase = $bddManager->linkConnect();
    }

    public function produitLeak()
    {
        $result = [];

        $sql = 'SELECT * FROM products';
        $request = $this->dataBase->prepare($sql);
        $request->execute();
        $products = $request->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            $result[] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'quantity' => $product['quantity'],
                'images' => $product['images'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at'],
            ];
        }

        return $result;
    }
}

?>
