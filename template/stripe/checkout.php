
    <section>
      <div class="product">
        <img src="http://<?= $serverName ?>/assets/images/<?= $product->url_image ?>" alt="The cover of Stubborn Attachments"  class="w-24" />
        <div class="description">
          <h3><?= $product->name ?></h3>
          <h5><?= $product->price ?></h5>
        </div>
      </div>
      <form action="/stripe/checkout" method="POST">
        <button type="submit" id="checkout-button">Checkout</button>
      </form>
    </section>
