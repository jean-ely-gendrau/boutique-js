<?php

namespace App\Boutique\Components;


/** Hydratation des classes avec les données récupérées par la requête. */
class HydrateOrderUserProduct
{

    /**
     * Method hydrateModelsFromData
     *

     * Hydrate les données fournies et les associe aux modèles correspondants.
     *
     * @param array $params Tableau associatif contenant les paramètres nécessaires :
     *                      - 'dataToHydrates' => Tableau associatif contenant les données à hydrater.
     *                      - 'productsModels' => Instance du modèle des produits.
     *                      - 'ordersModels' => Instance du modèle des commandes.
     *                      - 'usersModels' => Instance du modèle des utilisateurs.
     * @return object Tableau contenant les instances hydratées des modèles.
     */
    public static function hydrate(array $params)
    {
        $dataToHydrates = $params['dataToHydrates'];
        /** @var \App\Boutique\Models\ProductsModels $dataProductModel */
        $dataProductModel = $params['productsModels'];
        $dataOrdersModel = $params['ordersModels'];
        $dataUserModel = $params['usersModels'];

        $ordersModels = [];
        $productsModels = [];

        foreach ($dataToHydrates as $dataToHydrate) {
            // var_dump($dataToHydrate);
            $orderId = $dataToHydrate['ordersId'];
            $productId = $dataToHydrate['pId'];

            // Si la clé 'id' de la commande est absente du tableau de commandes/produits, on l'ajoute (isInMultidimensionalArray permet de vérifier un tableau multidimensionnel)
            if (!isset($ordersModels[$orderId]) && !$dataProductModel->isInMultidimensionalArray($productId, $ordersModels)) {

                // Hydrate Orders
                $ordersModels[$orderId] = clone $dataOrdersModel;
                $ordersModels[$orderId]->selfHydrate($dataToHydrate);
            }
            if (!array_key_exists($productId, $productsModels)) {
                // Hydrate ProductsModels
                $productsModels[$productId] = clone $dataProductModel;
                $productsModels[$productId]->selfHydrate($dataToHydrate);
            }


            // Calcule le nombre d'occurence identique dans le tableau de données à partir de la column 'pId' avec le productId en cours 
            $productsModels[$productId]->setQuantity(array_count_values(array_column($dataToHydrates, 'pId'))[$productId]);

            // Hydrate UsersModels
            $dataUserModel->selfHydrate($dataToHydrate);
        }

        //DEBUG echo '<pre>', var_dump('ordersModels', $ordersModels), '</pre>';

        // En renvoie sous forme de class STD les CLASS suivante avec les données hydratées au propriétés.
        return (object)[
            'ordersModels' => $ordersModels,
            'productsModels' => $productsModels,
            'userModel' => $dataUserModel
        ];
    }
}
