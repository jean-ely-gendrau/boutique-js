<?php

use App\Boutique\Controllers\PanierController;
use App\Boutique\Models\Products;

$clientId = 1; // replace 1 with the actual client ID

$panierController = new PanierController();

$paniers = $panierController->Panier($clientId); // replace $clientId with the actual client ID
?>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-16 py-3">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    Produit
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantité
                </th>
                <th scope="col" class="px-6 py-3">
                    Prix a l'unité
                </th>
                <!-- <th scope="col" class="px-6 py-3">
                    Action
                </th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paniers as $productItem) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <?php $images = json_decode($productItem['images'], true); ?>
                        <img src="http://<?= $serverName ?>/assets/images/<?= $images['main'] ?>" class="w-16 md:w-32 max-w-full max-h-full">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        <?= $productItem['product_name'] ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div>
                                <input type="number" id="Quantiter" min="0" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1" required />
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        <?= $productItem['price'] ?>
                    </td>
                    <!-- <td class="px-6 py-4">
                        <a href="remove_from_cart.php?id=<?= $productItem['id_product'] ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                    </td> -->
                </tr>
            <?php endforeach; ?>
            <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                Valider le panier
            </button>
        </tbody>
    </table>