<?php

namespace App\Boutique\Models;

use DateTime;
use App\Boutique\Manager\BddManager;
use PDO;

class Products
{

    private $id_product;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $images;
    private $id_category;
    private $id_sub_cat;
    private $created_at;
    private $updated_at;

    // BASE DE DONNEE
    private $dataBase;

    public function __construct(?array $data = null)
    {

        $this->id_product = $data['id_product'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->price = $data['price'] ?? '';
        $this->quantity = $data['quantity'] ?? '';
        $this->images = $data['images'] ?? '';
        $this->id_category = $data['id_category'] ?? '';
        $this->id_sub_cat = $data['id_sub_cat'] ?? '';
        $this->created_at = isset($data['created_at']) ? $this->setDateTime($data['created_at']) : '';
        $this->updated_at = isset($data['updated_at']) ? $this->setDateTime($data['updated_at']) : '';

    }

    public function __get(string $name)
    {

        return $this->name;
    }

    public function __isset($name)
    {

        return isset($this->data[$name]);
    }

    public function __set(string $property, mixed $value)
    {

    }

    public function setDateTime(string $dateSting)
    {
        $newdate = new DateTime($dateSting);
        return $newdate->format('Y-m-d H:i:s');
    }

    // public function getCreatedDate() {
    //     $createdNewDate = new DateTime($this->created_at);
    //     return $createdNewDate->format('Y-m-d');
    // }

    // public function getUpdatedDate() {

    //     $updatedNewDate = new DateTime($this->updated_at);
    //     return $updatedNewDate->format('Y-m-d');
    // }

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