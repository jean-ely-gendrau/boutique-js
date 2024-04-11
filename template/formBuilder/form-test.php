<?php

$formBuilder = new App\Boutique\Builder\FormBuilder(); ?>

<!-- FORMULAIRE TEST CONENXION -->

<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Connection à votre compte
    </h1>
<?php
$formBuilder
    ->setClassForm('space-y-4 md:space-y-6')
    ->addField('email', 'email', [
        'text-label' => 'Email',
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' =>
            'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre email',
    ])
    ->addField('password', 'password', [
        'text-label' => 'Mot de passe',
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' =>
            'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre mot de pass',
    ]);

echo $formBuilder->render();
?>
</div>
</div>

<!-- FORMULAIRE TEST INSCRIPTION -->


<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Créer un compte
    </h1>

<?php
$formBuilderA = new App\Boutique\Builder\FormBuilder();

$formBuilderA
    ->addField('text', 'full_name', [
        'text-label' => 'Votre nom et prénom',
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' =>
            'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre mot de pass',
    ])
    ->addField('email', 'email', [
        'text-label' => 'Votre Email',
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' =>
            'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre email',
    ])
    ->addField('password', 'password', [
        'text-label' => 'Mot de passe',
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' =>
            'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre mot de pass',
    ])
    ->addField('password', 'passwordCompare', [
        'text-label' => 'Confirmation de mot de passe',
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'class-label' =>
            'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        'placeholder' => 'Enter votre mot de pass',
    ])
    ->addElementAction('button', 'buttonA', 'buttonA', [
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
    ])
    ->addElementAction('link', 'buttonA', 'buttonA', [
        'class' =>
            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'anchor' => 'connection',
        'attributes' => ['title' => 'connection', 'href' => '/'],
    ]);

echo $formBuilderA->render();
?>
</div>
</div>