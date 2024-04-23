<?php
namespace App\Boutique\Controllers;

// use App\Boutique\Manager\BddManager;
use PDO;

class FilterPrice
{

    private $dataBase;
    protected $serverPath;

    // public function __construct(BddManager $bddManager)
    // {
    //     global $serverName;
    //     $this->serverPath = $serverName;
    //     $this->dataBase = $bddManager->linkConnect();
    // }

    public function testJS(...$arguments)
    {
        $data = "test.js";
        // var_dump(json_encode($data));
        // header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function produitElement(...$arguments)
    {
        if ($arguments['filter'] == 'asc') {
            echo json_encode("Produit par prix ascendent");
            // $sql = "SELECT * FROM products ORDER BY price ASC LIMIT 10;";
            // $request = $this->dataBase->prepare($sql);
            // $request->execute();
            // $detail = $request->fetchAll(PDO::FETCH_ASSOC);
            // return $detail;
        } elseif ($arguments['filter'] == 'desc') {
            echo json_encode("Produit par prix descendent");
            // $sql = "SELECT * FROM products ORDER BY price DESC LIMIT 10;";
            // $request = $this->dataBase->prepare($sql);
            // $request->execute();
            // $detail = $request->fetchAll(PDO::FETCH_ASSOC);
            // return $detail;
        }
    }
}
// $bddManager = new BddManager();

// $class = new FilterPrice($bddManager);
// $class->testJS();