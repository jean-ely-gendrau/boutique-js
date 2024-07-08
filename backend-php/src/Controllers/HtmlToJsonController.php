<?php

namespace App\Boutique\Controllers;

use App\Boutique\Forms\FeedBackForm;
use App\Boutique\Forms\ProductsAdminForms;
use App\Boutique\Forms\UsersRegistrationForms;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;

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
   * Méthode FormUsersControl retourne un formulaire de la section transmise en arguments
   * 
   * [!>Warning] IMPLEMENTER JWT
   *
   * @param array ...$arguments Les arguments transmis à la méthode $_POST,$_GET,$render,$uri,$serverName.
   * @return string
   */
  public function FormUsersControl(...$arguments)
  {
    switch ($arguments['tableName'] ?? '') {
        /*******
       * User
       */
      case 'feedback':
        $bufferOut = ['htmlElement' => FeedBackForm::CommentRatings(...$arguments ?? [])];
        break;

      default:
        $bufferOut = 'La list est vide';
    }

    return isset($arguments['jsonFalse']) ? $bufferOut : $this->returnJson(200, $bufferOut);
  }

  /**
   * Méthode FormAdmin retourne un formulaire de la section admin
   * 
   * [!>Warning] IMPLEMENTER JWT
   *
   * @param array ...$arguments Les arguments transmis à la méthode $_POST,$_GET,$render,$uri,$serverName.
   * @return string
   */
  public function FormAdmin(...$arguments)
  {
    switch ($arguments['tableName'] ?? '') {
        /*******
       * User
       */
      case 'users':
        $bufferOut = ['htmlElement' => UsersRegistrationForms::AdminAddUser(...$arguments ?? [])];
        break;

        /*******
         * Product
         */
      case 'products':
        $bufferOut = ['htmlElement' => ProductsAdminForms::ProductsForm(...$arguments ?? [])];
        break;

      default:
        $bufferOut = 'La list est vide';
    }

    return isset($arguments['jsonFalse']) ? $bufferOut : $this->returnJson(200, $bufferOut);
  }

  /**
   * Méthode Template retourne un template du dossier template
   * 
   * [!>Warning] IMPLEMENTER JWT
   *
   * @param array ...$arguments Les arguments transmis à la méthode $_POST,$_GET,$render,$uri,$serverName.
   * @return string
   */
  public function Template(...$arguments)
  {

    switch ($arguments['pageTemplate']) {
        /*******
       * User
       */
      case 'profile':
        $crudManager = new CrudManager('users', Users::class);
        $select = $crudManager->getById($arguments['idGet']);

        $array['params'] = json_decode(json_encode($select), true);
        $array['params']['jsonFalse'] = true;
        $array['params']['tableName'] = 'users';
        $array['params']['update-user'] = true; // Paramètre pour la mise à jours (utilisé par la __CLASS__ UsersRegistrationForms::AdminAddUser )
        $bufferOut = call_user_func_array([$this, 'FormAdmin'], $array['params']);
        break;

        /*******
         * Products
         */
      case 'products':
        $crudManager = new CrudManager('products', ProductsModels::class);
        $select = $crudManager->getById($arguments['idGet']);

        $array['params'] = json_decode(json_encode($select), true);
        $array['params']['jsonFalse'] = true;
        $array['params']['tableName'] = 'products';
        $array['params']['update-product'] = true; // Paramètre pour la mise à jours (utilisé par la __CLASS__ UsersRegistrationForms::AdminAddUser )
        $bufferOut = call_user_func_array([$this, 'FormAdmin'], $array['params']);
        break;

        /*******
         * feedback
         */
      case 'feedback':
        $crudManagerComments = new CrudManager('comments', ProductsModels::class);
        $crudManagerRatings = new CrudManager('ratings', ProductsModels::class);
        //$select = $crudManagerComments->getById($arguments['idGet']);
        $array['params']['jsonFalse'] = true;
        $array['params']['tableName'] = 'feedback';
        $bufferOut = call_user_func_array([$this, 'FormUsersControl'], $array['params']);
        break;
    }

    return $this->returnJson(200, $bufferOut);
  }
}
