<?php

namespace App\Boutique\Models;

use App\Boutique\Manager\BddManager;
use PDO;

class Products
{

    private $dataBase;
    protected $serverPath;

    public function __construct(BddManager $bddManager)
    {
        global $serverName;
        $this->serverPath = $serverName;
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


        echo "<div class='mx-auto flex justify-start max-w-6x1'>";
        echo "<h2 class='bg-gray-100 ml-10 p-2 rounded-xl'>Meilleurs ventes de " . $pageURL . "</h2>";
        echo "</div>";

        foreach ($mostSell as $sellMost) {
            $imageData = json_decode($sellMost['images'], true);
            $sellMost['images'] = $imageData;

            echo "<div class='bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1'>";
            echo "<div class='bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block' viewBox='0 0 64 64'>";
            echo 'path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 div0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" data-original="#000000"></path>';
            echo "</svg>";
            echo "</div>";
            echo '<img src="http://' . $this->serverPath . '/assets/images/' . $sellMost['images']['main'] . '"alt="' . $sellMost["name"] . '"> <br>';
            echo "<p class='mt-3 font-bold'>" . $sellMost["name"] . "</p>";
            echo "<div class='flex justify-center'>";
            echo "<p class='mt-3 font-bold mr-2'>" . $sellMost["price"] . "€</p>";
            echo "<p class='mt-3 font-medium text-gray-300'>" . $sellMost["price"] . "€";
            echo "</div>";
            echo "<div>";
            echo '<button type="button" class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add to cart</button>';
            echo '</div>';
            echo '</div>';
        }

        echo "<div class='mx-auto flex justify-start max-w-6x1'>";
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
        echo "</div>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $counterSubCat = $_POST['counterSubCat'];

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
            } else {
            }
        }
    }
}

?>