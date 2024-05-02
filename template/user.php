<?php

use App\Boutique\Controllers\ApiController;

$apiController = new ApiController();

$apiData = $apiController->GetProductsAll();


var_dump($apiData)

?>




<div class="items-center">
    <a href="modification" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="http://<?= $serverName ?>/assets/images/image_modification.jpg" alt="image_modification_profil">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Modification de profil</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Vous pouvez modifier votre profil ici.</p>
        </div>
    </a>


    <a href="historique" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="http://<?= $serverName ?>/assets/images/image_historique.jpg" alt=" image_historique_achat">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Historique d'achat</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Vous pouvez voire votre historique ici.</p>
        </div>
    </a>


    <a href="panier" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="http://<?= $serverName ?>/assets/images/image_panier.jpg" alt="image_panier">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Consulter votre panier</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Vous pouvez voire votre panier ici.</p>
        </div>
    </a>
</div>