<?php
/*
use App\Boutique\Controllers\HistoriqueController;

$clientId = 1; // replace 1 with the actual client ID



$historiqueController = new HistoriqueController();
$orders = $historiqueController->Historique($clientId); // replace $clientId with the actual client ID

*/

/** @var \Motor\Mvc\Builder\ModalBuilder $modalFeedback */
echo $modalFeedback?->render() ?? "";

//DEBUG echo '<pre>',  var_dump($productModel), '</pre>'
?>

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:w-full xl:p-0 dark:bg-gray-800 dark:border-gray-700 mx-2 h-full">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-gray-500 dark:text-gray-400 text-lg md:text-xl lg:text-2xl">Historique d'achat</h1>


                <p class="text-gray-500 dark:text-gray-400 text-base md:text-lg lg:text-xl">Derniers achat</p>



                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nom du Produit</th>
                                <th scope="col" class="px-6 py-3">Quantité</th>
                                <th scope="col" class="px-6 py-3 hidden md:md:table-cell">Adresse</th>
                                <th scope="col" class="px-6 py-3">Prix</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-9 py-3">Date</th>
                                <th scope="col" class="px-12 py-3">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // var_dump($orderModel);
                            foreach ($orderModel as $order) :
                            ?>
                                <tr id="<?= $order->id ?>" class="produit bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="flex flex-wrap px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white gap-2 md:gap-4">
                                        <h3 class="flex flex-col justify-evenly gap-2 md:gap-4">
                                            <?= $productModel[$order->products_id]->name ?>
                                            <span id="<?= $productModel[$order->products_id]->average_rating ?>" class="rating flex space-x-2 mt-4 m-auto">
                                                <svg id="score1" class="w-3 md:w-4 xl:w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                                                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                                </svg>
                                                <svg id="score2" class="w-3 md:w-4 xl:w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                                                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                                </svg>
                                                <svg id="score3" class="w-3 md:w-4 xl:w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                                                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                                </svg>
                                                <svg id="score4" class="w-3 md:w-4 xl:w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                                                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                                </svg>
                                                <svg id="score5" class="w-3 md:w-4 xl:w-5 fill-[#CED5D8] dark:fill-gray-900" viewBox="0 0 14 13" fill="none" xmlns="https://www.w3.org/2000/svg">
                                                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                                </svg>
                                            </span>
                                        </h3>
                                        <img src="https://placehold.co/155x75?font=lora&text=<?= $statusFormat = str_replace(' ', '-', ucwords($productModel[$order->products_id]->name)); ?>" alt="image du produit: <?= $productModel[$order->products_id]->name ?>" />
                                    </th>
                                    <td class="px-6 py-4"><?= $productModel[$order->products_id]->quantity ?></td>
                                    <td class="px-6 py-4 hidden md:md:table-cell"><?= $userModel->adress ?></td>
                                    <td class="px-6 py-4"><?= $productModel[$order->products_id]->price ?> €</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center ml-3 mb-2">
                                            <?php
                                            /** @var \App\Boutique\Enum\BasketStatus $basketStatus  */
                                            $statusFormat = str_replace(' ', '_', ucwords($order->status));
                                            $colorsStatus = (object)['En_Attente' => 'yellow', "Expedier" => "Indigo", "Livrer" => "green", "Echec" => "red"];
                                            $cssStatus = "bg-{$colorsStatus->$statusFormat}-100 text-{$colorsStatus->$statusFormat}-800 text-xs text-nowrap font-medium px-1  md:px-2.5 py-0.5 rounded-full dark:bg-{$colorsStatus->$statusFormat}-900 dark:text-{$colorsStatus->$statusFormat}-300";
                                            $icon =  $basketStatus::fromName($statusFormat);
                                            echo $icon->value;
                                            ?>
                                        </div>
                                        <span class="<?= $cssStatus ?>"><?= $order->status ?></span>
                                    </td>
                                    <?php //DATE ORDER 
                                    ?>
                                    <td class="px-6 py-4">
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500 ">
                                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                            </svg>
                                            <?= $order::formatCreated_at($order->created_at) ?>
                                        </span>
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
                                                'flex items-center justify-center px-2 md:px-4 py-2 truncate md:text-clip text-[0.7em] md:text-sm xl:text-base md:font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
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