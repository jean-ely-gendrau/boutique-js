<?php

$formBuilder = new App\Boutique\Builder\FormBuilder();

$formBuilder->addField('email', 'email', 'email', 'Email', [
    'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
    'class-label' =>
        'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
    'placeholder' => 'Enter votre email',
]);
$formBuilder->addField('password', 'password', 'password', 'Mot de passe', [
    'class' =>
        'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
    'class-label' =>
        'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
    'placeholder' => 'Enter votre mot de pass',
]);
echo $formBuilder->render();
?>
