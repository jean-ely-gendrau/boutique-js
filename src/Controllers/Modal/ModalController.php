<?php

namespace App\Boutique\Controllers\Modal;

use Motor\Mvc\Builder\ModalBuilder;
use App\Boutique\Forms\UsersRegistrationForms as Users_Forms;

class ModalController
{
  /** @var \Motor\Mvc\Utils\Render $render*/
  protected $render;

  public function __construct()
  {
  }

  public function modalConnect()
  {
    $newModal = new ModalBuilder(Users_Forms::ConnectForm());
    $newModal->setIdModal('modal-connect-form');

    return (object) ['modal' => $newModal, 'buttonOpen' => $newModal->createOpenButton('Connect')];
  }

  public function modalCheckout()
  {
    $newModal = new ModalBuilder();
    $newModal
      ->setIdModal('modal-buyer-direct')
      ->addHeader('modal-content-head', '<h2>Stripe Checkout</p>')
      ->addBody(
        'modal-content-body',
        '<img class="" src="http://' . $this->render->getParams('serverName') . '/assets/images/sample/modal/checkout_stripe.png" />',
      )
      ->addFooter('modal-content-footer', 'Achat immédiat', [], 'footer');

    return (object) ['modal' => $newModal, 'buttonOpen' => $newModal->createOpenButton('Achat immédiat')];
  }

  public function Index(...$arguments)
  {
    $this->render = $arguments['render'];

    $this->render->addParams(['modalBuyerDirect' => $this->modalCheckout()->modal, 'buttonModalBuyerDirect' => $this->modalCheckout()->buttonOpen]);
    $this->render->addParams(['modalConnect' => $this->modalConnect()->modal, 'buttonModalConnect' => $this->modalConnect()->buttonOpen]);
    /*
             $this->render->addParams('modalBuyerDirect', $this->modalCheckout()->modal);
        $this->render->addParams('modalConnect', $this->modalConnect()->modal);
        $this->render->addParams('buttonModalConnect', $this->modalConnect()->buttonOpen);
        $this->render->addParams('buttonModalBuyerDirect', $this->modalCheckout()->buttonOpen);
*/
    return $this->render->render('modal/index', $arguments);
  }
}
