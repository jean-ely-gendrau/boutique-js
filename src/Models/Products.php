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

    //Ajouté les propriétés et méthodes au besoins
    public function produitLeak()
    {
        $result = [];

        // Sélectionne toutes les données de la table products
        $sql = 'SELECT * FROM products';
        $request = $this->dataBase->prepare($sql);
        $request->execute();
        $products = $request->fetchAll(PDO::FETCH_ASSOC);

        // Boucle à travers les produits et ajoute-les au résultat
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

    // public function __toString()
    // {
    //     // Retourner une représentation sous forme de chaîne de caractères des données de l'objet
    //     return $this->produitLeak(); // ou toute autre méthode ou propriété que vous souhaitez afficher
    // }
}

?>
