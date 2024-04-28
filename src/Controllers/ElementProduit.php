<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\BddManager;

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
        /** @var \Motor\Mvc\Utils\Render $render */
        $render = $arguments['render'];

        $id = 'id';

        $sql = 'SELECT * FROM products WHERE id = :id';
        $request = $this->linkConnect()->prepare($sql);
        $request->bindParam(':id', $id);
        $request->execute();
        $detail = $request->fetchAll(\PDO::FETCH_ASSOC);

        $render->addParams('detail', $detail);

        return $render->render('detail', $arguments);
    }
}

?>
