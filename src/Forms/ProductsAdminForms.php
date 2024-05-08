<?php

namespace App\Boutique\Forms;

use Motor\Mvc\Builder\FormBuilder;
use Motor\Mvc\Validators\ValidatorJS;

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

    // Mappage des régles de validation au champs du formulaire

    //    $validatorJS->addRule('email', '/^[^\s@]+@[^\s@]+\.[^\s@]+$/', "Votre adresse email n'a pas un format valide");

    // Ajout des régles de validation au formulaire
    $formBuilderProduct->setValidator($validatorJS);

    $formBuilderProduct
      ->setIdForm('admin-form-product') // ID FORM
      ->setAction('/panel-admin/products') // ACTION -> ROUTE DE TRAITEMENT
      ->setClassForm('space-y-2 md:space-y-4 p-2') // CSS FORM
      ->addField('text', 'name', [
        'text-label' => 'Nom du produit',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter le nom du produit',
      ]) // CHAMP NAME
      ->addField('textarea', 'description', [
        'text-label' => 'Déscription',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Fournir une description détaillée du produit',
      ]) // CHAMP DESCRIPTION
      ->addField('number', 'price', [
        'text-label' => 'Prix en €',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => '0,00',
      ]) // CHAMP PRICE
      ->addField('number', 'quantity', [
        'text-label' => 'Nom du produit',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => '0',
      ]) // CHAMP NAME
      ->addField('file', 'image-main', [
        'text-label' => 'Image Principal',
        'class' =>
        'block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
      ]) // CHAMP NAME
      ->addElementAction('button', 'admin-product', 'admin-product', [
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'anchor' => 'Ajouter produit',
        'attributes' => [
          'data-js' => 'handleSampleConnect,click',
          'data-route' => '/sample-connect-js',
          'data-id-form' => 'sample-form-connect',
        ]
      ]); // BUTTON SUBMIT

    return $formBuilderProduct->render();
  }
}
