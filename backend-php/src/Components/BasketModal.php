<?php

namespace App\Boutique\Components;

use Motor\Mvc\Builder\ModalBuilder;

class BasketModal
{

  public function render()
  {

    $basketModal = new ModalBuilder();
    $basketModal->setIdModal('modal-basket');
    $basketModal->addBody('body-modal-basket', '');
    $basketModal->addFooter('footer-modal-basket', '');
  }
}
