<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\BddManager;

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
        /** @var \Motor\Mvc\Utils\Render $render */
        $render = $arguments['render'];

        $categoryName = $arguments['categoryName'];

        $produitLimit = 5;

        // affiche les produit les plus livrer
        $sqlMostSell = "SELECT products.*FROM products JOIN category ON products.category_id = category.id WHERE category.id = :categoryName IN (SELECT DISTINCT id_product FROM orders WHERE status = 'livrer')"; //OK
        $requestMostSell = $this->linkConnect()->prepare($sqlMostSell);
        $requestMostSell->bindParam(':categoryName', $categoryName);
        $requestMostSell->execute();
        $mostSell = $requestMostSell->fetchAll(\PDO::FETCH_ASSOC);

        // récup value et nom sous categorie
        $sqlNameSousCategorie = 'SELECT sub_category.* FROM sub_category JOIN category ON sub_category.category_id = category.id WHERE category.id = :categoryName'; //OK
        $requestNameSqlSubCat = $this->linkConnect()->prepare($sqlNameSousCategorie);
        $requestNameSqlSubCat->bindParam(':categoryName', $categoryName);
        $requestNameSqlSubCat->execute();
        $NameSubCat = $requestNameSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);

        // afficher 10 produit de la catégorie voulu    
        $sqlProduit = 'SELECT products.* FROM products JOIN category ON products.category_id = category.id WHERE category.id = :categoryName LIMIT 10'; //OK
        $requestProduit = $this->linkConnect()->prepare($sqlProduit);
        $requestProduit->bindParam(':categoryName', $categoryName);
        $requestProduit->execute();
        $produitSql = $requestProduit->fetchAll(\PDO::FETCH_ASSOC);

        if (isset($arguments['counterSubCat'])) {
            $counterSubCat = $arguments['counterSubCat'];

            // affiche le nom de la sous catégorie ainsi que la description.
            $sqlSousCategorie = 'SELECT * FROM sub_category WHERE category_id = :categotyName AND id = :counterSubCat'; //OK
            $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
            $requestSqlSubCat->bindParam(':categoryName', $categoryName);
            $requestSqlSubCat->bindParam(':counterSubCat', $counterSubCat);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);

            // affiche les produits de la sous catégorie.
            $sql = 'SELECT products.* FROM products JOIN sub_category ON products.sub_category_id = sub_category.id JOIN category ON sub_category.category_id = category.id WHERE category.id = :categoryName AND sub_category.id = :$counterSubCat'; //OK
            $request = $this->linkConnect()->prepare($sql);
            $request->bindParam(':categoryName', $categoryName);
            $request->bindParam(':counterSubCat', $counterSubCat);
            $request->execute();
            $products = $request->fetchAll(\PDO::FETCH_ASSOC);

            $render->addParams(['subCat' => $subCat, 'products' => $products]);
        }

        $render->addParams('mostSell', $mostSell);
        $render->addParams('NameSubCat', $NameSubCat);
        $render->addParams('produitSql', $produitSql);

        return $render->render('produit', $arguments);
    }
}
