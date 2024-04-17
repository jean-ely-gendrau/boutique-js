<!DOCTYPE html>
<html lang="fr">
<?php
// // Importez votre classe FileImportJson

// use App\Boutique\Components\FileImportJson;

// // $indexData = new FileImportJson();
// // Appelez la méthode getFile() pour récupérer les données du fichier JSON
// $indexData = FileImportJson::getFile('config/seo.fr.json', true);

// var_dump($indexData);

// // Vérifiez si la clé 'Index' existe dans les données récupérées

// // Si la clé 'Index' existe, accédez à ses valeurs
// $seoConfig = $indexData['Index'];
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="http://<?= $serverName ?>/assets/styles/global.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <title>Teacoffe</title>
  <title><?= $seoConfig->seoTitlePage
/* TITRE */
?></title>
  <meta name="description" content="<?= $seoConfig->seoDescriptionPage
/* DESCRIPTION */
?>" />
  <link rel="canonical" href="/" />
  <!-- META SEO OG  -->
  <meta property="og:image" content="<?= $seoConfig->seoUrlImage
/* Url de l'image de partage */
?>" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:image:alt" content="<?= $seoConfig->seoAltImage
/* Text Alt de l'image de partage */
?>" />
  <meta property="og:type" content="<?= $seoConfig->seoType
/* Type de contenue */
?>" />
  <meta property="og:url" content="<?= $_SERVER['SERVER_NAME']
/* Url  de la page courante */
?>" />
  <meta property="og:title" content="<?= $seoConfig->seoOgTitlePage ?? $seoConfig->seoTitlePage
/* TITRE de partage, peu être légerement différent du titre */
?>" />
  <meta property="og:description" content="<?= $seoConfig->seoOgDescriptionPage ?? $seoConfig->seoDescriptionPage
/* DESCRIPTION de partage, peu être légerement différent de la déscription */
?>" />
  <meta name="robots" content="<?= $seoConfig->seoRobotIndex
/* balise pour les robot , par défault index follow, indiqué noindex pour ne pas indexé la page, nofollow pour ne pas suivre les liens de la page, none pour tout interdire. c'est le cas de la page erreur qui ne sera ni indexer ni suivie par les robots. */
?>" />
<?php  ?>
  <link rel="icon" href="http://<?= $serverName ?>/assets/images/iconTitle.png">
</head>

<body>
  <header>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="flex items-center md:order-3 space-x-3 md:space-x-0 rtl:space-x-reverse">
          <button type="button"
            class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom">
            <span class="sr-only">Ouvrir le menu utilisateur</span>
            <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
          </button>
          <!-- Dropdown menu -->
          <div
            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
            id="user-dropdown">
            <div class="px-4 py-3">
              <span class="block text-sm text-gray-900 dark:text-white">ICI_SESSION FULLNAME</span>
              <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">ICI_SESSION_MAIL</span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
              <li>
                <a href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
              </li>
              <li>
                <a href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Commande</a>
              </li>
              <li>
                <a href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                  out</a>
              </li>
            </ul>
          </div>
          <button data-collapse-toggle="navbar-user" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-user" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15" />
            </svg>
          </button>
        </div>
        <!-- LOGO -->
        <a href="/" class="flex items-center space-x-3 md:order-2 rtl:space-x-reverse">
          <img src="http://<?= $serverName ?>/assets/images/tea-coffee.png" class="h-14" alt="TeaCoffe Logo" />
          <!--  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">TeaCoffe</span> -->
        </a>
        <!-- MENU -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
          <ul
            class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="/"
                class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                aria-current="page">Acceuil</a>
            </li>
            <li>
              <a href="/produit?cafe=cafe"
                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Café</a>
            </li>
            <li>
              <a href="/produit?the=the"
                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Thé</a>
            </li>
            <li>
              <a href="/contact"
                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>