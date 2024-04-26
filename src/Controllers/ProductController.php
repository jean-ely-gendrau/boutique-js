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
        // SELECT p.* FROM products p INNER JOIN orders o ON p.id = o.id_product WHERE o.status = 'livrer' AND p.category_id = 1;
        $sqlMostSell = "SELECT p.* FROM products p INNER JOIN orders o ON p.id = o.id_product WHERE o.status = 'livrer' AND p.category_id = :categoryName"; //OK OK
        $requestMostSell = $this->linkConnect()->prepare($sqlMostSell);
        $requestMostSell->bindParam(':categoryName', $categoryName);
        $requestMostSell->execute();
        $mostSell = $requestMostSell->fetchAll(\PDO::FETCH_ASSOC);

        // récup id et nom sous categorie
        $sqlNameSousCategorie = 'SELECT sub_category.* FROM sub_category JOIN category ON sub_category.category_id = category.id WHERE category.id = :categoryName'; //OK OK
        $requestNameSqlSubCat = $this->linkConnect()->prepare($sqlNameSousCategorie);
        $requestNameSqlSubCat->bindParam(':categoryName', $categoryName);
        $requestNameSqlSubCat->execute();
        $NameSubCat = $requestNameSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);

        // afficher 10 produit de la catégorie voulu    
        $sqlProduit = 'SELECT * FROM `products` WHERE category_id = :categoryName LIMIT 10'; //OK OK
        $requestProduit = $this->linkConnect()->prepare($sqlProduit);
        $requestProduit->bindParam(':categoryName', $categoryName);
        $requestProduit->execute();
        $produitSql = $requestProduit->fetchAll(\PDO::FETCH_ASSOC);

        if (isset($arguments['counterSubCat'])) {
            $counterSubCat = $arguments['counterSubCat'];

            // affiche la description de la sous categorie
            $sqlSousCategorie = 'SELECT * FROM sub_category WHERE category_id = :categotyName AND id = :counterSubCat'; //a tester
            $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
            $requestSqlSubCat->bindParam(':categoryName', $categoryName);
            $requestSqlSubCat->bindParam(':counterSubCat', $counterSubCat);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);

            // affiche les produits de la sous catégorie.
            $sql = 'SELECT * FROM products WHERE category_id = :categoryName AND sub_category_id = :counterSubCat'; //a tester
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
