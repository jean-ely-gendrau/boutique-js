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
        if ($arguments['filter'] == 'asc') {
            $sqlSousCategorie = "SELECT * FROM products WHERE id_category = 0 ORDER BY price ASC LIMIT 5";
            $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);
            echo json_encode($subCat);
        } elseif ($arguments['filter'] == 'desc') {
            $sqlSousCategorie = "SELECT * FROM products WHERE id_category = 0 ORDER BY price DESC LIMIT 5";
            $requestSqlSubCat = $this->linkConnect()->prepare($sqlSousCategorie);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);
            echo json_encode($subCat);
        }
    }
}