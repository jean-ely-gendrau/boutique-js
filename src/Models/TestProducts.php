<?php

namespace App\Boutique\Models;

use App\Boutique\Manager\BddManager;
use App\Boutique\Manager\CrudManager;
use PDO;

class TestProducts
{
    private $dataBase;

    public function __construct(BddManager $bddManager)
    {
        $this->dataBase = $bddManager->linkConnect();
    }

    /**
     * La fonction retrouve tout les produits de la bdd et formatte les données avant de les retourner.
     *
     *  @return Un tableau de tout les produits de la bbd avec chaque nom de produits, prix, description,
     * quantitée, images, date de création et de modification. Le champ images contient les données de l'image
     * sous forme de tableau.
     */
    public function AllProduct()
    {
        $result = [];

        $sql = 'SELECT * FROM products';
        $request = $this->dataBase->prepare($sql);
        $request->execute();
        $products = $request->fetchAll(PDO::FETCH_ASSOC);

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
        // $crudManager = new CrudManager('products', TestProducts::class);
        // var_dump($crudManager);
        // $crudManager->getAll();

        // return $crudManager;
    }
}

?>
