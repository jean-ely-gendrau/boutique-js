<?php
// Vérifie si le cookie 'cart' existe
if(isset($_COOKIE['cart'])) {
    // Récupère les données du cookie et les décode en tableau associatif
    $cart = json_decode($_COOKIE['cart'], true);
    // var_dump($cart[0]['name']);
    // var_dump($cart[0]['price']);
    // var_dump($cart[0]['quantity']);
    foreach($cart as $key => $value){
                            for($i=0; $i < $value['quantity']; $i++){
                                // $crudManagerOrder->CreateOrder($user->id, $value['id']);
                                var_dump($value['name']);

                            }
                        }
                        
    
  }
?>
<section class="bg-acceuil">
  <div style="backdrop-filter: blur(1px)">

    <!-- bannière carousel -->
    <?= $carousel ?>
  <div class="sm:w-full lg:max-w-6xl mx-auto">
    <!-- Appelle du render Slider -->
    <h2 class="w-64 text-gray-700 dark:text-gray-200 bg-gray-100 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">
      Dernier produit de la boutique
    </h2>
    <div class="mx-auto lg:w-fit">
      <?= $product ?>
    </div>

    <h2 class="w-64 text-gray-700 dark:text-gray-200 bg-gray-100 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de café</h2>
    <div class="mx-auto">
      <?= $productsCoffee ?>
    </div>


    <h2 class="w-64 text-gray-700 dark:text-gray-200 bg-gray-100 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de thé</h2>
    <div class="mx-auto">
      <?= $productsTea ?>
    </div>
</div>
  </div>
</section>