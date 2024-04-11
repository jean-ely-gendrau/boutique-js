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

        $counterIdCategorie = "1";

        while ($counterIdCategorie !== 6) {

            $sql = "SELECT * FROM products WHERE id_category = $counterIdCategorie";
            $request = $this->dataBase->prepare($sql);
            $request->execute();
            $products = $request->fetchAll(PDO::FETCH_ASSOC);

            $sqlNomCategorie = "SELECT * FROM `category` WHERE id_category = $counterIdCategorie";
            $requete = $this->dataBase->prepare($sqlNomCategorie);
            $requete->execute();
            $nomCategorie = $requete->fetchAll(PDO::FETCH_ASSOC);

            if ($products) {

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
            $counterIdCategorie++;
        }
    }

}

?>