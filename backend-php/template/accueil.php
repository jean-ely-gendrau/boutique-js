<section class="bg-acceuil">
  <div style="backdrop-filter: blur(1px)">
    <h1>Kikou</h1>
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