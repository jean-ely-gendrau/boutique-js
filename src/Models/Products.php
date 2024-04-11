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

        // $product = json_decode($products['images'], true);
        foreach ($products as $product) {
            $imageData = json_decode($product['images'], true);
            $product['images'] = $imageData;
            $result[] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'quantity' => $product['quantity'],
                'images' => $imageData,
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at'],
            ];
        }

        return $result;
    }
}

?>
