<?php
namespace App\Boutique\Controllers;

use App\Boutique\Manager\BddManager;

class FilterPrice extends BddManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function testJS(...$arguments)
    {
        $data = "test.js";
        echo json_encode($data);
    }

    public function produitElement(...$arguments)
    {
        echo json_encode(var_dump($arguments));
        // $sql1 = "SELECT * FROM products WHERE id_category = $id_category AND id_sub_cat = $id_sub_category ORDER BY price $orderBy LIMIT $limit";
        // $sql3 = "SELECT * FROM products WHERE id_category = 0 ORDER BY price ASC LIMIT 5";
        // if ($arguments['orderBy'] == 'asc') {
        //     $sqlSousCategorie = $sql1 = "SELECT * FROM products WHERE id_category = 0 AND id_sub_cat = 0 ORDER BY price ASC LIMIT 5";
        //     $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
        //     $requestSqlSubCat->execute();
        //     $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);
        //     echo json_encode($subCat);
        // } elseif ($arguments['orderBy'] == 'desc') {
        //     $sqlSousCategorie = "SELECT * FROM products WHERE id_category = 0 ORDER BY price DESC LIMIT 5";
        //     $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
        //     $requestSqlSubCat->execute();
        //     $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);
        //     echo json_encode($subCat);
        // }
    }
    private function selectProductQuery($id_category, $id_sub_category = null, $orderBy = null/*, $limit = null*/)
    {
        if (isset($id_sub_category) && isset($orderBy)) {
            return $sqlRequest = "SELECT * FROM products WHERE id_category = $id_category AND id_sub_cat = $id_sub_category ORDER BY price $orderBy LIMIT 5";
        }
        if (isset($orderBy) && !isset($id_sub_category)) {
            return $sqlRequest = "SELECT * FROM products WHERE id_category = $id_category ORDER BY price $orderBy LIMIT 5";
        }
    }
}