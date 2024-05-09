<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="http://<?= $serverName ?>/assets/styles/global.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <title>Teacoffe</title>
  <title>
    <?= $seoConfig->seoTitlePage;
    /* TITRE */
    ?>
  </title>
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

<body class="flex flex-col space-y-5 bg-gray-50 dark:bg-gray-900">
  <header>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex font-medium md:justify-end items-center md:order-3 space-x-3 rtl:space-x-reverse md:w-72 lg:w-80">
          <button type="button" class="rounded-full fill-gray-700 stroke-white dark:fill-white dark:stroke-gray-900 h-6 w-6 md:h-7 md:w-7 lg:h-8 lg:w-8 2xl:h-9 2xl:w-9 mx-2" data-js="darkSwitch,click">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M18 2.75C17.5858 2.75 17.25 2.41421 17.25 2C17.25 1.58579 17.5858 1.25 18 1.25H22C22.3034 1.25 22.5768 1.43273 22.6929 1.71299C22.809 1.99324 22.7449 2.31583 22.5304 2.53033L19.8107 5.25H22C22.4142 5.25 22.75 5.58579 22.75 6C22.75 6.41421 22.4142 6.75 22 6.75H18C17.6967 6.75 17.4232 6.56727 17.3071 6.28701C17.191 6.00676 17.2552 5.68417 17.4697 5.46967L20.1894 2.75H18ZM13.5 8.75C13.0858 8.75 12.75 8.41421 12.75 8C12.75 7.58579 13.0858 7.25 13.5 7.25H16.5C16.8034 7.25 17.0768 7.43273 17.1929 7.71299C17.309 7.99324 17.2449 8.31583 17.0304 8.53033L15.3107 10.25H16.5C16.9142 10.25 17.25 10.5858 17.25 11C17.25 11.4142 16.9142 11.75 16.5 11.75H13.5C13.1967 11.75 12.9232 11.5673 12.8071 11.287C12.691 11.0068 12.7552 10.6842 12.9697 10.4697L14.6894 8.75H13.5Z"></path>
                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 11.5373 21.3065 11.4608 21.0672 11.8568C19.9289 13.7406 17.8615 15 15.5 15C11.9101 15 9 12.0899 9 8.5C9 6.13845 10.2594 4.07105 12.1432 2.93276C12.5392 2.69347 12.4627 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"></path>
              </g>
            </svg>
          </button>
          <?php
          $result = $rendering->give('isConnected') ? true : false;
          if ($result) {
            echo '<button type="button"
            class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom">
            <span class="sr-only">Ouvrir le menu utilisateur</span>
            <p class="text-white p-1 w-8 h-8 flex items-center justify-center rounded-full font-bold">' .
              $rendering->give('full_name')[0] .
              '</p>
          </button>
          <!-- Dropdown menu -->
          <div
            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
            id="user-dropdown">
            <div class="px-4 py-3">
              <span class="block text-sm text-gray-900 dark:text-white">' .
              $rendering->give('full_name') .
              '</span>
              <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">' .
              $rendering->give('email') .
              '</span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
              <li>
                <a href="/user"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
              </li>
              <li>
                <a href="/panier"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Commande</a>
              </li>
              <li>
                <a href="/deconnexion"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                  out</a>
              </li>
            </ul>
          </div>';
          } else {
            echo '<svg viewBox="0 0 24 24" class="rounded-full fill-gray-700 stroke-white dark:fill-white dark:stroke-gray-900 h-6 w-6 md:h-7 md:w-7 lg:h-8 lg:w-8 2xl:h-10 2xl:w-10" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9ZM12 20.5C13.784 20.5 15.4397 19.9504 16.8069 19.0112C17.4108 18.5964 17.6688 17.8062 17.3178 17.1632C16.59 15.8303 15.0902 15 11.9999 15C8.90969 15 7.40997 15.8302 6.68214 17.1632C6.33105 17.8062 6.5891 18.5963 7.19296 19.0111C8.56018 19.9503 10.2159 20.5 12 20.5Z"></path> </g></svg>
              <div class="flex flex-nowrap md:space-x-1">
                <a href="/inscription" class="block py-2 px-1 md:px-2 text-xs md:text-sm lg:text-base 2xl:text-lg text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Inscription</a>
                <a href="/connexion" class="block py-2 px-1 md:px-2 text-xs md:text-sm lg:text-base 2xl:text-lg text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Connexion</a>
              </div>';
          }
          ?>

        </div>
        <!-- LOGO -->
        <a href="/" class="flex items-center space-x-3 md:order-2">
          <img src="http://<?= $serverName ?>/assets/images/tea-coffee.png" class="h-10 md:h-12 lg:h-14 xl:h-16" alt="TeaCoffe Logo" />
          <!--  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">TeaCoffe</span> -->
        </a>
        <!-- BUTTON MENU -->
        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
        <!-- MENU -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
          <ul class="flex flex-col font-medium text-xs md:text-sm lg:text-base 2xl:text-lg md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="/" class="block py-2 px-2 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Acceuil</a>
            </li>
            <li>
              <a href="/produit/1" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Café</a>
            </li>
            <li>
              <a href="/produit/2" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Thé</a>
            </li>
            <li>
              <a href="/contact" class="block py-2 px-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- START MAIN -->
  <main id="content-main" class="flex flex-col mx-2 space-y-4 md:mx-auto md:gap-y-3 lg:gap-y-4  min-h-main w-full">