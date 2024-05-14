<section class="bg-acceuil">
  <div style="backdrop-filter: blur(1px)">

    <!-- bannière carousel -->
    <?= $carousel ?>

    <!-- Appelle du render Slider -->
    <div class="block">
      <h2 class="w-9/12 text-gray-700 dark:text-gray-200 bg-gray-100 ml-10 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">
        Dernier produit de la boutique
      </h2>
      <?= $product ?>
    </div>

    <div class="block">
      <h2 class="w-9/12 text-gray-700 dark:text-gray-200 bg-gray-100 ml-10 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de café</h2>
      <?= $productsCoffee ?>
    </div>


    <div class="block">
      <h2 class="w-9/12 text-gray-700 dark:text-gray-200 bg-gray-100 ml-10 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de thé</h2>
      <?= $productsTea ?>
    </div>

  </div>
</section>