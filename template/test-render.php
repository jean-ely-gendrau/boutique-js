
<main class="bg-acceuil">

  <!------------------- Image de banière ----------------------------->
  <div class="max-h-[35rem]">
    <img src="http://<?= $serverName ?>/assets/images/TotalBanner.jpg" alt="image de présentation de la boutique"
      class="mx-auto rounded-3xl mt-20" />
    <div class="flex flex-column -translate-y-48 justify-evenly">
      <div class="translate-x-[-300px] translate-y-[-250px] fixed bg-gray-100 p-4 rounded-[40px]">
        <img src="http://<?= $serverName ?>/assets/images/logo.png" alt="logo de la boutique" class="" />
      </div>
      <div class="bg-gray-100 p-4 w-[600px] rounded-[40px] translate-x-64">
        <p class="text-2xl">Découvrez l'excellence chez Tea'Coffee :</p>
        <p class="text-2xl text-center">Une sélection exquise de café et de thé pour</p>
        <p class="text-2xl text-end">des moments de dégustation inoubliables.</p>
      </div>
    </div>
  </div>

    <div class="mx-auto flex justify-start max-w-6xl">
    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Dernier produit de la boutique</h2>
  </div>
    <!-- Appelle du render HorizontalSelector -->
    <?= $product ?>

    <div class="mx-auto flex justify-start max-w-6xl">
    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Notre sélection de thé</h2>
  </div>

    <?= $productsTea ?>
    
</main>
