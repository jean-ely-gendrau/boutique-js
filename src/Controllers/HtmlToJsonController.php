<?php

namespace App\Boutique\Controllers;

use App\Boutique\Forms\ProductsAdminForms;

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
   * @return void
   */
  protected function returnJson(int $codeHTTP, mixed $data): void
  {
    header('Content-type: application/json; charset=utf-8');
    http_response_code($codeHTTP);
    echo json_encode($data);
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
        return $this->returnJson(200, ProductsAdminForms::ProductsForm());

        /*******
         * Product
         */
      case 'users':
        //ProductsAdminForms::ProductsForm();
        break;
    }
  }
}
