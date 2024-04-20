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
    public function produitLeak($categoryName, $pageURL)
    {

        if ($categoryName == "0") {
            $counterSubCat = "0";
            $counterSubCat3 = "3";

        } else if ($categoryName == "1") {
            $counterSubCat = "3";
            $counterSubCat3 = "6";
        }


        $sqlMostSell = "SELECT * FROM products WHERE id_category = '$categoryName' AND id_product IN (SELECT DISTINCT id_product FROM orders WHERE status = 'livrer')";
        $requestMostSell = $this->dataBase->prepare($sqlMostSell);
        $requestMostSell->execute();
        $mostSell = $requestMostSell->fetchAll(PDO::FETCH_ASSOC);


        // affiche de le nom de la catégorie.
        $sqlNomCategorie = "SELECT * FROM `category` WHERE id_category = '$categoryName'";
        $requete = $this->dataBase->prepare($sqlNomCategorie);
        $requete->execute();
        $nomCategorie = $requete->fetchAll(PDO::FETCH_ASSOC);


        echo "Meilleurs ventes de " . $pageURL;

        foreach ($mostSell as $sellMost) {
            $imageData = json_decode($sellMost['images'], true);
            $sellMost['images'] = $imageData;
            $result[] = [
                'name' => $sellMost['name'],
                'price' => $sellMost['price'],
                'description' => $sellMost['description'],
                'quantity' => $sellMost['quantity'],
                'images' => $imageData,
                'created_at' => $sellMost['created_at'],
                'updated_at' => $sellMost['updated_at'],
            ];
        }

        return $result;

        foreach ($nomCategorie as $categorieNom) {
            $result[] = [
                'description' => $categorieNom['description'],
            ];
        }
        while ($counterSubCat < $counterSubCat3) {

            // affiche le nom de la sous catégorie.
            $sqlSousCategorie = "SELECT * FROM sub_category WHERE id_category = '$categoryName' AND id_sub_cat ='$counterSubCat'";
            $requestSqlSubCat = $this->dataBase->prepare($sqlSousCategorie);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(PDO::FETCH_ASSOC);


            // affiche les produits de la catégorie.
            $sql = "SELECT * FROM products WHERE id_category = '$categoryName' AND id_sub_cat ='$counterSubCat'";
            $request = $this->dataBase->prepare($sql);
            $request->execute();
            $products = $request->fetchAll(PDO::FETCH_ASSOC);

            foreach ($subCat as $catSub) {
                $result[] = [
                    'description' => $catSub['description'],
                ];

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
            $counterSubCat++;
        }
    }
}

?>