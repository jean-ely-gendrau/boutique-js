<?php

namespace App\Boutique\Controllers;

use App\Boutique\Manager\CrudManager;

/**
 * AdminPanel
 * Contrôlleur pour l'administration du site Web
 */
class AdminPanel extends CrudManager
{
  public function __construct()
  {
  }

  /**
   * Méthode Index qui affiche les variables transmises à la méthode.
   *
   * @param array ...$arguments Les arguments transmis à la méthode.
   * @return void
   */
  public function Index(...$arguments)
  {

    // Rendre le template
    $content = $arguments['render']->renderAdmin('panel', $arguments);
    return $content;
  }
}
