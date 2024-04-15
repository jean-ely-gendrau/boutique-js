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
    public function produitLeak($categoryName)
    {

        // "SELECT * FROM products NATURAL JOIN orders AND category WHERE name = '$categoryName' AND id_product"
        
        // "SELECT * FROM products WHERE category = '$categoryName' 
        //  AND id_poduct IN (SELECT DISTINCT id_product FROM orders WHERE status = 'livrer')


        $sqlMostSell = "SELECT * FROM products WHERE category = '$categoryName' AND id_poduct IN (SELECT DISTINCT id_product FROM orders WHERE status = 'livrer')";
        $requestMostSell = $this->dataBase->prepare($sqlMostSell);
        $requestMostSell->execute();
        $mostSell = $requestMostSell->fetchAll(PDO::FETCH_ASSOC);


        // affiche les produits de la catégorie.
        $sql = "SELECT * FROM products NATURAL JOIN category WHERE name = '$categoryName'";
        $request = $this->dataBase->prepare($sql);
        $request->execute();
        $products = $request->fetchAll(PDO::FETCH_ASSOC);


        // affiche de le nom de la catégorie.
        $sqlNomCategorie = "SELECT * FROM `category` WHERE name = $categoryName";
        $requete = $this->dataBase->prepare($sqlNomCategorie);
        $requete->execute();
        $nomCategorie = $requete->fetchAll(PDO::FETCH_ASSOC);

        if ($products) {

            foreach ($mostSell as $sellMost) {

                echo "<div>";
                echo '<img src="./image/produit/' . $sellMost["photo"] . '"alt="' . $sellMost["nom"] . '"> <br>';
                echo $sellMost["name"] . "<br>";
                echo $sellMost["price"] . " €<br>";
                echo $sellMost["description"] . "<br>";
                echo " - Quantité: " . $sellMost["quantity"] . "<br>";
                echo " Créé le " . $sellMost["created_at"] . "<br>";
                echo " Modifié le " . $sellMost["updated_at"] . "<br>";
                echo "</div>";
                echo "<br>";
            }

            foreach ($nomCategorie as $categorieNom) {

                echo '<h2>' . $categorieNom["name"] . '</h2>';
                echo '<h3>' . $categorieNom["description"] . '</h3>';

                foreach ($products as $product) {

                    // name, description, price, quantity, images, created_at, updated_at
                    echo "<div>";
                    echo '<img src="./image/produit/' . $product["photo"] . '"alt="' . $product["nom"] . '"> <br>';
                    echo $product["name"] . "<br>";
                    echo $product["price"] . " €<br>";
                    echo $product["description"] . "<br>";
                    echo " - Quantité: " . $product["quantity"] . "<br>";
                    echo " Créé le " . $product["created_at"] . "<br>";
                    echo " Modifié le " . $product["updated_at"] . "<br>";
                    echo "</div>";
                    echo "<br>";

                }
            }
        }
    }

}
 
?>