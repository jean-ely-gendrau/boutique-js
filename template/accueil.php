<section class="bg-acceuil">
  <div style="backdrop-filter: blur(1px)">

    <!-- bannière carousel -->
    <?= $carousel ?>

    <!-- Appelle du render Slider -->
    <div class="mt-4 mx-auto flex justify-start max-w-6xl">
      <h2 class="bg-gray-100 ml-10 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">
        Dernier produit de la boutique
      </h2>
    </div>
    <?= $product ?>

    <div class="mx-auto flex justify-start max-w-6xl">
      <h2 class="bg-gray-100 ml-10 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de café</h2>
    </div>

    <?= $productsCoffee ?>

    <div class="mx-auto flex justify-start max-w-6xl">
      <h2 class="bg-gray-100 ml-10 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de thé</h2>
    </div>

    <?= $productsTea ?>
  </div>
</section>