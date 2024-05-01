<section class="mx-auto">
    <h1>Votre Panier :</h1>
    <!-- panier -->
    <img src="http://<?= $serverName ?>/assets/images/<?= $product->url_image ?>" alt="" class="w-24">        
    <p><?php echo $product->name; ?></p>
    <p><?php echo $product->price; ?>e</p>
    <button class="bg-gray-500 w-12">
        <a href="/pay" class="text-white">Payer</a>
    </button>
</section>