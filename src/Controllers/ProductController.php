<?php

namespace App\Boutique\Controllers;

use App\Boutique\Manager\BddManager;


/**
 * La classe TestRender étend Render et contient les méthodes pour afficher des variables et
 * renvoyer une vue (View) avec les données de l'exemple.
 */
class ProductController extends BddManager
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Produit Index qui affiche les variables transmises à la méthode.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string
     */
    public function Produit(...$arguments)
    {
        /** @var \App\Boutique\Utils\Render $render */
        $render = $arguments['render'];
  
        $categoryName = $arguments["categoryName"];

        $produitLimit = 5;

        if ($categoryName === "cafe") {
            $categoryName = '0';

        } elseif ($categoryName === "the") {
            $categoryName = '1';
        }

        $counterSubCat = "";


        $sqlMostSell = "SELECT * FROM products WHERE id_category = :categoryName AND id_product IN (SELECT DISTINCT id_product FROM orders WHERE status = 'livrer')";
        $requestMostSell = $this->linkConnect()->prepare($sqlMostSell);
        $requestMostSell->bindParam(':categoryName', $categoryName);
        $requestMostSell->execute();
        $mostSell = $requestMostSell->fetchAll(\PDO::FETCH_ASSOC);




        if (isset($arguments['counterSubCat'])) {
            $counterSubCat = $arguments['counterSubCat'];

            if ($counterSubCat === '0' || $counterSubCat === '1' || $counterSubCat === '2' || $counterSubCat === '3' || $counterSubCat === '4' || $counterSubCat === '5') {

                // affiche le nom de la sous catégorie.
                $sqlSousCategorie = "SELECT * FROM sub_category WHERE id_category = :categoryName AND id_sub_cat = :counterSubCat";
                $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
                $requestSqlSubCat->bindParam(':categoryName', $categoryName);
                $requestSqlSubCat->bindParam(':counterSubCat', $counterSubCat);
                $requestSqlSubCat->execute();
                $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);

                // affiche les produits de la catégorie.
                $sql = "SELECT * FROM products WHERE id_category = :categoryName AND id_sub_cat = :counterSubCat LIMIT :produitLimit";
                $request = $this->linkConnect()->prepare($sql);
                $request->bindParam(':categoryName', $categoryName);
                $request->bindParam(':counterSubCat', $counterSubCat);
                $request->bindParam(':produitLimit', $produitLimit, \PDO::PARAM_INT);
                $request->execute();
                $products = $request->fetchAll(\PDO::FETCH_ASSOC);

                $render->addParams(["subCat"=>$subCat, "products"=>$products]);

            } else if ($counterSubCat === '99') {
                echo "ajouté javascript";
            } else {
            }
        }


        // var_dump($arguments);
        $render->addParams("mostSell", $mostSell);


       return $render->render("produit", $arguments);
    }



}
