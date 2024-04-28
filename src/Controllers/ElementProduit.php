<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\Details;
use App\Boutique\Models\ProductsModels;
use Motor\Mvc\Manager\BddManager;
use Motor\Mvc\Manager\CrudManager;

class ElementProduit extends BddManager
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
    public function ProduitElement(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render $render */
        // $render = $arguments['render'];

        // $sql = 'SELECT * FROM products WHERE id = :id_product';
        // $request = $this->linkConnect()->prepare($sql);
        // $request->bindParam(':id_product', $id_product);
        // $request->execute();
        // $detail = $request->fetchAll(\PDO::FETCH_ASSOC);

        // $render->addParams('detail', $detail);

        $crudManager = new CrudManager('products', ProductsModels::class);

        // $detail = $crudManager->getById($arguments['product_id']);
        $detail = $crudManager->getOneProduct($arguments['product_id']);

        var_dump($detail);
        // Nouvelle classe Components
        $view = new Details();

        $productView = $view->DetailsProduct($detail);

        $arguments['render']->addParams('detail', $productView);

        $content = $arguments['render']->render('details-produit', $arguments);

        return $content;
    }
}

?>
