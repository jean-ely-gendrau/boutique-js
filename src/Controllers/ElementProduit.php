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

        // $product_id = $arguments['id_product'];

        // $sql = 'SELECT * FROM products WHERE id = :id';
        // $request = $this->linkConnect()->prepare($sql);
        // $request->bindParam(':id', $product_id);
        // $request->execute();
        // $detail = $request->fetchAll(\PDO::FETCH_ASSOC);

        // $render->addParams('detail', $detail);

        // return $render->render('detail', $arguments);
        //-------------------------------------------------------------------------------------------------

        // Instance de CrudManager, passage de la table 'products' en paramètre
        $crudManager = new CrudManager('products', ProductsModels::class);

        // Appel de la méthode getOneProduct prenant l'id du produit en paramètre
        $detail = $crudManager->getOneProduct($arguments['product_id']);

        // Passage dans render des paramètres 'detail' => $detail
        $arguments['render']->addParams('detail', $detail);

        // Passage de la méthode render du template 'details-produit' avec ses arguments dans $content
        $content = $arguments['render']->render('details-produit', $arguments);

        // Renvoi $content
        return $content;
    }
}

?>
