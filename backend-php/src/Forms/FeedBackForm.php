<?php

namespace App\Boutique\Forms;

//use App\Boutique\Models\Users;
use Motor\Mvc\Builder\FormBuilder;
use Motor\Mvc\Manager\SessionManager;
use Motor\Mvc\Validators\ValidatorJS;
use App\Boutique\Models\Special\CommentRatings;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;
use Motor\Mvc\Validators\ReflectionValidator;

class FeedBackForm
{
  /**
   * Méthode static CommentRatings
   *
   * @param array [...$arguments Les arguments transmis à la méthode suivant l'appel de call_user_func_array.]
   *
   * @return string [Le contenu généré en rendant le template 'test-render' avec les arguments fournis.]
   */
  public static function CommentRatings(...$arguments): string
  {

    $commentRatings = new CommentRatings($arguments);
    $formCommentRatings = new FormBuilder();

    // Instancier le ValidatorJS Pour les validation d'input avec Javascript
    // Verifier que vous posséder les méthode JS suivante validateRules et addAndCleanErrorHtmlMessage dans vos fichier JS
    // Si c'est méthode ne son pas présente vous ne pourrai pas valider vos input est des erreurs pourrais en résulter.
    $validatorJS = new ValidatorJS();

    // Mappage des régles de validation au champs du formulaire (ratings,comments)
    $validatorJS->addRule(
      'ratings',
      '/^(1|[1-5]|5)$/',
      'Le nombre d`\'étoiles doit être compris entre 1 et 5',
    );

    $validatorJS->addRule(
      'comments',
      '/^[\w]{2,500}$/',
      'Votre commentaire doit être compris entre 2 à 500 cratères',
    );

    // Ajout des régles de validation au formulaire
    $formCommentRatings->setValidator($validatorJS);

    /*
    * Paramètre de configuration du formulaire
    * Ce formulaire et soumis par Javascript.
    */
    $sessionManager = new SessionManager();
    $emailUser = (string) $sessionManager->give('email'); // ID DE SESSION USER
    $crudManager = new CrudManager('users', Users::class);

    $dataUser = $crudManager->getByEmail($emailUser);
    $users_id = $dataUser->getId();

    $idForm = 'feedback-form'; // ID FORM

    $actionForm = "/api/feedback-validation/{$arguments['id']}"; // ACTION
    $formCommentRatings
      ->setIdForm($idForm) // ID FORM
      ->setAction($actionForm) // ACTION -> ROUTE DE TRAITEMENT
      ->setClassForm('p-4 space-y-3 md:space-y-6') // CSS FORM
      ->addField('textarea', 'infos_name', [
        'class-label' => 'flex flex-wrap w-full sm:flex-nowrap items-center gap-3 md:gap-6',
        'text-label' => $arguments['name'],
        'disabled' => true,
        'class' =>
        'disable text-gray-900 border-0 text-sm block w-full p-2.5 dark:text-white text-wrap resize-none my-2',
        'value-area' => $arguments['description'],
        'attributes' => ['row' => '10']
      ])
      ->addField('number', 'rating', [
        'class-label-group' => 'relative flex flex-wrap text-gray-900 dark:text-white items-center gap-2',
        'indicator' => 'nombre compris entre 1 et 5',
        'class-label' => 'flex flex-wrap w-full sm:flex-nowrap items-center gap-2',
        'text-label' => '<svg class="w-4 h-4 fill-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                         </svg> <span>Quelle est la quantité d\'étoiles à attribuer à ce produit ?</span>',
        'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'required' => 1,
        'attributes' => ['value' => $commentRatings->getRating() ?? ''],
        'error-message' => $errors['ratings'] ?? false,
      ]) // CHAMPS COMMENTS
      ->addField('textarea', 'comment', [
        'class-label-group' => 'py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700',
        'text-label' => 'Commentaire',
        'class' =>
        'px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800',
        'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre commentaire',
        'required' => 1,
        'attributes' => ['value' => $commentRatings->getComment() ?? '', 'autocomplete' => 'section-blue shipping comments'],
        'error-message' => $errors['comment'] ?? false,
      ]) // CHAMPS COMMENTS
      ->addField('hidden', 'users_id', [
        'label-false' => 1,
        'attributes' => ['value' => $users_id],
      ]) // CHAMPS USERS_ID
      ->addElementAction('button', 'feedback-button-user', 'feedback-button-user', [
        'class' =>
        'flex w-full justify-center items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800',
        'anchor' => 'Valider',
        'attributes' => [
          'data-js' => 'handlePost,click',
          'data-route' => $actionForm,
          'data-id-form' => $idForm,
        ]
      ]); // BUTTON SUBMIT


    return $formCommentRatings->render();
  }
}
