<?php

namespace App\Boutique\Forms;

use App\Boutique\EntityManager\ProductsEntity;
use Motor\Mvc\Builder\FormBuilder;
use Motor\Mvc\Validators\ValidatorJS;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Special\CategorySubCat;
use Motor\Mvc\Manager\CrudManager;
use Motor\Mvc\Validators\ReflectionValidator;

class ProductsAdminForms
{

  /**
   * Méthode static ProductsForm
   *
   * @param array [...$arguments Les arguments transmis à la méthode suivant l'appel de call_user_func_array.]
   *
   * @return string [Le contenu généré en rendant le template 'test-render' avec les arguments fournis.]
   */
  public static function ProductsForm(...$arguments)
  {
    $formBuilderProduct = new FormBuilder();

    // Instancier le ValidatorJS Pour les validation d'input avec Javascript
    // Verifier que vous posséder les méthode JS suivante validateRules et addAndCleanErrorHtmlMessage dans vos fichier JS
    // Si c'est méthode ne son pas présente vous ne pourrai pas valider vos input est des erreurs pourrais en résulter.
    $validatorJS = new ValidatorJS();

    $modelProducts = new ProductsModels($arguments); // Instance d'un models de class User
    $crudManager = new ProductsEntity();
    $resultCategory = $crudManager->getAllCategory();
    $idCat = isset($arguments['selectCategory']) ? intval($arguments['selectCategory']) : 1;
    $resultSubCategory = $crudManager->getSubCategoryByCategoryId($idCat);

    $errors = [];
    // ReflectionValidator::validate($modelProducts)
    // Cette méthode statice de la class ReflectionValidator
    // Permet de valider les données côter backend en utilisant
    // les attributs introduit depuis php 8.*.
    // Préfixer vos propriéte dans vos class est utilisé le
    // validatorData pour créer vos Regex et réstriction sur vos valeurs.
    if (!empty($_POST) && isset($_POST['validation-product'])) {
      $errors = ReflectionValidator::validate($modelProducts);
      //DEBUG var_dump($errors);
    }

    // Mappage des régles de validation au champs du formulaire

    //    $validatorJS->addRule('email', '/^[^\s@]+@[^\s@]+\.[^\s@]+$/', "Votre adresse email n'a pas un format valide");

    // Ajout des régles de validation au formulaire
    $formBuilderProduct->setValidator($validatorJS);

    $formBuilderProduct
      ->setIdForm('admin-form-product') // ID FORM
      ->setAction('/panel-admin/products') // ACTION -> ROUTE DE TRAITEMENT
      ->setClassForm('flex flex-wrap justify-between items-center space-y-2 md:space-y-4 p-2') // CSS FORM
      ->addField('text', 'name', [
        'text-label' => 'Nom du produit',
        'class-label-group' => 'min-w-full w-full',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter le nom du produit',
        'attributes' => ['value' => $modelProducts->getName() ?? ''],
      ]) // CHAMP NAME
      ->addField('select', 'category_id', [
        'label-false' => 1,
        'class-label-group' => 'w-[calc(50%/1.2)] relative flex flex-nowrap text-gray-900 dark:text-white items-center gap-2',
        'indicator' => 'Catégorie',
        'class-indicator' => 'bg-blue-200 text-xs font-medium text-blue-800 text-center p-0.5 leading-none rounded-full px-2 dark:bg-blue-900 dark:text-blue-200 absolute translate-y-1/2 translate-x-1/2 bottom-2 right-1/2',
        'options-selected' => "{$idCat}",
        'class' => 'w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'options-select-array' => json_decode(json_encode($resultCategory), true),
        'select-array-multi' => 1,
        'options-keys' => ['keyValue' => 'id', 'keyText' => 'name'],
        'attributes' => [
          'data-js' => 'handleViewHtml,change',
          'data-route' => '/api-html/form/products',
          'data-target-id' => 'admin-form-product',
          'data-form-id' => 'admin-form-product'
        ]
      ])
      ->addField('select', 'sub_category_id', [
        'label-false' => 1,
        'class-label-group' => 'w-[calc(50%/1.2)] relative flex flex-nowrap text-gray-900 -dark:text-white items-center gap-2',
        'indicator' => 'Sous catégorie',
        'options-selected' => "1",
        'class' => 'w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'options-select-array' => json_decode(json_encode($resultSubCategory), true),
        'select-array-multi' => 1,
        'options-keys' => ['keyValue' => 'idSubCat', 'keyText' => 'nameSubCat'],
      ])
      ->addField('textarea', 'description', [
        'text-label' => 'Déscription',
        'class-label-group' => 'min-w-full w-full',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Fournir une description détaillée du produit',
        'value-area' => $modelProducts->getDescription() ?? '',
      ]) // CHAMP DESCRIPTION
      ->addField('number', 'price', [
        'text-label' => 'Prix en €',
        'class-label-group' => 'w-[calc(50%/1.2)]',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => '0,00',
        'attributes' => ['value' => $modelProducts->getPrice() ?? '', 'step' => "0.25", 'min' => "0"],
      ]) // CHAMP PRICE
      ->addField('number', 'quantity', [
        'text-label' => 'Produit en stock',
        'class-label-group' => 'w-[calc(50%/1.2)] ',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => '0',
        'attributes' => ['value' => $modelProducts->getQuantity() ?? '', 'step' => "1", 'min' => "0"],
      ]) // CHAMP NAME
      ->addField('file', 'image-main', [
        'text-label' => 'Image Principal',
        'class-label-group' => 'w-full',
        'class' =>
        'w-full block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
      ]); // CHAMP URL_IMAGE



    /**
     * Paramètrage du boutton du fomulaire Ajout/Modification de produit
     */
    $formBuilderProduct->setClassActionGroup('flex flex-wrap w-full justify-between');

    $boolUpdate = isset($arguments['update-product']);
    $parmsForm = (object) [
      'route' => $boolUpdate ? "/api/Products/{$modelProducts->getId()}" : "/api/Products",
      'name' => $boolUpdate ?  'update-product' : 'validation-product',
      'anchor' => $boolUpdate ? 'Modification produit' : 'Ajouter produit'
    ];

    $formBuilderProduct->addElementAction('button', $parmsForm->name, $parmsForm->name, [
      'class' =>
      'flex w-1/2 md:w-48 items-center justify-center p-3 truncate hover:text-clip text-sm font-medium text-gray-700 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-500 hover:underline',
      'anchor' => $parmsForm->anchor,
      'attributes' => [
        'data-js' => 'handlePost,click',
        'data-route' => $parmsForm->route,
        'data-id-form' => 'admin-form-product',
      ]
    ]); // BUTTON SUBMIT

    /**
     * Paramètrage du boutton du fomulaire Supprimer
     * Visible seulement si on souhaite modifier un profile
     */
    if (isset($arguments['update-product'])) {
      $formBuilderProduct->addElementAction('submit', 'delete-product', 'delete-product', [
        'class' =>
        'flex w-1/2 md:w-48 items-center justify-center p-3 text-red-600 dark:text-red-500 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 hover:underline',
        'anchor' => '<svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
              <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z" />
            </svg>
            <span class="truncate hover:text-clip hover:text-balance text-sm font-medium">Supprimer ' . $modelProducts->getName() . '</span>',
        'attributes' => [
          'data-js' => 'handlePost,click',
          'data-method' => 'DELETE',
          'data-route' => '/api/Products/' . $modelProducts->getId() . ''
        ]
      ]);
    }

    return $formBuilderProduct->render();
  }
}
