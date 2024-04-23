<?php

namespace App\Boutique\Controllers;

use App\Boutique\Manager\BddManager;


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
    public function produitElement(...$arguments)
    {
        /** @var \App\Boutique\Utils\Render $render */
        $render = $arguments['render'];

        $id_product = $arguments["id_product"];

        //SELECT * FROM `products` WHERE id_product = 1;
        $sql = "SELECT * FROM products WHERE id_product = :id_product";
        $request = $this->linkConnect()->prepare($sql);
        $request->bindParam(':id_product', $id_product);
        $request->execute();
        $detail = $request->fetchAll(\PDO::FETCH_ASSOC);

        $render->addParams("detail", $detail);

        return $render->render("detail", $arguments);
    }
}

?>