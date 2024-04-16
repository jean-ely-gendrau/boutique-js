<?php

use App\Boutique\Controllers\HistoriqueController;

$clientId = 1; // replace 1 with the actual client ID



$historiqueController = new HistoriqueController();
$orders = $historiqueController->Historique($clientId); // replace $clientId with the actual client ID
?>


<h1>Historique d'achat</h1>


<p>Derniers achat</p>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nom du Produit</th>
                <th scope="col" class="px-6 py-3">Adresse</th>
                <th scope="col" class="px-6 py-3">Prix</th>
                <th scope="col" class="px-6 py-3">Status</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= $order['product_name'] ?>
                    </th>
                    <td class="px-6 py-4"><?= $order['adress'] ?></td>
                    <td class="px-6 py-4"><?= $order['price'] ?></td>
                    <td class="px-6 py-4"><?= $order['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>