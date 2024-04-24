<section class="bg-acceuil">
<div style="backdrop-filter: blur(1px)">
<!-- box-shadow: 3px 3px 9px 0px gray; #808080-->
  <!-- bannière carousel -->
  <?php /** @var \App\boutique\Components\Carousel $carousel */
  echo $carousel; ?>

  <!-- Appelle du render Slider -->
  <?= $product ?>

  <div class="mx-auto flex justify-start max-w-6xl">
    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Notre sélection de café</h2>
  </div>

  <?= $productsCoffee ?>

  <div class="mx-auto flex justify-start max-w-6xl">
    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Notre sélection de thé</h2>
  </div>

  <?= $productsTea ?>
</div>
</section>