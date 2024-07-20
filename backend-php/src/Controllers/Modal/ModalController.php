<?php

namespace App\Boutique\Controllers\Modal;

use Motor\Mvc\Components\Debug;
use Motor\Mvc\Builder\ModalBuilder;
use App\Boutique\Forms\UsersRegistrationForms as Users_Forms;
use App\Boutique\Models\Special\UsersConnect;

class ModalController
{
  /** @var \Motor\Mvc\Utils\Render $render*/
  protected $render;

  public function __construct()
  {
  }

  /**
   * Method modalConnect
   *
   * @return object
   */
  public function modalConnect()
  {
    $userConnect = new UsersConnect();
    $newModal = new ModalBuilder(Users_Forms::ConnectFormUsersRegistration($userConnect));
    // $newModal->setIdModal('modal-connect-form');

    return (object) ['modal' => $newModal->render(), 'buttonOpen' => $newModal->renderOpenButton('Connect')];
  }

  /**
   * Method modalCheckout
   *
   * @return object
   */
  public function modalCheckout()
  {
    $newModal = new ModalBuilder();
    $newModal
      ->setIdModal('modal-buyer-direct')
      ->addHeader('modal-content-head', '<h2>Stripe Checkout</p>')
      ->addBody(
        'modal-content-body',
        '<img class="" src="https://' . $this->render->getParams('serverName') . '/assets/images/sample/modal/checkout_stripe.png" />',
      )
      ->addFooter('modal-content-footer', 'Achat immédiat', [], 'footer');


    return (object) ['modal' => $newModal->render(), 'buttonOpen' => $newModal->renderOpenButton('Achat immédiat')];
  }

  /**
   * Method Index
   *
   * Cette méthode affiche un exemple d'implémentation de la class Modal 
   * 
   * Route: /sample-modal-viewer
   * Page : template/modal/index.php
   * 
   * 
   * @param array ...$arguments [Ici nous reçevons les arguments de la requete $_POST $_GET sous forme de tableau associatif]
   *
   * @return void
   */
  public function Index(...$arguments)
  {
    $this->render = $arguments['render'];

    // Modal Checkout
    $this->render->addParams(['modalBuyerDirect' => $this->modalCheckout()->modal, 'buttonModalBuyerDirect' => $this->modalCheckout()->buttonOpen]);

    // Modal Connect
    $modalConnect = $this->modalConnect();
    $this->render->addParams(['modalConnect' => $modalConnect->modal, 'buttonModalConnect' => $modalConnect->buttonOpen]);

    return $this->render->render('modal/index', $arguments);
  }
}
