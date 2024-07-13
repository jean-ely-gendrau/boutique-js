<?php
/*
use App\Boutique\Controllers\HistoriqueController;

$clientId = 1; // replace 1 with the actual client ID



$historiqueController = new HistoriqueController();
$orders = $historiqueController->Historique($clientId); // replace $clientId with the actual client ID

*/

/** @var \Motor\Mvc\Builder\ModalBuilder $modalFeedback */
echo $modalFeedback?->render() ?? "";

?>

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-full xl:p-0 dark:bg-gray-800 dark:border-gray-700 mx-2 h-full">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-gray-500 dark:text-gray-400 text-lg md:text-xl lg:text-2xl">Historique d'achat</h1>


                <p class="text-gray-500 dark:text-gray-400 text-base md:text-lg lg:text-xl">Derniers achat</p>



                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nom du Produit</th>
                                <th scope="col" class="px-6 py-3">Adresse</th>
                                <th scope="col" class="px-6 py-3">Prix</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // var_dump($orderModel);
                            foreach ($orderModel as $order) : ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?= $productModel[$order->products_id]->name ?>
                                    </th>
                                    <td class="px-6 py-4"><?= $userModel->adress ?></td>
                                    <td class="px-6 py-4"><?= $order->price ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <?php
                                            /** @var \App\Boutique\Enum\BasketStatus $basketStatus  */
                                            $statusFormat = str_replace(' ', '_', ucwords($order->status));
                                            $icon =  $basketStatus::fromName($statusFormat);
                                            echo $icon->value;
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        // MODAL FEEDBACK RENDER
                                        echo $modalFeedback->renderOpenButton(
                                            '
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="https://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Noter le produit',
                                            [
                                                'type' => 'button',
                                                'class' =>
                                                'flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
                                                'data-js' => 'handleViewHtml,click',
                                                'data-route' => "/api-html/template/feedback/{$order->id}",
                                                'data-target-id' => 'body-modal-add-feedback',
                                            ]
                                        );
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>