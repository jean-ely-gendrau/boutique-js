<?php

/** @var \Motor\Mvc\Builder\ModalBuilder $modalFeedback */
echo $modalFeedback?->render() ?? "";
?>
<section>
  <div class="flex flex-col mx-auto text-center md:max-[55rem]">
    <div class="bg-white mx-auto rounded-lg shadow dark:border md:w-[55rem] md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-3xl my-4 text-gray-700 dark:text-gray-200">Remerciements pour votre commande chez <span class="text-green-600">Tea'</span><span class="text-amber-700">Coffee</span></h1>
        <h2 class="text-2xl mt-20 mb-4 text-gray-700 dark:text-gray-200">Cher(e) [Nom du client],</h2>
        <p class="text-start mx-20 text-gray-700 dark:text-gray-200 text-sm">Merci infiniment pour votre commande chez <span class="text-green-600">Tea'</span><span class="text-amber-700">Coffee</span> ! Nous sommes ravis de vous compter parmi nos précieux clients.</p>
        <p class="text-start mx-20 text-gray-700 dark:text-gray-200 text-sm">Votre commande a été validée avec succès et nous sommes en train de la préparer avec le plus grand soin. Vous devriez la recevoir dans les délais prévus.</p>
        <h2 class="text-2xl mt-20 mb-4 text-gray-700 dark:text-gray-200">Détails de votre commande :</h2>
        <div>
          <p class="text-start mx-20 text-gray-700 dark:text-gray-200 text-sm">Numéro de commande : #123456</p>
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3 text-center">Articles commandés</th>
                <th scope="col" class="px-6 py-3 text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($commande as $product) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td scope="col" class="px-6 py-3 text-center w-6/12">
                    <img id='<?= $product->id ?>' src='https://<?= $serverName ?>/assets/images/tea-coffee.png' alt='<?= $product->name ?>' class='w-10 h-10 mx-auto mt-2 article-image' />
                    <p id='<?= $product->id ?>' class="mx-auto mt-2 text-gray-700 dark:text-gray-200 text-sm cursor-pointer article-name"><?= $product->name ?></p>
                  </td>
                  <td scope="col" class="px-6 py-3 text-center"><?= $product->status ?></td>
                  <td>
                    <?php
                    // MODAL FEEDBACK RENDER
                    $modalFeedback->renderOpenButton('
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="https://www.w3.org/2000/svg" aria-hidden="true">
                          <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Noter le produit', [
                      'type' => 'button',
                      'class' =>
                      'flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
                      'data-js' => 'handleViewHtml,click',
                      'data-route' => "/api-html/form/feedback/{$product->id}",
                      'data-target-id' => 'body-modal-add-feedback',
                    ]);
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
          </table>
          <?php
          $totalPrice = 0;
          foreach ($commande as $price) :
            $totalPrice += $price->price;
          endforeach;
          ?>
          <h2 class="text-2xl mt-2 mb-4 text-gray-700 dark:text-gray-200">Total : <?= $totalPrice ?>€</h2>
        </div>
        <p class="text-start mx-20 text-gray-700 dark:text-gray-200 text-sm">Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter à tout moment. Notre équipe est là pour vous aider et s'assurer que votre expérience d'achat soit aussi agréable que possible.</p>
        <p class="text-start mx-20 text-gray-700 dark:text-gray-200 text-sm">Encore une fois, merci pour votre confiance en [Nom de votre entreprise]. Nous espérons que nos produits/services dépasseront vos attentes.</p>
      </div>
    </div>
  </div>
</section>