<?php

namespace App\Boutique\Controllers;

use App\Boutique\Forms\ProductsAdminForms;
use App\Boutique\Forms\UsersRegistrationForms;

/**
 */
class HtmlToJsonController
{
  public function __construct()
  {
  }

  /**
   * Method returnJson
   *
   * @param int $codeHTTP [code de la réponse http]
   * @param mixed $data [les données à transmettre dans le corp du body]
   *
   * @return string
   */
  protected function returnJson(int $codeHTTP, mixed $data): string
  {
    header('Content-type: application/json; charset=utf-8');
    http_response_code($codeHTTP);
    return json_encode($data);
  }

  /**
   * Méthode FormAdmin retourne un formulaire de la section admin
   * 
   * [!>Warning] IMPLEMENTER JWT
   *
   * @param array ...$arguments Les arguments transmis à la méthode $_POST,$_GET,$render,$uri,$serverName.
   * @return void
   */
  public function FormAdmin(...$arguments)
  {

    switch ($arguments['tableName']) {
        /*******
       * User
       */
      case 'users':
        $returnJson = ['htmlElement' => UsersRegistrationForms::AdminAddUser()];
        break;

        /*******
         * Product
         */
      case 'products':
        $returnJson = ['htmlElement' => ProductsAdminForms::ProductsForm()];
        break;
    }

    return $this->returnJson(200, $returnJson);
  }
}
