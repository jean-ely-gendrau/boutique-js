<?php

namespace App\Boutique\Forms;

//use App\Boutique\Models\Users;
use Motor\Mvc\Builder\FormBuilder;
//use Motor\Mvc\Manager\SessionManager;
use Motor\Mvc\Validators\ValidatorJS;
use App\Boutique\Models\Special\CommentRatings;
use Motor\Mvc\Validators\ReflectionValidator;

class FeedBackForm
{
  /**
   * Méthode static CommentRatings
   *
   * @param CommentRatings $commentRatings [$commentRatings une instance de la class CommentRatings instancié avec les données du formulaire ou vide lors de l'initialisation]
   * @param bool|string $errors [Dans le cas où des erreurs surviennent lors de la saisie des champs input]
   * @param bool $render [Par défaut **(false)** le render ce fait au moment de l'appel de la méthode dans le template, si vous deviez le rendre au moment du rendu de la méthode passée l'argument à **(true)**]
   * 
   * @return FormBuilder|string [Le contenu généré du formulaire]
   */
  public static function CommentRatings(CommentRatings $commentRatings, $errors = false, $render = false): FormBuilder|string
  {
    $formCommentRatings = new FormBuilder();

    // Instancier le ValidatorJS Pour les validation d'input avec Javascript
    // Verifier que vous posséder les méthode JS suivante validateRules et addAndCleanErrorHtmlMessage dans vos fichier JS
    // Si c'est méthode ne son pas présente vous ne pourrai pas valider vos input est des erreurs pourrais en résulter.
    $validatorJS = new ValidatorJS();

    // Mappage des régles de validation au champs du formulaire (ratings,comments)
    $validatorJS->addRule(
      'ratings',
      '/^(1|[1-5]|5)$/',
      'Votre commentaire doit être compris entre 2 à 500 cratères',
    );

    $validatorJS->addRule(
      'comments',
      '/^[\w]{2,500}$/',
      'Votre commentaire doit être compris entre 2 à 500 cratères',
    );

    // Ajout des régles de validation au formulaire
    $formCommentRatings->setValidator($validatorJS);

    $idForm = 'feedback-form';
    $actionForm = '/api/feedback-validation';
    $formCommentRatings
      ->setIdForm($idForm) // ID FORM
      ->setAction($actionForm) // ACTION -> ROUTE DE TRAITEMENT
      ->setClassForm('space-y-2 md:space-y-4') // CSS FORM
      ->addField('number', 'ratings', [
        'text-label' => '<svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                         </svg>',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'required' => 1,
        'attributes' => ['value' => $commentRatings->getRating() ?? ''],
        'error-message' => $errors['ratings'] ?? false,
      ]) // CHAMPS COMMENTS
      ->addField('text', 'comments', [
        'text-label' => 'Commentaire',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre commentaire',
        'required' => 1,
        'attributes' => ['value' => $commentRatings->getComment() ?? '', 'autocomplete' => 'section-blue shipping comments'],
        'error-message' => $errors['comment'] ?? false,
      ]) // CHAMPS COMMENTS
      ->addElementAction('button', 'connect-button-user', 'connect-button-user', [
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'anchor' => 'Notez',
        'attributes' => [
          'data-js' => 'handleSampleConnect,click',
          'data-route' => $actionForm,
          'data-id-form' => $idForm,
        ]
      ]); // BUTTON SUBMIT


    return $render === false ? $formCommentRatings : $formCommentRatings->render();
  }
}
