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

    public function produitLeak($categoryName, $pageURL)
    {

        $counterSubCat = "";

        if ($categoryName == "0") {
            $titre = "cafe";
            $counterSubCat0 = "0";
            $nameSubCat0 = "Corsé";
            $counterSubCat1 = "1";
            $nameSubCat1 = "Moyen";
            $counterSubCat2 = "2";
            $nameSubCat2 = "Faible";
            $type = "Choisissez la force de votre ";

        } else if ($categoryName == "1") {
            $titre = "the";
            $counterSubCat0 = "3";
            $nameSubCat0 = "Noir";
            $counterSubCat1 = "4";
            $nameSubCat1 = "Vert";
            $counterSubCat2 = "5";
            $nameSubCat2 = "Blanc";
            $type = "Choisissez votre feuille de ";
        }


        $sqlMostSell = "SELECT * FROM products WHERE id_category = :categoryName AND id_product IN (SELECT DISTINCT id_product FROM orders WHERE status = 'livrer')";
        $requestMostSell = $this->dataBase->prepare($sqlMostSell);
        $requestMostSell->bindParam(':categoryName', $categoryName);
        $requestMostSell->execute();
        $mostSell = $requestMostSell->fetchAll(PDO::FETCH_ASSOC);

        echo "Meilleures ventes de " . $pageURL;

        foreach ($mostSell as $sellMost) {
            echo "<div>";
            echo '<img src="./image/produit/' . $sellMost["photo"] . '"alt="' . $sellMost["name"] . '"> <br>';
            echo $sellMost["name"] . "<br>";
            echo $sellMost["price"] . " €<br>";
            echo $sellMost["description"] . "<br>";
            echo " - Quantité: " . $sellMost["quantity"] . "<br>";
            echo "</div>";
            echo "<br>";
        }
        echo "<form action='' method='post'>";
        echo "<label for=''>" . $type . $pageURL . ": </label>";
        echo "<select name='counterSubCat' id='counterSubCat'>";
        echo "<option value='99'>ici que sa se passe</option>";
        echo "<option value='" . $counterSubCat0 . "'>" . $nameSubCat0 . "</option>";
        echo "<option value='" . $counterSubCat1 . "'>" . $nameSubCat1 . "</option>";
        echo "<option value='" . $counterSubCat2 . "'>" . $nameSubCat2 . "</option>";
        echo "</select>";
        echo "<button type='submit'>Valider</button>";
        echo "</form>";

        echo "<br>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $counterSubCat = $_POST['counterSubCat'];
            header("location: /produit?$titre=$titre");

            if ($counterSubCat === '0' || $counterSubCat === '1' || $counterSubCat === '2') {

                // affiche le nom de la sous catégorie.
                $sqlSousCategorie = "SELECT * FROM sub_category WHERE id_category = :categoryName AND id_sub_cat = :counterSubCat";
                $requestSqlSubCat = $this->dataBase->prepare($sqlSousCategorie);
                $requestSqlSubCat->bindParam(':categoryName', $categoryName);
                $requestSqlSubCat->bindParam(':counterSubCat', $counterSubCat);
                $requestSqlSubCat->execute();
                $subCat = $requestSqlSubCat->fetchAll(PDO::FETCH_ASSOC);

                // affiche les produits de la catégorie.
                $sql = "SELECT * FROM products WHERE id_category = :categoryName AND id_sub_cat = :counterSubCat";
                $request = $this->dataBase->prepare($sql);
                $request->bindParam(':categoryName', $categoryName);
                $request->bindParam(':counterSubCat', $counterSubCat);
                $request->execute();
                $products = $request->fetchAll(PDO::FETCH_ASSOC);

                foreach ($subCat as $catSub) {

                    echo '<h3>' . $catSub["description"] . '</h3>';

                    foreach ($products as $product) {
                        echo "<div>";
                        echo '<img src="./image/produit/' . $product["photo"] . '"alt="' . $product["name"] . '"> <br>';
                        echo $product["name"] . "<br>";
                        echo $product["price"] . " €<br>";
                        echo $product["description"] . "<br>";
                        echo " - Quantité: " . $product["quantity"] . "<br>";
                        echo "</div>";
                        echo "<br>";
                    }
                }
            } else if ($counterSubCat === '99') {
                echo "ajouté javascript";
            } else {}
        }
    }
}

?>
