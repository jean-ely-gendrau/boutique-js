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

        // affiche les produit les plus livrer
        $sqlMostSell = "SELECT * FROM products WHERE id_category = :categoryName AND id_product IN (SELECT DISTINCT id_product FROM orders WHERE status = 'livrer')";
        $requestMostSell = $this->linkConnect()->prepare($sqlMostSell);
        $requestMostSell->bindParam(':categoryName', $categoryName);
        $requestMostSell->execute();
        $mostSell = $requestMostSell->fetchAll(\PDO::FETCH_ASSOC);




        if (isset($arguments['counterSubCat'])) {
            $counterSubCat = $arguments['counterSubCat'];

            // affiche le nom de la sous catégorie ainsi que la description.
            $sqlSousCategorie = "SELECT * FROM sub_category WHERE id_category = :categoryName AND id_sub_cat = :counterSubCat";
            $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
            $requestSqlSubCat->bindParam(':categoryName', $categoryName);
            $requestSqlSubCat->bindParam(':counterSubCat', $counterSubCat);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);

            // affiche les produits de la sous catégorie.
            $sql = "SELECT * FROM products WHERE id_category = :categoryName AND id_sub_cat = :counterSubCat LIMIT :produitLimit";
            $request = $this->linkConnect()->prepare($sql);
            $request->bindParam(':categoryName', $categoryName);
            $request->bindParam(':counterSubCat', $counterSubCat);
            $request->bindParam(':produitLimit', $produitLimit, \PDO::PARAM_INT);
            $request->execute();
            $products = $request->fetchAll(\PDO::FETCH_ASSOC);

            $render->addParams(["subCat" => $subCat, "products" => $products]);

        }

        $render->addParams("mostSell", $mostSell);

        return $render->render("produit", $arguments);
        
    }
}
